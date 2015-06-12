var txtbox =  new function()
{
	var valueold = '';
	var newvalue = '';
	var id = '';
	var flag = true;
	
	
 	function default_value()
	{
		$('#'+this.divid).html(newvalue) ;
	}
	
	function new_value()
	{
		$('#'+this.divid).html(newvalue) ;
	}
	return {
		divid: '' ,
		edit:function(divid, song, chart)
		{
			this.divid = divid ;
			if(flag)
			{
				valueold = $('#'+divid).html() ;
				var str = '<input type="text" name="txtbox_name" id="txtbox_name" value="'+valueold+'" size=15 /><a href="javascript:txtbox.save('+song +','+chart +');"> Save</a>|<a href="javascript:txtbox.cancel();"> Cancel</a>';
				$('#'+divid).html(str);
				flag = false;
			}
		},
		
		save:function (song, chart)
		{
			newvalue = $("#txtbox_name").val() ;
			$.post(url+'chart/addvote',{'new_vote':newvalue, 'old_vote':valueold, 'song_id':song, 'chart_id':chart}, function(res)
			{
				if(res==1)
				{
					$('#'+txtbox.divid).html(newvalue) ;
				}
				else
				{
					 $('#'+txtbox.divid).html(valueold) ;
				}
			});
			flag = true ;
		},
		cancel:function ()
		{
			$('#'+this.divid).html(valueold) ;
			flag = true ;
		}
		
	};
};