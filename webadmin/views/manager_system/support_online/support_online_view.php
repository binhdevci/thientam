<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('support_online/dels', $attributes);
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
        <tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'checknew')" /></th>
            <th><?=lang('name_support');?></th>
			<th><?=lang('yahoo');?></th>
			<th><?=lang('skype');?></th>
			<th><?=lang('name_present');?></th>

            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_support_online?>"></td>
        <td><?=$rs->lb_name?></td>
		<td><?=$rs->lb_yahoo?></td>
		<td><?=$rs->lb_skype?></td>
		<td><?=$rs->lb_name_present?></td>
        <td align="center"><?=icon_edit('support_online/edit/'.$rs->id_support_online)?>
            <span id="publish<?=$rs->id_support_online?>">
            <?=icon_active("'pl_support_online'","'id_support_online'",$rs->id_support_online,$rs->bl_active)?>
            </span>
            <?=icon_del('support_online/del/'.$rs->id_support_online.'/'.(int)$this->uri->segment(4))?>
		</td>
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
