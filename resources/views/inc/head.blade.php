<?php
error_reporting(1);
ini_set('display_errors', 1);
require($_SERVER['DOCUMENT_ROOT'].'/account/scss/tmplapp.php');
$TmplApp = new TmplApp();
$TmplApp->AutoCompileScss();

?>
@include('inc.metatags')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="account/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="account/plugins/swiper/swiper.min.css">
<link rel="stylesheet" href="account/plugins/dropzone/dropzone.css">
<link rel="stylesheet" href="account/plugins/ion-rangeslider/ion.rangeSlider.min.css">
<link rel="stylesheet" href="account/css/style.css?t=<?php echo date('U'); ?>">
<link rel="stylesheet" href="account/css/den.css?t=<?php echo date('U'); ?>">

<link rel="stylesheet" href="account/css/custom.css?t=<?php echo date('U'); ?>">

<style type="text/css">
    
.dz-preview.dz-image-preview.dz-processing.dz-complete {
  border: 5px solid green;
}

</style>
