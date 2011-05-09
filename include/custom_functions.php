<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
//

@include_once(_CAL_BASE_PATH_."customize/custom_functions.php");
@include_once(_CAL_BASE_PATH_."customize/map_link.php");

# functions that can be customized
if(!function_exists('map_link')) {

function map_link($addr_st, $addr_ci)
{

   return 'http://maps.google.com/maps?oi=map&q='.urlencode($addr_st." ".$addr_ci);
}

}

?>
