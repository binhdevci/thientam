<?php
class admincp extends Controller
{
	protected $_templates;
	 var $_userloginName;
    var $_userNameSesion;
	function admincp()
	{
		 parent::Controller();
			 @session_start(); 
		 //$this->permit_library->check_permit();
	 	 $this->session->set_userdata(array('Url'=>uri_string()));   
	  
		 $this->load->model('admincp_model','admincp');
		 $this->load->model('login_model','login');
	}
	
	function index()
	{
		 $data['title'] = lang('dashboard');
		
		
		if (isset($_SESSION['permission']) ) {
        } else {
			$login_name = $this->session->userdata('lb_login_name');
			if($login_name=='admin'){
				$rs = $this->login->getPermissionAsAdmin();
			}else{
				$rs = $this->login->get_permission($login_name);
			}
			$permissionArray=null;
			$parentMenus = null;
			$parentMenus = array();
			if($rs!=null){
				foreach ($rs as $per){
					if($login_name=='admin'){
						$permissionArray[$per['cd_screen']]=2;
						$parentMenus = $this->checkParentMenu($per['cd_screen'], $parentMenus);
					}else{
						if($per['nb_flag_permission'] >0){
							$parentMenus = $this->checkParentMenu($per['cd_screen'], $parentMenus);
							$permissionArray[$per['cd_screen']]=$per['nb_flag_permission'];
						}
						
					}
					
					
				}
			}
			$_SESSION['permission']=$permissionArray;
			$_SESSION['parentMenus']=$parentMenus;
           
        }
		 $this->_templates['page'] = 'admincp/index';
		 $this->site_library->load($this->_templates['page'],$data);
	}
	function checkParentMenu($screen, $parentMenus) {
		if($screen == 'PL_INFO_COMPANY' || $screen == 'PL_SUPPORT_ONLINE' || $screen == 'PL_USER'
			|| $screen == 'PL_LOGIN_CODE' || $screen == 'PL_SCREEN' ){
			$parentMenus['M_SYSTEM'] = 1;
		}else if($screen == 'PL_CATEGORY_PRODUCT' || $screen == 'PL_PRODUCT'){
			$parentMenus['M_PRODUCT'] = 1;
		}else if($screen == 'PL_CATEGORY_NEWS' || $screen == 'PL_NEWS'){
			$parentMenus['M_NEWS'] = 1;
		}else if($screen == 'PL_PROVINCE' || $screen == 'PL_DISTRICT' || $screen == 'PL_REGION'
			|| $screen == 'PL_PURPOSE' || $screen == 'PL_CATEGORY_PLACE' || $screen == 'PL_PLACE'
			|| $screen == 'PL_CRITERIAL_PLACE' || $screen == 'PL_UTILITY_PLACE' || $screen == 'PL_GROUP_UTILITY'
			|| $screen == 'PL_ORIGINAL_PRODUCT' || $screen == 'PL_SESSION_PLACE' || $screen == 'PL_GROUP_PURPOSE'){
			$parentMenus['M_SCHEDULE'] = 1;
		}else if($screen == 'PL_PARTNERS' ){
			$parentMenus['M_PARTNERS'] = 1;
		}else if($screen == 'PL_COMMENT_PRODUCT'|| $screen == 'PL_MEMBER'){
			$parentMenus['M_COMMENT'] = 1;
		}else if($screen == 'PL_GALLERY' || $screen == 'PL_ALBUM'|| $screen == 'PL_CATEGORY_ALBUM'){
			$parentMenus['M_IMAGE'] = 1;
		}
				
		return $parentMenus;	
		
	}
	function quickpost()
	{
		 $this->load->view('modules/mod_quickpost');
	}
	
	function close(){
		 $this->load->view('close');
	}
}
?>
