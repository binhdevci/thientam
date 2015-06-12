<?php
class setting_library
{
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->setting();
	}
	
	function setting()
	{
		$query = $this->CI->db->get('config');           
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			foreach ($result as $row)
			{
				$this->setting[$row['name']] = $row['value'];
			}            
		}
	}                  
}
?>