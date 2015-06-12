<?php
function generic_char($length = 10){
	$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0, $passwd = ''; $i < $length; $i++)
	$passwd .= substr($str, mt_rand(0, strlen($str) - 1), 1);
	return $passwd;
}
function str_limit($str, $n = 300)
{
    if (strlen($str) <= $n)
    {
        return $str;
    }
    
	 $limit = strpos($str,' ', $n) ;
     while($limit==false&&$n>1)
     {    $n--;
         $limit = strpos($str,' ', $n) ;
     }
	 $limit = $limit ? $limit : $n ;
	 $out = substr($str, 0, $limit) ;
	 return $out.' ...' ;
}

// Hàm dinh dang ngay
function format_date($datetime, $format){
    return date($format, mysqldatetime_to_timestamp($datetime));
}

function mysqldatetime_to_timestamp($datetime){
      // function is only applicable for valid MySQL DATETIME (19 characters) and DATE (10 characters)
      $l = strlen($datetime);
        if(!($l == 10 || $l == 19))
          return 0;

        //
        $date = $datetime;
        $hours = 0;
        $minutes = 0;
        $seconds = 0;

        // DATETIME only
        if($l == 19)
        {
          list($date, $time) = explode(" ", $datetime);
          list($hours, $minutes, $seconds) = explode(":", $time);
        }

        list($year, $month, $day) = explode("-", $date);

        return mktime($hours, $minutes, $seconds, $month, $day, $year);
}

function checkimg($img,$title,$w){
    $url = 'http://dendomdom.com/';
    if($img!=''){
        return '<img src="'.$url.$img.'" width="'.$w.'px" alt="'.$title.'">';
    }else{
        return '<img src="'.base_url().'skin/images/no_image.jpg" width="'.$w.'px" alt="no images">';
    }
}

function get_type_img($filename){
$i = strrpos($filename,".");
    if (!$i) { return ""; }
    $l = strlen($filename) - $i;
    $extension = substr($filename,$i+1,$l);                 
    $extension = strtolower($extension);
    return $extension;
}


function str_hash($str, $n = 300)
{
    if (strlen($str) <= $n)
    {
        return $str." ...";
    }
    
	 //$limit = strpos($str, ' ', $n) ;
	 $out = substr($str, 0, $n) ;
	 return $out.' ...' ;
}
function url_ri(){
	return $_SERVER["REQUEST_URI"];
}

/**
* @author binh ngo
* @method get current url
* @date 15/10/2013
**/
function cur_page_url() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function get_news($lb_alias){
	$CI= & get_instance();
	$rs = $CI->common->get_news_alias($lb_alias);
	return $rs;
}
function get_news_categoty($lb_alias){
	$CI= & get_instance();
	$rs = $CI->common->get_all_news_with_category($lb_alias);
	return $rs;
}
function get_news_relative($lb_string_id_news=''){
	$CI= & get_instance();
	$arr=explode(',',$lb_string_id_news);
	$rs=array();
	if(count($arr)>0){
		$rs = $CI->common->get_data_str('pl_news','id_news',$arr);
	}
	return $rs;
}
function get_menu_item(){
	$CI= & get_instance();
	$rs = $CI->common->get_menu_item();
	return $rs;
}
function get_news_cate($id_category_news){
	$CI= & get_instance();
	$rs = $CI->common->get_news_cate($id_category_news);
	return $rs;
}
function get_categoty(){
	$CI= & get_instance();
	$rs = $CI->common->get_all_category();
	return $rs;
}
function  build_config_paging($url,$total_rows){
		$config['base_url'] =$url;
		$config['total_rows'] = $total_rows; // get no of news in my database
		$config['per_page'] = PER_PAGE; // no of news per page view
		$config['full_tag_open'] = '<ul class="pagination pull-right no-margin">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['query_string_segment'] = 'page';
		return $config;
	}
function formatMoney($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
		if (is_numeric($number)) { // a number
			if (!$number) { // zero
				$money = ($cents == 2 ? '0.00' : '0'); // output zero
			} else { // value
				if (floor($number) == $number) { // whole number
					$money = number_format($number, ($cents == 2 ? 2 : 0)); // format
				} else { // cents
					$money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
				} // integer or decimal
			} // value
			return $money;
		} // numeric
	} // for
function  get_news_common($lb_alias){
	$CI= & get_instance();
	$CI->load->model('common_model','common');
	$rs = $CI->common->get_news($lb_alias);
	return $rs;
 }
 function  get_image_slide(){
	$CI= & get_instance();
	$CI->load->model('common_model','common');
	$rs = $CI->common->get_image_slide_home();
	return $rs;
 }
?>
