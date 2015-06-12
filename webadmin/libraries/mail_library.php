<?php
  class mail_library{
      function __construct(){
          $this->CI = get_instance();
          
      }
      function send($name,$from,$to,$subject,$message){
        $mess=$message;
        $headers = "From: ".$name." <".$from.">\n";
        $headers .= "Reply-To: ".$name." <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html;\n";
        return @mail( $to, $subject, $mess, $headers );          
      }
  }
?>