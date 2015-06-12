<? $attributes = array('id' => 'my_form');?>
<?=form_open(uri_string(),$attributes)?>      
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_category_image');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=$rs->lb_name?>"></td>
	</tr>
	<tr>
		<td class="label"><?=lang('parent');?></td>
		<td>
			<span value="<?=$rs->id_parent?>"
				classhd=" id_parent"
				class="combobox"
				idhd=" id_parent"
				field="cbbox- id_parent"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_category_image/id_category_image/lb_name/"
				width="360"
				options="js_category_image"
			</span>
		</td>
	</tr>
    <tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" <?php if($rs->bl_active==1) echo 'checked'; ?>/></td>
	</tr>                 
	<tr>
		<td colspan="2" align="center">
			<input type="button" name="bt_submit" value="" class="capnhat">
		</td>
	</tr>
	
</table>
<?=form_close()?>

<script>
	js_category_image =<?=$js_category_image?>;
	$(document).ready(function()
    {
		Combobox.create();
	})
</script>
