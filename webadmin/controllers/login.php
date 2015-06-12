<?php
class login extends Controller
{
	protected $_templates;
	
	function login()
	{
		parent::Controller();
		@session_start();
		$this->load->model('login_model','login');
	}
	
	function index()
	{  
	  if($this->session->userdata('lb_login_name'))
	  {
		  redirect('admincp');
	  }       
	  $this->form_validation->set_rules('user_login',lang('user_name'),'trim|required|callback_check_login');
	  $this->form_validation->set_rules('user_pass',lang('password'),'trim|required');
	  if($this->form_validation->run()){
		  if($this->login->checklogin())
		  {
				
			  $this->session->set_flashdata('message',lang('login_success'));
			  redirect('admincp');
		  }
		  else
		  {
			  $this->session->set_flashdata('error',lang('err_login_unsuccsess').'.'. lang('please_check_info'));
		  }
	  }          
	  $this->load->view('login/index');
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		 session_unset();// delete all session.
		redirect(base_url());          
	}       
}
?>
