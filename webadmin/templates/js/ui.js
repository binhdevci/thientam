jQuery(function($) {
	$(".cboxElement").colorbox({
        width:"730", height:"500", iframe:true     
    });
	 $("#addimages_avatar").colorbox({
        width:"730", height:"500", iframe:true     
    });
	$(".btnloadgroup").colorbox({
        width:"730", height:"500", iframe:true     
    });
	$(".btnloadshow").colorbox({
        width:"730", height:"500", iframe:true     
    });
	$(".colorbox").colorbox({iframe:true,scrolling:true, fixed:true, width:"900", height:"550"});
	$(".colorbox_upload").colorbox({iframe:true,scrolling:true, fixed:true,opacity:0.3,overlayClose:false ,width:"1100", height:"620"});
	$(".colorbox_view_tag").colorbox({iframe:true,opacity:0.3,width:"99%", height:"99%",scrolling:true,fixed:true});
	$('a.gallery').colorbox(function(){
		var url = $(this).attr('href');
		return '<img src="' + url + '" />';
	});
});
 