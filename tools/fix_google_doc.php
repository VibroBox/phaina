#!/usr/bin/php
<?php

include(dirname(__FILE__).'/../include/strings.php');
include('IRI.php');

// Check if script is included by unit tests.
if (!isset($argv))
  return;

if (count($argv) < 3) {
  echo "This script cleans up and fixes html document exported from Google Docs.\n";
  echo "NOTE: you should have tidy-html5 installed in your PATH.\n";
  echo "See more details at https://github.com/htacg/tidy-html5\n\n";
  echo "Usage: ${argv[0]} <html_from_google_docs> <out_clean_html> [optional_path_to_tidy_binary]\n";
  exit(1);
}

const UGLY_ID_PATTERN = '/(h|id|kix)\.[\w-]+/';

$html = file_get_contents($argv[1]);
if ($html === false)
  die("ERROR: Can't open file $argv[1].");

// Tidy removes empty <span>s, so &nbsp; replacement should be done before tidy.
$count = ReplaceInvalidNbsp($html);
if ($count)
  echo "* Replaced $count incorrect &nbsp; randomly inserted by Google Docs after <span> tags.\n\n";

$doc = CreateDOMDocument($html);
MoveIdsFromEmptyATags($doc);
$html = $doc->saveHTML();

// Html exported from GDocs can be malformed. Fix it before processing with DOMDocument.
echo "* Launching tidy-html5 to fix non-closed <p> tags...\n";
RunTidy("-utf8 -q --preserve-entities yes --logical-emphasis yes --anchor-as-name no -w 0 -gdoc", $html);

$doc = CreateDOMDocument($html);
$count = FixImages($doc);
if ($count)
  echo "* Fixed $count images.\n\n";

foreach (StripCommentsAndFixLinks($doc) as $result)
  echo $result;

// Collect all IDs randomly generated by Google to make them prettier later.
$links = GetUglyIDs($doc);

$html = $doc->SaveHTML();

// Replace ugly IDs with `cleaner` version.
$count = ReplaceUglyIDs($html, $links);
if ($count)
  echo "* Replaced $count randomly generated IDs with their prettier versions.\n";

// Further document cleanup and extraction of <body>'s content.
echo "* Launching tidy-html5 again to do all the dirty work...\n";
// After this call $html has only <body> content.
RunTidy("-utf8 -q -indent --fix-uri no --show-body-only yes -w 0", $html);

// Use international IRIs instead of URLs in the final document (HTML5 allows it).
// It makes much easier to compare diffs and do code review.
$count = ReplacePattern(
    '/href="(.*)"/Ui',
    $html,
    function ($uri) {
      return (new SimplePie_IRI($uri))->get_iri();
    },
    function ($uri) {
      // Ignore local document links like #h1.abcdef.
      if ($uri[0] == '#')
        return false;
      // Filter URIs which do not contain any non-ASCII characters.
      return $uri != (new SimplePie_IRI($uri))->get_iri();
    });
echo "* Replaced $count non-ASCII URIs to IRIs.\n\n";

// Remove references to gdocs pages from contents.
$html = preg_replace('| (&nbsp;)\1*<a href=".*">[0-9]+</a>|', '', $html, -1, $count);
if ($count)
  echo "* Removed $count references to pages from contents.\n\n";

foreach (ImprovePunctuation($html) as $result)
  echo $result;

foreach (ImgToFigures($html) as $result)
  echo $result;

if (false === file_put_contents($argv[2], $html))
  echo "ERROR while saving processed html to ${argv[2]}\n";

///////////////////////////////////////////////////////////////////////////////

function ReplaceInvalidNbsp(&$html) {
  $html = str_replace('>&nbsp;', '> ', $html, $count);
  return $count;
}

// Replaces space with &nbsp; before em dash.
function ImprovePunctuation(&$html) {
  // Use UTF-8 em dash.
  $html = str_ireplace('&mdash;', '—', $html, $count);
  if ($count)
    $results[] = "* Replaced $count &mdash; with `—`.\n";
  // Use UTF-8 non-breaking space.
  $html = str_ireplace('&nbsp;', ' ', $html, $count);
  if ($count)
    $results[] = "* Replaced $count &nbsp; with ` ` (non-breaking space in UTF-8).\n";
  // Insert non-breaking space before em dash.
  $html = str_replace(' —', ' —', $html, $count);
  if ($count)
    $results[] = "* Replaced $count spaces before em-dash to non-breaking spaces.\n";
  return $results;
}

function FixImages(&$domDocument) {
  // Remove hardcoded css styles for each <img> tag.
  $count = StripAttributes($domDocument, 'img', 'style');
  if ($count)
    echo "* Stripped $count `style` attributes from <img> tags.\n";

  // Copy <img> `title` attribute to the `alt` attribute if it is empty.
  foreach ($domDocument->getElementsByTagName('img') as $img) {
    if (empty($img->getAttribute('alt'))) {
      $img->setAttribute('alt', $img->getAttribute('title'));
    }
  }
}

function StripCommentsAndFixLinks(&$domDocument) {
  $redirects = 0;
  $nodesToRemove = array();
  foreach ($domDocument->getElementsByTagName('a') as $a) {
    $href = $a->getAttribute('href');
    // Some <a> from google gocs can have only id attributes.
    if (empty($href))
      continue;
    // Fix google redirects.
    if (0 === strpos($href, 'https://www.google.com/url?q=')) {
      $query = parse_url($href, PHP_URL_QUERY);
      parse_str($query, $query);
      $a->setAttribute('href', $query['q']);
      $a->setAttribute('target', '_blank');
      ++$redirects;
    } else if (0 === strpos($href, '#cmnt_ref')) {
      // Strip comments <div><p><a>.
      $nodesToRemove[] = $a->parentNode->parentNode;
    } else if (0 === strpos($href, '#cmnt')) {
      // Strip references to comments <sup><a>.
      $nodesToRemove[] = $a->parentNode;
    }
  }
  // Remove nodes in the separate foreach to avoid undefined behavior if we do it in above foreach.
  foreach ($nodesToRemove as $node)
    $node->parentNode->removeChild($node);

  $results = [];
  if ($redirects)
    $results[] = "* $redirects google redirects were fixed.\n";
  $commentsAndRefs = count($nodesToRemove);
  if ($commentsAndRefs)
    $results[] = "* $commentsAndRefs comments and references were removed\n";
  return $results;
}

function ImgToFigures(&$html) {
  // Change <p> to <figure> for <img> tags.
  $fixed = preg_replace('|<p><img (.+)></p>|U', '<figure><img $1></figure>', $html, -1, $count);
  if ($count == 0)
    return [];
  $results[] = "* Converted $count <img> to <figure>.\n";

  // Replaces <figure><img></figure><p>Image Caption</p>
  // to <figure><img><figcaption>Image Caption</figcaption></figure>
  // NOTE: The code below is useful only if after every image there is a paragraph describing it.
  // NOTE: `s` (PCRE_DOTALL) modifier should be added to match \n with a dot.
  $fixed = preg_replace('|</figure>\s*<p>(.+)</p>|Us', '<figcaption>$1</figcaption></figure>', $fixed, -1, $count);
  if ($count)
    $results[] = "* Created $count <figcaption> from <p> following <figure>.\n";

  $html = $fixed;
  return $results;
}

function RenameTags(&$domDocument, $tag, $newTagName) {
  $count = 0;
  $tagsToRename = $domDocument->getElementsByTagName($tag);
  while ($tagsToRename->length) {
    $old = $tagsToRename->item(0);
    $new = $domDocument->createElement($newTagName);

    while ($old->hasChildNodes()) {
      $child = $old->childNodes->item(0);
      $child = $domDocument->importNode($child, true);
      $new->appendChild($child);
    }
    foreach ($old->attributes as $attr)
      $new->setAttribute($attr->nodeName, $attr->nodeValue);

    $old->parentNode->replaceChild($new, $old);
    ++$count;
  }
  return $count;
}

function StripAttributes(&$domDocument, $tags, $attributes) {
  $strippedCount = 0;
  foreach (is_array($tags) ? $tags : array($tags) as $tag) {
    foreach (is_array($attributes) ? $attributes : array($attributes) as $attr) {
      foreach ($domDocument->getElementsByTagName($tag) as $t) {
        if ($t->removeAttribute($attr))
          ++$strippedCount;
      }
    }
  }
  return $strippedCount;
}

function GetUglyIDs($domDocument) {
  $results = [];
  foreach ($domDocument->getElementsByTagName('*') as $el) {
    if (!$el->hasAttribute('id'))
      continue;
    $value = $el->getAttribute('id');
    if (preg_match(UGLY_ID_PATTERN, $value)) {
      $results[$value] = $el->nodeValue;
    }
  }
  return $results;
}

function ReplaceUglyIDs(&$html, $idsAndTexts) {
  if (empty($idsAndTexts))
    return 0;

  // All generated IDs should be unique.
  // But this code is not needed because tidy (which is launched later) fixes it in a much cleaner way.
  // $duplicatesToFix = array_diff_key($idsAndTexts, array_unique($idsAndTexts));
  // if (array_walk($duplicatesToFix, function(&$value, $key) { $value = $value . strstr($key, '.'); }))
  //   $idsAndTexts = array_replace($idsAndTexts, $duplicatesToFix);

  foreach ($idsAndTexts as $id => $text)
    $idsAndTexts[$id] = MakePrettyLink($text);
  $html = str_replace(array_keys($idsAndTexts), array_values($idsAndTexts), $html, $count);

  return $count;
}

function RunTidy($params, &$text) {
  global $argv;
  if (isset($argv[3])) $tidy = $argv[3];
  else $tidy = 'tidy';
  $ret = RunCmdStdinStdout($tidy . ' ' . $params, $text);
  switch ($ret) {
    case 0:  echo "* Done.\n\n"; break;
    case 1:  echo "* Done with some warnings.\n\n"; break;
    case 2:  echo "* Tidy has encountered errors while processing html.\n\n"; break;
    case -1:
    case 127: echo "* ERROR: `$tidy` has not been found.\n\n"; exit(-1);
    default: echo "* Unknown return code $ret.\n\n"; break;
  }
}

// Pipes $text to $cmd stdin.
// Returns $cmd exit code and $text contains $cmd's stdout.
function RunCmdStdinStdout($cmd, &$text) {
  $process = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['pipe', 'w']], $pipes);
  if (!is_resource($process))
    die("ERROR launching `$cmd`.\n");
  fwrite($pipes[0], $text);
  fclose($pipes[0]);
  $text = stream_get_contents($pipes[1]);
  fclose($pipes[1]);
  return proc_close($process);
}

// Handle situation when empty <a> tag was inserted before tag with content.
function MoveIdsFromEmptyATags(&$domDocument) {
  foreach ($domDocument->getElementsByTagName('a') as $a) {
    if (!$a->hasAttribute('id') || !empty($a->textContent))
      continue;

    $id = $a->getAttribute('id');
    if (preg_match(UGLY_ID_PATTERN, $id)) {
      $s = $a->nextSibling;

      // Content tag should not have id and should have content.
      if (!$s->hasAttribute('id') && !empty($s->textContent)) {
        $s->setAttribute('id', $id);
        $a->removeAttribute("id");
      }
    }
  }
}

function CreateDOMDocument($html) {
  $doc = new DOMDocument();
  $doc->preserveWhiteSpace = false;
  $doc->loadHTML($html);

  return $doc;
}
