<?
class editor extends Controller
{
    protected $_templates;
	
    function editor()
	{
        parent::Controller();
		 @session_start(); 
        $this->load->model('editor_model','editor');
    }
	function index()
	{
	  $data['title'] = '';
	  $config['base_url'] = base_url().'editor/index/';  
	  $data['total'] = $this->editor->getNumFile();
	  $config['total_rows']   =  $data['total'];
	  $config['per_page']  =   '10';
	  $config['uri_segment'] = 3;   
	  $this->pagination->initialize($config);   
	  $data['list'] =   $this->editor->getAllFile($config['per_page'],(int)$this->uri->segment('3'));
	  $data['pagination']    = $this->pagination->create_links();            
	  $this->_templates['page'] = 'editor/index';
	  $this->site_library->load($this->_templates['page'],$data,'editor');
	}
      
	function upload()
	{
	  $data['title'] = '';
	  $this->_templates['page'] = 'editor/upload';
	  $this->form_validation->set_rules('id','','');
	  if($this->form_validation->run())
	  {
		  $file = $this->editor->upload();
		  $data['file'] = $file;
		  redirect('editor');
	  }
	  $this->site_library->load($this->_templates['page'],$data,'editor');
	}
}
?>