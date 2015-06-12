<?php
require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$db->where( BL_ACTIVE_1 );
$query = $db->get( PL_LANG );
$result = $query->result();
foreach($result  as $k=>$language){
	$field = LB_NAME;
	$lang[$language->cd_lang]=$language->$field;
}
