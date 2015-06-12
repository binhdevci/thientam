<?php
  class pagination_library{
      function __construct(){
          $this->CI = get_instance();
      }
      function pagination($num,$offset,$limit,$url){
          //$id_blog = $this->input->post('id_blog');
            $page = $offset;
            $adjacents = 2;

            if($page) 
                $start = ($page - 1) * $limit;             //first item to display on this page
            else
                $start = 0;                                //if no page var is given, set start to 0
            
 
            $total_pages = $num;
            /* Setup page vars for display. */
            if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
            $prev = $page - 1;                            //previous page is page - 1
            $next = $page + 1;                            //next page is page + 1
            $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                        //last page minus 1
            
            /* 
                Now we apply our rules and draw the pagination object. 
                We're actually saving the code to a variable in case we want to draw it more than once.
            */
            $pagination = "";
            if($lastpage > 1)
            {    

                $pagination .='<span class="pagebar-mainbody">';
                //previous button
                if ($page > 1) 
                    $pagination.= "<a href=\"javascript:javascript:GoToPage($page-1);\">&lt;</a>";
                else
                    $pagination.= "<a href=\"javascript:;\">&lt;</a>";    
                
                //pages    
                if ($lastpage < 6 + ($adjacents * 2))    //not enough pages to bother breaking it up
                {    
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                        else
                            $pagination.= "<a href=\"javascript:javascript:GoToPage($counter); \">$counter</a>";                    
                    }
                }
                elseif($lastpage > 4 + ($adjacents * 2))    //enough pages to hide some
                {
                    //close to beginning; only hide later pages
                    if($page < 1 + ($adjacents * 2))        
                    {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:GoToPage($counter); \">$counter</a>";                    
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage($lpm1); \">$lpm1</a>";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage($lastpage); \">$lastpage</a>";        
                    }
                    //in middle; hide some front and some back
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"javascript:javascript:GoToPage(1); \">1</a>";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage(2); ;\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:GoToPage($counter); \">$counter</a>";                    
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage($lpm1);\">$lpm1</a>";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage($lastpage);\">$lastpage</a>";        
                    }
                    //close to end; only hide early pages
                    else
                    {
                        $pagination.= "<a href=\"javascript:javascript:GoToPage(1);\">1</a>";
                        $pagination.= "<a href=\"javascript:javascript:GoToPage(2);\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:GoToPage($counter);\">$counter</a>";                    
                        }
                    }
                }
                
                //next button
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"javascript:javascript:GoToPage($page+1);\">&gt;</a>";
                else
                    $pagination.= "<a href=\"javascript:;\">&gt;</a>";
               return $pagination.= "</span>\n";
            }                
      }
      
      function page($num,$offset,$limit,$url){
          //$id_blog = $this->input->post('id_blog');
            $page = $offset;
            $adjacents = 2;

            if($page) 
                $start = (($page - 1) * $limit)+6;             //first item to display on this page
            else
                $start = 6;                                //if no page var is given, set start to 0
            
 
            $total_pages = $num;
            /* Setup page vars for display. */
            if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
            $prev = $page - 1;                            //previous page is page - 1
            $next = $page + 1;                            //next page is page + 1
            $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;                        //last page minus 1
            
            /* 
                Now we apply our rules and draw the pagination object. 
                We're actually saving the code to a variable in case we want to draw it more than once.
            */
            $pagination = "";
            if($lastpage > 1)
            {    
                $pagination .= "<div class=\"pages\">";
                $pagination .='<div class="pagebar-mainbody">';
                //previous button
                if ($page > 1) 
                    $pagination.= "<a href=\"javascript:javascript:go($page-1);\">&lt;</a>";
                else
                    $pagination.= "<a href=\"javascript:;\">&lt;</a>";    
                
                //pages    
                if ($lastpage < 6 + ($adjacents * 2))    //not enough pages to bother breaking it up
                {    
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                        else
                            $pagination.= "<a href=\"javascript:javascript:go($counter); \">$counter</a>";                    
                    }
                }
                elseif($lastpage > 4 + ($adjacents * 2))    //enough pages to hide some
                {
                    //close to beginning; only hide later pages
                    if($page < 1 + ($adjacents * 2))        
                    {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:go($counter); \">$counter</a>";                    
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"javascript:javascript:go($lpm1); \">$lpm1</a>";
                        $pagination.= "<a href=\"javascript:javascript:go($lastpage); \">$lastpage</a>";        
                    }
                    //in middle; hide some front and some back
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"javascript:javascript:go(1); \">1</a>";
                        $pagination.= "<a href=\"javascript:javascript:go(2); ;\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:go($counter); \">$counter</a>";                    
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"javascript:javascript:go($lpm1);\">$lpm1</a>";
                        $pagination.= "<a href=\"javascript:javascript:go($lastpage);\">$lastpage</a>";        
                    }
                    //close to end; only hide early pages
                    else
                    {
                        $pagination.= "<a href=\"javascript:javascript:go(1);\">1</a>";
                        $pagination.= "<a href=\"javascript:javascript:go(2);\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"pagebar-selections\"><span class=\"pagelink-current\">$counter</span></span>";
                            else
                                $pagination.= "<a href=\"javascript:javascript:go($counter);\">$counter</a>";                    
                        }
                    }
                }
                
                //next button
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"javascript:javascript:go($page+1);\">&gt;</a>";
                else
                    $pagination.= "<a href=\"javascript:;\">&gt;</a>";
               return $pagination.= "</div></div>\n";
            }                
      }            
  }
?>
