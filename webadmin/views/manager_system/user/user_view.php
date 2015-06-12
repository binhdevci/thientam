<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('user/dels', $attributes);
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
        <tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'checknew')" /></th>
            <th><?=lang('name_user');?></th>
			<th><?=lang('login_name');?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
			$lb_name_user = $rs->lb_name_user ;
			$lb_login_name = $rs->lb_login_name ;
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_user?>"></td>
        <td><?=$lb_name_user?></td>
		<td><?=$lb_login_name?></td>
        <td align="center"><?=icon_edit('user/edit/'.$rs->id_user)?>
            <span id="publish<?=$rs->id_user?>">
            <?=icon_active("'pl_user'","'id_user'",$rs->id_user,$rs->bl_active)?>
            </span>
            <?=icon_del('user/del/'.$rs->id_user.'/'.(int)$this->uri->segment(4))?>
		</td>
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
