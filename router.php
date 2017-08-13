<?php
// Redirect all non-existing URIs to the root /index.php for correct routing.
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']))
  return false;
else
  require $_SERVER['DOCUMENT_ROOT'] . '/index.php';
?>
