<?php
class Image extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_image';
	protected $lb_primary_key = 'id_image';
	protected $lb_order_key = 'nb_order';
	
	#######
	protected $lb_foreign_key_category_image = 'id_category_image';
	protected $lb_foreign_name_category_image = 'lb_name';
	protected $table_foreign_category_image = 'pl_category_image';
	
	#######
	protected $lb_foreign_key_member = 'id_member';
	protected $lb_foreign_name_member = 'lb_name_member';
	protected $table_foreign_member= 'pl_member';

	function Image(){
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
	  @method build data for image
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_image');
		$data['add'] = 'image/add';
		$config['base_url'] = base_url().'image/index/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_num_rows($this->lb_table,$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] =   $this->common->get_all_paging($this->lb_table,$this->lb_order_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();            
		$this->_templates['page'] = 'manager_image/image/image_view';
		//$data_option['colsOptionSearch'] =json_encode($this->build_option_search());
		//$data_option['arr_edit_mask'] =json_encode($this->build_edit_mask());
		//$data['advance_search']= $this->load->view('modules/advanced_search_view',$data_option,true);
		$this->site_library->load($this->_templates['page'],$data);
	}
	function background($lb_alias){
		$arr_search = array();
		$start = (int)$this->uri->segment(4) ;
		$data['title'] = lang('list_image');
		$data['add'] = 'image/add';
		
		$data['list'] =   $this->common->get_all_image_background($lb_alias);
		$this->_templates['page'] = 'manager_image/image/image_bg_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for image
	  @return array;
	**/  
	function add(){
		$data['title'] = lang('add');
		$this->form_validation->set_rules('lb_name',lang('name_image'),'trim|required');
		$this->form_validation->set_rules('lb_image',lang('image'),'trim|required');
		// $this->form_validation->set_rules('id_category_image',lang('name_category_image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data = $this->build_data($_POST,1);
			if($this->common->insert_data($this->lb_table,$data)){
			 	      
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('image');
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_image/image/image_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for image
	  @return array;
	**/
	function edit(){
		$rs     	  = $this->common->get_item($this->lb_table,$this->lb_primary_key);		
		$rs_category_image     = $this->common->get_parent_id($this->table_foreign_category_image,$this->lb_foreign_key_category_image,$rs->id_category_image);
		$data['rs'] = $rs;
		$data['title'] = lang('update').' '.$rs->lb_name;
		$this->form_validation->set_rules('lb_name',lang('name_image'),'trim|required');
		$this->form_validation->set_rules('lb_image',lang('image'),'trim|required');
		// $this->form_validation->set_rules('id_category_image',lang('name_category_image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$data_update = $this->build_data($_POST,0);
			
			$wh_value =$this->uri->segment(3) ;
			if($this->common->update_data($this->lb_table,$data_update,$this->lb_primary_key,$wh_value)){
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('image');
			}
		}

		$data['message'] = $this->pre_message;
		$data['js_category_image']    = $this->site_library->encodeForCombobox($rs_category_image, $this->lb_foreign_key_category_image,$this->lb_foreign_name_category_image,'');
		$this->_templates['page'] = 'manager_image/image/image_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for image
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["lb_name"]=formatInputStr(trim($data["lb_name"]));
		$dataUpdate["lb_alias"]=formatInputStr(unsigned(trim($data["lb_name"])));
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		$dataUpdate["id_category_image"]=formatInputStr(trim($data["id_category_image"]));
		$dataUpdate["lb_summary"]=formatInputStr(trim($data["lb_summary"]));
		$dataUpdate["lb_image"]=formatInputStr(trim($data["lb_image"]));
		
		
		if($flag==1){
			$rs = $this->common->get_id_max($this->lb_table,'nb_order');
			$id_old= (int)$rs->nb_order;
			$nb_order =$id_old +1;
			$dataUpdate['nb_order']=$nb_order;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
			$dataUpdate['lb_create_by']=$this->session->userdata('lb_login_name');
			$dataUpdate["dt_update"] = date('Y-m-d H:i:s') ;
		}else{
			$dataUpdate['lb_update_by']=$this->session->userdata('lb_login_name');
		}
		return $dataUpdate;
	}
	
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for image
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('image/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for image
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
		redirect('image/index/0/'.$page);
	} 
		/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build field of image
	  @return array;
	**/
	function build_field(){
		$data = array();
		$data[]='id_image';
		$data[]='bl_active';
		$data[]='bl_approved';
		$data[]='dt_create';
		$data[]='lb_name';
		$data[]='lb_image';
		$data[]='lb_alias';
		return $data;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for option search
	  @return array;
	**/		
	function  build_option_search(){
		$data['lb_name'] = lang('name_image');
		$data['bl_approved'] = lang('bl_approved');
		return $data;
	}
	
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for edit mask
	  @return array;
	**/	
	function build_edit_mask(){
		###image
		$data['lb_name']['lb_source'] = $this->lb_table;
		$data['lb_name']['lb_value_field'] = $this->lb_primary_key;
		$data['lb_name']['lb_display_field'] = 'lb_name';
		###approved
		$data['bl_approved']['lb_source'] = $this->lb_table;
		$data['bl_approved']['lb_value_field'] = 'bl_approved';
		$data['bl_approved']['lb_display_field'] = 'bl_approved';
	
		return $data;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method search
	  @return array;
	**/
	function advance_search(){
		$type = $this->input->post("type");
		if($type=='ajax'){
			$strSearch = $this->input->post("strwhere");
			$main_table = $this->lb_table;
			$arrFields = array();
			$arr_datafield = $this->build_field();
			foreach ($arr_datafield as $k => $v) {
				$arrFields[] = $main_table . "." . $v;
			}
			$listFields = implode(",", $arrFields);
			$strFrom = $main_table;
			$arr_table_foreign = $this->build_table_foriegn();
			foreach($arr_table_foreign as $k=>$v){
				$strFrom .= " left join ".$k." ";
				$strFrom .= " on " . $main_table . "." . $v . "=" .$k . "." . $v. " ";
			}
			 $operator_old = '';
			$strWhere = '';
			$logic_ll = 'or';
			$arr_edit_mask = $this->build_edit_mask();
			foreach ($strSearch as $k => $v) {
				 $type = $this->input->post('type');
				$lb_field = $v['field'];
				$edit_mask = $arr_edit_mask[$lb_field];
				//print_r($edit_mask['lb_source']);
				if (!empty($edit_mask['lb_source'])) {
					$lb_value_field = $edit_mask['lb_value_field'];
					$lb_display_field = $edit_mask['lb_display_field'];
					$ref_table = $edit_mask['lb_source'];
					$lb_display_field = "lower(" . $ref_table . "." . $lb_display_field . ")";
					$field = $lb_display_field;
				}
				if ($v['operator'] == 'not') {
					$operator = 'and';
				} else {
					$operator = $v['operator'];
				}
				
				//$field = "lower(" . $main_table . "." . $v['field'] . ")";
				$value =$v['value'];
				$value = $this->db->escape_str($value);
				if ($v['logic'] == "<" || $v['logic'] == "<=" || $v['logic'] == ">" || $v['logic'] == ">=") {
				   $value = " '".$v['logic']." " . $value . "' ";
				} elseif ($v['logic'] == "=" || $v['logic'] == "<>") {
					$value = " '" . $value . "' ";
				} elseif ($v['logic'] == "like" || $v['logic'] == "notlike") {
					$value = " '%" . $value . "%' ";
				} elseif ($v['logic'] == "startWith") {
					$value = " '" . $value . "%' ";
				} elseif ($v['logic'] == "endWith") {
					$value = " '%" . $value . "' ";
				}

				###################
				if ($operator_old != 'not') {
					if ($v['value'] == '' && $v['logic'] == 'notlike') {
						//$value .= " or " . $field . " is null )";
						//$field = " ( " . $field;
					}
					else if ($v['value'] == '' && $v['logic'] != '<>') {
						$value .= " or " . $field . " is null )";
						$field = " ( " . $field;
					}
					else if ($v['value'] != '' && $v['logic'] == '<>') {
						$value .= " or " . $field . " is null )";
						$field = " ( " . $field;
					}//date: 06/10/2011
					
					else if ($v['value'] != '' && $v['logic'] == 'notlike') {
						$value .= " or " . $field . " is null )";
						$field = " ( " . $field;
					}//date: 06/10/2011
					else {
						$value .= " and " . $field . " is not null )";
						$field = " ( " . $field;
					}

					if ($v['logic'] == 'like' || $v['logic'] == 'startWith' || $v['logic'] == 'endWith') {
						$logic = "like";
					}else if($v['logic'] == 'notlike'){
						$logic = "not like";
					}
					else {
						$logic = $v['logic'];
					}
				}

				$strWhere = " ( " . $strWhere . " " . $field . " " . $logic . " " . $value . " ) " . $operator . " ";
				$operator_old = $v['operator'];
			}
			$strWhere = " where " . $strWhere;
			 $this->session->set_userdata('strWhere',$strWhere);
			 $this->session->set_userdata('strFrom',$strFrom);
			 $this->session->set_userdata('listFields',$listFields);
		}else{
			$strWhere=$this->session->userdata('strWhere');
			$strFrom=$this->session->userdata('strFrom');
			$listFields=$this->session->userdata('listFields');
		}
		$str_order_by =' ';
		$start = (int)$this->uri->segment(4) ;
		$config['base_url'] = base_url().'image/advance_search/'.(int)$this->uri->segment(3);  
		$data['num'] = $this->common->get_all_paging_search($strFrom,$listFields,$strWhere,$arr_order=array(),0,0);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 4;   
		$this->pagination->initialize($config);   
		$data['list'] = $this->common->get_all_paging_search($strFrom,$listFields,$strWhere,$arr_order=array(),$start,$config['per_page']);  
		$data['pagination']    = $this->pagination->create_links();
		$data['search'] = 'search';
		$this->_templates['page'] = 'manager_image/image/ajax_image_view';
		echo $this->load->view($this->_templates['page'],$data,true);
        
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build table foreign
	  @return array;
	**/		
	function  build_table_foriegn(){
		$data[$this->table_foreign_category_image] = $this->lb_foreign_key_category_image;
		return $data;
	}
	
}
?>
