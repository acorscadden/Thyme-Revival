<?php



  $_cal_modules['sync']['export']['generic']['display_name'] = _GENERAL_ . ' (.csv)';
  $_cal_modules['sync']['export']['generic']['include'] = 'generic/export_generic.php';
  $_cal_modules['sync']['export']['generic']['date_range'] = true;
  $_cal_modules['sync']['export']['generic']['attachments'] = false;
  $_cal_modules['sync']['export']['generic']['export'] = 'print_event_csv';
  $_cal_modules['sync']['export']['generic']['content_type'] = 'text/csv';
  $_cal_modules['sync']['export']['generic']['ext'] = '.csv';
  $_cal_modules['sync']['export']['generic']['header'] = 'export_header_csv';
  $_cal_modules['sync']['export']['generic']['footer'] = 'export_footer_csv';
  $_cal_modules['sync']['export']['generic']['export'] = 'export_event_csv';
?>