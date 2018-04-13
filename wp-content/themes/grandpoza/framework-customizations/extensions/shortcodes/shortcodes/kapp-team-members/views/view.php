<?php
if ( ! defined( 'FW' ) ) {die( 'Forbidden' ); }

$team_members = fw_akg( 'team_members', $atts, array() ) ;

switch($atts["style"])
{
    case 0 :
        include dirname(__FILE__ ). "/templates/template1.php";
        break;
    case 1 :
        include dirname(__FILE__ ). "/templates/template2.php";
        break;
    case 2 :
        include dirname(__FILE__ ). "/templates/template3.php";
        break;
    case 3 :
        include dirname(__FILE__ ). "/templates/template4.php";
        break;
    case 4 :
        include dirname(__FILE__ ). "/templates/template5.php";
        break;
}

?>
