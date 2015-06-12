<? $attributes = array('id' => 'my_form');?>
<?=form_open(uri_string(),$attributes)?>     
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('title_events');?></td>
		<td><input type="text" name="lb_title" id="lb_title"class="w350" value="<?=set_value('lb_title')?>"></td>
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
		<td class="label">Mẫu tin</td>
		<td>
			<span value=""
				classhd="id_news"
				class="combobox"
				idhd="id_news"
				field="cbbox-id_news"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_news/id_news/lb_title/"
				width="360"
				options="js_news"
			</span>
		</td>
	</tr>
	<tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" checked="checked"></td>
	</tr>  
	<tr>
		<td  class="label"><?=lang('description');?></td>
		<td>
		<textarea class="full field" cols="" rows="" name="lb_description" id="wysiwyg-advanced"><?=set_value('lb_description')?></textarea>
		</td>
	</tr>  
	<tr>
		<td  class="label"><?=lang('feeling');?></td>
		<td>
		<textarea class="full field" cols="" rows="" name="lb_feeling" id="wysiwyg-advanced-feeling"><?=set_value('lb_feeling')?></textarea>
		</td>
	</tr> 
	<tr>
		<td class="label" style="width: 150px;"><?=lang('date_active');?></td>
		<td>
			<input type="text" name="dt_start" id="dt_start"class="w150" value="<?=set_value('dt_start')?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="button" name="bt_submit" value="" class="themmoi">
		</td>
	</tr>
	
</table>
<?=form_close()?>
 <script>
$(function() {
$( "#dt_start" ).datepicker({ dateFormat: "yy-mm-dd" });
});
</script>
</head>

<script>
	js_news =[];
	$(document).ready(function()
    {
		Combobox.create();
	})
</script>