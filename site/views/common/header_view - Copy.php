<header id="header">
        <div class="darker-row">
			<div class="container">
				<div class="row">
				   <div class="span7" style="padding-top:10px;">
						<div class="row">
						
							<div class="span3">
								<span class="title"><h4><a href="#">Cần tiền bán gấp xe Vouvo 2012</a></h4></span>
								<span class="">Địa chỉ: Lê Duẫn - P. Bến Nghé - Quận 1 - HCM<p>Liên hệ: 0909738749 - Anh Đức</span>
							</div>
							<div class="span2">
								<img src="<?=base_url()?>templates/images/map.png" alt="Webmarket Logo" style="padding-top:10px;"/>
							</div>
						</div>
					</div>
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
                        <a href="index.html" class=""><?php echo $row->lb_name_display;?> </a>
					 </li>
					 <?php }?>
                    <li><a href="contact.html">Liên hệ</a></li>
                  </ul>

                  <!--  ==========  -->
                  <!--  = Search form =  -->
                  <!--  ==========  -->
                  <form class="navbar-form pull-right" action="#" onsubmit="return  false;" method="get">
                      <button type="submit"><span class="icon-search"></span></button>
                      <input type="text" class="span3" name="search" id="navSearchInput">
                  </form>
                </div><!-- /.nav-collapse -->
            </div>

            <!--  ==========  -->
            <!--  = Cart =  -->
           
          </div>
        </div>
      </div>
    </div> <!-- /main menu -->

    