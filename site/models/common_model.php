<?
class Common_model extends Model{
	function Common_model(){
		 parent::Model();
	}
	
	
	
	
	
    function insert_data($lb_table,$data){
        try{			
            $rs=$this->db->insert($lb_table, $data);
            return $rs;
        }catch(Exception $ex){
            return false;
        }
    }
	
   
	function get_result_alias($lb_alias){
		try	{
				$query = " select 
n.id_news,n.id_category_news,n.lb_title,n.lb_summary,n.lb_description,n.lb_alias,n.lb_image
from

 pl_news n
inner join pl_category_news as c ON n.id_category_news=c.id_category_news
where
c.id_parent =(select id_category_news from pl_category_news where lb_alias =?)
				";
				$query = $this->db->query($query,array($lb_alias));
				return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	
	
	function get_menu_item(){
		try	{
				$query = "select 
							*
						from 
							pl_menu_item m
						where 
							m.bl_active=1 
							and
							m.bl_is_product =1
						order by nb_order DESC,dt_update DESC 	
				";
				$query = $this->db->query($query);
				return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	
	function get_all_category(){
		try	{
			$query = "select 
					*
				from 
					pl_category_news c
			where 
					c.bl_active=1 
				order by nb_order DESC,dt_update DESC	
			";
			$query = $this->db->query($query);
			return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	function get_total_news_item_index($cate,$q){
		try	{
			$query ="select
					count(1) as num
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				join pl_category_news c on c.id_category_news = n.id_category_news
				where 
					n.bl_active =1
					and n.bl_is_product =1
				";
			if(!empty($cate)){
				$query .=" and c.lb_alias ='".$cate."'";
			}
			if(!empty($q)){
				$query .=" and n.lb_title like'%".$q."%'";
			}
			$query = $this->db->query($query);
			return $query->row();
		}catch(Exception $e){
			return false;
		}
	}
	function get_news_item_index($offset=0,$perpage=20,$cate,$q){
		try	{
			$query ="select
					n.lb_title,n.lb_alias as lb_alias_news,n.lb_image, n.lb_summary, 
					n.lb_description, n.id_category_news,n.lb_keyword_seo,n.lb_description_seo,
					n.lb_price, n.nb_order, n.dt_update,
				  m.lb_name as lb_name_menu, m.lb_alias as lb_alias_menu,
					mi.id_menu_item, mi.lb_name as lb_name_menu_item, mi.lb_alias as lb_alias_menu_item
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				left join pl_category_news c on c.id_category_news = n.id_category_news
				where 
					n.bl_active =1
					and n.bl_is_product =1 ";
			if(!empty($cate)){
				$query .=" and c.lb_alias ='".$cate."'";
			}
			if(!empty($q)){
				$query .=" and n.lb_title like'%".$q."%'";
			}
			$query .=" order by n.id_news_item DESC	limit ?,?";
			$query = $this->db->query($query,array($offset,$perpage));
			return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	function get_total_news_item($lb_alias_menu_item,$cate,$q){
		try	{
			$query ="select
					count(1) as num
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				left join pl_category_news c on c.id_category_news = n.id_category_news
				where 
					n.bl_active =1
					and mi.lb_alias =?
					and n.bl_is_product =1
				";
			if(!empty($cate)){
				$query .=" and c.lb_alias ='".$cate."'";
			}
			if(!empty($q)){
				$query .=" and n.lb_title like'%".$q."%'";
			}
			$query = $this->db->query($query,array($lb_alias_menu_item));
			return $query->row();
		}catch(Exception $e){
			return false;
		}
	}
	function get_news_item($lb_alias_menu_item,$offset=0,$perpage=20,$cate,$q){
		try	{
			$query ="select
					n.lb_title,n.lb_alias as lb_alias_news,n.lb_image, n.lb_summary, 
					n.lb_description, n.id_category_news,n.lb_keyword_seo,n.lb_description_seo,
					n.lb_price, n.nb_order, n.dt_update,
				  m.lb_name as lb_name_menu, m.lb_alias as lb_alias_menu,
					mi.id_menu_item, mi.lb_name as lb_name_menu_item, mi.lb_alias as lb_alias_menu_item
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				left join pl_category_news c on c.id_category_news = n.id_category_news
				where 
					n.bl_active =1
					and mi.lb_alias =?
					and n.bl_is_product =1
					
				";
			if(!empty($cate)){
				$query .=" and c.lb_alias ='".$cate."'";
			}
			if(!empty($q)){
				$query .=" and n.lb_title like'%".$q."%'";
			}
			$query .='limit ?,?';
			$query = $this->db->query($query,array($lb_alias_menu_item,$offset,$perpage));
			return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	function  get_detail_item_news($lb_alias=''){
		try	{
			$query ="select
					n.id_news_item,n.lb_title,n.lb_alias as lb_alias_news,n.lb_image, n.lb_summary, 
					n.lb_description, n.id_category_news,n.lb_keyword_seo,n.lb_description_seo,
					n.lb_price, n.nb_order, n.dt_update,
					m.lb_name as lb_name_menu, m.lb_alias as lb_alias_menu,m.lb_name_display,
					mi.id_menu_item, mi.lb_name as lb_name_menu_item, mi.lb_alias as lb_alias_menu_item
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				where 
					n.bl_active =1
					and n.lb_alias = ?
				";
			$query = $this->db->query($query,array($lb_alias));;
			
			return $query->row();
		}catch(Exception $e){
			
			return false;
		}
	}
	function get_news_item_same($lb_alias_menu_item,$id_news_item){
		try	{
			$query ="select
			
					n.id_news_item,n.lb_title,n.lb_alias as lb_alias_news,n.lb_image, n.lb_summary, 
					n.lb_description, n.id_category_news,n.lb_keyword_seo,n.lb_description_seo,
					n.lb_price, n.nb_order, n.dt_update,
				  m.lb_name as lb_name_menu, m.lb_alias as lb_alias_menu,
					mi.id_menu_item, mi.lb_name as lb_name_menu_item, mi.lb_alias as lb_alias_menu_item
				from 
					pl_news_item n
				join pl_menu_item mi ON n.id_menu_item = mi.id_menu_item
				join pl_menu m on m.id_menu = mi.id_menu
				where 
					n.bl_active =1
					and mi.lb_alias =?
					and n.id_news_item <> ?
				order by n.id_news_item DESC
				limit 0,4
					
				";
			
			$query = $this->db->query($query,array($lb_alias_menu_item,$id_news_item));
			return $query->result();
		}catch(Exception $e){
			return false;
		}
	}
	function get_news($lb_alias=''){
		try	{
			$query ="select
					*
				from 
					pl_news_item n
				where 1
					and n.lb_alias = ?
				";
			$query = $this->db->query($query,array($lb_alias));
			return $query->row();
		}catch(Exception $e){
			
			return false;
		}
	}
	function get_image_slide_home(){
		try	{
			$query ="select
					*
				from 
					pl_image 
				where
					1
					and bl_active = 1
				order by id_image DESC	
				limit 6	
				";
			$query = $this->db->query($query);
			return $query->result();
		}catch(Exception $e){
			
			return false;
		}
	}
}
?>