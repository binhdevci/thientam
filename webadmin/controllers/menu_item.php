<?php
class Menu_item extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_menu_item';
	protected $lb_primary_key = 'id_menu_item';
	
	function Menu_item(){
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
	  @method build data for menu
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_menu_item');
		$data['add'] = 'menu_item/add';
		$config['base_url'] = base_url().'menu_item/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_primary_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_system/menu_item/menu_item_view';
		$data['rs_menu'] = $this->common->get_parent('pl_menu');
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for menu
	  @return array;
	**/  
	function add(){
		$data['title'] = lang('add');
		$this->form_validation->set_rules('lb_name',lang('name_menu_item'),'trim|required');
		$this->form_validation->set_rules('lb_name_display',lang('name_display'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,1);
			if($this->common->insert_data($this->lb_table,$data)){
			 	      
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('menu_item');
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_system/menu_item/menu_item_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for menu
	  @return array;
	**/
	function edit(){
		$rs     = $this->common->get_item($this->lb_table,$this->lb_primary_key);		
		$rs_menu    = $this->common->get_parent_id('pl_menu','id_menu',$rs->id_menu);
		$data['rs'] = $rs;
		$data['title'] = lang('update').' '.$rs->lb_name;
		$this->form_validation->set_rules('lb_name',lang('name_menu_item'),'trim|required');
		$this->form_validation->set_rules('lb_name_display',lang('name_display'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,0);
			
			$wh_value =$this->uri->segment(3) ;
			if($this->common->update_data($this->lb_table,$data,$this->lb_primary_key,$wh_value)){
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('menu_item/index');
			}
		}
		$data['js_menu']    = $this->site_library->encodeForCombobox($rs_menu, 'id_menu','lb_name','');
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_system/menu_item/menu_item_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for menu
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["id_menu"]=formatInputStr(trim($data["id_menu"]));
		$dataUpdate["lb_name"]=formatInputStr(trim($data["lb_name"]));
		$dataUpdate["lb_name_display"]=formatInputStr(($data["lb_name_display"]));
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		$dataUpdate["bl_is_product"]= (int) $this->input->post("bl_is_product") ;
		$dataUpdate["is_has_list"]= (int) $this->input->post("is_has_list") ;
		$dataUpdate["lb_alias"]=formatInputStr(unsigned(trim($data["lb_name_display"])));
		if($flag==1){
			$rs = $this->common->get_id_max($this->lb_table,'nb_order');
			$id_old= (int)$rs->nb_order;
			$nb_order =$id_old +1;
			$dataUpdate['nb_order']=$nb_order;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
		}
		$dataUpdate["dt_update"] = date('Y-m-d H:i:s') ;
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for menu
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('menu_item/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for menu
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
		redirect('menu_item/index/0/'.$page);
	}    
}
?>
