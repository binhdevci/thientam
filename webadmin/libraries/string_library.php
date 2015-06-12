<?php
class string_library{
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
    
    function changeImgTamtay($value){
        $value = str_replace("http://img.tamtay.vn/files/", "", $value); 
        $value = str_replace("_resize.", "_thumb.", $value); 
        $value = str_replace(".", "_thumb.", $value); 
        $value = str_replace("_thumb_thumb", "_thumb", $value); 
        return $value;
    }

    
    // Hàm chuyen ngay
function chuyenngay($ngayhientai,$songay){           
    $my_time = strtotime ($ngayhientai); //converts date string to UNIX timestamp
    $timestamp = $my_time + ($songay * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d H:i:s",$timestamp);  //puts the UNIX timestamp back into string format              
    return $return_date;//exit function and return string
}
    
    // Ham cat chu
function catchu($value, $length){   
        if($value!=''){
        if(is_array($value)) list($string, $match_to) = $value;
        else { $string = $value; $match_to = $value{0}; }

        $match_start = stristr($string, $match_to);
        $match_compute = strlen($string) - strlen($match_start);

        if (strlen($string) > $length)
        {
            if ($match_compute < ($length - strlen($match_to)))
            {
                $pre_string = substr($string, 0, $length);
                $pos_end = strrpos($pre_string, " ");
                if($pos_end === false) $string = $pre_string."...";
                else $string = substr($pre_string, 0, $pos_end)."...";
            }
            else if ($match_compute > (strlen($string) - ($length - strlen($match_to))))
            {
                $pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
                $pos_start = strpos($pre_string, " ");
                $string = "...".substr($pre_string, $pos_start);
                if($pos_start === false) $string = "...".$pre_string;
                else $string = "...".substr($pre_string, $pos_start);
            }
            else
            {       
                $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
                $pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
                $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
                if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
                else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
            }

            $match_start = stristr($string, $match_to);
            $match_compute = strlen($string) - strlen($match_start);
        }
        
        return $string;
        }else{
            return $string ='';
        } 
}
    // Hàm dinh dang ngay
function format_date($datetime, $format){
    return date($format, $this->mysqldatetime_to_timestamp($datetime));
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
    /************Loc chu tim kiem****************/
function getkeyword($text){
           $output = array();
           $output2 = array();
           $arr = explode('"',$text);

           for ($i=0;$i<count($arr);$i++)
           {
               if ($i%2==0)
               {
                $output=array_merge($output,explode(" ",$arr[$i]));
               }
               else $output[] = $arr[$i];
           }
           foreach($output as $word) if (trim($word)!="") $output2[]=$word;
           return $output2;
}

} 