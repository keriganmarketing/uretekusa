<?php
/**
 * The theme header
 *
 * */

$factorycommercegurus_protocol = ( is_ssl() ) ? "https:" : "http:";

$factorycommercegurus_responsive_status = '';
$factorycommercegurus_responsive_status = factorycommercegurus_getoption( 'factorycommercegurus_responsive' );

$factorycommercegurus_preloader = '';
$factorycommercegurus_preloader = factorycommercegurus_getoption( 'factorycommercegurus_preloader' );

$factorycommercegurus_logo = '';
$factorycommercegurus_preloader_status = '';

$factorycommercegurus_topbar_display = '';
$factorycommercegurus_topbar_display = factorycommercegurus_getoption( 'factorycommercegurus_topbar_display' );

$factorycommercegurus_topbar_message = '';
$factorycommercegurus_topbar_message = factorycommercegurus_getoption( 'factorycommercegurus_topbar_message' );

$factorycommercegurus_display_cart = '';
$factorycommercegurus_display_cart = factorycommercegurus_getoption( 'factorycommercegurus_show_cart' );

$factorycommercegurus_display_search = '';
$factorycommercegurus_display_search = factorycommercegurus_getoption( 'factorycommercegurus_show_search' );


$factorycommercegurus_catalog = '';
$factorycommercegurus_catalog = factorycommercegurus_getoption( 'factorycommercegurus_catalog_mode' );


$factorycommercegurus_primary_menu_layout = '';
$factorycommercegurus_primary_menu_layout = factorycommercegurus_getoption( 'factorycommercegurus_primary_menu_layout' );


$factorycommercegurus_sticky_menu = '';
$factorycommercegurus_sticky_menu = factorycommercegurus_getoption( 'factorycommercegurus_sticky_menu' );


if ( !empty( $_SESSION['factorycommercegurus_header_top'] ) ) {
	$factorycommercegurus_topbar_display = $_SESSION['factorycommercegurus_header_top'];
}

$factorycommercegurus_shop_announcements = '';
$factorycommercegurus_shop_announcements = factorycommercegurus_getoption( 'factorycommercegurus_shop_announcements' );

$factorycommercegurus_logo_position = '';
$factorycommercegurus_logo_position = factorycommercegurus_getoption( 'factorycommercegurus_logo_position' );


if ( isset( $_GET['logo_position'] ) ) {
	$factorycommercegurus_logo_position = $_GET['logo_position'];
}
?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php
		if ( $factorycommercegurus_responsive_status == 'enabled' ) {
			?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php } ?>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">        
       <!--[if lte IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script><![endif]-->
		<?php wp_head(); ?>
    </head>
    <body id="skrollr-body" <?php body_class(); ?>>

    <?php if ( $factorycommercegurus_preloader !== 'disabled' ) {
	?>
    <div class="cg-loader">
    	<div class="spinner">
  			<div class="double-bounce1"></div>
  			<div class="double-bounce2"></div>
		</div>
	</div>

	<script>
	( function ( $ ) { "use strict";
		$(window).load(function() {
			$(".cg-loader").fadeOut("slow");;
		});
	}( jQuery ) );
	</script>
	<?php } ?>

		<div id="main-wrapper" class="content-wrap">

			<?php if ( $factorycommercegurus_logo_position == 'left' ) { ?>
				<?php get_template_part( 'partials/header', 'left' ); ?>

			<?php } else { ?>
				<?php get_template_part( 'partials/header', 'left' ); ?>
			<?php } ?>

			<?php
			if ( $factorycommercegurus_responsive_status !== 'disabled' ) {
				?>
				<div id="mobile-menu">
					<a id="skip" href="#cg-page-wrap" class="hidden" title="<?php esc_attr_e( 'Skip to content', 'factory' ); ?>"><?php esc_html_e( 'Skip to content', 'factory' ); ?></a> 
					<?php
					if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'mobile' ) ) {
						wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => 'ul', 'menu_id' => 'mobile-cg-mobile-menu', 'menu_class' => 'mobile-menu-wrap', 'walker' => new factorycommercegurus_mobile_menu() ) );
					} elseif ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'mobile-cg-primary-menu', 'menu_class' => 'mobile-menu-wrap', 'walker' => new factorycommercegurus_mobile_menu() ) );
					}
					?>
				</div><!--/mobile-menu -->
			<?php } ?>

			<div id="cg-page-wrap" class="hfeed site">