<?php
require_once(dirname(__FILE__).'/../../config.php');

// Page properties.
define('TITLE', 'titleNewsGeelyPage');
define('DESCRIPTION', 'metaDescriptionNewsGeelyPage');
define('KEYWORDS', 'metaKeywordsNewsGeelyPage');
define('FILE', __FILE__);
define('META', [
  ['property' => 'og:image', 'content' => URL('img/news/geely_collecting_telemetry.jpg')],
  ['property' => 'og:image:width', 'content' => '1999'],
  ['property' => 'og:image:height', 'content' => '1500'],
]);

HTML_HEAD(); ?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <?php IncludeContent('belgee-geely') ?>
  </section>
</main>
<?php HTML_ASIDE(); ?>
<?php HTML_FOOTER(); ?>

</body>
</html>
