<?php

   $_cal_modules['sync']['export']['outlook2003']['display_name'] = "Outlook 2003";
   $_cal_modules['sync']['export']['outlook2003']['include'] = "outlook2003/export_outlook2003.php";
   $_cal_modules['sync']['export']['outlook2003']['date_range'] = false;
   $_cal_modules['sync']['export']['outlook2003']['attachments'] = false;
   $_cal_modules['sync']['export']['outlook2003']['hide_sync'] = true;

   $_cal_modules['sync']['export']['outlook2003']['export'] = "print_event_outlook2003";
   $_cal_modules['sync']['export']['outlook2003']['content_type'] = "text/calendar; method=REQUEST";
   $_cal_modules['sync']['export']['outlook2003']['ext'] = ".ics";

   $_cal_modules['sync']['export']['outlook2003']['header'] = "export_header_ical";
   $_cal_modules['sync']['export']['outlook2003']['footer'] = "export_footer_ical";
   $_cal_modules['sync']['export']['outlook2003']['export'] = "export_event_outlook2003";

   $_cal_modules['sync']['export']['outlook2003']['email_func'] = "email_outlook2003";

   $_cal_modules['sync']['export']['outlook2003']['email_no_msg'] = true;

?>
