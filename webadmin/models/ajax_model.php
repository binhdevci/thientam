<?php
class ajax_model extends Model
{
	function ajax_model()
	{
		 parent::Model();
		 $this->load->model('common_model','common');
	}
  
	function search_song_file()
	{
		
	}
	
	function order_sort($lb_table,$wh_field,$wh_value,$status)
	{
		$num_rows = $this->common->get_num_rows($lb_table,null);
		
		$this->db->select('nb_order,'.$wh_field);
		$this->db->where($wh_field,$wh_value);
		$row_current = $this->db->get($lb_table)->row();
		
		if($status=='down')
		{
			if($row_current->nb_order == 1)
				return;
			$this->db->select('max(nb_order) nb_order');
			$this->db->where('nb_order <',(int)$row_current->nb_order);
			$nb_order = $this->db->get($lb_table)->row()->nb_order;
			
			$this->db->select('nb_order,'.$wh_field);
			$this->db->where('nb_order',$nb_order);
			$row_tmp = $this->db->get($lb_table)->row();
		}
		else
		{
			if($row_current->nb_order == $num_rows)
				return;
			$this->db->select('min(nb_order) nb_order');
			$this->db->where('nb_order >',(int)$row_current->nb_order);
			$nb_order = $this->db->get($lb_table)->row()->nb_order;
			
			$this->db->select('nb_order,'.$wh_field);
			$this->db->where('nb_order',$nb_order);
			$row_tmp = $this->db->get($lb_table)->row();
		}
		
		$this->db->where($wh_field,$wh_value);
		$data = array('nb_order'=>$row_tmp->nb_order);
		$this->db->update($lb_table,$data);
		
		$this->db->where($wh_field,$row_tmp->$wh_field);
		$data = array('nb_order'=>$row_current->nb_order);
		$this->db->update($lb_table,$data);
	}
	
	function data_select($table,$value_field,$display_field)
	{
		$this->db->select($value_field.','.$display_field);
		return $this->db->get($table)->result();
	}

/********* Upload img **********/ 
	function add_img($filename,$ProductID,$session)
	{
	  
		if($ProductID!=0)
		{
			if($filename!='')
			{
				fn_resize_image('../uploads/images/'.$filename,'../uploads/product/200/'.$filename,200,200);
				fn_resize_image('../uploads/images/'.$filename,'../uploads/product/80/'.$filename,80,80);
				fn_resize_image('../uploads/images/'.$filename,'../uploads/product/40/'.$filename,40,40);
				fn_resize_image('../uploads/images/'.$filename,'../uploads/product/30/'.$filename,30,30);
				
				//Doan nay lam meo hinh
				/*$this->ResizeImages('../uploads/images/'.$filename,'../uploads/product/200/'.$filename,200,200) ;
				$this->ResizeImages('../uploads/images/'.$filename,'../uploads/product/80/'.$filename,80,80) ;
				$this->ResizeImages('../uploads/images/'.$filename,'../uploads/product/40/'.$filename,40,40) ;
				$this->ResizeImages('../uploads/images/'.$filename,'../uploads/product/30/'.$filename,30,30) ;*/
			}  
		}  
		$data = array(
			'ImagePath' => $filename,
			'ProductID' => (int)$ProductID,
			'ImageSession' => ($ProductID!=0)? '' : $session
		);
		
		$this->db->insert('productimage',$data);
		
		return $this->db->insert_id();
	}

	function ResizeImages($src, $dest, $w, $h)
	{
		//include('SimpleImage.php');
		require_once APPEXCEL.'excel/SimpleImage.php';
		$image = new SimpleImage();
		$image->load($src);
		$image->resize($w,$h);
		$image->save($dest);
	}

}
?>
