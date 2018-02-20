<?php
function PageFile() {
  if (!defined('FILE'))
    die("Please add `define('FILE', __FILE__);` in your rendered page.\n");
  
  // TODO: Add support for php files in subdirectories.
  // Did not invent better solution how to identify that news page (php files in subdirectories) should be highlighted in main menu.
  if (defined('FILE_ID'))
    return FILE_ID;

  return basename(FILE);
}

function ExtractLinkFromPage($pageFile) {
  if ($pageFile == 'index.php')
    return '';  // Empty link means a root index page.
  // Retrieve link directly from specified php file.
  $regex = '|[^/][^/] *define *\([\'"]LINK[\'"] *, *[\'"](.*)[\'"]\)|U';
  $content = file_get_contents(dirname(__FILE__).'/../www/'.$pageFile);
  if (preg_match($regex, $content, $match))
    return $match[1];
  // Use page file without extension as a link.
  if (EndsWith($pageFile, '.php'))
    return substr($pageFile, 0, -4);

  return $pageFile;
}

// TODO: Support localized (translated) links.
function PageLink() {
  if (defined('LINK'))
    return LINK;
  // TODO: Correctly support pages in subfolders.
  $file = PageFile();
  if ($file == 'index.php')
    return '';  // Empty link means a root index page.

  // Generate page link address from the current (php) file name without extension.
  return MakePrettyLink(substr($file, 0, strrpos($file, '.')));
}

function PageTitle() {
  if (defined('TITLE'))
    return T(TITLE);

  die("Please define page's TITLE.\n");
}

function PageDescription() {
  if (defined('DESCRIPTION'))
    return T(DESCRIPTION);

  return T(DEFAULT_META_DESCRIPTION);
}

function PageKeywords() {
  if (defined('KEYWORDS'))
    return T(KEYWORDS);

  return T(DEFAULT_META_KEYWORDS);
}

// Returns an array of links to page's CSS files.
function PageCSS() {
  if (!defined('CSS'))
    return [];

  if (is_array(CSS))
    return CSS;
  return [CSS];
}

// Returns an array of links to page's JavaScript files.
function PageJS() {
  if (!defined('JS'))
    return [];

  if (is_array(JS))
    return JS;
  return [JS];
}

function PageCustomMeta() {
  if (!defined('META'))
    return [];
  return META;
}

?>
