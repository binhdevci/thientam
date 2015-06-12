<?=form_open(uri_string())?>    
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('code_lang');?></td>
		<td><input type="text" name="cd_lang" id="cd_lang"class="w150" value="<?=$rs->cd_lang?>"></td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_lang');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=$rs->lb_name?>"></td>
	</tr>
    <tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" <?php if($rs->bl_active==1) echo 'checked'; ?>></td>
	</tr>                 
	<tr>
		<td colspan="2" align="center">
			<input type="submit" name="bt_submit" value="" class="capnhat">
		</td>
	</tr>
	
</table>
<?=form_close()?>

