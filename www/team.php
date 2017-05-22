<?php
require_once(dirname(__FILE__).'/../config.php');
// Page properties.
define('TITLE', 'titleTeamPage');
define('DESCRIPTION', 'metaDescriptionTeamPage');
define('KEYWORDS', 'metaKeywordsTeamPage');
define('FILE', __FILE__);

HTML_HEAD();

$team = [[
    'img' => 'img/team/Igor_Davydov.jpg',
    'name' => 'Igor Davydov',
    'title' => 'idavydovTitle',
    'description' => 'idavydovDescription'],
  [
    'img' => 'img/team/Alexander_Zolotarev.jpg',
    'name' => 'Alexander Zolotarev',
    'title' => 'zolotarevTitle',
    'description' => 'zolotarevDescription'],
  [
    'img' => 'img/team/Yury_Aslamov.jpg',
    'name' => 'Yury Aslamov',
    'title' => 'yaslamovTitle',
    'description' => 'yaslamovDescription'],
  [
    'img' => 'img/team/Sergei_Vasukevich.jpg',
    'name' => 'Sergey Vasukevich',
    'title' => 'vasukevichTitle',
    'description' => 'vasukevichDescription'],
  [
    'img' => 'img/team/Aliaksei_Maniuk.jpg',
    'name' => 'Aliaksei Maniuk',
    'title' => 'maniukTitle',
    'description' => 'maniukDescription'],
  [
    'img' => 'img/team/Aleksandr_Tsurko.jpg',
    'name' => 'Aleksandr Tsurko',
    'title' => 'tsurkoTitle',
    'description' => 'tsurkoDescription'],
  [
    'img' => 'img/team/Andrey_Aslamov.jpg',
    'name' => 'Andrey Aslamov',
    'title' => 'aslamovTitle',
    'description' => 'aslamovDescription'],
  [
    'img' => 'img/team/Anatoliy_Shevchenko.jpg',
    'name' => 'Anatoliy Shevchenko',
    'title' => 'shevchenkoTitle',
    'description' => 'shevchenkoDescription'],
  [
    'img' => 'img/team/Mikita_Kasmach.jpg',
    'name' => 'Mikita Kasmach',
    'title' => 'kasmachTitle',
    'description' => 'kasmachDescription'],
  [
    'img' => 'img/team/Petr_Riabtsev.jpg',
    'name' => 'Petr Riabtsev',
    'title' => 'riabtsevTitle',
    'description' => 'riabtsevDescription'],
  [
    'img' => 'img/team/Oleg_Avsyankin.jpg',
    'name' => 'Oleg Avsyankin',
    'title' => 'avsyankinTitle',
    'description' => 'avsyankinDescription'],
  [
    'img' => 'img/team/Roman_Tolkach.jpg',
    'name' => 'Roman Tolkach',
    'title' => 'tolkachTitle',
    'description' => 'tolkachDescription'],
  [
    'img' => 'img/team/Mihail_Bogdanec.jpg',
    'name' => 'Mihail Bogdanec',
    'title' => 'bogdanecTitle',
    'description' => 'bogdanecDescription'],
  [
    'img' => 'img/team/Yaraslava_Herasimuk.jpg',
    'name' => 'Yaraslava Herasimuk',
    'title' => 'herasimukTitle',
    'description' => 'herasimukDescription'],
  [
    'img' => 'img/team/Artem_Bourak.jpg',
    'name' => 'Artem Bourak',
    'title' => 'bourakTitle',
    'description' => 'bourakDescription']
];
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section team">
    <h1><?= T('teamH1') ?></h1>
    <p class="preface"><?= T('teamPreface') ?></p>
    <div class="team-container">
      <?php foreach ($team as $m) : ?>
      <div class="team-member">
        <img class="team-member__img" src="<?= URL($m['img']) ?>" alt="<?= T($m['name']) ?>" />
        <div class="team-member__description">
          <h3 class="team-member__name"><?= T($m['name']) ?></h3>
          <h4 class="team-member__title"><?= T($m['title']) ?></h4>
          <div><?= T($m['description']) ?></div>
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
