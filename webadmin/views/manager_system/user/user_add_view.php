<?=form_open(uri_string())?>    
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_user');?></td>
		<td><input type="text" name="lb_name_user" id="lb_name_user"class="w350" value="<?=set_value('lb_name_user')?>"></td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('login_name');?></td>
		<td><input type="text" name="lb_login_name" id="lb_login_name"class="w350" value="<?=set_value('lb_login_name')?>"></td>
	</tr> 
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('password');?></td>
		<td><input type="password" name="lb_password" id="lb_password"class="w350" value="<?=set_value('lb_password')?>"></td>
	</tr>
	<tr>
		<td class="label"><?=lang('name_login_code');?></td>
		<td>
			<span value=""
				classhd="id_login_code"
				class="combobox"
				idhd="id_login_code"
				field="cbbox-id_login_code"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_login_code/id_login_code/lb_name/"
				width="360"
				options="js_login_code"
			</span>
		</td>
	</tr>
	<tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" checked="checked"></td>
	</tr>    
    <tr>
    	<td colspan="2"><? if(isset($mess)) echo $mess; ?></td>
     </tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" name="bt_submit" value="" class="themmoi">
		</td>
	</tr>
	
</table>
<?=form_close()?>
<script>
	js_login_code =[];
	$(document).ready(function()
    {
		Combobox.create();
	})
</script>
