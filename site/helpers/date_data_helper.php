<?php
function format_date_view($date){
	 if(!empty($date)){
	 	return date('d/m/Y', strtotime($date));
	 }
	 return '';
}