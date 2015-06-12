<?php
  function icon_edit($link){
      return '<a href="'.site_url($link).'" title="'.lang('update').'"><img src="'.base_url().'templates/icon/edit.gif"></a>';
  }
  function icon_active($table,$field,$id,$status){
      if($status==1){
                  $rep ='un_';
      }else{
                  $rep ='';
      }
    return  '<a href="javascript:;" onclick="publish('.$table.','.$field.','.$id.','.$status.');" title="'.lang('active_deactive').'"><img src="'.base_url().'templates/icon/'.$rep.'lock.png"></a>';
  }
  
  function icon_del($link){
      return '<a onclick="return verify_del();" href="'.site_url($link).'" title="'.lang('delete').'"><img src="'.base_url().'templates/icon/del.png"></a>'; 
  }
  function icon_del_comment($link){
      return '<a onclick="return verify_del();" href="'.site_url($link).'" title="'.lang('delete').'"><img src="'.base_url().'templates/icon/del.png"></a>'; 
  }
  function icon_up($table,$field,$id,$status){
	  return  '<a href="javascript:;" onclick="order_sort('.$table.','.$field.','.$id.','.$status.');" title="'.lang('up').'"><img src="'.base_url().'templates/icon/up.gif"></a>';
  }
  function icon_down($table,$field,$id,$status){
	  return  '<a href="javascript:;" onclick="order_sort('.$table.','.$field.','.$id.','.$status.');" title="'.lang('down').'"><img src="'.base_url().'templates/icon/down.gif"></a>';
  }
  function icon_order($table,$field,$id)
  {
	  return '<a href="javascript:;" onclick="order_sort('.$table.','.$field.','.$id.','.'\'up\''.');" title="'.lang('up').'"><img src="'
	  			.base_url().'templates/icon/up.gif"></a>'.
		  '<a href="javascript:;" onclick="order_sort('.$table.','.$field.','.$id.','.'\'down\''.');" title="'.lang('down').'"><img src="'
		  		.base_url().'templates/icon/down.gif"></a>';
  }
  function icon_chonmua($link){
      return '<a href="'.site_url($link).'" title="Đưa vào chọn mua"><img src="'.base_url().'templates/icon/chonmua.png"></a>';
  }
  function icon_view($link,$id=null,$rel=null){
      return '<a href="'.site_url($link).'" title="Xem" id="'.$id.'" rel="'.$rel.'"><img src="'.base_url().'templates/icon/view.png"></a>';
  }
  function icon_log($link){
      return '<a href="'.site_url($link).'" title="Xem log" ><img src="'.base_url().'templates/icon/log.png"></a>';      
  } 
  function icon_bid($link){
      return '<a href="'.site_url($link).'" title="Chọn sản phẩm đấu giá" ><img src="'.base_url().'templates/icon/bid.png"></a>';      
  }    
?>
