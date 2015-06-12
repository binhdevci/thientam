<?
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('contact/dels', $attributes);
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
            <th><?=lang('fullname');?></th>
			<th><?=lang('title_contact');?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
			$title = ($rs->bl_read!=1)  ? '<b>'.$rs->lb_title.'</b>' : $rs->lb_summary;
			$fullname = ($rs->bl_read!=1)  ? '<b>'.$rs->lb_fullname.'</b>' : $rs->lb_fullname ;
	?>
    <tr class="row<?=$k?>">
        <td><input type="checkbox" name="ar_id[]" value="<?=$rs->id_contact?>"></td>
        <td width="300"><?=$fullname?></td>
		<td><?=$title?></td>
        <td align="center">
			<?=icon_edit('contact/edit/'.$rs->id_contact)?>
            <?=icon_del('contact/del/'.$rs->id_contact.'/'.(int)$this->uri->segment(4))?>
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
