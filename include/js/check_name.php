<?php

   global $_cal_alphabet;


   # Due to the way Usernames, Calendars ..etc.. are handled
   # a title/name of those items must be a letter in this
   # language's alphabet

?>
<script language='javascript' type='text/javascript'>

var alphabet = new Array();

<?php

   foreach($_cal_alphabet as $c)
      echo("\talphabet['". strtolower($c) ."'] = 1;\n");

   echo("\n\n");
?>

function check_name(ent, elm)
{

    if(!alphabet[elm.value.substring(0,1).toLowerCase()]) {
       alert(ent + ' <?php echo(_MUST_BEGIN_WITH_CHAR_) ?>');
       return false;
    }

    return true;

}

</script>
