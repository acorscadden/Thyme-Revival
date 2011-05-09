<?php

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files.docs$/", "",dirname(__FILE__));

   require_once($BASE_PATH ."include/config.php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");

   $_cal_html = new _cal_html();

   _ex_theme_set("slate");
   $_cal_html->print_header("Event Class");

?>
<div id="ref">
<h3 align=center>Template Reference</h3>

Event Properties<br>
      <ul>
	       <li><a class='body' href="#title">$title</a></li>
               <li><a class='body' href="#calendar">$calendar</a></li>
	       <li><a class='body' href="#category">$category</a></li>
               <li><a class='body' href="#start">$start</a></li>
	       <li><a class='body' href="#times">$times</a></li>
               <li><a class='body' href="#org_name">$org_name</a></li>
               <li><a class='body' href="#org_email">$org_email</a></li>
               <li><a class='body' href="#url">$url</a></li>
	       <li><a class='body' href="#notes">$notes</a></li>
               <li><a class='body' href="#location">$location</a></li>
	       <li><a class='body' href="#addr_st">$addr_st</a></li>
	       <li><a class='body' href="#addr_ci">$addr_ci</a></li>
	       <li><a class='body' href="#phone">$phone</a></li>
	       <li><a class='body' href="#icon">$icon</a></li>
      </ul>
</div>
<br /><br />
<div align='center' style='font-size: 10px'><a name="title">(<a class='body' href="#top">top</a>)</a></div>
<hr>
<font class='heading'>$title</font>
<hr>
The title of the event.
<br /><br />

<div align='center' style='font-size: 10px'><a name="calendar">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$calendar</font>
<hr>
The title of the calendar that this event belongs to. E.g. "<font color='red'>Default Calendar</font>"
<br /><br />

<div align='center' style='font-size: 10px'><a name="category">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$category</font>
<hr>
The event's category.
<br /><br />
<div align='center' style='font-size: 10px'><a name="start">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$start</font>
<hr>

The start date of this event.

<br /><br />

<div align='center' style='font-size: 10px'><a name="times">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$times</font>
<hr>

The start time and duration of this event. E.g. 10:00am - 11:30am. This may also be set to
<b>All day</b> or <B>Call for times</b>.
<br /><br />

<div align='center' style='font-size: 10px'><a name="org_name">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$org_name</font>
<hr>
The organizer's name.
<br /><br />

<div align='center' style='font-size: 10px'><a name="org_email">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$org_email</font>
<hr>
The organizer's email address.
<br /><br />


<div align='center' style='font-size: 10px'><a name="url">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$url</font>
<hr>
The URL of this event.
<br /><br />


<div align='center' style='font-size: 10px'><a name="location">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$location</font>
<hr>
The location of the event.<br /><br />
<div align='center' style='font-size: 10px'><a name="notes">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$notes</font>
<hr>
The event notes.
<br /><br />
<div align='center' style='font-size: 10px'><a name="addr_st">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$addr_st</font>
<hr>
The street address of the event (the first line of the address).
<br /><br />
<div align='center' style='font-size: 10px'><a name="addr_ci">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$addr_ci</font>
<hr>
The City State, Zip of the event (the second line of the address).
<br /><br />
<div align='center' style='font-size: 10px'><a name="phone">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$phone</font>
<hr>
The phone number of the event.
<br /><br />
<div align='center' style='font-size: 10px'><a name="icon">(<a class='body' href="#top">top</a>)</a></div>

<hr>
<font class='heading'>$icon</font>
<hr>
The img tag of the icon for this event. E.g.<br /><br />
<font color='red'>&lt;img src='<?php echo(@constant("_CAL_BASE_URL_")) ?>icons/org/flag.gif' border=0&gt;</font><br><br>
If the event has no icon, this property will be blank.

<div align='center' style='font-size: 10px'>(<a class='body' href="#top">top</a>)</div>
<?php

   $_cal_html->print_footer();
?>
