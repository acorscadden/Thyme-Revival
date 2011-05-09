<?php

if(!@constant("_DEBUG_"))
   error_reporting(E_ALL ^ (E_NOTICE));

   $BASE_PATH = preg_replace("/modules.common_files.docs$/", "",dirname(__FILE__));

   require_once($BASE_PATH."include/config.php");

   require_once(@constant("_CAL_BASE_PATH_") . "include/classes/class.html.php");

   $_cal_html = new _cal_html();

_ex_theme_set("slate");

   $_cal_html->print_header("Event Class");

?>
<style type='text/css'>
#cal table.CALSTABLE td { border: 1px solid; }
</style>
Use the table below to find format options for $cal-&gt;format_date() and _ex_date()<br><br>
<TABLE 
BORDER="1" cellspacing=0 cellpadding=4
CLASS="CALSTABLE"
><COL><COL><COL><THEAD
><TR
><TH
><VAR
CLASS="parameter"
>format</VAR
> character</TH
><TH
>Description</TH
><TH
>Example returned values</TH
></TR
></THEAD
><TBODY
><TR
><TD
ALIGN="center"
><SPAN
CLASS="emphasis"
><I
CLASS="emphasis"
>Day</I
></SPAN
></TD
><TD
>---</TD
><TD
>---</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>d</VAR
></TD
><TD
>Day of the month, 2 digits with leading zeros</TD
><TD
><VAR
CLASS="literal"
>01</VAR
> to <VAR
CLASS="literal"
>31</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>D</VAR
></TD
><TD
>A textual representation of a day, three letters</TD
><TD
><VAR
CLASS="literal"
>Mon</VAR
> through <VAR
CLASS="literal"
>Sun</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>j</VAR
></TD
><TD
>Day of the month without leading zeros</TD
><TD
><VAR
CLASS="literal"
>1</VAR
> to <VAR
CLASS="literal"
>31</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>l</VAR
> (lowercase 'L')</TD
><TD
>A full textual representation of the day of the week</TD
><TD
><VAR
CLASS="literal"
>Sunday</VAR
> through <VAR
CLASS="literal"
>Saturday</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>S</VAR
></TD
><TD
>English ordinal suffix for the day of the month, 2 characters</TD
><TD
>&#13;        <VAR
CLASS="literal"
>st</VAR
>, <VAR
CLASS="literal"
>nd</VAR
>, <VAR
CLASS="literal"
>rd</VAR
> or
        <VAR
CLASS="literal"
>th</VAR
>.  Works well with <VAR
CLASS="literal"
>j</VAR
>

       </TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>w</VAR
></TD
><TD
>Numeric representation of the day of the week</TD
><TD
><VAR
CLASS="literal"
>0</VAR
> (for Sunday) through <VAR
CLASS="literal"
>6</VAR
> (for Saturday)</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>z</VAR
></TD
><TD
>The day of the year (starting from 0)</TD
><TD
><VAR
CLASS="literal"
>0</VAR
> through <VAR
CLASS="literal"
>365</VAR
></TD
></TR
><TR
><TD
ALIGN="center"
><SPAN
CLASS="emphasis"
><I
CLASS="emphasis"
>Week</I
></SPAN
></TD
><TD
>---</TD
><TD
>---</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>W</VAR
></TD
><TD
>ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0)</TD
><TD
>Example: <VAR
CLASS="literal"
>42</VAR
> (the 42nd week in the year)</TD
></TR
><TR
><TD
ALIGN="center"
><SPAN
CLASS="emphasis"
><I
CLASS="emphasis"
>Month</I
></SPAN
></TD
><TD
>---</TD
><TD
>---</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>F</VAR
></TD
><TD
>A full textual representation of a month, such as January or March</TD
><TD
><VAR
CLASS="literal"
>January</VAR
> through <VAR
CLASS="literal"
>December</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>m</VAR
></TD
><TD
>Numeric representation of a month, with leading zeros</TD
><TD
><VAR
CLASS="literal"
>01</VAR
> through <VAR
CLASS="literal"
>12</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>M</VAR
></TD
><TD
>A short textual representation of a month, three letters</TD
><TD
><VAR
CLASS="literal"
>Jan</VAR
> through <VAR
CLASS="literal"
>Dec</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>n</VAR
></TD
><TD
>Numeric representation of a month, without leading zeros</TD
><TD
><VAR
CLASS="literal"
>1</VAR
> through <VAR
CLASS="literal"
>12</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>t</VAR
></TD
><TD
>Number of days in the given month</TD
><TD
><VAR
CLASS="literal"
>28</VAR
> through <VAR
CLASS="literal"
>31</VAR
></TD
></TR
><TR
><TD
ALIGN="center"
><SPAN
CLASS="emphasis"
><I
CLASS="emphasis"
>Year</I
></SPAN
></TD
><TD
>---</TD
><TD
>---</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>L</VAR
></TD
><TD
>Whether it's a leap year</TD
><TD
><VAR
CLASS="literal"
>1</VAR
> if it is a leap year, <VAR
CLASS="literal"
>0</VAR
> otherwise.</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>o</VAR
></TD
><TD
>ISO-8601 year number. This has the same value as
        <VAR
CLASS="literal"
>Y</VAR
>, except that if the ISO week number
        (<VAR
CLASS="literal"
>W</VAR
>) belongs to the previous or next year, that year
        is used instead. (added in PHP 5.1.0)</TD
><TD
>Examples: <VAR
CLASS="literal"
>1999</VAR
> or <VAR
CLASS="literal"
>2003</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>Y</VAR
></TD
><TD
>A full numeric representation of a year, 4 digits</TD
><TD
>Examples: <VAR
CLASS="literal"
>1999</VAR
> or <VAR
CLASS="literal"
>2003</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>y</VAR
></TD
><TD
>A two digit representation of a year</TD
><TD
>Examples: <VAR
CLASS="literal"
>99</VAR
> or <VAR
CLASS="literal"
>03</VAR
></TD
></TR
><TR
><TD
ALIGN="center"
><SPAN
CLASS="emphasis"
><I
CLASS="emphasis"
>Time</I
></SPAN
></TD
><TD
>---</TD
><TD
>---</TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>a</VAR
></TD
><TD
>Lowercase Ante meridiem and Post meridiem</TD
><TD
><VAR
CLASS="literal"
>am</VAR
> or <VAR
CLASS="literal"
>pm</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>A</VAR
></TD
><TD
>Uppercase Ante meridiem and Post meridiem</TD
><TD
><VAR
CLASS="literal"
>AM</VAR
> or <VAR
CLASS="literal"
>PM</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>B</VAR
></TD
><TD
>Swatch Internet time</TD
><TD
><VAR
CLASS="literal"
>000</VAR
> through <VAR
CLASS="literal"
>999</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>g</VAR
></TD
><TD
>12-hour format of an hour without leading zeros</TD
><TD
><VAR
CLASS="literal"
>1</VAR
> through <VAR
CLASS="literal"
>12</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>G</VAR
></TD
><TD
>24-hour format of an hour without leading zeros</TD
><TD
><VAR
CLASS="literal"
>0</VAR
> through <VAR
CLASS="literal"
>23</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>h</VAR
></TD
><TD
>12-hour format of an hour with leading zeros</TD
><TD
><VAR
CLASS="literal"
>01</VAR
> through <VAR
CLASS="literal"
>12</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>H</VAR
></TD
><TD
>24-hour format of an hour with leading zeros</TD
><TD
><VAR
CLASS="literal"
>00</VAR
> through <VAR
CLASS="literal"
>23</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>i</VAR
></TD
><TD
>Minutes with leading zeros</TD
><TD
><VAR
CLASS="literal"
>00</VAR
> to <VAR
CLASS="literal"
>59</VAR
></TD
></TR
><TR
><TD
><VAR
CLASS="literal"
>s</VAR
></TD
><TD
>Seconds, with leading zeros</TD
><TD
><VAR
CLASS="literal"
>00</VAR
> through <VAR
CLASS="literal"
>59</VAR
></TD
></TR
></TBODY
></TABLE
></DIV
>

<P> Unrecognized characters in the format string will be printed as-is.
<?php
    $_cal_html->print_footer();
?>
