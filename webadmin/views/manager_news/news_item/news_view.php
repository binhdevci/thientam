<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('id_news_item/dels', $attributes);
?>
<table class="admindata">
    <thead> 
		 
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
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_news_item?>"></td>
		<td width="100" ><?
				echo '<img width="100" height="100" src="'.base_url_site().$rs->lb_image.'" />';
				?> 
		</td>
        <td><?=$title?></td>
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
			<?=icon_edit('news_item/edit/'.$id_menu_item.'/'.$rs->id_news_item)?>
            <span id="publish<?=$rs->id_news_item?>">
            <?=icon_active("'pl_news_item'","'id_news_item'",$rs->id_news_item,$rs->bl_active)?>
            </span>
            <?=icon_del('news_item/del/'.$rs->id_news_item.'/'.(int)$this->uri->segment(4))?></td>
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
