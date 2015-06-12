<?php
class ajax extends Controller{
	function ajax()
	{
		parent::Controller();
		if (!isset($this->CI)){
            $this->CI =& get_instance();
        }
		 @session_start(); 
		 $this->load->library('string_library');
		 $this->load->model('ajax_model','ajax');
		 $this->load->helper('img_helper');
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method set active
	  @return string;
	**/
	function publish(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$field = $this->input->post('field');
		$table = $this->input->post('table');
		if($status==0){
			$pub = 1;
		}else{
			$pub = 0;
		}
		$this->db->set('bl_active',$pub);
		$this->db->where($field,$id);
		$this->db->update($table);
		echo icon_active("'$table'","'$field'",$id,$pub);
	}
	function order_sort()
	{
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$field = $this->input->post('field');
		$table = $this->input->post('table');
		$this->ajax->order_sort($table,$field,$id,$status);
		echo icon_order("'$table'","'$field'",$id);
	}
	function data_select()
	{
		$table = $this->input->post('table');
		$value_field = $this->input->post('value_field');
		$display_field = $this->input->post('display_field');
		$list_object = $this->ajax->data_select($table,$value_field,$display_field);

		echo '<option value="0" selected="selected"></option>';
		foreach($list_object as $row){
			echo '<option value="'.$row->$value_field.'">'.$this->echo_result($row,$display_field).'</option>';
		}			
	}
	function echo_result($row,$display_field,$deli_exp=',',$deli_imp="-")
	{
		$arr_exp = explode($deli_exp,$display_field);
		$arr_imp = array();
		foreach($arr_exp as $item){
			$arr_imp[] = $row->$item;
		}
		return implode($deli_imp,$arr_imp);
	}
	function statis(){
		$status = $this->input->post('status');//ok
		$dem=0;
		$now=getdate();
		if($status==0)//tuan
		{
			$now_day=$now["mday"]; //ok    7 14 21 28: 0 1 2 3			
			$this->db->select('dt_create');
			$query=$this->db->get('t_access');
			if($query->num_rows()>0) //ok=1
			{
				$dt=$query->result();
				if(floor($now_day/7)==0)
				{
					foreach($dt as $rs)
					{
						$d=date('d-m-Y',strtotime($rs->dt_create));
						$arr=explode('-',$d);
						$user_day=$arr[0];//ok
						
						if($user_day<=7)		
						{
							$dem++;
						}
					}//foreach
				}//if floor
				else if(floor($now_day/7)==1)
				{
					foreach($dt as $rs)
					{
						$d=date('d-m-Y',strtotime($rs->dt_create));
						$arr=explode('-',$d);
						$user_day=$arr[0];//ok
						
						if($user_day >7 && $user_day <=14)		
						{
							$dem++;
						}
					}//foreach
				}//if floor
				else if(floor($now_day/7)==2)
				{
					foreach($dt as $rs)
					{
						$d=date('d-m-Y',strtotime($rs->dt_create));
						$arr=explode('-',$d);
						$user_day=$arr[0];//ok
						
						if($user_day >14 && $user_day<=21)		
						{
							$dem++;
						}
					}//foreach
				}//if floor
				else//if(floor($now_day/7)==3)
				{
					foreach($dt as $rs)
					{
						$d=date('d-m-Y',strtotime($rs->dt_create));
						$arr=explode('-',$d);
						$user_day=$arr[0];//ok
						
						if($user_day>21)		
						{
							$dem++;
						}
					}//foreach
				}//if floor
			}
			echo  "Có ".$dem." người truy cập";
		}else if($status==1)//thang
		{
			//$pub = 0;
			
			
			$now_month=$now["mon"]; //ok
			//$this->db->where('id_access',$id);
			$this->db->select('dt_create');
			$query=$this->db->get('t_access');
			if($query->num_rows()>0) //ok=1
			{
				$dt=$query->result();
				foreach($dt as $rs)
				{
					$d=date('d-m-Y',strtotime($rs->dt_create));
					$arr=explode('-',$d);
					$user_month=$arr[1];//ok
					
					if($user_month==$now_month)		
					{
						$dem++;
					}
				}
			}
			echo  "Có ".$dem." người truy cập";
		}
		else// nam 
		{
			$now_year=$now['year']	;			
			//$this->db->where('id_access',$id);
			$this->db->select('dt_create');
			$query=$this->db->get('t_access');
			if($query->num_rows()>0)
			{
				$dt=$query->result();
				foreach($dt as $rs)
				{
					$d=date('d-m-Y',strtotime($rs->dt_create));
					$arr=explode('-',$d);
					$user_year=$arr[2];//ok
					
					if($user_year==$now_year)		
					{
						$dem++;
					}
				}
			}
			echo  "Có ".$dem." người truy cập.";
		}		
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method load combobox
	  @return string;
	**/
	function load_combobox($lb_source, $lb_value_field, $lb_display_field,$offset=0, $num=50) {
		$value = $this->CI->input->post('value');//get value post 
		$lb_value_field = $lb_value_field;
		$lb_display_field = $lb_display_field;
		$data_where = array();
        if (!empty($value)) {
            $value = $this->CI->db->escape_str($value);
            //$value = $this->strtolower_utf8($value);
            $num = 100000;
			$data_where = array('like'=>array($lb_display_field,$value));
        }
        $totalRec = $this->CI->common->select_data_paging_where_data_source($lb_source,'','',0,0,$data_where);   
        $total = $totalRec;
        $rs = '';
        if ($offset <= $total - 1) {
			$data = $this->CI->common->select_data_paging_where_data_source($lb_source,$lb_display_field,'ASC',$num,$offset,$data_where);
            if ($offset == 0)
                $rs['data'][''] = '';
            foreach ($data as $k => $v) {
				$rs['data'][$v->$lb_value_field] = $v->$lb_display_field;
            }
        }
        else
            $rs['data'] = null;
        $rs['total'] = $total;
        echo json_encode($rs);
    }
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method load info 
	  @return string;
	**/
	function get_info_string_id(){
		$lb_table = $this->CI->input->post('lb_table');//get value post 
		$lb_string_return = $this->CI->input->post('lb_string_return');//get value post 
		$lb_primary_key = $this->CI->input->post('lb_primary_key');//get value post 
		$value_primary_key = $this->CI->input->post('value_primary_key');//get value post 
		$rs = $this->CI->common->get_item_id($lb_table,$lb_primary_key,$value_primary_key);
		echo $rs->$lb_string_return;
		exit;
	}
}
?>
