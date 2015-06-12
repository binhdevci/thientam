<? $attributes = array('id' => 'my_form');?>
<?=form_open(uri_string(),$attributes)?>    
<table class="form">
	
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('name_image');?></td>
		<td><input type="text" name="lb_name" id="lb_name"class="w350" value="<?=set_value('lb_name')?>"></td>
	</tr>
	<tr>
		<td class="label required"><?=lang('image');?></td>
		<td>
			<input type="text" name="lb_image" class="w350" value="" id="hinhanh">
			<a href="<?=base_url()?>filemanager/index/hinhanh" id="addimages" class="cboxElement" title="Thêm File">
				<img src="<?=base_url()?>templates/images/icon/attach.png" alt="">
			</a>                 
		</td>
	</tr> 
	 
	
	<tr>
		<td class="label required"><?=lang('name_category_image');?></td>
		<td>
			<span value=""
				classhd="id_category_image"
				class="combobox"
				idhd="id_category_image"
				field="cbbox-id_category_image"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_category_image/id_category_image/lb_name/"
				width="360"
				options="js_category_image"
			</span>
		</td>
	</tr>
	
	<tr>
		<td class="label"><?=lang('summary');?></td>
		<td>
			<textarea style="width: 500px;height: 100px;" name="lb_summary"><?=set_value('lb_summary')?></textarea>
		</td>
	</tr>
    <tr>
		<td class="label"><?=lang('title_link');?></td>
		<td><input type="text" name="lb_alias" id="lb_alias"class="w350" readonly="readonly" value="<?=set_value('lb_alias')?>"></td>
	</tr>
	
  
	<tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" checked="checked"></td>
	</tr>                 
	<tr>
		<td colspan="2" align="center">
			<input type="button" name="bt_submit" value="" class="themmoi">
		</td>
	</tr>
	
</table>
<?=form_close()?>
<script>
	js_category_image =[];
	$(document).ready(function()
    {
		Combobox.create();
	})
</script>
