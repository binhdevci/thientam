<?=form_open(uri_string())?>    
<table class="form">
	<tr>
		<td class="label"><?=lang('name_menu');?></td>
		<td>
			<span value=""
				classhd="id_menu"
				class="combobox"
				idhd="id_menu"
				field="cbbox-id_menu"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_menu/id_menu/lb_name/"
				width="360"
				options="js_menu"
			</span>
		</td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_menu_item');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=set_value('lb_name')?>"></td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_display');?></td>
		<td><input type="text" name="lb_name_display" id="lb_name_display"class="w350" value="<?=set_value('lb_name_display')?>"></td>
	</tr> 
	
	<tr>
		<td class="label"><?=lang('active');?></td>
		<td>
			<input type="checkbox" name="bl_active" value="1" checked="checked">
			<?=lang('is_has_list');?>
			<input type="checkbox" name="is_has_list" value="1" checked="checked">
		</td>
	</tr>  
	<tr>
		<td class="label">Là sản phẩm</td>
		<td>
			<input type="checkbox" name="bl_is_product" value="1" checked="checked">
			
		</td>
	</tr>  
	<tr>
		<td colspan="2" align="center">
			<input type="submit" name="bt_submit" value="" class="themmoi">
		</td>
	</tr>
	
</table>
<?=form_close()?>

<script>
	js_menu =[];
	$(document).ready(function()
    {
		Combobox.create();
	})
</script>	