<?=form_open(uri_string())?>    
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_support');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=$rs->lb_name?>"></td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_present');?></td>
		<td><input type="text" name="lb_name_present" id="lb_name_present"class="w350" value="<?=$rs->lb_name_present?>"></td>
	</tr> 
	<tr>
		<td class="label"><?=lang('yahoo');?></td>
		<td><input type="text" name="lb_yahoo" id="lb_yahoo"class="w350" value="<?=$rs->lb_yahoo?>"></td>
	</tr> 
	<tr>
		<td class="label"><?=lang('skype');?></td>
		<td><input type="text" name="lb_skype" id="lb_skype"class="w350" value="<?=$rs->lb_skype?>"></td>
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
