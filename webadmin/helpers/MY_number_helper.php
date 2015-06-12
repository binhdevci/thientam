<?
function format_price($price)
{
	$vnd = number_format($price,0,".",",") ; 
	return $vnd ;
}
function to_number($str)
{
	$num = preg_replace("/(\.|,|'| )/", '', $str);
	return $num ;
}
?>