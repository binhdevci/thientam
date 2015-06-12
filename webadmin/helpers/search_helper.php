<?php

/*
 *@author : Vo Van Hieu
 *@method : Generic Search bar
 *@param  : $class(array) - Set class for search bar, key_search, field_search and btn_search
 *          $option(array)- Set option for field search
 *          $url_search(str)- url search
 *@date   : 25/07/2012
 *@modify : 
 */
function searchBar($class=array(),$option,$url_search){
    $CI =& get_instance();
    $search_bar = isset($class['search_bar'])?$class['search_bar']:'search_bar';
    $key_search = isset($class['key_search'])?$class['key_search']:'key_search';
    $field_search = isset($class['field_search'])?$class['field_search']:'field_search';
    $btn_search = isset($class['btn_search'])?$class['btn_search']:'btn_search';


    $html_search  = '<div class="'.$search_bar.'">';
    $html_search .= '<input onkeyup="auto_search(\''.$url_search.'\')" class="'.$key_search.'" name="key_search" id="key_search" type="text" value="'.($CI->session->userdata('key_search')?$CI->session->userdata('key_search'):'').'"/>&nbsp;';
    $html_search .= '<select class="'.$field_search.'" name="field_search" id="field_search">';
    foreach($option as $key=>$value){
        $html_search .= '<option '.($CI->session->userdata('field_search')==$key?'selected':'').' value="'.$key.'">'.$value.'</option>';
    }
    $html_search .= '</select>&nbsp;';
    //$html_search .= ' <input class="'.$btn_search.'" name="btn_search" id="btn_search" type="submit" value="Search"/>';
    $html_search .= '</div>';

    return $html_search;
}

?>
