<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('tags/dels', $attributes);
?>
<table class="admindata">
    <thead>
		
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
            <th><?=lang('name_tags');?></th>
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
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_tags?>"></td>
		<td><?=$rs->lb_name?></td>
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
			<?=icon_edit('tags/edit/'.$rs->id_tags)?>
            <span id="publish<?=$rs->id_tags?>">
            	<?=icon_active("'pl_tags'","'id_tags'",$rs->id_tags,$rs->bl_active)?>
            </span>
            <?=icon_del('tags/del/'.$rs->id_tags.'/'.(int)$this->uri->segment(4))?></td>
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
