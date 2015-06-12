<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('category_news/dels', $attributes);
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
            <th colspan="6"> <input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
                <?=lang('total');?>
                <?=$num?>
                <?=lang('record');?>
                <span class="pages">
                <?=$pagination?>
                </span> 
			</th>
        </tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'checknew')" /></th>
            <th><?=lang('name_category_news');?></th>
			<th>Thuộc nhóm</th>
			<th><?=lang('title_link');?></th>
            <th style="width:100px;"><?=lang('create_date')?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_category_news?>"></td>
		<td><?=$rs->lb_name?></td>
        <td><?
			$CI= & get_instance();
			$rs_cate     = $CI->common->get_item_id('pl_category_news','id_category_news',$rs->id_parent);
			echo ( !empty($rs_cate->lb_name))?$rs_cate->lb_name:"";
		?>
		</td>
		
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
			<?=icon_edit('category_news/edit/'.$rs->id_category_news)?>
            <span id="publish<?=$rs->id_category_news?>">
            	<?=icon_active("'pl_category_news'","'id_category_news'",$rs->id_category_news,$rs->bl_active)?>
            </span>
            <?=icon_del('category_news/del/'.$rs->id_category_news.'/'.(int)$this->uri->segment(4))?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;
	?>
    <tfoot>
		<td colspan="6"><input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
			<?=lang('total');?>
			<?=$num?>
			<?=lang('record');?>
			<span class="pages">
			<?=$pagination?>
			</span>
		</td>
	</tfoot>
</table>
<?=form_close()?>
