<?php
class Events extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_events';
	protected $lb_primary_key = 'id_events';
	protected $lb_foreign_key = 'id_place';
	protected $lb_foreign_key_cate = 'id_category_events';
	protected $lb_foreign_name_cate = 'lb_name';
	protected $table_foreign_cate = 'pl_category_events';
	protected $lb_order_key = 'nb_order';
	
	function Events(){
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
	  @method build data for events
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_events');
		$data['add'] = 'events/add';
		$config['base_url'] = base_url().'events/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_order_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_events/events/events_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for events
	  @return array;
	**/  
	function add(){
		$data['title'] = lang('add');
		$this->form_validation->set_rules('lb_title',lang('title_events'),'trim|required');
		$this->form_validation->set_rules('lb_image',lang('image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,1);
			if($this->common->insert_data($this->lb_table,$data)){
			 	      
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('events');
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_events/events/events_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for events
	  @return array;
	**/
	function edit(){
		$rs     	  = $this->common->get_item($this->lb_table,$this->lb_primary_key);	
			$rs->dt_start =date_show($rs->dt_start);
		$data['rs'] = $rs;
		$rs_news     = $this->common->get_parent_id('pl_news','id_news',$rs->id_news);
		$data['title'] = lang('update').' '.$rs->lb_title;
		$this->form_validation->set_rules('lb_title',lang('title_events'),'trim|required');
		$this->form_validation->set_rules('lb_title',lang('image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data_update = $this->build_data($_POST,0);
			
			$wh_value =$this->uri->segment(3) ;
			if($this->common->update_data($this->lb_table,$data_update,$this->lb_primary_key,$wh_value)){
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('events/index');
			}
		}
		$data['js_news']    = $this->site_library->encodeForCombobox($rs_news, 'id_news','lb_title','');
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_events/events/events_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for events
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["lb_title"]=formatInputStr(trim($data["lb_title"]));
		$dataUpdate["id_news"]=formatInputStr(trim($data["id_news"]));
		$dataUpdate["lb_alias"]=formatInputStr(unsigned(trim($data["lb_title"])));
		$dataUpdate["lb_image"]=formatInputStr(trim($data["lb_image"]));
		$dataUpdate["lb_feeling"]=trim($data["lb_feeling"]);
		$dataUpdate["lb_description"]=trim($data["lb_description"]);
		$dataUpdate["dt_start"]=trim($data["dt_start"]);
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		if($flag==1){
			$rs = $this->common->get_id_max($this->lb_table,'nb_order');
			$id_old= (int)$rs->nb_order;
			$nb_order =$id_old +1;
			$dataUpdate['nb_order']=$nb_order;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
			$dataUpdate['lb_create_by']=$this->session->userdata('lb_login_name');
			$dataUpdate["dt_update"] = date('Y-m-d H:i:s') ;
		}
		$dataUpdate['lb_update_by']=$this->session->userdata('lb_login_name');
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for events
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('events/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for events
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
		redirect('events/index/0/'.$page);
	}    
}
?>
