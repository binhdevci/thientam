<?
class Common_model extends Model{
	protected $lb_table_permission = 'pl_permission';
	function Common_model(){
		 parent::Model();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data
	  @return void;
	**/
    function select_data($list_fields,$lb_table,$str_where,$type="obj",$row=false){
        try{
            $rs=array();
            $sql = sprintf("SELECT ".(($list_fields!="")? $list_fields:"*")."
                            FROM ". $lb_table."
                            ".$str_where);
            $query = $this->db->query($sql);
            if($type=="arr")
                if($row)
                    $rs = $query->row_array();
                else
                    $rs	= $query->result_array();
            elseif($type=="obj")
                if($row)
                    $rs = $query->row();
                else
                    $rs = $query->result();

            return $rs;
        }catch(Exception $ex){
			return false;
        }
    }
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data paging
	  @return void;
	**/
	function get_all_paging($lb_table,$lb_primary_key,$num,$offset,$arr_search=array(),$arr_order=array()){
			if(isset($arr_search['key_search'])&&$arr_search['key_search']!=''){
					$this->db->where($arr_search['field_search'],$arr_search['key_search']);
			}
			if(isset($arr_order['order_key'])&&$arr_order['order_key']!=''){
				$this->db->order_by($arr_order['order_key'],$arr_order['order_type']);
			}
			else
				$this->db->order_by($lb_primary_key,'DESC');
		return $this->db->get($lb_table,$num,$offset)->result();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data paging
	  @return void;
	**/
	function get_all_paging_news($num,$offset,$id_category_news=0){
		if($id_category_news >0){
		$query = " select
					n.id_news,n.bl_active,
					 n.lb_title,n.lb_title_background,n.lb_summary,n.lb_description,n.lb_image_home
					 ,n.lb_image,n.lb_string_id_news,n.lb_video,n.bl_slide
					 ,n.lb_alias,n.dt_create,n.lb_create_by,
					 c.lb_name
					from 
					pl_news n
					left join pl_category_news c on n.id_category_news = c.id_category_news
					where 1=1 and
					n.id_category_news =?
					order by c.id_category_news DESC
					limit ?,?	
				";
				
				$query = $this->db->query($query,array($id_category_news,$offset,(int)$num));
				return $query->result();
			}else{
				$query = " select
					n.id_news,n.bl_active,
					 n.lb_title,n.lb_title_background,n.lb_summary,n.lb_description,n.lb_image_home
					 ,n.lb_image,n.lb_string_id_news,n.lb_video,n.bl_slide
					 ,n.lb_alias,n.dt_create,n.lb_create_by,
					 c.lb_name
					from 
					pl_news n
					left join pl_category_news c on n.id_category_news = c.id_category_news
					where 1=1
					order by c.id_category_news DESC
					limit ?,?	
				";
				$query = $this->db->query($query,array($offset,(int)$num));
				return $query->result();
				}
			
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data paging
	  @return void;
	**/
	function get_all_paging_search($strFrom,$listFields,$strWhere,$arr_order=array(),$num,$offset){
		if($num==0&&$offset==0){
			$sql ="select * from ".$strFrom.' '.$strWhere;
			$query = $this->db->query($sql);
			return $query->num_rows();
		}else{
			$sql ="select " .$listFields. " from ".$strFrom.' '.$strWhere.' limit '.$num.','.$offset;
			$query = $this->db->query($sql);
			return $query->result();
		}	
		
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data foreign table
	  @return void;
	**/
	function get_parent($lb_table_foreign){
		return $this->db->get($lb_table_foreign)->result();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data foreign table
	  @return void;
	**/
	function get_parent_id($lb_table,$lb_foreign_key,$id){
		if($id>0){
			 $this->db->where($lb_foreign_key,$id);
			 $query = $this->db->get($lb_table);
			 return $query->result();
		}
		return array();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data foreign table
	  @return void;
	**/
	function get_all($lb_table,$lb_field,$value){
		 $this->db->where($lb_field,$value);
		  $this->db->where('bl_active',1);
		 $query = $this->db->get($lb_table);
		 return $query->result();
		return array();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select number rows
	  @return void;
	**/
	function get_num_rows($lb_table,$arr_search=array(),$id_category_news=0){
        /*Begin search*/
        if(isset($arr_search['key_search'])&&$arr_search['key_search']!=''){
                $this->db->where($arr_search['field_search'],$arr_search['key_search']);
        }
        /*End search*/
		if($id_category_news>0){
        $this->db->where('id_category_news',$id_category_news);
		}
		$query = $this->db->get($lb_table);
		return $query->num_rows();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select item rows
	  @return object;
	**/
	function get_item($lb_table,$lb_primary_key){
         $id = (int)$this->uri->segment(3);
		 $this->db->where($lb_primary_key,$id);
		 $query = $this->db->get($lb_table);
		 return $query->row();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select item rows id
	  @return object;
	**/
	function get_item_id($lb_table,$lb_primary_key,$id){
		 $this->db->where($lb_primary_key,$id);
		 $query = $this->db->get($lb_table);
		 return $query->row();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select item rows
	  @return object;
	**/
	function get_item_info_company($lb_table,$lb_primary_key){
         $id = 1;
		 $this->db->where($lb_primary_key,$id);
		 $query = $this->db->get($lb_table);
		 return $query->row();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method save update data 
	  @return void;
	**/
    function update_data($lb_table,$data,$wh_field,$wh_value){
        try{
            $this->db->where($wh_field, $wh_value);
            $rs=$this->db->update($lb_table, $data);
            return $rs;
        }catch(Exception $ex){
            return false;
        }
    }
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get max id data 
	  @return void;
	**/
	function get_id_max($lb_table,$id_field){
		try{
			$this->db->select_max($id_field);			
			$query=$this->db->get($lb_table);			
			return $query->row();
		}catch(Exception $ex){
			return false;	
		}					
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method save insert data 
	  @return void;
	**/
    function insert_data($lb_table,$data){
        try{			
            $rs=$this->db->insert($lb_table, $data);
			return $rs;
        }catch(Exception $ex){
            return false;
        }
    }
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method save insert data 
	  @return void;
	**/
    function insert_data_last_id($lb_table,$data){
        try{			
            $rs=$this->db->insert($lb_table, $data);
			$rs = $this->db->insert_id();
			return $rs;
        }catch(Exception $ex){
            return false;
        }
    }
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method delete data 
	  @return void;
	**/
    function delete_data($table_name,$arr_where){
        try{
            $rs=$this->db->delete($table_name,$arr_where);
            return $rs;
        }catch(Exception $ex){
            return false;
        }
    }
	//true=>not duplicate
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method check duplicate data 
	  @return void;
	**/
	function check_duplicate($lb_table,$wh_field,$wh_value,$lb_primary_key,$val_primary_key){
		try{
			$this->db->where($wh_field,$wh_value);			
			if($val_primary_key>0){
				$this->db->where($lb_primary_key.' != '.$val_primary_key);
			}
			$query=$this->db->get($lb_table);
			if(count($query->result())>0)
				return false;
        }catch(Exception $ex){
            return false;
        }
		return true;
	}
	//binh.ngo
	//get data paging num row where
	//date 30/7/2012
	function select_data_paging_where_data_source($main_table,$order_by = "", $order = "ASC",$num,$offset,$data_where){
		if(!empty($data_where)){
			foreach($data_where as $k=>$v){
				if($k=='like'){
					$this->db->like($v[0],$v[1]);
				}
			}
		}
		
		if($num==0&&$offset==0){
			$query = $this->db->get($main_table);
			return $query->num_rows();
		}else{
			if($order_by!=''){
				$this->db->order_by($order_by,$order);
			}
			$query = $this->db->get($main_table,$num,$offset);
			return $query->result();
		}
	}
	//binh.ngo
	//get data  where in
	//date 30/7/2012
	function get_data_str($lb_table,$lb_primary_key,$arr_id){
		
		$this->db->where_in($lb_primary_key,$arr_id);
		return $this->db->get($lb_table)->result();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method get permission with screen and id login code
	  @return array;
	**/	
	function get_flag_permission($id_login_code,$cd_screen){
		//$id_login_code = (int)$this->uri->segment(3);
		$str_where ="WHERE id_login_code ='".$id_login_code."' AND cd_screen='".$cd_screen."'";
		$rs = $this->select_data('',$this->lb_table_permission,$str_where,$type="obj",true);
		if(count($rs)>0)
			return $rs->nb_flag_permission;
		return 0;
	}
	//binh.ngo
	//get data paging num row where
	//date 30/7/2012
	function select_data_paging_where_join($main_table,$num,$offset,$id_member=0){
		
		$this->db->join('pl_product',$main_table.'.id_product=pl_product.id_product');
		if($id_member >0){
			$this->db->where($main_table.'.id_member = '.$id_member );
		}
		if($num==0&&$offset==0){
			$query = $this->db->get($main_table);
			return $query->num_rows();
		}else{
			$this->db->order_by('id_comment_product','DESC');
			$query = $this->db->get($main_table,$num,$offset);
			return $query->result();
		}
	}
	############ Tran Viet Quoc ###############
	function multi_query($query){
		try
		{
			$sql = 'call '.$query;
			$rs = array();
			$result=mysqli_multi_query($this->db->conn_id, $sql );
                        if (!$result) {
                            die('Invalid query: ' . $this->db->conn_id->error);
                        }
                        
			do {
				if( $result = mysqli_store_result( $this->db->conn_id ) ){
					$rsTemp = array();
					while ( $row = mysqli_fetch_object($result) ) {
						$rsTemp[] = $row;
					}
					mysqli_free_result($result);
				}
				if (mysqli_more_results( $this->db->conn_id )) {
					$rs[] = $rsTemp;
				}

			} while ( mysqli_next_result( $this->db->conn_id ) );

			return $rs;
		}
		catch(Exception $ex)
		{
			return false;
		}
	}
	/**
	@author binh.ngo
	@date create 5/5/2014
	@method select data  image vote last
	@return void;
	**/
	function get_all_image_background($lb_alias=''){
		try	{
				$query = " select 
					i.id_image,i.lb_name,i.lb_image,i.lb_summary,i.dt_create,i.bl_active,i.lb_alias
				from 
					pl_image i
				inner join	pl_category_image c on c.id_category_image =i.id_category_image
				where c.lb_alias =?
				order by i.id_image desc 
				";
				$query = $this->db->query($query,array($lb_alias));
				return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select number rows
	  @return void;
	**/
	function get_num_rows_item($lb_table,$arr_search=array(),$id_menu_item=0){
        /*Begin search*/
        if(isset($arr_search['key_search'])&&$arr_search['key_search']!=''){
                $this->db->where($arr_search['field_search'],$arr_search['key_search']);
        }
        /*End search*/
		if($id_menu_item>0){
        $this->db->where('id_menu_item',$id_menu_item);
		}
		$query = $this->db->get($lb_table);
		return $query->num_rows();
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select data paging
	  @return void;
	**/
	function get_all_paging_news_item($lb_table,$num,$offset,$id_menu_item){
		if($id_menu_item>0){
        $this->db->where('id_menu_item',$id_menu_item);
		}
		$this->db->order_by('nb_order','DESC');
		$query = $this->db->get($lb_table,$num,$offset);
		return $query->result();
			
			
	}
	/**
	  @author binh.ngo
	  @date create 10/09/2012
	  @method select item rows
	  @return object;
	**/
	function get_news_item($lb_table,$lb_primary_key){
         $id = (int)$this->uri->segment(4);
		 $this->db->where($lb_primary_key,$id);
		 $query = $this->db->get($lb_table);
		 return $query->row();
	}
}
?>
