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
<h3 align=center>API Reference</h3>

Event Class Variables<br>
      <ul>
	       <li><a class='body' href="#title">title</a></li>
               <li><a class='body' href="#cal_title">cal_title</a></li>
	       <li><a class='body' href="#category">category</a></li>
               <li><a class='body' href="#start">start</a></li>
	       <li><a class='body' href="#end">end</a></li>
	       <li><a class='body' href="#allday">allday</a></li>
	       <li><a class='body' href="#duration">duration</a></li>
               <li><a class='body' href="#repeats">repeats</a></li>
	       <li><a class='body' href="#ends_at">ends_at</a></li>
               <li><a class='body' href="#org_name">org_name</a></li>
               <li><a class='body' href="#org_email">org_email</a></li>
               <li><a class='body' href="#url">url</a></li>
	       <li><a class='body' href="#notes">notes</a></li>
	       <li><a class='body' href="#flag">flag</a></li>
               <li><a class='body' href="#location">location</a></li>
	       <li><a class='body' href="#addr_st">addr_st</a></li>
	       <li><a class='body' href="#addr_ci">addr_ci</a></li>
	       <li><a class='body' href="#phone">phone</a></li>
	       <li><a class='body' href="#icon">icon</a></li>
      </ul>
</div>
<br /><br />
<div align='center' style='font-size: 10px'><a name="title">(<a class='body' href="#top">top</a>)</a></div>
<hr>
string <font class='heading'>title</font>
<hr>
The title of the event.
<br /><br />

<div align='center' style='font-size: 10px'><a name="cal_title">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>cal_title</font>
<hr>
The title of the calendar that this event belongs to. E.g. "<font color='red'>Default Calendar</font>"
<br /><br />

<div align='center' style='font-size: 10px'><a name="category">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>category</font>
<hr>
The event's category.
<br /><br />
<div align='center' style='font-size: 10px'><a name="start">(<a class='body' href="#top">top</a>)</a></div>

<hr>
int <font class='heading'>start</font>
<hr>
The timestamp of when this event will start. E.g.
<code><font color="#000000">
<br /><font color="#0000BB">&lt;?php<br /><br />&nbsp;&nbsp;&nbsp;$e </font><font color="#007700">= </font><font color="#0000BB">$cal</font><font color="#007700">-&gt;</font><font color="#0000BB">get_event</font><font color="#007700">(</font><font color="#0000BB">18</font><font color="#007700">, </font><font color="#DD0000">"2008-2-4"</font><font color="#007700">);<br />&nbsp;&nbsp;&nbsp;echo(</font><font color="#0000BB">$cal</font><font color="#007700">-&gt;</font><font color="#0000BB">format_date</font><font color="#007700">(</font><font color="#DD0000">"l"</font><font color="#007700">, </font><font color="#0000BB">$e</font><font color="#007700">-&gt;</font><font color="#0000BB">start</font><font color="#007700">));<br />&nbsp;&nbsp;&nbsp;echo(</font><font color="#DD0000">" at "</font><font color="#007700">);<br />&nbsp;&nbsp;&nbsp;echo(</font><font color="#0000BB">$cal</font><font color="#007700">-&gt;</font><font color="#0000BB">format_date</font><font color="#007700">(</font><font color="#DD0000">"H:i"</font><font color="#007700">, </font><font color="#0000BB">$e</font><font color="#007700">-&gt;</font><font color="#0000BB">start</font><font color="#007700">));<br /><br /></font><font color="#0000BB">?&gt;</font>
</font>
</code><br />
May print <font color='red'>Sunday at 9:30</font>.<br /><br />
See also <a class='body' href="?option=com_content&task=view&id=64&Itemid=37#format_date">format_date()</a><Br>
<br />
<div align='center' style='font-size: 10px'><a name="end">(<a class='body' href="#top">top</a>)</a></div>

<hr>
int <font class='heading'>end</font>
<hr>
The timestamp of when this event will end. Also see <a class='body' href="#start">start</a>.
<br /><br />
<div align='center' style='font-size: 10px'><a name="allday">(<a class='body' href="#top">top</a>)</a></div>

<hr>
int <font class='heading'>allday</font>
<hr>
1 if the event lasts all day, 0 or NULL if not.
<br /><br />
<div align='center' style='font-size: 10px'><a name="duration">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>duration</font>
<hr>
The duration of the event in the format <font color='red'>hh:mm:ss</font>.
Note, ignored if <a class='body' href="#allday">allday</a> == 1. E.g.
<code><font color="#000000">
<br /><font color="#0000BB">&lt;?php<br /><br />&nbsp;&nbsp;&nbsp;$e </font><font color="#007700">= </font><font color="#0000BB">$cal</font><font color="#007700">-&gt;</font><font color="#0000BB">get_event</font><font color="#007700">(</font><font color="#0000BB">14</font><font color="#007700">, </font><font color="#DD0000">"2009-2-4"</font><font color="#007700">);<br /><br />&nbsp;&nbsp;&nbsp;if(!</font><font color="#0000BB">$e</font><font color="#007700">-&gt;</font><font color="#0000BB">allday</font>) {<br />&nbsp;&nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;list(</font><font color="#0000BB">$hr</font><font color="#007700">,</font><font color="#0000BB">$mn</font><font color="#007700">,</font><font color="#0000BB">$sc</font><font color="#007700">) = </font><font color="#0000BB">explode</font><font color="#007700">(</font><font color="#DD0000">":"</font><font color="#007700">, </font><font color="#0000BB">$e</font><font color="#007700">-&gt;</font><font color="#0000BB">duration</font><font color="#007700">);<br /> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo(</font><font color="#DD0000">"event will last for "</font><font color="#007700">. </font><font color="#0000BB">$hr </font><font color="#007700">.</font><font color="#DD0000">" hours and "</font><font color="#007700">);<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo(</font><font color="#0000BB">$mn </font><font color="#007700">.</font><font color="#DD0000">" minutes&lt;br&gt;\n"</font><font color="#007700">);<br /><br />&nbsp;&nbsp;&nbsp;}<br /><br /></font><font color="#0000BB">?&gt;</font>
</font>
</code><br />
<div align='center' style='font-size: 10px'><a name="repeats">(<a class='body' href="#top">top</a>)</a></div>

<hr>
boolean <font class='heading'>repeats</font>
<hr>
True if the event repeats, false if not.
<br /><br />

<div align='center' style='font-size: 10px'><a name="ends_at">(<a class='body' href="#top">top</a>)</a></div>

<hr>
timestamp <font class='heading'>ends_at</font>
<hr>
The time that this event ends. Basically, start + duration. 
<br /><br />

<div align='center' style='font-size: 10px'><a name="org_name">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>org_name</font>
<hr>
The organizer's name.
<br /><br />

<div align='center' style='font-size: 10px'><a name="org_email">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>org_email</font>
<hr>
The organizer's email address.
<br /><br />


<div align='center' style='font-size: 10px'><a name="url">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>url</font>
<hr>
The URL of this event.
<br /><br />


<div align='center' style='font-size: 10px'><a name="location">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>location</font>
<hr>
The location of the event.<br /><br />
<div align='center' style='font-size: 10px'><a name="notes">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>notes</font>
<hr>
The event notes.
<br /><br />
<div align='center' style='font-size: 10px'><a name="flag">(<a class='body' href="#top">top</a>)</a></div>

<hr>
int <font class='heading'>flag</font>
<hr>
1 if the event is flagged, 0 if it is not.<br /><br />
<div align='center' style='font-size: 10px'><a name="addr_st">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>addr_st</font>
<hr>
The street address of the event (the first line of the address).
<br /><br />
<div align='center' style='font-size: 10px'><a name="addr_ci">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>addr_ci</font>
<hr>
The City State, Zip of the event (the second line of the address).
<br /><br />
<div align='center' style='font-size: 10px'><a name="phone">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>phone</font>
<hr>
The phone number of the event.
<br /><br />
<div align='center' style='font-size: 10px'><a name="icon">(<a class='body' href="#top">top</a>)</a></div>

<hr>
string <font class='heading'>icon</font>
<hr>
The relative URL to the icon for this event. E.g.<br />
<font color='red'>icons/org/flag.gif</font>
<div align='center' style='font-size: 10px'>(<a class='body' href="#top">top</a>)</div>
<?php

   $_cal_html->print_footer();
?>
