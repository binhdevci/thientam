<? 
	if(!isset($_SESSION['permission'])||!isset($_SESSION['parentMenus'])){
		 redirect(base_url());
	}
	$permission=$_SESSION['permission'];
	$parentMenus=$_SESSION['parentMenus'];
	
?>
<ul id="menu">
    
	<li class="node"><a href="#" class=""><?=lang('pl_system');?></a>
    	<ul>
			<li><a href="<?=base_url()?>user"><?=lang('pl_user');?></a></li>
			<li><hr size="1" style="color:#D1D1D1;" /></li>
			<li><a href="<?=base_url()?>menu">Quản lý Menu</a></li>
			<li><hr size="1" style="color:#D1D1D1;" /></li>
			<li><a href="<?=base_url()?>menu_item">Quản lý Menu Item</a></li>
			<!--<li><hr size="1" style="color:#D1D1D1;" /></li>
			<li><a href="<?=base_url()?>tags">Quản lý Tags</a></li>-->
        </ul>
    </li>
    <?
		$rs_menu =get_menu();
		
		foreach($rs_menu as $row){
	?>
	<li class="node"><a href="#" class=""><?=$row->lb_name;?></a>
		<? if($row->is_has_list==1){
				$rs_menu_item = get_menu_item($row->id_menu);
				if(!empty($rs_menu_item )){	
		?>
				<ul>
					<?foreach($rs_menu_item as $rowi){?>
						<li><a href="<?=base_url()?>news_item/index/<?=$rowi->id_menu_item;?>/0/0"><?=$rowi->lb_name;?></a></li>
					<?}?>
				</ul>
				<?}?>
		<?}?>
    </li>
	<?
		}
	?>
	<li class="node"><a href="#" class=""><?=lang('pl_manager_news');?></a>
    	<ul>
			<li><a href="<?=base_url()?>category_news"><?=lang('pl_category_news');?></a></li>
		</ul>
    </li>
	
	<li class="node"><a href="<?=base_url()?>image" class="">Quản lý hình ảnh</a>
    </li>
</ul>
<div style="float: right;padding-top: 5px;">
    <?=date('H:i, d/m/Y',time() - $this->config->item('site_time'))?>
</div>
