<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('events/dels', $attributes);
?>
<table class="admindata">
    <thead>       	
        <tr>
            <th colspan="6"> <input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
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
            <th><?=lang('title_events');?></th>
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
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_events?>"></td>
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
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
        	
			<?=icon_edit('events/edit/'.$rs->id_events)?>
            <span id="publish<?=$rs->id_events?>">
            <?=icon_active("'pl_events'","'id_events'",$rs->id_events,$rs->bl_active)?>
            </span>
            <?=icon_del('events/del/'.$rs->id_events.'/'.(int)$this->uri->segment(4))?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;
	?>
    <tfoot>
		<td colspan="6"><input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
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
