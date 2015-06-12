<style type="text/css">
.search {
	margin:5px;
	padding:5px;
	height:40px;
}
ul.rows {
	height:25px;
	display:block;
	width:100%;
}
ul.rows li {
	width:200px;
	float:left;
}
</style>
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.validate.min.js"></script>

<? $zone = $this->uri->segment(3); ?>


<div id="diverror" style="padding:5px; text-align:center; color:#F00;"></div>
<!--<div class="search">
	<form action="" name="frmsearch" id="frmsearch" method="post">
    	<input type="hidden" name="zone" id="zone" value="" />
    	<ul class="rows">
        	<li>Song <input type="text" name="song" id="song" value="" /></li>
            <li>Artist <input type="text" name="artist" id="artist" value="" /></li>
            <li><input type="submit" name="btnsearch" id="btnsearch" value="Search" /></li>
        </ul>
    </form>
</div>-->
<div id="listchart" style="padding: 20px 0;height: 400px; overflow: auto;">
    <table class="admindata" id="admindata">
    <thead>
        <tr> <th colspan="3"> <?=lang('total');?> <?=$num?> <?=lang('record');?><span class="pages"><?=$pagination?></span> </th> </tr>
        <tr>
            <th class="checkbox"><input type="checkbox" name="sa" id="sa"  onclick="check_all();" /></th>
            <th>Tiêu đề</th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
	?>
    <tr class="row<?=$k?> row-<?=$i?>">
        <td><input type="checkbox" class="checkbox_id-<?=$i?>" name="ar_id[]" value="<?=$rs->id_news?>"></td>
        <td><?=$rs->lb_title?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;?>
    <tfoot>
    <td colspan="3">
    	
    	<div id="paging"><input class="submit" type="button" value="<?=lang('choose');?>" onclick="closes();"/><?=lang('total');?><?=$num?><?=lang('record');?>
                <span class="pages"><?=$pagination?></span></div></td>
    </tfoot>
</table>
</div>
<script type="text/javascript">
	function closes()
	{
		 var leng_row=document.getElementById('admindata').rows.length-3;
		 var arr_id = new Array();
		 for(var i=1;i<=leng_row;i++)
		 {
			var value=$(".checkbox_id-"+i).val();
			var checked = $(".checkbox_id-"+i).is(':checked'); 
			
			if(value >0 &&checked){
			  arr_id.push(value);
			}
		 }
		 
		if(arr_id.length>0)
		{
			var length=parent.document.getElementById('tbl_row_news').rows.length;
			
			var url = '<?=base_url();?>news/get_news_append';
			$.post(url,{str_news_id:arr_id,length:length-1},function(result){
				parent.$("#tbl_row_news").last().append(result);
				parent.$.fn.colorbox.close();
			});
		}else{
			parent.$.fn.colorbox.close();
		}
	}
	function check_all()
	{
		var leng_row=document.getElementById('admindata').rows.length-3;
		var checked = $("#sa").is(':checked'); 
		if(checked)
		{
			 for(var i=1;i<=leng_row;i++)
			 {
				$(".checkbox_id-"+i).attr('checked',true); 
			 }
		}
		else
		{
			 for(var i=1;i<=leng_row;i++)
			 {
				$(".checkbox_id-"+i).attr('checked',''); 
			 }
		}
	}
	
</script>
