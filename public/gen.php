<?php
error_reporting(1);
ini_set('display_errors', 1);

require($_SERVER['DOCUMENT_ROOT'].'/account/scss/tmplapp.php');
$TmplApp = new TmplApp();
$TmplApp->AutoCompileScss();

?>

  <p>ecc</p>