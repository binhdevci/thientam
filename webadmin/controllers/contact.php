<?php
class Contact extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_contact';
	protected $lb_primary_key = 'id_contact';
	
	function Contact(){
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
	  @method build data for contact
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_contact');
		$config['base_url'] = base_url().'contact/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_primary_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_contact/contact/contact_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for contact
	  @return array;
	**/
	function edit(){
		$rs     = $this->common->get_item($this->lb_table,$this->lb_primary_key);	
		if($rs->bl_read !=1){
			$wh_value = $rs->id_contact;
			$build_data = $this->build_data_read();
			$this->common->update_data($this->lb_table,$build_data,$this->lb_primary_key,$wh_value);
		}
		$data['rs'] = $rs;
		$data['title'] = lang('update').' '.$rs->lb_title;
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_contact/contact/contact_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 18/09/2012
	  @method build data read for contact
	  @return array;
	**/
	function build_data_read(){
		
		$dataUpdate["bl_read"] = 1;
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for contact
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["lb_name"]=trim($data["lb_name"]);
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		if($flag==1){
			$kq=$this->common->get_id_max($this->lb_table,$this->lb_primary_key);
			$id_old= (int)$kq->id_contact;
			$id_new =$id_old +1;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
		}
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for contact
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('contact/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for contact
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
		redirect('contact/index/0/'.$page);
	}    
}
?>
