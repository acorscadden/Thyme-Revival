<script language="JavaScript" type='text/javascript'>
//
// $Id: event_list.js,v 1.9 2007/02/26 02:24:27 ian Exp $
//

   function view_count(c)
   {
      document.location = "<?php echo($_SERVER['PHP_SELF']) ?>?evnt_count=" + c;
   }

   function viewtype(selName)
   {

      var mytype = document.forms['<?php echo($_cal_form->name) ?>'].elements[selName].value;

      document.location = "<?php echo($_SERVER['PHP_SELF']) ?>?evnt_type=" + mytype;

   }


   function viewvcat(selName)
   {

      var mytype = document.forms['<?php echo($_cal_form->name) ?>'].elements[selName].value;

      document.location = "<?php echo($_SERVER['PHP_SELF']) ?>?vcat=" + mytype;

   }

   function viewcal(selNum)
   {

      var mycal = document.forms['<?php echo($_cal_form->name) ?>'].elements['calendar_' + selNum].value;

      document.location = "<?php echo($_SERVER['PHP_SELF']) ?>?calendar=" + mycal;


   }


   function updateDelete()
   {

      for(i = 0; i < document.<?php echo($_cal_form->name) ?>.elements.length; i++) 
      {

         var str = document.<?php echo($_cal_form->name) ?>.elements[i].name;
         
         if(str.substr(0,7) == "delete_") {

            document.<?php echo($_cal_form->name) ?>.elements[i].checked = document.<?php echo($_cal_form->name) ?>.deletecheckall.checked;
            
         }
      }

   }

   function check_all(checked)
   {

      for(i = 0; i < document.<?php echo($_cal_form->name) ?>.elements.length; i++)
      {

         var str = document.<?php echo($_cal_form->name) ?>.elements[i].name;

         if(str.substr(0,7) == "delete_") {
            document.<?php echo($_cal_form->name) ?>.elements[i].checked = checked;
         }
      }

      document.<?php echo($_cal_form->name) ?>.deletecheckall.checked = checked;




   }


</script>
