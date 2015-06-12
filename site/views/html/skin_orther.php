<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  	<?=$this->load->view('html/meta_skin')?>
</head>
	<body class="index" id="boundary">

		<!-- Fullscreen slider -->
		<!--<div class="fullscreen-slider" style="cursor:pointer;" onclick="slide_up_down()">
			<div class="image-holder"></div>
			<ul class="content-holder item-background">
				
			</ul>
		</div>-->
		<!-- end. Fullscreen slider -->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]--> 
  <?=$this->load->view('common/header_view')?>
  
  <!-- mainouter -->
  	<?=$this->load->view($page) ; ?>
	<!-- mainouter -->
  <?=$this->load->view('common/footer_view')?>
  
  <!-- JavaScript at the bottom for fast page loading -->
  
  <!-- scripts concatenated and minified via build script --> 
  <!-- end scripts -->
    
  </body>
 <script id="item-background" type="text/x-jquery-tmpl">
	<li data-image="<?=base_url()?>${lb_image}" ></li>
</script>

	<script>
	 $(document).ready(function() {
      // res.load_backgound();
	});
	</script>
</html>