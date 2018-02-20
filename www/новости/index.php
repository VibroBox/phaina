<?php
require_once(dirname(__FILE__).'/../../config.php');

// Page properties.
define('TITLE', 'titleNewsPage');
define('DESCRIPTION', 'metaDescriptionNewsPage');
define('KEYWORDS', 'metaKeywordsNewsPage');
define('FILE', __FILE__);
define('FILE_ID', '/новости/index.php');
define('META', [
  ['property' => 'og:image', 'content' => URL('img/meta/VibroBox_and_vibration_sensor.jpg')],
  ['property' => 'og:image:width', 'content' => '1200'],
  ['property' => 'og:image:height', 'content' => '700'],
]);

HTML_HEAD();
$news = [[
  'img' => 'img/news-'.LANG.'/geely/image3.jpg',
  'title' => 'titleNewsGeelyPage',
  'description' => 'descriptionForNewsGeelyPage',
  'url'=> '/новости/испытания-вибродиагностики-vibrobox-на-предприятии-по-производству-автомобилей-geely-в-беларуси'],
];
?>

<body class="page__news">

<?php HTML_HEADER(); ?>

<main role="main"  class="main__news">
  <section class="section">
    <h1><?= T('titleNewsPage') ?></h1>
    <div class="content content__news">
      <?php foreach ($news as $n) : ?>
      <div class="news-article">
        <img class="news-article__img" src="<?= URL($n['img']) ?>" alt="<?= $n['title'] ?>" title="<?= $n['title'] ?>"/>
        <div class="news-article__description">
          <h4 class="news-article__title"><a href="<?= URL($n['url']) ?>"><?= T($n['title']) ?></a></h4>
          <div><?= T($n['description']) ?> <a href="<?= URL($n['url']) ?>"><?=T('readMore')?></a></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php HTML_ASIDE(); ?>
<?php HTML_FOOTER(); ?>

</body>
</html>
