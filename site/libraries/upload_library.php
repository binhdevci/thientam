<?php
class upload_library{
	function __construct(){
		$this->CI = get_instance();
	}
	
	function file_extension($filename)	{
		$path_info = pathinfo($filename);
		return $path_info['extension'];
	}
	
}
?>
