<?php
function format_date_show($date)
{
	//ngay thang xem d/m/Y
	if(empty($date)) return '';
	$arr = explode(' ',$date);
	$arr_date =explode('-',$arr[0]);
	
	return $arr_date[2].'/'.$arr_date[1].'/'.$arr_date[0];
}
function date_show($date){
	//ngay thang xem d/m/Y
	if(empty($date)) return '';
	$arr = explode(' ',$date);
	return $arr[0];
}

function format_date_sql($date)
{
	//chuyen ngày tháng lưu trữ cho mysql: Y-m-d
	if(empty($date))
	{
		return NULL;
	}
	else
	{
		$arr = explode('/',$date);
		return $arr[2].'-'.$arr[1].'-'.$arr[0];
	}
}
// tritigi:15-05-2012: chuyen doi ngay tu mysql sang hien thi kieu vietnam (d/m/Y) or (d/m/Y H:i:S).
function date_mysql2vn($strdata='', $op=0)
{
	if(empty($strdata)) return '';
	$strdata = $op==0 ? date("d/m/Y", strtotime($strdata)) : date("d/m/Y H:i:s", strtotime($strdata)) ;
	return $strdata;
} 

// tritigi:15-05-2012: chuyen doi ngay viet nam sang mysql kiễu date (Y-m-d)
function date_vn2mysql($strdata='')
{
	if(empty($strdata)) return '';
	$temdate=explode("/", trim($strdata));
	$strdata=$temdate[2].'-'.$temdate[1].'-'.$temdate[0];
	return $strdata;
} 
function date_vn2time($str)
{
	//date in vn : d/m/Y
	if(empty($str) or (strlen($str)!=10)) return 0;
	//date in english d/m/Y
	$temp=explode("/", trim($str));
	$strdata=$temp[1].'/'.$temp[0].'/'.$temp[2];
	return $strtime = strtotime($strdata) ;
}