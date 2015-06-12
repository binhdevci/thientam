<?php
class News_item extends Controller
{
	protected $_templates;
	protected $lb_table = 'pl_news_item';
	protected $lb_primary_key = 'id_news_item';
	protected $lb_foreign_key_cate = 'id_category_news';
	protected $lb_foreign_name_cate = 'lb_name';
	protected $table_foreign_cate = 'pl_category_news';
	protected $lb_order_key = 'nb_order';
	
	function News_item(){
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
	  @method build data for news
	  @return array;
	**/
	function index(){
		$arr_search = array();
		$id_menu_item =(int)$this->uri->segment(3);
		$item     	  = $this->common->get_parent_id('pl_menu_item','id_menu_item',$id_menu_item);	
		$start = (int)$this->uri->segment(5) ;
		$data['title'] = $item[0]->lb_name;
		$data['add'] = 'news_item/add/'.$id_menu_item;
		$config['base_url'] = base_url().'news_item/index/'.$id_menu_item."/".(int)$this->uri->segment(4);  
		$data['num'] = $this->common->get_num_rows_item($this->lb_table,$arr_search,$id_menu_item );
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '20';
		$config['uri_segment'] = 5;   
		
		$this->pagination->initialize($config);
		
		$data['list'] =   $this->common->get_all_paging_news_item($this->lb_table,$config['per_page'], $start,$id_menu_item);
		$data['pagination']    = $this->pagination->create_links();            
		$data['rs_cate'] = $this->common->get_parent($this->table_foreign_cate);
		$data['id_menu_item'] = $id_menu_item;
		$this->_templates['page'] = 'manager_news/news_item/news_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for news
	  @return array;
	**/  
	function add($id_menu_item){
		$item     	  = $this->common->get_parent_id('pl_menu_item','id_menu_item',$id_menu_item);	
		
		$data['item'] = $item;
		$data['title'] = lang('add').'-'.$item[0]->lb_name_display;
		$this->form_validation->set_rules('lb_title',lang('title_news'),'trim|required');
		$this->form_validation->set_rules('lb_image',lang('image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$_POST['id_menu_item'] = $id_menu_item;
			$data = $this->build_data($_POST,1);
			if($this->common->insert_data($this->lb_table,$data)){
				$id_news_item = $this->db->insert_id();
				if(isset($_POST["ar_id_news"])&&count($_POST["ar_id_news"])>0){
					$dataUpdate["lb_string_id_news"]=implode(',',$_POST["ar_id_news"]);
				}else{
					$dataUpdate["lb_string_id_news"]='';
				}
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('news_item/index/'.$id_menu_item);
			}
		}
		$data['message'] = $this->pre_message;
		$this->_templates['page'] = 'manager_news/news_item/news_add_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for news
	  @return array;
	**/
	function edit($id_menu_item){
		$rs     	  = $this->common->get_news_item($this->lb_table,$this->lb_primary_key);		
		
		if(empty($rs)){
			redirect('news_item/index/'.$id_menu_item);
		}
		
		$rs_category_news     = $this->common->get_parent_id($this->table_foreign_cate,$this->lb_foreign_key_cate,$rs->id_category_news);
		$data['rs'] = $rs;
		$data['title'] = lang('update').' '.$rs->lb_title;
		$this->form_validation->set_rules('lb_title',lang('title_news'),'trim|required');
		$this->form_validation->set_rules('lb_title',lang('image'),'trim|required');
		if($this->form_validation->run()== FALSE){
			$this->pre_message = validation_errors();
		}else{
			$_POST['id_menu_item'] = $id_menu_item;
			$data_update = $this->build_data($_POST,0);
			
			$wh_value =$this->uri->segment(4) ;
			if($this->common->update_data($this->lb_table,$data_update,$this->lb_primary_key,$wh_value)){
				$this->session->set_flashdata('message',lang('save_success'));
				redirect('news_item/index/'.$id_menu_item);
			}
		}
		$str_news_id = explode(',',$rs->lb_string_id_news);
		if(!empty($str_news_id)){
		$data['list_news'] =   $this->common->get_data_str($this->lb_table,$this->lb_primary_key,$str_news_id);
		}
		$data['message'] = $this->pre_message;
		$data['js_category_news']    = $this->site_library->encodeForCombobox($rs_category_news, $this->lb_foreign_key_cate,$this->lb_foreign_name_cate,'');
		$this->_templates['page'] = 'manager_news/news_item/news_edit_view';
		$this->site_library->load($this->_templates['page'],$data);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for news
	  @return array;
	**/
	function build_data($data,$flag=1){
		//flag=10?insert:update
		$dataUpdate["id_menu_item"]=trim($data["id_menu_item"]);
		$dataUpdate["id_category_news"]=trim($data["id_category_news"]);
		$dataUpdate["lb_title"]=formatInputStr(trim($data["lb_title"]));
		$dataUpdate["lb_price"]=formatInputStr(trim($data["lb_price"]));
		// $dataUpdate["lb_title_background"]=formatInputStr(trim($data["lb_title_background"]));
		$dataUpdate["lb_alias"]=formatInputStr(unsigned(trim($data["lb_title"])));
		$dataUpdate["lb_image"]=formatInputStr(trim($data["lb_image"]));
		// $dataUpdate["lb_image_home"]=formatInputStr(trim($data["lb_image_home"]));
		$dataUpdate["lb_summary"]=trim($data["lb_summary"]);
		$dataUpdate["lb_description"]=trim($data["lb_description"]);
		$dataUpdate["bl_active"]= (int) $this->input->post("bl_active") ;
		$dataUpdate["bl_is_product"]= (int) $this->input->post("bl_is_product") ;
		// $dataUpdate["bl_slide"]= (int) $this->input->post("bl_slide") ;
		// $dataUpdate["bl_video"]= (int) $this->input->post("bl_video") ;
		// $dataUpdate["bl_is_hot_news"]= (int) $this->input->post("bl_is_hot_news") ;
		
		if(empty($data["lb_title_seo"])){
			$dataUpdate["lb_title_seo"]=formatInputStr(trim($data["lb_title"]));
		}else{
			$dataUpdate["lb_title_seo"]=formatInputStr(trim($data["lb_title_seo"]));
		}
		if(empty($data["lb_keyword_seo"])){
			$dataUpdate["lb_keyword_seo"]=formatInputStr(trim($data["lb_title"]));
		}else{
			$dataUpdate["lb_keyword_seo"]=formatInputStr(trim($data["lb_keyword_seo"]));
		}
		if(empty($data["lb_description_seo"])){
			// $dataUpdate["lb_description_seo"]=formatInputStr(trim($data["lb_summary"]));
		}else{
			$dataUpdate["lb_description_seo"]=formatInputStr(trim($data["lb_description_seo"]));
		}
		if($flag==1){
			$rs = $this->common->get_id_max($this->lb_table,'nb_order');
			$id_old= (int)$rs->nb_order;
			$nb_order =$id_old +1;
			$dataUpdate['nb_order']=$nb_order;
			$dataUpdate["dt_create"] = date('Y-m-d H:i:s') ;
			$dataUpdate['lb_create_by']=$this->session->userdata('lb_login_name');
			
		}else{
			$dataUpdate["nb_order"]=trim($data["nb_order"]);
			$dataUpdate["dt_update"] = date('Y-m-d H:i:s') ;
		}
		
		$dataUpdate['lb_update_by']=$this->session->userdata('lb_login_name');
		return $dataUpdate;
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for news
	  @return array;
	**/
	function del(){
		$id = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$arr_where = array($this->lb_primary_key=>$id);
		if($this->common->delete_data($this->lb_table,$arr_where))
		  $this->session->set_flashdata('message',lang('delete_success'));
		else $this->session->set_flashdata('message',lang('delete_unsuccess'));
		redirect('news/index/0/'.$page);
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method build data for news
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
		redirect('news/index/0/'.$page);
	}    
	/**
	@author binh.ngo
	@date create 10/09/2012
	@method build data for purpose
	@return array;
	**/
	function list_news(){
		$arr_search = array();
		$data['title'] ='Danh sách tags';
		$start = (int)$this->uri->segment(4) ;
		$config['base_url'] = base_url().'tags/index/'.(int)$this->uri->segment(3);
		$data['num'] = $this->common->get_num_rows('pl_tags',$arr_search);
		$config['total_rows']   =  $data['num'];
		$config['per_page']  =   '40';
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['list'] =   $this->common->get_all_paging('pl_tags',$this->lb_order_key,$config['per_page'], $start,$arr_search);
		$data['pagination']    = $this->pagination->create_links();
		$this->_templates['page'] = 'manager_news/news_item/list_news_view';
		$this->site_library->load($this->_templates['page'],$data,'music');
	}
	/**
	@author binh.ngo
	@date create 10/09/2012
	@method build data append
	@return array;
	**/
	function get_news_append(){
		if(isset($_POST['str_news_id'])){
			$str_news_id = $_POST['str_news_id'];
		}else{
			$str_news_id = 0;
		}
		$data['list'] =   $this->common->get_data_str('pl_tags','id_tags',$str_news_id);
		$this->_templates['page'] = 'manager_news/news_item/table_news_view';
		echo $this->load->view($this->_templates['page'],$data,true);
	}
}
?>
