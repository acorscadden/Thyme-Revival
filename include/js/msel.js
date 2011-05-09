<script language='javascript' type='text/javascript'>
<!--

function add_to_sel(sel1,sel2)
{

    var index = document.<?php echo($_cal_form->name) ?>.elements[sel1].selectedIndex;

    var name = document.<?php echo($_cal_form->name) ?>.elements[sel1].options[index].text;
    var val = document.<?php echo($_cal_form->name) ?>.elements[sel1].options[index].value;

    if(val == 0) {
       return;
    }

    var optlen = document.<?php echo($_cal_form->name) ?>.elements[sel2].options.length;

    for(i = 0; i < optlen; i++)
    {

       if(document.<?php echo($_cal_form->name) ?>.elements[sel2].options[i].value == val) {
          return;
       }

    }

    document.<?php echo($_cal_form->name) ?>.elements[sel2].options[optlen++] = new Option(name, val);



}

function rem_sel(sel_name)
{

   var sel = document.<?php echo($_cal_form->name) ?>.elements[sel_name].selectedIndex;


   if(sel == -1) {
      return;
   }

   document.<?php echo($_cal_form->name) ?>.elements[sel_name].options[sel] = null;

}
// -->
</script>
