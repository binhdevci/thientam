<?php
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

function get_type_img($filename)
{
	$i = strrpos($filename,".");
	if (!$i) { return ""; }
	$l = strlen($filename) - $i;
	$extension = substr($filename,$i+1,$l);                 
	$extension = strtolower($extension);
	return $extension;
}
/**
	@author binh ngo
	@method replace signed of string
	@date 12/12/2012
**/
function unsigned($str){
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	$str = preg_replace("/(Đ)/", 'D', $str);
	$str = preg_replace("/( )/", '-', $str);
	$str = preg_replace("/(\'|\"|`|&|,|\.|\?)/", '', $str);
	$str = preg_replace("/(---|--)/", '-', $str);
	
	$pattern = '/([^a-z0-9\-\._])/i';
	$str = preg_replace($pattern, '', $str);
		
	$str = strtolower($str);
	return $str;
}
/**
	@author binh ngo
	@method rename url 
	@date 12/12/2012
**/
if ( ! function_exists('base_url_site')){
    function base_url_site()
    {
        $CI =& get_instance();
        return $CI->config->slash_item('base_url_site');
    }
}
/**
	@author binh ngo
	@method format string not injecion 
	@date 12/12/2012
**/
function formatInputStr($str){
	$str=stripslashes($str);
	$str=addslashes($str);
	return $str;
}
function stringchange($value)
{
	#---------------------------------a^
	$value = str_replace("ấ", "a", $value);
	$value = str_replace("ầ", "a", $value);
	$value = str_replace("ẩ", "a", $value);
	$value = str_replace("ẫ", "a", $value);
	$value = str_replace("ậ", "a", $value);
	#---------------------------------A^
	$value = str_replace("Ấ", "A", $value);
	$value = str_replace("Ầ", "A", $value);
	$value = str_replace("Ẩ", "A", $value);
	$value = str_replace("Ẫ", "A", $value);
	$value = str_replace("Ậ", "A", $value);
	#---------------------------------a(
	$value = str_replace("ắ", "a", $value);
	$value = str_replace("ằ", "a", $value);
	$value = str_replace("ẳ", "a", $value);
	$value = str_replace("ẵ", "a", $value);
	$value = str_replace("ặ", "a", $value);
	#---------------------------------A(
	$value = str_replace("Ắ", "A", $value);
	$value = str_replace("Ằ", "A", $value);
	$value = str_replace("Ẳ", "A", $value);
	$value = str_replace("Ẵ", "A", $value);
	$value = str_replace("Ặ", "A", $value);
	#---------------------------------a
	$value = str_replace("á", "a", $value);
	$value = str_replace("à", "a", $value);
	$value = str_replace("ả", "a", $value);
	$value = str_replace("ã", "a", $value);
	$value = str_replace("ạ", "a", $value);
	$value = str_replace("â", "a", $value);
	$value = str_replace("ă", "a", $value);
	#---------------------------------A
	$value = str_replace("Á", "A", $value);
	$value = str_replace("À", "A", $value);
	$value = str_replace("Ả", "A", $value);
	$value = str_replace("Ã", "A", $value);
	$value = str_replace("Ạ", "A", $value);
	$value = str_replace("Â", "A", $value);
	$value = str_replace("Ă", "A", $value);
	#---------------------------------e^
	$value = str_replace("ế", "e", $value);
	$value = str_replace("ề", "e", $value);
	$value = str_replace("ể", "e", $value);
	$value = str_replace("ễ", "e", $value);
	$value = str_replace("ệ", "e", $value);
	#---------------------------------E^
	$value = str_replace("Ế", "E", $value);
	$value = str_replace("Ề", "E", $value);
	$value = str_replace("Ể", "E", $value);
	$value = str_replace("Ễ", "E", $value);
	$value = str_replace("Ệ", "E", $value);
	#---------------------------------e
	$value = str_replace("é", "e", $value);
	$value = str_replace("è", "e", $value);
	$value = str_replace("ẻ", "e", $value);
	$value = str_replace("ẽ", "e", $value);
	$value = str_replace("ẹ", "e", $value);
	$value = str_replace("ê", "e", $value);
	#---------------------------------E
	$value = str_replace("É", "E", $value);
	$value = str_replace("È", "E", $value);
	$value = str_replace("Ẻ", "E", $value);
	$value = str_replace("Ẽ", "E", $value);
	$value = str_replace("Ẹ", "E", $value);
	$value = str_replace("Ê", "E", $value);
	#---------------------------------i
	$value = str_replace("í", "i", $value);
	$value = str_replace("ì", "i", $value);
	$value = str_replace("ỉ", "i", $value);
	$value = str_replace("ĩ", "i", $value);
	$value = str_replace("ị", "i", $value);
	#---------------------------------I
	$value = str_replace("Í", "I", $value);
	$value = str_replace("Ì", "I", $value);
	$value = str_replace("Ỉ", "I", $value);
	$value = str_replace("Ĩ", "I", $value);
	$value = str_replace("Ị", "I", $value);
	#---------------------------------o^
	$value = str_replace("ố", "o", $value);
	$value = str_replace("ồ", "o", $value);
	$value = str_replace("ổ", "o", $value);
	$value = str_replace("ỗ", "o", $value);
	$value = str_replace("ộ", "o", $value);
	#---------------------------------O^
	$value = str_replace("Ố", "O", $value);
	$value = str_replace("Ồ", "O", $value);
	$value = str_replace("Ổ", "O", $value);
	$value = str_replace("Ô", "O", $value);
	$value = str_replace("Ộ", "O", $value);
	#---------------------------------o*
	$value = str_replace("ớ", "o", $value);
	$value = str_replace("ờ", "o", $value);
	$value = str_replace("ở", "o", $value);
	$value = str_replace("ỡ", "o", $value);
	$value = str_replace("ợ", "o", $value);
	
	#---------------------------------O*
	$value = str_replace("Ớ", "O", $value);
	$value = str_replace("Ờ", "O", $value);
	$value = str_replace("Ở", "O", $value);
	$value = str_replace("Ỡ", "O", $value);
	$value = str_replace("Ợ", "O", $value);
	#---------------------------------u*
	$value = str_replace("ứ", "u", $value);
	$value = str_replace("ừ", "u", $value);
	$value = str_replace("ử", "u", $value);
	$value = str_replace("ữ", "u", $value);
	$value = str_replace("ự", "u", $value);
	#---------------------------------U*
	$value = str_replace("Ứ", "U", $value);
	$value = str_replace("Ừ", "U", $value);
	$value = str_replace("Ử", "U", $value);
	$value = str_replace("Ữ", "U", $value);
	$value = str_replace("Ự", "U", $value);
	#---------------------------------y
	$value = str_replace("ý", "y", $value);
	$value = str_replace("ỳ", "y", $value);
	$value = str_replace("ỷ", "y", $value);
	$value = str_replace("ỹ", "y", $value);
	$value = str_replace("ỵ", "y", $value);
	#---------------------------------Y
	$value = str_replace("Ý", "Y", $value);
	$value = str_replace("Ỳ", "Y", $value);
	$value = str_replace("Ỷ", "Y", $value);
	$value = str_replace("Ỹ", "Y", $value);
	$value = str_replace("Ỵ", "Y", $value);
	#---------------------------------DD
	$value = str_replace("Đ", "D", $value);
	$value = str_replace("Đ", "D", $value);
	$value = str_replace("đ", "d", $value);
	#---------------------------------o
	$value = str_replace("ó", "o", $value);
	$value = str_replace("ò", "o", $value);
	$value = str_replace("ỏ", "o", $value);
	$value = str_replace("õ", "o", $value);
	$value = str_replace("ọ", "o", $value);
	$value = str_replace("ô", "o", $value);
	$value = str_replace("ơ", "o", $value);
	#---------------------------------O
	$value = str_replace("Ó", "O", $value);
	$value = str_replace("Ò", "O", $value);
	$value = str_replace("Ỏ", "O", $value);
	$value = str_replace("Õ", "O", $value);
	$value = str_replace("Ọ", "O", $value);
	$value = str_replace("Ô", "O", $value);
	$value = str_replace("Ơ", "O", $value);
	#---------------------------------u
	$value = str_replace("ú", "u", $value);
	$value = str_replace("ù", "u", $value);
	$value = str_replace("ủ", "u", $value);
	$value = str_replace("ũ", "u", $value);
	$value = str_replace("ụ", "u", $value);
	$value = str_replace("ư", "u", $value);
	#------------------------------------
	$value = str_replace(" ", "-", $value);
	$value = str_replace("(", "", $value);
	$value = str_replace(")", "", $value);
	$value = str_replace("-", "-", $value);
	$value = str_replace("'", "", $value);
	$value = str_replace("\"","", $value);
	$value = str_replace("<", "", $value);
	$value = str_replace(">", "", $value);
	$value = str_replace("+", "", $value);
	$value = str_replace("*", "", $value);
	$value = str_replace("/", "", $value);
	$value = str_replace("?", "", $value);
	$value = str_replace("!", "", $value);
	$value = str_replace(",", "", $value);
	$value = str_replace("”", "", $value);
	$value = str_replace("“", "", $value);
	$value = str_replace("#", "", $value); 
	$value = str_replace("%", "", $value); 
	$value = str_replace(".", "", $value); 
	$value = str_replace(":", "", $value); 
	$value = str_replace("&", "", $value); 
	$value = str_replace("=", "-", $value); 
	$value = str_replace("|", "", $value); 
	$value = str_replace(";", "", $value); 
	$value = str_replace("^", "", $value); 
	
	return $value;
}
 function  get_menu(){
	$CI= & get_instance();
	$CI->load->model('common_model','common');
	$rs = $CI->common->get_all('pl_menu','bl_active',1);
	return $rs;
 }
 function  get_menu_item($id_menu){
	$CI= & get_instance();
	$CI->load->model('common_model','common');
	$rs = $CI->common->get_all('pl_menu_item','id_menu',$id_menu);
	return $rs;
 }
?>
