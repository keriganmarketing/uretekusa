<?php 
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

      $tax_args = $atts['category'] == 0 ? '' : array(
      array(
              'taxonomy'  => 'service_category',
              'field'     => 'term_id',
              'terms'     => $atts['category']
          )
      );

      $args = array(
          "posts_per_page"  => $atts["posts_count"],
          'post_type'       => 'service',
          'tax_query'       => $tax_args,
          );

      $kapp_services = new WP_Query($args);

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
      }
?>

