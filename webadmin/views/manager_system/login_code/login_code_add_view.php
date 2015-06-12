<?=form_open(uri_string(),array('id'=>'checknew'))?>    
<table class="form">
	<tr>	
		<td style="width: 550px;">
			<table>
				<tr>
					<td class="label required" style="width: 150px;"><?=lang('name_login_code');?></td>
					<td><input type="text" name="lb_name" id="lb_name"class="w300" value="<?=set_value('lb_name')?>"></td>
				</tr>
				
				<tr>
					<td class="label"><?=lang('active');?></td>
					<td><input type="checkbox" name="bl_active" value="1" checked="checked"></td>
				</tr>                 
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="bt_submit" value="" class="themmoi">
					</td>
				</tr>
			</table>
		</td>
		<td>
			<h4><?=lang('permission');?>
                <input type="checkbox" name="sa" id="sa" onclick="check_chose()" />
                <?=lang('choose_all');?></h4>
            <? foreach($list as $r):?>
				<div class="permission_name"><b><?=$r->lb_name?></b>[<?=$r->cd_screen?>]</div>
				 <div style="overflow: hidden;">
					<span class="permit_name">
						<input type="checkbox" name="r_<?=$r->cd_screen?>" id="r_<?=$r->cd_screen?>" onclick="r(this.id);" value="">
						 <?=lang('per_read');?>
					</span>
					<span class="permit_name">
						<input type="checkbox" name="w_<?=$r->cd_screen?>" id="w_<?=$r->cd_screen?>" onclick="w(this.id);" value="">
						 <?=lang('per_write');?>
					</span>
					<input type="hidden" name="<?=$r->cd_screen?>" id="<?=$r->cd_screen?>" value=""/>
				</div>
            <? endforeach;?>
		</td>
	</tr>
	
</table>
<?=form_close()?>
<script>
	var arr_screen = new Array();
	$(document).ready(function()
    {
			var j=0;
			<? foreach($list as $r):?>
				
				arr_screen[j] ='<?=$r->cd_screen?>';
				j++;
			<? endforeach;?>
	})
	function check_chose(){
		var is_check = document.getElementById('sa').checked;	
		for(var i=0;i<arr_screen.length;i++){
			if(is_check){
				document.getElementById('w_'+arr_screen[i]).checked = true;
				document.getElementById('r_'+arr_screen[i]).checked = true;
				document.getElementById(arr_screen[i]).value = '2';
			}else{
				document.getElementById('w_'+arr_screen[i]).checked = '';
				document.getElementById('r_'+arr_screen[i]).checked = '';
				document.getElementById(arr_screen[i]).value = '0';
			}
			
		}
	}
	
</script>
