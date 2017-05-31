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

  <link rel="stylesheet" type="text/css" href="<?= URL('css/style.css') ?>">

  <!-- Favicon section. -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= URL('apple-touch-icon-57x57.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= URL('apple-touch-icon-60x60.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= URL('apple-touch-icon-72x72.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= URL('apple-touch-icon-76x76.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= URL('apple-touch-icon-114x114.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= URL('apple-touch-icon-120x120.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= URL('apple-touch-icon-144x144.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= URL('apple-touch-icon-152x152.png?v=4') ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= URL('apple-touch-icon-180x180.png?v=4') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= URL('favicon-32x32.png?v=4') ?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?= URL('android-chrome-192x192.png?v=4') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= URL('favicon-16x16.png?v=4') ?>">
  <link rel="manifest" href="<?= URL('manifest.json?v=4') ?>">
  <link rel="mask-icon" href="<?= URL('safari-pinned-tab.svg?v=4') ?>" color="#5bbad5">
  <link rel="shortcut icon" href="<?= URL('favicon.ico?v=4') ?>">
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="msapplication-TileImage" content="<?= URL('mstile-144x144.png?v=4') ?>">
  <meta name="theme-color" content="#ffffff">

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
