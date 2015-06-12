<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('news/dels', $attributes);
?>
<table class="admindata">
    <thead> 
		 <tr>
			
            <th colspan="7">
			Loại tin tức	&nbsp;&nbsp;&nbsp;		
               <select id="id_category_news">
					<option value="" onclick="location='<?=$url_search?>'" >ALL</option>
					<?foreach($rs_cate as $rs){?>
						<option onclick="location='<?=$url_search.$rs->id_category_news?>'" value="<?=$rs->id_category_news?>" <?=((int)$this->uri->segment(5)==$rs->id_category_news)?'selected':''?>><?=$rs->lb_name?></option>
					<?}?>
			   </select>
			</th>
        </tr>
        <tr>
            <th colspan="7"> <input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
                <?=lang('total');?>
                <? echo $num; ?>
                <?=lang('record');?>
                <span class="pages">
                <? echo $pagination; ?>
                </span> 
			</th>
        </tr>
        <tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'checknew')" /></th>
			<th><?=lang('image');?></th>
            <th><?=lang('title_news');?></th>
			<th>Loại tin</th>
			<th><?=lang('title_link');?></th>
            <th style="width:100px;"><?=lang('create_date'); ?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):		
			$title =!empty($rs->lb_image_home)  ? '<b>'.$rs->lb_title.'</b>' : $rs->lb_title ;
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_news?>"></td>
		<td width="100" ><?
				$img=$rs->lb_image;
				if($img!=''){
						
						$name=explode('.',$img); 
						if(count($name) >1){
							$name_thumb=$name[0].'_thumb.'.$name[1];
							if(file_exists('../uploads/thumbnails/'.$name_thumb)){
							//	echo '<img src="'.base_url_site().'uploads/thumbnails/'.$name_thumb.'" />';
							}else{
								//fn_resize_image('../uploads/images/'.$img,'../uploads/thumbnails/'.$name_thumb,50,50);
							//	echo '<img src="'.base_url_site().'uploads/thumbnails/'.$name_thumb.'" />';
							}
						}
				}
				?> 
		</td>
        <td><?=$title?></td>
		<td><?=$rs->lb_name?></td>
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
        	
			<?=icon_edit('news/edit/'.$rs->id_news)?>
            <span id="publish<?=$rs->id_news?>">
            <?=icon_active("'pl_news'","'id_news'",$rs->id_news,$rs->bl_active)?>
            </span>
            <?=icon_del('news/del/'.$rs->id_news.'/'.(int)$this->uri->segment(4))?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;
	?>
    <tfoot>
		<td colspan="7"><input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
				<?=lang('total');?>
				<? //echo $num?>
				<?=lang('record');?>
				<span class="pages">
				<? //echo $pagination?>
				</span>
		</td>
	</tfoot>
</table>
<?=form_close()?>
