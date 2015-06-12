<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('login_code/dels', $attributes);
?>
<table class="admindata">
    <thead>
        <tr>
            <th colspan="4"> <input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
                <?=lang('total');?>
                <?=$num?>
                <?=lang('record');?>
                <span class="pages">
                <?=$pagination?>
                </span> 
			</th>
        </tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'checknew')" /></th>
            <th><?=lang('name_login_code');?></th>
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
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_login_code?>"></td>
        <td><?=$rs->lb_name?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
			<?=icon_edit('login_code/edit/'.$rs->id_login_code)?>
            <span id="publish<?=$rs->id_login_code?>">
            	<?=icon_active("'pl_login_code'","'id_login_code'",$rs->id_login_code,$rs->bl_active)?>
            </span>
            <?=icon_del('login_code/del/'.$rs->id_login_code.'/'.(int)$this->uri->segment(4))?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;
	?>
    <tfoot>
		<td colspan="4"><input type="submit" onclick="return verify_del();" name="btn_submit" class="submit" value="<?=lang('delete');?>">
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
