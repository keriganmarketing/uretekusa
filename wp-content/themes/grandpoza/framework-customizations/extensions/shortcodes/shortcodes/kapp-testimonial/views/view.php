<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
      $testimonials =  fw_akg( 'testimonials', $atts, array() );

      switch($atts["style"])
      {
          case 0:
              include dirname(__FILE__ ). "/templates/template1.php";
              break;
          case 2:
              include dirname(__FILE__ ). "/templates/template3.php";
              break;
          case 3 :
              include dirname(__FILE__ )."/templates/template4.php";
              break;
      }
?>
