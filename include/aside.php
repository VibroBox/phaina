<aside>
  <?php if (PageFile() == 'technology.php') : ?>
  <a class="jumpToTOC" title="<?= T('goToTableOfContents') ?>" href="<?= T(['en'=>'#table_of_contents', 'ru'=>'#содержание']) ?>">→</a>
  <?php endif ?>
  <a class="feedback" title="<?= T('feedback') ?>" href="mailto:info@vibrobox.com?subject=<?= T('feedback').' / '.PageTitle() ?>"><?= T('feedback') ?></a>
</aside>
