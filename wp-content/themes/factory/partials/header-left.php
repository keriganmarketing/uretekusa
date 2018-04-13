<?php
// Logo to the left with the menu below


$factorycommercegurus_protocol = ( is_ssl() ) ? "https:" : "http:";

$factorycommercegurus_responsive_status = '';
$factorycommercegurus_responsive_status = factorycommercegurus_getoption( 'factorycommercegurus_responsive' );

$factorycommercegurus_logo = '';

$factorycommercegurus_display_cart = '';
$factorycommercegurus_display_cart = factorycommercegurus_getoption( 'factorycommercegurus_show_cart' );

$factorycommercegurus_display_search = '';
$factorycommercegurus_display_search = factorycommercegurus_getoption( 'factorycommercegurus_show_search' );

$factorycommercegurus_page_heading_alignment = '';
$factorycommercegurus_page_heading_alignment = factorycommercegurus_getoption( 'factorycommercegurus_page_heading_alignment' );

$factorycommercegurus_catalog = '';
$factorycommercegurus_catalog = factorycommercegurus_getoption( 'factorycommercegurus_catalog_mode' );

$factorycommercegurus_primary_menu_layout = '';
$factorycommercegurus_primary_menu_layout = factorycommercegurus_getoption( 'factorycommercegurus_primary_menu_layout' );

$factorycommercegurus_sticky_menu = '';
$factorycommercegurus_sticky_menu = factorycommercegurus_getoption( 'factorycommercegurus_sticky_menu' );

if ( !empty( $_SESSION['factorycommercegurus_header_top'] ) ) {
	$factorycommercegurus_topbar_display = $_SESSION['factorycommercegurus_header_top'];
}

$factorycommercegurus_topbar = '';
$factorycommercegurus_topbar = factorycommercegurus_getoption( 'factorycommercegurus_topbar' );

$factorycommercegurus_mobile_visible = '';
$factorycommercegurus_mobile_visible = factorycommercegurus_getoption( 'factorycommercegurus_mobile_visible' );

$factorycommercegurus_shop_announcements = '';
$factorycommercegurus_shop_announcements = factorycommercegurus_getoption( 'factorycommercegurus_shop_announcements' );

$factorycommercegurus_logo_position = '';
$factorycommercegurus_logo_position = factorycommercegurus_getoption( 'factorycommercegurus_logo_position' );

$factorycommercegurus_cta_sticky = '';
$factorycommercegurus_cta_sticky = factorycommercegurus_getoption( 'factorycommercegurus_cta_sticky' );

?>

<?php if ( $factorycommercegurus_mobile_visible == '1' ) { ?>
	<div class="mobile-header-details">
		<?php dynamic_sidebar( 'header-details' ); ?>
	</div>
<?php } ?>

<!-- Load Top Bar -->
<?php if ( $factorycommercegurus_topbar == '1' ) { ?>

<?php if ( $factorycommercegurus_mobile_visible == '1' ) { ?>
	<div class="cg-announcements mobile-visible">
<?php } else { ?>
	<div class="cg-announcements">
<?php } ?>

		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 top-bar-left">
					<?php if ( $factorycommercegurus_shop_announcements == '1' ) { ?>
						<ul class="cg-show-announcements">
							<?php factorycommercegurus_get_announcements(); ?>
						</ul>
					<?php } else { ?>
						<?php if ( is_active_sidebar( 'top-bar-left' ) ) : ?>
							<?php dynamic_sidebar( 'top-bar-left' ); ?>
						<?php endif; ?>
					<?php } ?>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 top-bar-right">
					<?php if ( is_active_sidebar( 'top-bar-right' ) ) : ?>
						<?php dynamic_sidebar( 'top-bar-right' ); ?>
					<?php endif; ?>
				</div>		
			</div>
		</div>
	</div>
<?php } ?>	
<!--/ End Top Bar -->

<!-- Only load if Mobile Search Widget Area is Enabled -->
<?php if ( is_active_sidebar( 'mobile-search' ) ) : ?>

	<script>

	    ( function ( $ ) {
	        "use strict";

	        $( document ).ready( function () {
	            $( ".activate-mobile-search" ).click( function () {
	                $( ".mobile-search-reveal" ).slideToggle( "fast" );
	            } );
	        } );

	    }( jQuery ) );
	</script>

	<div class="mobile-search-reveal">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="activate-mobile-search close"><i class="ion-close-round"></i></div>
					<?php dynamic_sidebar( 'mobile-search' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<!--/ End Mobile Search -->

<?php if ( $factorycommercegurus_page_heading_alignment == 'left' ) { ?>
	<div id="wrapper" class="cg-heading-align-left">
<?php } else { ?>
	<div id="wrapper" class="cg-heading-align-center">
<?php } ?>
	<!-- Left Logo with menu below -->
	<div class="cg-menu-below cg-logo-left cg-menu-left">
		<div class="container">
			<div class="cg-logo-cart-wrap">
				<div class="cg-logo-inner-cart-wrap">
					<div class="row">
						<div class="container width-auto">
							<div class="cg-wp-menu-wrapper">
								<div id="load-mobile-menu">
								</div>

								<?php if ( is_active_sidebar( 'mobile-search' ) ) : ?>
									<div class="activate-mobile-search"><i class="ion-android-search mobile-search-icon"></i></div>
								<?php endif; ?>

								<div class="rightnav">
									<div class="cg-extras">
															
										<?php if ( $factorycommercegurus_display_search == '1' ) { ?>
										<div class="extra"><?php echo factorycommercegurus_search(); ?></div>
										<?php } ?> 
										<div class="extra"><?php dynamic_sidebar( 'header-details' ); ?></div>


									</div><!--/cg-extras --> 
								</div><!--/rightnav -->

								<?php
								$factorycommercegurus_main_logo	 = '';
								$factorycommercegurus_main_logo	 = factorycommercegurus_get_logo( 'main' );

								if ( $factorycommercegurus_main_logo ) {
									?>

									<div class="leftnav logo image dynamic-logo-width">
										<a class="cg-main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
											<span class="helper"></span><img src="<?php echo esc_url( $factorycommercegurus_main_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
									</div>

								<?php } else { ?>
									<div class="leftnav text-logo dynamic-logo-width">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									</div>
								<?php } ?>

							</div>
						</div><!--/container -->
					</div><!--/row -->
				</div><!--/cg-logo-inner-cart-wrap -->
			</div><!--/cg-logo-cart-wrap -->
		</div><!--/container -->
	</div><!--/cg-menu-below -->
	<div class="cg-primary-menu cg-wp-menu-wrapper cg-primary-menu-below-wrapper cg-primary-menu-left">
		<div class="container">
			<div class="row margin-auto">
			
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
						<?php
						wp_nav_menu( array(
							'theme_location'	 => 'primary',
							'before'			 => '',
							'after'				 => '',
							'link_before'	 	 => '<span>',
							'link_after'	 	 => '</span>',
							'depth'				 => 4,
							'container'			 => 'div',
							'container_class'	 => 'cg-main-menu',
							'fallback_cb'		 => false,
							'walker'			 => new factorycommercegurus_primary_menu() )
						);
						?>
					<?php } else { ?>
						<p class="setup-message"><?php echo esc_html__( 'You can set your main menu in Appearance &rarr; Menus', 'factory' ); ?></p>
					<?php } ?>
					
			</div>
		</div>
	</div>




	<?php
	if ( $factorycommercegurus_sticky_menu == '1' ) {
		?>
		<!--FIXED -->
		<?php
		$factorycommercegurus_fixed_beside_style = '';

		if ( isset( $_GET['logo_position'] ) ) {
			$factorycommercegurus_logo_position = $_GET['logo_position'];
		}

		if ( $factorycommercegurus_logo_position == 'beside' ) {
			$factorycommercegurus_fixed_beside_style = 'cg-fixed-beside';
		}
		?>
		<div class="cg-header-fixed-wrapper <?php echo esc_attr( $factorycommercegurus_fixed_beside_style ); ?>">
			<div class="cg-header-fixed">
				<div class="container">
					<div class="cg-wp-menu-wrapper">
						<div class="cg-primary-menu">
							<div class="row">
								<div class="container width-auto">
									<div class="cg-wp-menu-wrapper">
										<div class="rightnav">
											
											<?php 
											if ( $factorycommercegurus_cta_sticky == 'yes' ) {
												factorycommercegurus_get_cta_button(); 
											}
											?>

										</div><!--/rightnav -->

										<?php
										$factorycommercegurus_sticky_logo	 = '';
										$factorycommercegurus_sticky_logo	 = factorycommercegurus_get_logo( 'sticky' );

										if ( $factorycommercegurus_sticky_logo ) {
											?>

											<div class="leftnav logo image">
												<a class="cg-sticky-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
													<span class="helper"></span><img src="<?php echo esc_url( $factorycommercegurus_sticky_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
											</div>
										<?php } else { ?>
											<div class="leftnav text-logo">
												<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
											</div>
										<?php } ?>
										<?php if ( has_nav_menu( 'primary' ) ) { ?>
											<?php
											wp_nav_menu( array(
												'theme_location' => 'primary',
												'before'		 => '',
												'after'			 => '',
												'link_before'	 => '',
												'link_after'	 => '',
												'depth'			 => 4,
												'fallback_cb'	 => false,
												'walker'		 => new factorycommercegurus_primary_menu() )
											);
											?>
										<?php } else { ?>
											<p class="setup-message"><?php echo esc_html__( 'You can set your main menu in Appearance -> Menus', 'factory' ); ?></p>
										<?php } ?>
									</div><!--/cg-wp-menu-wrapper -->
								</div><!--/container -->
							</div><!--/row -->
						</div><!--/cg-primary-menu -->
					</div><!--/cg-wp-menu-wrapper -->
				</div><!--/container -->
			</div><!--/cg-header-fixed -->
		</div><!--/cg-header-fixed-wrapper. -->
	<?php }
	?>

	<div class="page-container">