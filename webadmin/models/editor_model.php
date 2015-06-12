<?php
class editor_model extends Model{
	function editor_model(){
	  parent::Model();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get all file
	  @return void;
	**/
	function getAllFile($num,$offset) {
		$ar_img = array('gif','png','jpg','jpeg');
		$this->db->where_in('lb_ext',$ar_img);
		$this->db->order_by('file_data_id','DESC');
		$query = $this->db->get('sys_file_data',$num,$offset);
		return $query->result();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get num file
	  @return void;
	**/
	function getNumFile(){
		$query = $this->db->get('sys_file_data');
		return $query->num_rows();
	} 
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method upload file
	  @return void;
	**/
	function upload(){
		$this->load->library('upload_library');
		$size = $_FILES["filedata"]["size"];
		if($size > 0){
			$filedata = $this->upload_library->uploadfile();
			if($filedata!=''){
				$file = explode('*',$filedata);
				$url = $file[0];
				$size = $file[1];
				$ext = $file[2];
				$data = array(
				'lb_name' => $file[3],
				'lb_url' => $url,
				'lb_size' => $size,
				'lb_ext' => $ext
				);
				$this->db->insert('sys_file_data',$data);
				return $url;
			}
		}else{
			return '';
		}
	}       
}
?>
