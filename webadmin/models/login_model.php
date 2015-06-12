<?php
class login_model extends Model{
	function login_model(){
		parent::Model();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method check login
	  @return void;
	**/
	function checklogin(){
		$username = $this->input->post('user_login');
		$password = md5($this->input->post('user_pass'));
		$this->db->where('lb_login_name',$username);
		$this->db->where('lb_password',$password);
		$query = $this->db->get('pl_user');
		if($query->row()){
			$row = $query->row_array();
			$this->session->sess_destroy();
			$this->session->sess_create(); 
			$this->session->set_userdata($row);
			//Set logged_in to true
			$this->session->set_userdata(array('logged_in' => true));               
			return true;
		}else{
			return false;
		}          
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get permission 
	  @return array;
	**/	
	function get_permission($username){
		$sql="SELECT DISTINCT ";
		$sql.="`ep`.`id_login_code`, ";
		$sql.="`ep`.`cd_screen`, ";
		$sql.="`ep`.`nb_flag_permission`, ";
		$sql.="`ee`.`lb_login_name` ";
		$sql.="FROM ";
		$sql.="`pl_user` AS `ee` ";
		$sql.="Inner Join `pl_permission` AS `ep` ON `ee`.`id_login_code` = `ep`.`id_login_code` ";
		$sql.="WHERE ";
		$sql.="`ee`.`lb_login_name` = '$username' ";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get permission admin 
	  @return array;
	**/	
	function getPermissionAsAdmin(){
		$sql="SELECT ";
		$sql.="`es`.`cd_screen`, ";
		$sql.="2 as nb_flag_permission ";
		$sql.="FROM ";
		$sql.="`pl_screen` AS `es` ";
		$rs = $this->db->query($sql);
		return $rs->result_array();
	}
}
?>
