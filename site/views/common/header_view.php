<?
	$rs_contact = get_news_common('lien-he');
?>
<header id="header">
        <div class="darker-row" style="padding-bottom:5px;">
			<div class="container">
				<div class="row">
				   <div class="span8" style="padding-top:10px;">
						<div class="row">
						
							<div class="span4">
								<?=$rs_contact->lb_summary?>
							</div>
							<div class="span4">
								<div id="map" style='height:150px; '>
								</div>
							</div>
						</div>
					</div>
					 <div class="span4">
                    <div class="top-right">
                        <div class="icons">
                            <a href="#"><span class="zocial-facebook"></span></a>
                            <a href="#"><span class="zocial-skype"></span></a>
                            <a href="#"><span class="zocial-twitter"></span></a>
                            
                        </div>
                    </div>
                </div> <!-- /social icons -->
				</div>
			</div>
		</div>
	</header>

    <!--  ==========  -->
    <!--  = Main Menu / navbar =  -->
    <!--  ==========  -->
    <div class="navbar navbar-static-top" id="stickyNavbar">
      <div class="navbar-inner">
        <div class="container">
          <div class="row">
            <div class="span12">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

                <!--  ==========  -->
                <!--  = Menu =  -->
                <!--  ==========  -->
				<?php
					$rs = get_menu_item();
				?>
                <div class="nav-collapse collapse">
                  <ul class="nav" id="mainNavigation">
				  <?php foreach($rs as $row){?>
                    <li class="dropdown active">
                        <a href="<?=base_url()?>xe-<?=$row->lb_alias?>.html" class=""><?php echo $row->lb_name_display;?> </a>
					 </li>
					 <?php }?>
                    <!--<li><a href="contact.html">Liên hệ</a></li>-->
                  </ul>

                  <!--  ==========  -->
                  <!--  = Search form =  -->
                  <!--  ==========  -->
                  <form class="navbar-form pull-right" action="<?=$url_left;?>"  method="get">
                      <button type="submit"><span class="icon-search"></span></button>
                      <input type="text" class="span3" name="q" id="q">
                  </form>
                </div><!-- /.nav-collapse -->
            </div>

            <!--  ==========  -->
            <!--  = Cart =  -->
           
          </div>
        </div>
      </div>
    </div> <!-- /main menu -->
	<?php $rs_img = get_image_slide();?>
	<div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
				<?php foreach($rs_img as $row){?>
                <li data-transition="premium-random" data-slotamount="3">
                    <img src="<?=base_url()?><?=$row->lb_image?>" alt="slider img" width="1400" height="377" />

                </li><!-- /slide -->
				<?php }?>
                
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
        <!--  ==========  -->
        <!--  = Nav Arrows =  -->
        <!--  ==========  -->
        <div id="sliderRevLeft"><i class="icon-chevron-left"></i></div>
        <div id="sliderRevRight"><i class="icon-chevron-right"></i></div>
    </div> <!-- /slider revolution -->

    