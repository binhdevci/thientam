<?=form_open(uri_string())?>    
<table class="form">
	<tr>
		<td class="label" style="width: 150px;"><?=lang('fullname');?></td>
		<td><input type="text" name="lb_fullname" id="lb_fullname"class="w350" value="<?=$rs->lb_fullname?>"></td>
	</tr>
	<!--<tr>
		<td class="label" style="width: 150px;"><?=lang('address');?></td>
		<td><input type="text" name="lb_address" id="lb_address"class="w350" value="<?=$rs->lb_address?>"></td>
	</tr> -->
	<tr>
		<td class="label" style="width: 150px;"><?=lang('phone');?></td>
		<td><input type="text" name="lb_phone" id="lb_phone"class="250" value="<?=$rs->lb_phone?>"></td>
	</tr>
	<tr>
		<td class="label" style="width: 150px;"><?=lang('create_date');?></td>
		<td><input type="text" name="dt_create" id="dt_create"class="250" value="<?=format_date_show($rs->dt_create)?>"></td>
	</tr>
	<tr>
		<td class="label" style="width: 150px;"><?=lang('email');?></td>
		<td><input type="text" name="lb_email" id="lb_email"class="w250" value="<?=$rs->lb_email?>"></td>
	</tr> 
	<tr>
		<td class="label" style="width: 150px;"><?=lang('content');?></td>
		<td><textarea style="width: 500px;height: 100px;" name="lb_summary"><?=$rs->lb_summary?></textarea></td>
	</tr> 
	
</table>
<?=form_close()?>
