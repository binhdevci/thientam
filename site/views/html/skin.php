<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->

<!-- Mirrored from demo.squidix.com/construct/index7.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 08 May 2014 19:57:56 GMT -->
<head>
  	<?=$this->load->view('html/meta_skin')?>
</head>
<body  >
<div class="master-wrapper">
  <?=$this->load->view('common/header_view')?>
  <!-- mainouter -->
  	<?=$this->load->view($page) ; ?>
	<!-- mainouter -->
  <?=$this->load->view('common/footer_view')?>
</div> <!-- end of master-wrapper -->
  <!-- JavaScript at the bottom for fast page loading -->
  
  <!-- scripts concatenated and minified via build script --> 
  <!-- end scripts -->
    
  </body>

</html>