<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

      $paged = get_query_var('paged') ? get_query_var('paged') : 1;

      $tax_args = $atts['category'] == 0 ? '' : array(
		    array(
			        'taxonomy'  => 'project_category',
			        'field'     => 'term_id',
			        'terms'     => $atts['category']
		        )
	        );

      $args = array(
          "posts_per_page"      => $atts['posts_count'],
          'paged'               => $paged,
          'tax_query'           => $tax_args,
          "post_type"           => "project"
          );

      $portfolio_posts = new WP_Query($args);

      switch($atts['style'])
      {
          case 0 :
              include dirname( __FILE__) ."/templates/template1.php";
              break;
          case 1 :
              include dirname( __FILE__) ."/templates/template2.php";
              break;
          case 2 :
              include dirname( __FILE__) ."/templates/template3.php";
              break;
          case 3 :
              include dirname( __FILE__) ."/templates/template4.php";
              break;
          case 4 :
              include dirname( __FILE__) ."/templates/template5.php";
              break;
      }
?>

