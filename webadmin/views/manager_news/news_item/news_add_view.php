<? $attributes = array('id' => 'my_form');?>
<?=form_open(uri_string(),$attributes)?>     
<table class="form">
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('title_news');?></td>
		<td><input type="text" name="lb_title" id="lb_title"class="w350" value="<?=set_value('lb_title')?>"></td>
	</tr>
	<tr>
		<td class="label required" style="width: 150px;"><?=lang('lb_price');?></td>
		<td><input type="text" name="lb_price" id="lb_price"class="w350" value="<?=set_value('lb_price')?>"></td>
	</tr>
	<!--<tr>
		<td class="label required" style="width: 150px;"><?=lang('title_news');?> slide</td>
		<td><input type="text" name="lb_title_background" id="lb_title_background"class="w350" value="<?=set_value('lb_title_background')?>"></td>
	</tr>-->
	<tr>
		<td class="label required"><?=lang('image');?></td>
		<td>
			<input type="text" name="lb_image" class="w350" value="" id="hinhanh">
			<a href="<?=base_url()?>filemanager/index/hinhanh" id="addimages" class="cboxElement" title="Thêm File">
				<img src="<?=base_url()?>templates/images/icon/attach.png" alt="">
			</a>                 
		</td>
	</tr> 
	<!--<tr>
		<td class="label required"><?=lang('image');?> trang chủ</td>
		<td>
			<input type="text" name="lb_image_home" class="w350" value="" id="lb_image_home">
			<a href="<?=base_url()?>filemanager/index/lb_image_home" id="addimages" class="cboxElement" title="Thêm File">
				<img src="<?=base_url()?>templates/images/icon/attach.png" alt="">
			</a>                 
		</td>
	</tr> 
	<tr>
		<td class="label required">File video</td>
		<td>
			<input type="text" name="lb_video" class="w350" value="" id="lb_video">
			<a href="<?=base_url()?>filemanager/index/lb_video" id="addimages" class="cboxElement" title="Thêm File">
				<img src="<?=base_url()?>templates/images/icon/attach.png" alt="">
			</a>                 
		</td>
	</tr> -->
	<tr>
		<td class="label"><?=lang('name_category_news');?></td>
		<td>
			<span value=""
				classhd="id_category_news"
				class="combobox"
				idhd="id_category_news"
				field="cbbox-id_category_news"
				idRow="0"
				urlLoad="<?php echo base_url(); ?>ajax/load_combobox/pl_category_news/id_category_news/lb_name/"
				width="360"
				options="js_category_news"
			</span>
		</td>
	</tr>
	
	<tr>
		<td class="label"><?=lang('active');?></td>
		<td><input type="checkbox" name="bl_active" value="1" checked="checked"></td>
	</tr>
	<tr>
		<td class="label">Là sản phẩm</td>
		<td><input type="checkbox" name="bl_is_product" value="1" checked="checked"></td>
	</tr> 
	<!--<tr>
		<td class="label">Is video</td>
		<td><input type="checkbox" name="bl_video" value="1" ></td>
	</tr>  
	<tr>
		<td class="label">Is slide</td>
		<td><input type="checkbox" name="bl_slide" value="1" ></td>
	</tr> 
	<tr>
		<td class="label">Is hot news</td>
		<td><input type="checkbox" name="bl_is_hot_news" value="1"></td>
	</tr> -->
	
	<tr>
		<td class="label"><?=lang('summary');?></td>
		<td>
			<textarea style="width: 500px;height: 100px;" name="lb_summary" id="wysiwyg-simple"><?=set_value('lb_summary')?></textarea>
		</td>
	</tr>
	<tr>
		<td  class="label"><?=lang('description');?></td>
		<td>
		<textarea class="full field" cols="" rows="" name="lb_description" id="wysiwyg-advanced"><?=set_value('lb_description')?></textarea>
		</td>
	</tr> 
	<!--<tr>
		<td class="label">Danh sách tags</td>
		<td>
			  <table>
                <tr>
                    <td><div id="list_song" name="list_song" style="width: 400px;height:300px; border:1px solid #999999;overflow:scroll;">
                            <table class="admindata" id="tbl_row_news" >
                                <tr>
                                    <th width="30"><input type="checkbox" name="sa_song" id="sa_song" checked="checked" onclick="check_all_news();" /></th>
                                    <th>Tên tags</th>
                                </tr>
								
                            </table>
                        </div></td>
                    <td><a class="colorbox" href="<?=base_url();?>news_item/list_news">Thêm tags</a><br/><br/>
						</td>
                </tr>
            </table>        
		</td>
	</tr>-->
    <tr>
		<td class="label">Tiêu đề Seo</td>
		<td>
			<textarea style="width: 500px;height: 100px;" name="lb_title_seo"><?=set_value('lb_title_seo')?></textarea>
		</td>
	</tr>
	<tr>
		<td class="label">Keyword Seo</td>
		<td>
			<textarea style="width: 500px;height: 100px;" name="lb_Keyword_seo"><?=set_value('lb_Keyword_seo')?></textarea>
		</td>
	</tr>
	<tr>
		<td class="label">Description Seo</td>
		<td>
			<textarea style="width: 500px;height: 100px;" name="lb_description_seo"><?=set_value('lb_description_seo')?></textarea>
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
	js_category_news =[];
	$(document).ready(function()
    {
		Combobox.create();
	})
	
</script>