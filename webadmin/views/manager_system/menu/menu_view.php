<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('menu/dels', $attributes);
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
			<th><?=lang('code_menu');?></th>
			<th><?=lang('name_menu');?></th>
			<th><?=lang('name_display');?></th>
			<th><?=lang('title_menu');?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_menu?>"></td>
        <td><?=$rs->cd_code?></td>
		<td><?=$rs->lb_name?></td>
		<td><?=$rs->lb_name_display?></td>
		<td><?=$rs->lb_alias?></td>
        <td align="center"><?=icon_edit('menu/edit/'.$rs->id_menu)?>
            <span id="publish<?=$rs->id_menu?>">
            <?=icon_active("'pl_menu'","'id_menu'",$rs->id_menu,(int)$rs->bl_active)?>
            </span>
            <?=icon_del('menu/del/'.$rs->id_menu.'/'.(int)$this->uri->segment(4))?>
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
