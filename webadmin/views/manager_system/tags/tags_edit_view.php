<? $attributes = array('id' => 'my_form');?>
<?=form_open(uri_string(),$attributes)?>       
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_tags');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=$rs->lb_name?>"></td>
	</tr>
    <tr>
		<td class="label"><?=lang('title_link');?></td>
		<td><input type="text" name="lb_alias" id="lb_alias"class="w350" readonly="readonly" value="<?=$rs->lb_alias?>"></td>
	</tr>
    <tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" <?php if($rs->bl_active==1) echo 'checked'; ?>></td>
	</tr>                 
	<tr>
		<td colspan="2" align="center">
			<input type="button" name="bt_submit" value="" class="capnhat">
		</td>
	</tr>
	
</table>
<?=form_close()?>
