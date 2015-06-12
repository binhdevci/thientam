<?php
  class editor_library{
      function __construct(){
          $this->CI = get_instance();
      }
      function editor_advanced($name,$value,$error){
          $data ='<script type="text/javascript" src="'.base_url().'templates/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
          $data .='<script type="text/javascript">';
          $data .='
            tinyMCE.init({
                // General options
                mode : "exact",
                elements : "'.$name.'",
                theme : "advanced",
                skin : "o2k7",
                skin_variant : "black",
                editor_selector : "advancedEditor",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "bullist,numlist,outdent,indent,blockquote,undo,redo,link,unlink,image,code,forecolor,backcolor,iespell,media,fullscreen",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "'.base_url().'templates/tinymce/js/css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "'.base_url().'templates/tinymce/js/lists/template_list.js",
                external_link_list_url : "'.base_url().'templates/tinymce/js/lists/link_list.js",
                external_image_list_url : "'.base_url().'templates/tinymce/js/lists/image_list.js",
                media_external_list_url : "'.base_url().'templates/tinymce/js/lists/media_list.js"


            });          
          ';
          $data .='</script>';
          $data .='<textarea id="'.$name.'" name="'.$name.'" rows="20" cols="100" style="width: 100%">'.$value.'</textarea>'.$error;
          return $data;
      }
	  
	  function editor_simply($name,$value,$error){
          $data ='<script type="text/javascript" src="'.base_url().'templates/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
          $data .='<script type="text/javascript">';
          $data .='
            tinyMCE.init({
                // General options
                mode : "exact",
                elements : "'.$name.'",
                theme : "advanced",
                skin : "o2k7",
                skin_variant : "black",
                editor_selector : "advancedEditor",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "bullist,numlist,outdent,indent,blockquote,undo,redo,link,unlink,image,code,forecolor,backcolor,iespell,media,fullscreen",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "'.base_url().'templates/tinymce/js/css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "'.base_url().'templates/tinymce/js/lists/template_list.js",
                external_link_list_url : "'.base_url().'templates/tinymce/js/lists/link_list.js",
                external_image_list_url : "'.base_url().'templates/tinymce/js/lists/image_list.js",
                media_external_list_url : "'.base_url().'templates/tinymce/js/lists/media_list.js"


            });          
          ';
          $data .='</script>';
          $data .='<textarea id="'.$name.'" name="'.$name.'" rows="20" cols="100" style="width: 100%">'.$value.'</textarea>'.$error;
          return $data;
      }
	  
      function editor_simply1($name,$value,$error){
          $data ='<script type="text/javascript" src="'.base_url().'templates/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
          $data .='<script type="text/javascript">';
          $data .='
            tinyMCE.init({
                // General options
                mode : "exact",
                elements : "'.$name.'",
                theme : "advanced",
                skin : "o2k7",
                skin_variant : "black",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,|,forecolor,backcolor,|,blockquote,|,link,image,code,|,emotions,iespell,media,|,fullscreen",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "center",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,

                // Example content CSS (should be your site CSS)
                content_css : "'.base_url().'templates/tinymce/js/css/content.css",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "'.base_url().'templates/tinymce/js/lists/template_list.js",
                external_link_list_url : "'.base_url().'templates/tinymce/js/lists/link_list.js",
                external_image_list_url : "'.base_url().'templates/tinymce/js/lists/image_list.js",
                media_external_list_url : "'.base_url().'templates/tinymce/js/lists/media_list.js"


            });          
          ';
          $data .='</script>';
          $data .='<textarea id="'.$name.'" name="'.$name.'" rows="10" cols="100" style="width: 100%">'.$value.'</textarea>'.$error;
          return $data;
      }
      
      function editornice($name,$value){
          $data ='
            <script type="text/javascript" src="'.base_url().'system/application/views/theme/system/js/nicEdit.js"></script>
            <script>
                 var area1;
                 function toggleArea1() {
                    if(!area1) {
                        area1 = new nicEditor({fullPanel : true}).panelInstance(\''.$name.'\',{hasPanel : true});
                    } else {
                        area1.removeInstance(\''.$name.'\');
                        area1 = null;
                    }
                  }
                  bkLib.onDomLoaded(function() { toggleArea1(); });
            </script>          
          ';
          $data .='<textarea id="'.$name.'" name="'.$name.'" cols="" rows="" style="width: 99%;height: 200px;">'.$value.'</textarea>';
          return $data;
      }
      
      function fck($editor){
          $data = '
            <script type="text/javascript" src="'.base_url_site().'editor/fckeditor/ckeditor.js"></script>
            <script type="text/javascript">

             CKEDITOR.replace( \''.$editor.'\',
             {
                //
                extraPlugins : \'MediaEmbed\',
                 toolbar :
                    [
                        [\'Source\'],
                        [\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Scayt\'],
                        [\'Undo\',\'Redo\',\'-\',\'Find\',\'Replace\',\'-\',\'SelectAll\',\'RemoveFormat\'],
                        [\'Image\',\'Flash\',\'Table\',\'HorizontalRule\',\'Smiley\',\'SpecialChar\',\'PageBreak\'],
                        [\'Maximize\',\'-\',\'About\'],
                        \'/\',
                        [\'Styles\',\'Format\'],
                        [\'Bold\',\'Italic\',\'Strike\'],[\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
                        [\'NumberedList\',\'BulletedList\',\'-\',\'Outdent\',\'Indent\',\'Blockquote\'],
                        [\'Link\',\'Unlink\',\'Anchor\',\'MediaEmbed\']
                    ],
                filebrowserBrowseUrl : \''.base_url_site().'editor/ckfinder/ckfinder.html\',
                 filebrowserImageBrowseUrl : \''.base_url_site().'editor/ckfinder/ckfinder.html?type=Images\',
                 filebrowserFlashBrowseUrl : \''.base_url_site().'editor/ckfinder/ckfinder.html?type=Flash\',
                filebrowserUploadUrl : \''.base_url_site().'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files\',
                 filebrowserImageUploadUrl : \''.base_url_site().'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images\',
                 filebrowserFlashUploadUrl : \''.base_url_site().'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash\'
             } 
             
             );
            </script>          
          ';
          return $data;
      }
  }
?>
