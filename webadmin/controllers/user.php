<?php
class User extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_user';
	protected $lb_primary_key = 'id_user';
	#####################
	protected $lb_foreign_key = 'id_login_code';
	protected $lb_foreign_name = 'lb_name';
	protected $table_foreign = 'pl_login_code';
	
	function User(){
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
	  @method build data for user
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_user');
		$data['add'] = 'user/add';
		$config['base_url'] = base_url().'user/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_primary_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_system/user/user_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for user
	  @return array;
	**/  
	function add(){
		$data['title'] = lang('add');		
		$this->form_validation->set_rules('lb_name_user',lang('name_user'),'trim|required');
		$this->form_validation->set_rules('lb_login_name',lang('login_name'),'trim|required');
		$this->form_validation->set_rules('lb_password',lang('password'),'trim|required');		
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}
		else{			
			$data_build = $this->build_data($_POST,1);
			$flag = true;	
			if($flag==true && $this->common->check_duplicate($this->lb_table,'lb_login_name',$data_build['lb_login_name'],$this->lb_primary_key,0)==false){
				$flag = false;
			}
			
			if($flag==true&&$this->common->insert_data($this->lb_table,$data_build)){	      
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('user');
			}
			else{
				if($flag)
					$this->session->set_flashdata('message',lang('save_unsuccess'));
				else
					$this->session->set_flashdata('message',lang('login_name').lang('duplicate'));
			}
		}
		$data['message'] = $this->pre_message;		
		$this->_templates['page'] = 'manager_system/user/user_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}	
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for user
	  @return array;
	**/
	function edit(){
		$rs     = $this->common->get_item($this->lb_table,$this->lb_primary_key);		
		$data['rs'] = $rs;
		$rs_login_code     = $this->common->get_parent_id($this->table_foreign,$this->lb_foreign_key,$rs->id_login_code);
		$data['title'] = lang('update').' '.$rs->lb_name_user;
		$this->form_validation->set_rules('lb_name_user',lang('name_user'),'trim|required');
		$this->form_validation->set_rules('lb_login_name',lang('login_name'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data_build = $this->build_data($_POST,0);
			$wh_value =$this->uri->segment(3) ;
			$flag = true;
			if($rs->lb_login_name!=$data_build['lb_login_name']){
				if(($this->common->check_duplicate($this->lb_table,'lb_login_name',$data_build['lb_login_name'],$this->lb_primary_key,0))==false){
					$flag = false;
				}
			}	
			if($flag ==false){
				$this->session->set_flashdata('message',lang('login_name').lang('duplicate'));
			}else{	
				if($flag==true&&$this->common->update_data($this->lb_table,$data_build,$this->lb_primary_key,$wh_value)){
					$this->session->set_flashdata('message',lang('save_success'));
					redirect('user');
				}else{
						$this->session->set_flashdata('message',lang('save_unsuccess'));
				}
			}
		}
		$data['js_login_code']    = $this->site_library->encodeForCombobox($rs_login_code, $this->lb_foreign_key,$this->lb_foreign_name,'');
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_system/user/user_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for user
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["lb_name_user"]=formatInputStr(trim($data["lb_name_user"]));
		$dataUpdate["lb_login_name"]=formatInputStr(trim($data["lb_login_name"]));
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		$dataUpdate["id_login_code"]= trim($data["id_login_code"]);
		if($flag==1){
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
		}
		if(!empty($data["lb_password"])){
			$dataUpdate["lb_password"]=md5(formatInputStr(trim($data["lb_password"])));
		}
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for user
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('user/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for user
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
		redirect('user/index/0/'.$page);
	}    
}
?>
