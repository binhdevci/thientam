<?

// PHP Calendar Class Version 1.4 (5th March 2001)
//  
// Copyright David Wilkinson 2000 - 2001. All Rights reserved.
// 
// This software may be used, modified and distributed freely
// providing this copyright notice remains intact at the head 
// of the file.
//
// This software is freeware. The author accepts no liability for
// any loss or damages whatsoever incurred directly or indirectly 
// from the use of this script. The author of this software makes 
// no claims as to its fitness for any purpose whatsoever. If you 
// wish to use this software you should first satisfy yourself that 
// it meets your requirements.
//
// URL:   http://www.cascade.org.uk/software/php/calendar/
// Email: davidw@cascade.org.uk


class MY_Calendar extends CI_Calendar
{
	
	/*var $date_event ;
	var $cont_event ;
	var $link_event ;
	var $tableclass ;*/
    /*
        Constructor for the Calendar class
    */
    function MY_Calendar()
    {
    }
    
    
    /*
        Get the array of strings used to label the days of the week. This array contains seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function getDayNames()
    {
        return $this->dayNames;
    }
    

    /*
        Set the array of strings used to label the days of the week. This array must contain seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function setDayNames($names)
    {
        $this->dayNames = $names;
    }
    
    /*
        Get the array of strings used to label the months of the year. This array contains twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function getMonthNames()
    {
        return $this->monthNames;
    }
    
    /*
        Set the array of strings used to label the months of the year. This array must contain twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }
    
    
    
    /* 
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
      function getStartDay()
    {
        return $this->startDay;
    }
    
    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    function setStartDay($day)
    {
        $this->startDay = $day;
    }
    
    
    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function getStartMonth()
    {
        return $this->startMonth;
    }
    
    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }
    
    
    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */
    function getCalendarLink($month, $year)
    {
        return "javascript:page.load('spotlight/events/".$month."/".$year."','calendar')";
    }
    
    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */
    /*function getDateLink($day, $month, $year)
    {
        return "";
    }*/
	function getDateLink($events_id)
    {
       // return $linkto ;
	   return "javascript:page.detail_events('spotlight/detail_events/".$events_id."/','jspPane')";
    }

    /*
        Return the HTML for the current month
    */
    function getCurrentMonthView($data='')
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"], $data);
    }
    

    /*
        Return the HTML for the current year
    */
    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"]);
    }
    
    
    /*
        Return the HTML for a specified month
    */
    function getMonthView($month, $year, $data='')
    {
		$this->date_event = $data ;
        return $this->getMonthHTML($month, $year, $data);
    }
    

    /*
        Return the HTML for a specified year
    */
    function getYearView($year)
    {
        return $this->getYearHTML($year);
    }
    
    
    
    /********************************************************************************
    
        The rest are private methods. No user-servicable parts inside.
        
        You shouldn't need to call any of these functions directly.
        
    *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12)
        {
            return 0;
        }
   
        $d = $this->daysInMonth[$month - 1];
   
        if ($month == 2)
        {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...
        
            if ($year%4 == 0)
            {
                if ($year%100 == 0)
                {
                    if ($year%400 == 0)
                    {
                        $d = 29;
                    }
                }
                else
                {
                    $d = 29;
                }
            }
        }
    
        return $d;
    }


    /*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $data, $showYear = 1)
    {
        $s = "";
        
        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year  = $a[1];        
        
    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));
    	
    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	
    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);
    	$prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	$nextMonth = $this->getCalendarLink($next[0], $next[1]);
			
    	
    	$header = $monthName . (($showYear > 0) ? " " . $year : "");
    	
    	$s .= "<table class=\"calendar\">\n";
    	$s .= "<tr>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendartop\">" . (($prevMonth == "") ? "&nbsp;" : "<a href=\"$prevMonth\">&lt;&lt;</a>")  . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendartop\" colspan=\"5\">$header</td>\n"; 
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendartop\">" . (($nextMonth == "") ? "&nbsp;" : "<a href=\"$nextMonth\">&gt;&gt;</a>")  . "</td>\n";
    	$s .= "</tr>\n";
    	
    	$s .= "<tr>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+1)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+2)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+3)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+4)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+5)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+6)%7] . "</td>\n";
    	$s .= "</tr>\n";
    	
    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;
    	while ($d > 1)
    	{
    	    $d -= 7;
    	}
 
        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());
    	
		$k=0;
    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<tr>\n";       
    	    
    	    for ($i = 0; $i < 7; $i++)
    	    {
				// set class for day
        	    //$class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarToday" : "calendar";
				//get CSS day event
				$date = (strlen($d)==1) ? "0".$d : $d ;
				//$mon = (strlen($month)==1) ? "0".$month : $month ;
				$dateloop =  $year ."-". $month ."-". $date ; 
				$class = $this->getCssEvent($dateloop) ;
				
				
    	        $s .= "<td class=\"$class[0]\" align=\"right\" valign=\"top\">"; 
    	        if ($d > 0 && $d <= $daysInMonth)
    	        {
    	            /*$link = $this->getDateLink($d, $month, $year);
    	            $s .= (($link == "") ? $d : "<a href=\"$link\">$d</a>");*/
					
					$s .= ($class[0] != "date_has_event") ? $d : '<a href="javascript:'.$class[2].'">'.$d.'</a>';
					$s .= ($class[0] == "date_has_event") ? $class[1] : "" ;
    	        }
    	        else
    	        {
    	            $s .= "&nbsp;";
    	        }
      	        $s .= "</td>\n";       
        	    $d++;
    	    }
    	    $s .= "</tr>\n";  
			$k ++; 
    	}
    	if($k<6){//set default binh.ngo
			$s .= "<tr>\n"; 
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";
				$s .= "<td class=\"calendar\" align=\"right\" valign=\"top\">"; 
				$s .= "</td>\n";     
			$s .= "</tr>\n";    
		}
    	$s .= "</table>\n";
    	
    	return $s;  	
    }
    
    function getCssEvent($date)
	{
		$today = date("Y-m-d") ; 
		$class = (trim($today)==trim($date)) ? "calendarToday" : 'calendar' ;
		
		$css = array($class,'','');
		$events = $this->date_event ;
		
		for($i=0;$i<count($events);$i++)
		{
			$event_day = date("Y-m-d", strtotime($events[$i]->dt_present)) ;
			
			if($date==$event_day)
			{
				$course = '<div class="events" ><ul id="eve" style=display:none;>';
				for($j=0;$j<count($event_day);$j++){
					if($date==$event_day){
						$course .= $this->getContentEvent($events[$i]->lb_title, $this->getDateLink($events[$i]->events_id)) ;
					}
				}
				$css[1] = $course .'</ul></div>' ;
				//$css[0] = "date_has_event" ;
				$css[0] = (trim($today)==trim($date)) ? "date_has_event calendarToday" : 'date_has_event' ;
				$css[2] = $this->getDateLink($events[$i]->events_id);
				//$css[3] =   $events[$i]->events_id;
				return $css ;
			}else{	
				$css[0] = $class ;
				$css[1] = "" ;
				$css[2] = "" ;
				//$css[3] = '';
			}
		}
		
		return $css ;
	}
	
	function getContentEvent($content, $link)
	{
		return $content = '<li><a href="'.$link.'">'.$content.'</a></li>';
	}
    /*
        Generate the HTML for a given year
    */
    function getYearHTML($year)
    {
        $s = "";
    	$prev = $this->getCalendarLink(0, $year - 1);
    	$next = $this->getCalendarLink(0, $year + 1);
        
        $s .= "<table class=\"calendar\" border=\"0\">\n";
        $s .= "<tr>";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"left\">" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\">&lt;&lt;</a>")  . "</td>\n";
        $s .= "<td class=\"calendarHeader\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $year . " - " . ($year + 1) : $year) ."</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" align=\"right\">" . (($next == "") ? "&nbsp;" : "<a href=\"$next\">&gt;&gt;</a>")  . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "</table>\n";
        
        return $s;
    }

    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */
    function adjustDate($month, $year)
    {
        $a = array();  
        $a[0] = $month;
        $a[1] = $year;
        
        while ($a[0] > 12)
        {
            $a[0] -= 12;
            $a[1]++;
        }
        
        while ($a[0] <= 0)
        {
            $a[0] += 12;
            $a[1]--;
        }
        
        return $a;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    var $startDay = 0;

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */
    var $startMonth = 1;

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */
    var $dayNames = array("S", "M", "T", "W", "T", "F", "S");
    
    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */
    var $monthNames = array("January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December");
                            
                            
    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
}

?>
