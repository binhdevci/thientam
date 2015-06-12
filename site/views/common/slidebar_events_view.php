 <div class="sidebar">
   <!-- most popular -->
  <? 
	$rs_n1=get_news_categoty('san-pham-tieu-bieu');
	if(!empty($rs_n1)){
   ?>
   <div class="most_popular">
    <h4>Sản Phẩm Tiêu Biểu</h4>
    <ul>
	 <? foreach($rs_n1 as $row){?>
		 <li>
		  <div class="bwWrapper">
		  <canvas height="55" width="60" style="position: absolute; top: 0px; left: 0px; width: 60px; height: 55px; display: block;"></canvas>
		  <a href="<?=base_url()?>san-pham-<?=$row->lb_alias?>.html">
		  <img width="60" height="55" alt="<?=$row->lb_title?>" src="<?=base_url()?><?=$row->lb_image?>">
		  </a>
		  </div>
		  <div class="desc">
		   <p><strong><a href="<?=base_url()?>san-pham-<?=$row->lb_alias?>.html"><?=$row->lb_title?></a></strong></p>
		   <p><?=str_limit($row->lb_summary,50)?></p>
		   <p><span><?=format_date_view($row->dt_create)?>   <a href="javascript:void(0)"><?=$row->lb_create_by?></a></span></p>
		  </div>
		 </li>
     <?}?>
    </ul>
   </div>
   <?}?><!-- /most popular -->
   <!-- our clients -->
    <? 
	$rs_n2=get_news_categoty('thu-linh-noi-gi');
	if(!empty($rs_n2)){
   ?>
   <div class="our_clients">
    <h4>Thủ Lĩnh Nói Gì?</h4>
		<ul class="clients_slider">
			<? foreach($rs_n2 as $row){?>
		  <li >
		   <blockquote>
			<?=$row->lb_description?>
		   </blockquote>
		  </li>	
		  <?}?>
		 
		 </ul>
			
   </div>
   <?}?>
   <!-- /our clients -->
   <!-- recent work -->
    <? 
	$rs_n3=get_news_categoty('guong-mat-tieu-bieu');
	if(!empty($rs_n3)){
   ?>
   <div class="recent_work">
    <h4>Gương Mặt Tiêu Biểu</h4>
    <ul class="recent_slider">
     <li>
	  <? foreach($rs_n3 as $row){?>
	 <div class="bwWrapper">
		 <canvas height="55" width="60" style="position: absolute; top: 0px; left: 0px; width: 59px; height: 54px; display: block;"></canvas>
		 <a title ="<?=$row->lb_title?>" href="<?=base_url()?>tin-tuc-<?=$row->lb_alias?>.html">
		 <img width="59" height="54" alt="" src="<?=base_url()?><?=$row->lb_image?>"></a>
	 </div>
	  <?}?>
		</li>
    </ul>
   </div>
   <?}?>
   <!-- /recent work -->
  </div>
 