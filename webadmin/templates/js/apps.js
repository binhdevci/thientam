function selectoption(id, value)
{
    var loca = document.getElementById(id).options ;
	for(var i=0;i<loca.length;i++){
		if(loca[i].value == value)
			loca[i].selected = true ;
	}
}
function changestatus(value,id)
{
    $("#loadstatus"+id).html('<image src="'+url+'templates/images/loading1.gif">');
    $.post(url+"order/changestatus",{'status':value,'id':id},function(data)
    {
        $("#loadstatus"+id).html('');  
                                                     
    },'json');    
}
function loadstatic()
{
    $("#static").html('<image src="'+url+'templates/images/loading.gif">');
    $.post(url+"ajax/thongke",{},function(data)
    {
        $("#static").html(data);                                               
    });     
}

//Site config
function loadConfig()
{
    $("#config").html('<image src="'+url+'templates/images/loading.gif">');
    $.post(url+"siteconfig/config",{},function(data)
    {
        $("#config").html(data);                                               
    });    
}

//Member
function updatemember(id){
    $("#page").html('<image src="'+url+'templates/images/loading.gif">');
    $.post(url+"member/update/",{'id':id},function(data)
    {
        $("#page").html(data);                                               
    });     
}

//Publish
function publish(table,field,id,status)
{
    $("#publish"+id).html('<image src="'+url+'templates/images/loading.gif">');
    $.post(url+"ajax/publish",{'table':table,'field':field,'id':id,'status':status},function(data)
    {
        $("#publish"+id).html(data);                                               
    });
}
//Order sort
function order_sort(table,field,id,status)
{
	$("#order_sort"+id).html('<image src="'+url+'templates/images/loading.gif">');
	$.post(url+"ajax/order_sort",{'table':table,'field':field,'id':id,'status':status},function(data)
    {
        $("#order_sort"+id).html(data);
		window.location.reload(true);	                                               
    });
}
//data for combobox
function data_select(table,value_field,display_field,id_select)
{
	$.post(url+"ajax/data_select",{'table':table,'value_field':value_field,'display_field':display_field},function(data)
	{
		$("#"+id_select).html(data);
	});
}
//disable id
function hide_id(id,hide)
{
	(hide==true)?$('#'+id).hide():$('#'+id).show();
}
$(function(){
    $("#title").keyup(function()
    {
        var word=$(this).val();
        $.post(url+"ajax/getalias/",{'name':word},function(data)
        {
            $("#alias").val(data);
        });
        return false;
    });
});
//statis
function statis(status)
{
    //$("#publish"+id).html('<image src="'+url+'templates/images/loading.gif">');
    $.post(url+"ajax/statis",{'status':status},function(data)
    {
        $("#statis").html(data);                                               
    });
}

function r(id_tag) {
	var isCheck = document.getElementById(id_tag).checked;
	var res = id_tag.substring(2);
	var result = document.getElementById(res).value;
	
	if(isCheck){	
		if(document.getElementById("w"+id_tag.substring(1)).checked) {	
			document.getElementById(res).value = '2';
		}else{
			document.getElementById(res).value = '1';
		}
	}else{
		var w_str = "w"+id_tag.substring(1);	
		document.getElementById(w_str).checked = false;
		document.getElementById(res).value = '';
	}	
}

function w(id_tag) {

	var isCheck = document.getElementById(id_tag).checked;	
	var r_str = "r"+id_tag.substring(1);	
	var result = id_tag.substring(2);	
	
	if(isCheck){		
		document.getElementById(r_str).checked = true;
		document.getElementById(result).value = '2';	
	}else{
		if(document.getElementById(r_str).checked){
			document.getElementById(result).value = '1';
		}else{
			document.getElementById(result).value = '';
		}
	}		
}
/**
 * @method convert link
 * 
 * @param objTagA
 * @param div
 * @return
 */
function convertLinkCodeAjax(objTagA, div) {
	var url = objTagA.href;
	objTagA.href = "javascript:void(0)";
	var browser = navigator.appName;
	
	if (browser == "Microsoft Internet Explorer") {
		objTagA.onclick = function() {
			$('#' + div).load(url + "/" );
		};
	} else
		objTagA.setAttribute("onclick", "$('#" + div + "').load('" + url + "/');");

}

function processPageBarCodeAjax(divPageBar, divAjax) 
{
	var common_page_bar = document.getElementById(divPageBar);
	var tagAs = common_page_bar.getElementsByTagName("A");
	if (tagAs) {
		for ( var i = 0; i < tagAs.length; i++) {
			convertLinkCodeAjax(tagAs[i], divAjax);
		}
	}
}
