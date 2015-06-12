<?php
class upload_library{
	function __construct()
	{
	  $this->CI = get_instance();
	}     
	
	function uploadfile()
	{
		$folderName = date('m-Y');
		$pathToUpload = '../uploads/images/' . $folderName;
		$pathDir = '/' . $folderName.'/';
		if ( ! file_exists($pathToUpload) )
		{
			$create = mkdir($pathToUpload, 0777);
			if ( ! ($create))
			return;
		}
		if(is_uploaded_file($_FILES['filedata']['tmp_name']))
		{
			$filename = stripslashes($_FILES['filedata']['name']);
			$size = $_FILES["filedata"]["size"];
             
			$extension = strtolower($this->file_extension($filename)); 
			$name = date("dmYHis").'_'.$_FILES['filedata']['name'] ;          
			//$filename = '../uploads/images/'. $name ;
			$filename = $pathToUpload.'/'. $name ;
			$filedata = 'uploads/images/'.$folderName.'/'. $name ;
			if(move_uploaded_file($_FILES['filedata']['tmp_name'], $filename)){
				$size = ($size/1024);
				return $filedata.'*'.$size.'*'.$extension.'*'.$name;
			}else{
				return $filedata='';  
			}              
		}else{
			return $filedata=''; 
		}
	} 
	
	function file_extension($filename)
	{
		$path_info = pathinfo($filename); 
		return $path_info['extension'];
	}    
}  
?>
