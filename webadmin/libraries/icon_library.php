<?php
  class icon_library{
      public function __construct(){
          $this->CI = &get_instance();
      }
      function publish($table,$field,$id,$status){
          if($status==0){
              $rep ='_x';
          }else{
              $rep ='';
          }
          return  '<a href="javascript:;" onclick="publish('.$table.','.$field.','.$id.','.$status.');" title="Bật | Tắt"><img src="'.base_url().'templates/images/icon/publish'.$rep.'.png"></a>';
      }
      function loadtypefile($file,$type){
          if($type=='gif' || $type=='jpg' || $type=='jpeg' || $type=='png'){
              return '<img src="'.base_url_site().$file.'" height="32">';
          }else if($type=='rar' || $type=='zip'){
              return '<img src="'.base_url().'templates/images/file/archive.png">';
          }else if($type=='doc' || $type=='docx'){
              return '<img src="'.base_url().'templates/images/file/document.png">';
          }else if($type=='xsl' || $type=='xslx'){
              return '<img src="'.base_url().'templates/images/file/spreadsheet.png">';
          }else if($type=='txt'){
              return '<img src="'.base_url().'templates/images/file/text.png">';
          }else if($type=='mp3' || $type=='swf'){
              return '<img src="'.base_url().'templates/images/file/audio.png">';
          }else if($type=='avi' || $type=='mp4' || $type=='flv'){
              return '<img src="'.base_url().'templates/images/file/video.png">';
          }else{
              return '<img src="'.base_url().'templates/images/file/default.png">';
          }
      }                  
  }
?>