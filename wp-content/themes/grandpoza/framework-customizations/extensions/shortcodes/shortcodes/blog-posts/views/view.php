<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

      $args = array(
          "posts_per_page"  => $atts["posts_count"],
          'cat'             => $atts['category']
          );

      $blog_kapp_posts = new WP_Query($args);

      switch($atts['style'])
      {
          case 0 :
              require dirname(__FILE__)."/templates/template-1.php";
              break;
          case 1 :
              require dirname(__FILE__)."/templates/template-2.php";
              break;
          case 2 :
              require dirname(__FILE__)."/templates/template-3.php";
              break;
      }
?>

<?php if( $atts['enable_visit_blog_btn'] ) : ?>

<div class="mt-40 t-center">
    <?php $blog_post_page_permalink = isset( $atts['blog_page_url'] ) && "" != $atts['blog_page_url'] ? $atts['blog_page_url'] : get_permalink( get_option( 'page_for_posts' ) ); ?>

    <a href="<?php echo esc_url( $blog_post_page_permalink ); ?>" class="btn btn-rounded">
        <?php echo esc_attr($atts['visit_blog_btn_text']); ?>
        <i class="fa fa-long-arrow-right ml-10"></i>
    </a>

</div>

<?php endif; ?>