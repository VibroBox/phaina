<?php
require_once(dirname(__FILE__).'/../../config.php');

// Page properties.
define('TITLE', 'titleNewsGeelyPage');
define('DESCRIPTION', 'metaDescriptionNewsGeelyPage');
define('KEYWORDS', 'metaKeywordsNewsGeelyPage');
define('FILE', __FILE__);
define('META', [
  ['property' => 'og:image', 'content' => URL('img/news-ru/geely/image3.jpg')],
  ['property' => 'og:image:width', 'content' => '1999'],
  ['property' => 'og:image:height', 'content' => '1500'],
]);

HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <h1><?= T('titleNewsGeelyPage') ?></h1>
    <time class="publicationDate" datetime="2017-08-11T13:11:21+00:00" itemprop="datePublished">Обновлено 11 августа 2017.</time>
    <div class="content">
      <p>Термин «Индустрия 4.0» («Industry 4.0»), описывающий европейскую инициативу массового внедрения концепции интернета вещей (IoT) в производственные процессы и системы управления предприятиями прочно вошёл в лексикон передовых промышленных гигантов.</p> <p>Системам оценки технического состояния оборудования в рамках этой концепции отведена важная роль. При помощи сервисов полностью автоматической диагностики промышленное оборудование должно уметь оценивать своё техническое состояние и сообщать о выявленных проблемах и требуемом обслуживании в систему управления предприятием<sup><a href="#ftnt1" id="ftnt_ref1" name="ftnt_ref1">[1]</a></sup>, которая проверит наличие на складе необходимых комплектующих, закажет их в случае необходимости, найдёт окно в технологическом процессе и сформирует заявку на точечное и своевременное обслуживание этого оборудования. При этом нет необходимости останавливать производственный процесс на длительный срок, разбирать и собирать производственную линию для выявления неисправностей и т.д.</p> <p>Именно для выполнения задач оценки технического состояния промышленного оборудования в рамках концепции «Индустрия 4.0» разработан сервис «VibroBox». Для этого используются облачные системы хранения и обработки данных, технологии машинного обучения (machine learning) на основе нейронных сетей (neural network), вейвлетный анализ (wavelet analysis), создание собственных базисных функций, правила нечёткой логики (fuzzy logic) и другие алгоритмы цифровой обработки сигналов.</p> <p>Компания «<a href="http://construction.citic/en/into/index.html" target="_blank">CITIC Construction</a>»<sup><a href="#ftnt2" id="ftnt_ref2" name="ftnt_ref2">[2]</a></sup> на протяжении многих лет входит в <a href="http://www.enr.com/toplists/2016-Top-250-International-Contractors1" target="_blank">топ-60</a> крупнейших международных строительных  компаний по версии <a href="http://www.enr.com/" target="_blank">ENR</a><sup><a href="#ftnt3" id="ftnt_ref3" name="ftnt_ref3">[3]</a></sup>. Одной из основных целей компании с момента её создания стало привлечение и использование самых передовых технологий и моделей ведения бизнеса.</p> <p>Для оценки возможностей «VibroBox» и перспектив дальнейшего сотрудничества по предложению руководителя проекта со стороны «CITIC Construction» <a href="https://www.vibrobox.ru/technology#аппаратная_платформа_сервиса_vibrobox" target="_blank">комплекс оборудования для сбора и передачи данных телеметрии «VibroBox»</a> был установлен на технологическом оборудовании строящегося в г. Жодино завода <a href="http://belgee.by/" target="_blank">СЗАО «БЕЛДЖИ»</a> – белорусско-китайского совместного предприятия по сборке легковых автомобилей марки Geely. Оценка технического состояния проводится для насосного и компрессорного оборудования китайского производства. Специалистам «CITIC Construction» предоставлен доступ <a href="https://demo.vibrobox.com/demo?locale=ru" target="_blank">к облачному сервису обработки данных телеметрии VibroBox</a> и автоматически формируемым отчётам о техническом состоянии контролируемого оборудования. Результаты проводимой сервисом VibroBox диагностики специалисты CITIC Construction оценили как высоко информативные, отметив стабильность работы системы.</p> <figure><img alt="Игорь Давыдов и Сергей Васюкевич объясняют принцип работы сервиса VibroBox" src="<?= URL('img/news-ru/geely/image1.jpg') ?>" title="Игорь Давыдов и Сергей Васюкевич объясняют принцип работы сервиса VibroBox"><figcaption><a href="https://www.vibrobox.ru/team#igor_davydov">Игорь Давыдов</a> и <a href="https://www.vibrobox.ru/team#sergey_vasukevich">Сергей Васюкевич</a> объясняют <a href="https://www.vibrobox.ru/technology">принцип работы</a> сервиса VibroBox и демонстрируют возможность сразу же видеть подробный отчёт и рекомендации о состоянии оборудования в <a href="https://demo.vibrobox.com/demo?locale=ru">личном кабинете</a>.</figcaption></figure> <figure><img alt="Датчик вибрации, установленный на горизонтальный центробежный насос" src="<?= URL('img/news-ru/geely/image2.jpg') ?>" title="Датчик вибрации, установленный на горизонтальный центробежный насос"><figcaption>Датчик <a href="https://www.vibrobox.ru/technology#датчики_для_съёма_вибрационного_сигнала_и_данных_телеметрии">вибрации</a>, установленный на горизонтальный центробежный насос.</figcaption></figure> <figure><img alt="Система VibroBox в действии: сбор и отправка данных в облачный сервис для полностью автоматической диагностики" src="<?= URL('img/news-ru/geely/image3.jpg') ?>" title="Система VibroBox в действии: сбор и отправка данных в облачный сервис для полностью автоматической диагностики"><figcaption>Система VibroBox в действии: сбор и отправка данных в облачный сервис для <a href="https://www.vibrobox.ru/technology">полностью автоматической</a> диагностики.</figcaption></figure> <hr> <div> <p><a href="#ftnt_ref1" id="ftnt1" name="ftnt1">[1]</a> Системы управления предприятием включают в себя CMMS, MES, ERP и некоторые другие.</p> </div> <div> <p><a href="#ftnt_ref2" id="ftnt2" name="ftnt2">[2]</a> <a href="http://construction.citic/en/into/index.html" target="_blank">CITIC Construction</a> — одно из подразделений китайского концерна <a href="http://www.group.citic/wps/portal" target="_blank">CITIC GROUP</a>.</p> </div> <div> <p><a href="#ftnt_ref3" id="ftnt3" name="ftnt3">[3]</a> <a href="http://www.enr.com/" target="_blank">Engineering News-Record</a> — признанный журнал в области строительства и архитектуры.</p> </div>
    </div>
  </section>
</main>
<?php HTML_ASIDE(); ?>
<?php HTML_FOOTER(); ?>

</body>
</html>
