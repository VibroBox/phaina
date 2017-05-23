<!DOCTYPE html>
<html lang="<?= LANG ?>">
<head>
  <title><?= PageTitle() ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="copyright" content="<?= T('copyright') ?>">
  <meta name="description" content="<?= PageDescription() ?>">
  <meta name="keywords" content="<?= PageKeywords() ?>">

  <?php foreach (PageCustomMeta() as $meta) : ?>
  <meta <?php foreach ($meta as $attr => $val) echo "$attr=\"$val\" "; ?>>
  <?php endforeach; ?>

  <link rel="icon" type="image/x-icon" href="<?= URL('favicon.ico') ?>?">
  <link rel="stylesheet" type="text/css" href="<?= URL('css/style.css') ?>">

  <?php if (count(LANG_SITES) > 1) : // The first site/language is used as a default one. ?>
  <link href="<?= URLTo(PageLink(), LANG_SITES[array_keys(LANG_SITES)[0]]) ?>" hreflang="x-default" rel="alternate">
  <?php foreach (LANG_SITES as $lang => $baseUrl) : ?>
  <link href="<?= URLTo(PageLink(), $baseUrl) ?>" hreflang="<?= $lang ?>" rel="alternate">
  <?php endforeach; endif; ?>

  <?php foreach (PageCSS() as $url) : ?>
  <link rel="stylesheet" type="text/css" href="<?= $url ?>">
  <?php endforeach; ?>

  <!-- TODO: Move external JS scripts to the footer. -->
  <?php foreach (PageJS() as $url) : ?>
  <script defer type="text/javascript" src="<?= $url ?>">
  <?php endforeach; ?>
</head>
