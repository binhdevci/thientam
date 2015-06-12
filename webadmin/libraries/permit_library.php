<?php
class permit_library
{
  function __construct()
  {
	 $this->CI =& get_instance();
	 //$this->check_permit();    
  }
  
  function check_permit() {
	
	
		 $AdminID = $this->CI->session->userdata('AdminID');
		 $this->CI->db->select('permission_detail.*, permission_admin.*');
		 $this->CI->db->join('permission_detail','permission_detail.ID = permission_admin.FunctionID');
		 $this->CI->db->where('permission_detail.PermissionName',$module);
		 $this->CI->db->where('permission_admin.AdminID',$AdminID);
		 $this->CI->db->where('permission_detail.FunctionName',$func);
		 $check = $this->CI->db->get('permission_admin')->row();
		 if(!$check)
		 {
			 $this->CI->session->set_flashdata('message','Bạn không có quyền thực thi chức năng trên');
			 redirect('admincp'); 
			 //redirect($this->CI->session->userdata('Url'));         
		 }
		 else
		 {
			// $this->write_logs($module,$func);
		 }
  }
  
  function write_logs($Modules,$Function)
  {
		$Url = $this->CI->session->userdata('Url');
		$AccountID = $this->CI->session->userdata('AdminID');
		$data = array(
			'AdminID' => $AccountID,
			'Modules' => $Modules,
			'Function' => $Function,
			'Url' => $Url,
			'LogInfo' =>$this->CI->agent->agent_string(),
			'LogIP' => $this->CI->input->ip_address(),
			'DateLog' => time()
		);
		$this->CI->db->insert('logs',$data);
  }
}
?>
