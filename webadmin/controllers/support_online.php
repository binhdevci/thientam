<?php
class Support_online extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_support_online';
	protected $lb_primary_key = 'id_support_online';
	
	function Support_online(){
		parent::Controller();
		 @session_start(); 
		$this->pre_message = "";
		$this->session->set_userdata(array('Url'=>uri_string()));
		$this->load->model('common_model','common');
		$this->load->library('editor_library');
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_support_online');
		$data['add'] = 'support_online/add';
		$config['base_url'] = base_url().'support_online/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_primary_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_system/support_online/support_online_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/  
	function add(){
		$data['title'] = lang('add');
		$this->form_validation->set_rules('lb_name',lang('support_name'),'trim|required');
		$this->form_validation->set_rules('lb_name_present',lang('name_present'),'trim|required');
		$this->form_validation->set_rules('lb_yahoo',lang('yahoo'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,1);
			if($this->common->insert_data($this->lb_table,$data)){
			 	      
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('support_online');
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_system/support_online/support_online_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/
	function edit(){
		$rs     = $this->common->get_item($this->lb_table,$this->lb_primary_key);		
		$data['rs'] = $rs;
		$data['title'] = lang('update').' '.$rs->lb_name;
		$this->form_validation->set_rules('lb_name',lang('support_name'),'trim|required');
		$this->form_validation->set_rules('lb_name_present',lang('name_present'),'trim|required');
		$this->form_validation->set_rules('lb_yahoo',lang('yahoo'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,0);
			
			$wh_value =$this->uri->segment(3) ;
			if($this->common->update_data($this->lb_table,$data,$this->lb_primary_key,$wh_value)){
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('support_online/index/0/'.$page);
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_system/support_online/support_online_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["lb_name"]=formatInputStr(trim($data["lb_name"]));
		$dataUpdate["lb_name_present"]=formatInputStr(($data["lb_name_present"]));
		$dataUpdate["lb_yahoo"]=formatInputStr(trim($data["lb_yahoo"]));
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		$dataUpdate["lb_skype"]=formatInputStr(trim($data["lb_skype"]));
		if($flag==1){
			$rs = $this->common->get_id_max($this->lb_table,'nb_order');
			$id_old= (int)$rs->nb_order;
			$nb_order =$id_old +1;
			$dataUpdate['nb_order']=$nb_order;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
		}
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('support_online/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for support_online
	  @return array;
	**/	
	function dels(){
		if(!empty($_POST['ar_id'])){
			$page = (int)$this->input->post('page');
			$ar_id = $this->input->post('ar_id');
			if(!empty($_POST['btn_submit'])){
				for($i = 0; $i < sizeof($ar_id); $i ++){
					if ($ar_id[$i]){
						$arr_where = array($this->lb_primary_key=>$ar_id[$i]);
						if($this->common->delete_data($this->lb_table,$arr_where))
							$this->session->set_flashdata('message',lang('delete_success'));
						else $this->session->set_flashdata('message',lang('delete_unsuccess'));
					}
				}
			}
		}
		redirect('support_online/index/0/'.$page);
	}    
}
?>
