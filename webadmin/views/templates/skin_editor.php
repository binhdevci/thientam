<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Quản trị hệ thống</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/system.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/layout_basic.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/icon.css">

<script type="text/javascript" src="<?=base_url()?>templates/js/jquery-core.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/apps.js"></script>
<script type="text/javascript">

        var CKEDITOR = window.parent.CKEDITOR;

        function windowClose()
        {
            CKEDITOR.dialog.getCurrent().hide();
        }

        function insertHTML(html)
        {
            window.parent.instance.insertHtml(html);
        }

        (function($)
        {
            $(window).ready(function() {
                window.parent.jQuery('.cke_dialog_footer').hide();
            });

        })(jQuery);
    </script>
<script type="text/javascript">
var CKEDITOR = window.parent.CKEDITOR;
var img_float;
function insertImage(file, alt)
{
    if(replace_html)
    {
        replace_html.remove();
    }
    var img_width = document.getElementById('insert_width').value;
	var img_float = get_float();
	var img_size = '';
	var img = new Image();
	img.src = file;
    if(img_width>0){
		img_size = 'width:'+img_width+'px;';
    }
	else{
		img_size = 'height:'+img.height+'px;width:'+img.width+'px;';	
	}
    //window.parent.instance.insertHtml('<img class="vnit_img" style="float: '+get_float()+';" src="' + file + '" alt="' + alt + '" '+img_width+' />');
	window.parent.instance.insertHtml('<img class="vnit_img" style="float: '+img_float+';'+img_size+'" src="' + file + '" alt="' + alt + '" />');
    windowClose();
}

function get_float()
{
    img_float = jQuery('input[name=insert_float]:checked').val();
    return img_float;
}

// By default, insert (which will also replace)
var replace_html = null;

(function($)
{
    $(function()
    {
        function detectFile()
        {
            // Get whatever is selected
            selection = window.parent.instance.getSelection();

            // A Tag has been fuly selected
            if(selection.getSelectedElement())
            {
                element = jQuery( selection.getSelectedElement().$ );
            }

            // If the cursor is anywhere in the textbox
            else(selection.getRanges()[ 0 ])
            {
                // Find the range of the selection
                range = selection.getRanges()[ 0 ];
                range.shrink( CKEDITOR.SHRINK_TEXT );

                // Have they clicked inside an <img> tag?
                maybe_element = range.getCommonAncestor().getAscendant( 'img', true );

                if(!maybe_element) return false;
                else element = jQuery(maybe_element.$);

                // Save this HTML to be replaced up update
                replace_html = maybe_element;
            }

            if( ! element.hasClass('vnit_img')) return false;

            $('#current_document').load(BASE_URI + 'admin/wysiwyg/files/ajax_get_file', {
                doc_id: element.attr('href').match(/\/download\/([0-9]+)/)[1]
            });

            return true;
        }

        detectFile() || $('#current_document h2').hide();
        
        $('#images-container img').hover( function() {
            $(this).attr('title', 'Click to insert image');
        });
    });
})(jQuery);
</script> 
<style type="text/css">
ul.list_img{
    padding: 0;
}
ul.list_img li{
    float: left;
    width: 100px;
    height: 100px;
    padding: 3px;
    border: 1px solid #c0c0c0;
    margin: 3px;
}
ul.list_img li img{
    width: 96px;
    height: 66px;
}
ul.list_img li .title{
    font-size: 11px;
    overflow: hidden;
    
}
.vnit_img:hover{
    cursor: pointer;
}
</style>
</head>
<body>
    <div class="wrapper">
        <?=$this->load->view($page)?>
    </div>
</body>
</html>
