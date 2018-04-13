<?php

// CommerceGurus Custom CSS

function factorycommercegurus_custom_css() {
	
	?>

	<style type="text/css">

		<?php
		$factorycommercegurus_logo_height							 = '';
		$factorycommercegurus_sticky_logo_height					 = '';
		$factorycommercegurus_padding_above_logo					 = '';
		$factorycommercegurus_padding_below_sticky_logo			 	 = '';
		$factorycommercegurus_padding_above_sticky_logo			 	 = '';
		$factorycommercegurus_padding_below_logo					 = '';
		$factorycommercegurus_dynamic_logo_width					 = '';
		$factorycommercegurus_mobile_header_height					 = '';
		$factorycommercegurus_mobile_logo_height					 = '';
		$factorycommercegurus_page_heading_top_margin				 = '';
		$factorycommercegurus_page_heading_bottom_margin			 = '';
		$factorycommercegurus_bg_color							 	 = '';
		$factorycommercegurus_pagewrapper_color					 	 = '';
		$factorycommercegurus_bg_img								 = '';
		$factorycommercegurus_bg_img_attach						 	 = '';
		$factorycommercegurus_bg_pattern_img						 = '';
		$factorycommercegurus_bg_img_repeat						 	 = '';
		$factorycommercegurus_bg_pattern_img_repeat				 	 = '';
		$factorycommercegurus_page_wrapper_color					 = '';
		$factorycommercegurus_skin_color							 = '';
		$factorycommercegurus_custom_css							 = '';
		$factorycommercegurus_announcements_bg					 	 = '';
		$factorycommercegurus_announcements_text					 = '';
		$factorycommercegurus_topbar_bgcolor						 = '';
		$factorycommercegurus_topbar_txtcolor						 = '';
		$factorycommercegurus_page_header_bg						 = '';
		$factorycommercegurus_level2_font_color 					 = '';
		
		$factorycommercegurus_bg_color_array						 = '';
		$factorycommercegurus_bg_color_array = factorycommercegurus_getoption( 'factorycommercegurus_background' );
		if ( $factorycommercegurus_bg_color_array ) {
			$factorycommercegurus_bg_color = $factorycommercegurus_bg_color_array['background-color'];
		}

	
		$factorycommercegurus_bg_img_array						 = '';
		$factorycommercegurus_bg_img_array = factorycommercegurus_getoption( 'factorycommercegurus_background' );
		if ( $factorycommercegurus_bg_img_array ) {
			$factorycommercegurus_bg_img = $factorycommercegurus_bg_img_array['background-image'];
		}

		$factorycommercegurus_bg_pattern_img_array						 = '';
		$factorycommercegurus_bg_pattern_img_array = factorycommercegurus_getoption( 'factorycommercegurus_pattern_background' );
		if ( $factorycommercegurus_bg_pattern_img_array ) {
			$factorycommercegurus_bg_pattern_img = $factorycommercegurus_bg_pattern_img_array['background-image'];			
		}

		$factorycommercegurus_bg_img_repeat_array						 = '';
		$factorycommercegurus_bg_img_repeat_array = factorycommercegurus_getoption( 'factorycommercegurus_background' );
		
		if ( $factorycommercegurus_bg_img_repeat_array ) {
			$factorycommercegurus_bg_pattern_img_repeat = $factorycommercegurus_bg_img_repeat_array['background-repeat'];
		}
		
		$factorycommercegurus_page_wrapper_color = factorycommercegurus_getoption( 'factorycommercegurus_page_wrapper_color' );
		$factorycommercegurus_primary_menu_img_height = factorycommercegurus_getoption( 'factorycommercegurus_primary_menu_img_height' );
		$factorycommercegurus_logo_height = factorycommercegurus_getoption( 'factorycommercegurus_logo_height' );
		$factorycommercegurus_padding_above_logo = factorycommercegurus_getoption( 'factorycommercegurus_padding_above_logo' );
		$factorycommercegurus_padding_below_logo = factorycommercegurus_getoption( 'factorycommercegurus_padding_below_logo' );
		$factorycommercegurus_sticky_logo_height = factorycommercegurus_getoption( 'factorycommercegurus_sticky_logo_height' );
		$factorycommercegurus_padding_above_sticky_logo = factorycommercegurus_getoption( 'factorycommercegurus_padding_above_sticky_logo' );
		$factorycommercegurus_padding_below_sticky_logo = factorycommercegurus_getoption( 'factorycommercegurus_padding_below_sticky_logo' );
		$factorycommercegurus_padding_below_logo = factorycommercegurus_getoption( 'factorycommercegurus_padding_below_logo' );
		$factorycommercegurus_dynamic_logo_width = factorycommercegurus_getoption( 'factorycommercegurus_dynamic_logo_width' );
		$factorycommercegurus_mobile_header_height = factorycommercegurus_getoption( 'factorycommercegurus_mobile_header_height' );
		$factorycommercegurus_mobile_logo_height = factorycommercegurus_getoption( 'factorycommercegurus_mobile_logo_height' );
		$factorycommercegurus_dynamic_widget_area_width = ( 100 - ( $factorycommercegurus_dynamic_logo_width ));
		$factorycommercegurus_page_heading_top_margin = factorycommercegurus_getoption( 'factorycommercegurus_page_heading_top_margin' );
		$factorycommercegurus_page_heading_bottom_margin = factorycommercegurus_getoption( 'factorycommercegurus_page_heading_bottom_margin' );
		$factorycommercegurus_announcements_bg = factorycommercegurus_getoption( 'factorycommercegurus_announcements_bg' );
		$factorycommercegurus_announcements_text = factorycommercegurus_getoption( 'factorycommercegurus_announcements_text' );
		$factorycommercegurus_topbar_bgcolor = factorycommercegurus_getoption( 'factorycommercegurus_topbar_bgcolor' );
		$factorycommercegurus_topbar_txtcolor = factorycommercegurus_getoption( 'factorycommercegurus_topbar_txtcolor' );
		
		$factorycommercegurus_page_header_bg_array = '';
		$factorycommercegurus_page_header_bg_array = factorycommercegurus_getoption( 'factorycommercegurus_page_header_bg' );
		if ( $factorycommercegurus_page_header_bg_array ) {
			$factorycommercegurus_page_header_bg = $factorycommercegurus_page_header_bg_array['url'] ;			
		}

		
		$factorycommercegurus_skin_color			 = factorycommercegurus_getoption( 'factorycommercegurus_skin_color' );
		$factorycommercegurus_primary_color		 = factorycommercegurus_getoption( 'factorycommercegurus_primary_color' );
		$factorycommercegurus_active_link_color	 = factorycommercegurus_getoption( 'factorycommercegurus_active_link_color' );
		$factorycommercegurus_link_hover_color	 = factorycommercegurus_getoption( 'factorycommercegurus_link_hover_color' );

		if ( !empty( $_SESSION['factorycommercegurus_skin_color'] ) ) {
			$factorycommercegurus_skin_color = $_SESSION['factorycommercegurus_skin_color'];
		}

		if ( isset( $factorycommercegurus_skin_color ) ) {
			if ( $factorycommercegurus_skin_color !== 'none' ) {
				$factorycommercegurus_primary_color		 = $factorycommercegurus_skin_color;
				$factorycommercegurus_active_link_color	 = $factorycommercegurus_skin_color;
				$factorycommercegurus_link_hover_color	 = $factorycommercegurus_skin_color;
			}
		}

		$factorycommercegurus_first_footer_bg			 	 = factorycommercegurus_getoption( 'factorycommercegurus_first_footer_bg' );
		$factorycommercegurus_second_footer_bg		 	 = factorycommercegurus_getoption( 'factorycommercegurus_second_footer_bg' );
		$factorycommercegurus_first_footer_text		 	 = factorycommercegurus_getoption( 'factorycommercegurus_first_footer_text' );
		$factorycommercegurus_first_footer_link		 	 = factorycommercegurus_getoption( 'factorycommercegurus_first_footer_link' );
		$factorycommercegurus_second_footer_text		 	 = factorycommercegurus_getoption( 'factorycommercegurus_second_footer_text' );
		$factorycommercegurus_header_bg_color			 	 = factorycommercegurus_getoption( 'factorycommercegurus_header_bg_color' );
		$factorycommercegurus_header_text_color		 	 = factorycommercegurus_getoption( 'factorycommercegurus_header_text_color' );
		$factorycommercegurus_navigation_text_color	 	 = factorycommercegurus_getoption( 'factorycommercegurus_navigation_text_color' );
		$factorycommercegurus_main_menu_dropdown_bg_hover	 = factorycommercegurus_getoption( 'factorycommercegurus_main_menu_dropdown_bg_hover' );
		$factorycommercegurus_mobile_header_bg_color	 	 = factorycommercegurus_getoption( 'factorycommercegurus_mobile_header_bg_color' );
		$factorycommercegurus_header_fixed_bg_color	 	 = factorycommercegurus_getoption( 'factorycommercegurus_header_fixed_bg_color' );
		$factorycommercegurus_header_fixed_text_color	 	 = factorycommercegurus_getoption( 'factorycommercegurus_header_fixed_text_color' );
		$factorycommercegurus_custom_css = factorycommercegurus_getoption( 'factorycommercegurus_custom_css' );

		$factorycommercegurus_level2_font_color_array = '';
		$factorycommercegurus_level2_font_color_array = factorycommercegurus_getoption( 'factorycommercegurus_level2_font' );
		if ( $factorycommercegurus_level2_font_color_array ) {
			$factorycommercegurus_level2_font_color = $factorycommercegurus_level2_font_color_array['color'];
		}

		$header_top_padding_height			 = ( ( $factorycommercegurus_logo_height ) + ( $factorycommercegurus_padding_above_logo ) );
		$sticky_header_top_padding_height	 = ( ( $factorycommercegurus_sticky_logo_height ) + ( $factorycommercegurus_padding_above_sticky_logo ) );
		$header_total_height				 = ( ( $factorycommercegurus_logo_height ) + ( $factorycommercegurus_padding_above_logo ) + ( $factorycommercegurus_padding_below_logo ) );
		$sticky_header_total_height			 = ( ( $factorycommercegurus_sticky_logo_height ) + ( $factorycommercegurus_padding_above_sticky_logo ) + ( $factorycommercegurus_padding_below_sticky_logo ) );


		if ( $factorycommercegurus_announcements_bg ) {
			?>

			.cg-announcements 
			{
				background-color: <?php echo esc_attr( $factorycommercegurus_announcements_bg ); ?>;
			}

			<?php
		}

		if ( $factorycommercegurus_announcements_text ) {
			?>

			.cg-announcements,
			.cg-announcements a,
			.cg-announcements a:hover

			{
				color: <?php echo esc_attr( $factorycommercegurus_announcements_text ); ?>;
			}

			<?php
		}

		if ( $factorycommercegurus_topbar_bgcolor ) {
			?>

			.cg-shopping-toolbar 
			{
				background-color: <?php echo esc_attr( $factorycommercegurus_topbar_bgcolor ); ?>;
			}

			<?php
		}

		if ( $factorycommercegurus_topbar_txtcolor ) {
			?>

			.cg-shopping-toolbar .wpml .widget_text,
			.cg-shopping-toolbar a.divider,
			.cg-shopping-toolbar a,
			.cg-shopping-toolbar
			{            
				color: <?php echo esc_attr( $factorycommercegurus_topbar_txtcolor ); ?>;
			}

			<?php
		}

		if ( $factorycommercegurus_level2_font_color ) {
			?>

			.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover, 
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover 
			{
				color: <?php echo esc_attr( $factorycommercegurus_level2_font_color ); ?>;
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_main_menu_dropdown_bg_hover ) {
			?>
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li:hover > a,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li:hover > a,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li > a:hover,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li > a:hover,
			.menu > li .cg-submenu-ddown .container > ul .menu-item-has-children .cg-submenu li a:hover,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul .menu-item-has-children > a:hover:after {
				background-color: <?php echo esc_attr( $factorycommercegurus_main_menu_dropdown_bg_hover ); ?>; 
				border-color: <?php echo esc_attr( $factorycommercegurus_main_menu_dropdown_bg_hover ); ?>;
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_bg_color ) {
			?>
			body {
				background-color: <?php echo esc_attr( $factorycommercegurus_bg_color ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_bg_img ) { ?>
			body {
				background-image: url('<?php echo esc_url( $factorycommercegurus_bg_img ); ?>'); 
				background-position: 0px 0px;
				background-attachment: fixed;
				background-size: cover;
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_bg_img_repeat ) { ?>
			body {
				background-repeat: <?php echo esc_attr( $factorycommercegurus_bg_img_repeat ); ?>; 
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_bg_pattern_img ) { ?>
			body {
				background-image: url('<?php echo esc_url( $factorycommercegurus_bg_pattern_img ); ?>'); 
				background-position: 0px 0px;
			}
		<?php } ?>

			<?php if ( $factorycommercegurus_page_header_bg ) { ?>
			.cg-hero-bg {
				background-image: url('<?php echo esc_url( $factorycommercegurus_page_header_bg ); ?>'); 
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_bg_pattern_img_repeat ) { ?>
			body {
				background-repeat: <?php echo esc_attr( $factorycommercegurus_bg_pattern_img_repeat ); ?>; 
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_page_wrapper_color ) { ?>
			#main-wrapper, 
			body.boxed #main-wrapper,
			#cg-page-wrap,
			.page-container {
				background-color: <?php echo esc_attr( $factorycommercegurus_page_wrapper_color ); ?>; 
			}
		<?php } ?>

		<?php if ( $factorycommercegurus_primary_color ) { ?>

			#top,
			.cg-primary-menu .menu > li > a:before,
			.new.menu-item a:after, 
			.cg-primary-menu-below-wrapper .menu > li.current_page_item > a,
			.cg-primary-menu-below-wrapper .menu > li.current-menu-ancestor > a,
			.cg-primary-menu-below-wrapper .menu > li.current_page_parent > a,
			.bttn:before, .cg-product-cta .button:before, 
			.slider .cg-product-cta .button:before, 
			.widget_shopping_cart_content p.buttons a.button:before,
			.faqs-reviews .accordionButton .icon-plus:before, 
			.content-area ul.bullets li:before,
			.container .mejs-controls .mejs-time-rail .mejs-time-current,
			.wpb_toggle:before, h4.wpb_toggle:before,
			#filters button.is-checked,
			.first-footer ul.list li:before,
			.tipr_content,
			.navbar-toggle .icon-bar,
			#calendar_wrap caption,
			.subfooter #mc_signup_submit,
			.container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
			.page-numbers li span.current,
			.page-numbers li a:hover,
			.product-category-description,
			.nav-slit h3,
			.cg-folio-thumb,
			.cg-folio-button,
			.cg-extra-product-options li a:after,
			.post-tags a:hover, 
			body.single-post.has-featured-image .header-wrapper .entry-meta time,
			#respond input#submit,
			#respond input#submit:hover,
			.content-area footer.entry-meta a:after,
			body .flex-direction-nav a,
			body.single-post .content-area footer.entry-meta a:after,
			.content-area .medium-blog footer.entry-meta a:after,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover:after,
			.container #mc_signup_submit,
			.cg-overlay-feature .cg-copy span.subtitle strong,
			.cg-overlay-slideup:hover .cg-copy,
			.container .mc4wp-form input[type="submit"],
			.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
			.wpcf7 input.wpcf7-submit,
			.double-bounce1, .double-bounce2,
			.entry-content a.more-link:before,
			.woocommerce a.button.alt,
			.woocommerce a.button.alt:hover,
			.widget_pages ul li:before, 
			.widget_meta ul li:before, 
			.widget_archive ul li:before, 
			.widget_categories ul li:before, 
			.widget_nav_menu ul li:before,
			.woocommerce button.button.alt,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt,
			.woocommerce input.button.alt:hover

			{
				background-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>; 
			}

			.page-numbers li span.current,
			ul.tiny-cart li ul.cart_list li.buttons .button.checkout,
			.page-numbers li a:hover, 
			.page-numbers li span.current,
			.page-numbers li span.current:hover,
			.page-numbers li a:hover,
			.vc_read_more,
			body .wpb_teaser_grid .categories_filter li a:hover, 
			.owl-theme .owl-controls .owl-page.active span, 
			.owl-theme .owl-controls.clickable .owl-page:hover span,
			.woocommerce-page .container .cart-collaterals a.button,
			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
			.order-wrap,
			.cg-product-cta .button:hover,
			.slider .cg-product-cta .button:hover,
			.widget_shopping_cart_content p.buttons a.button.checkout,
			.entry-content a.more-link:hover,
			body.home .wpb_text_column p a.more-link:hover,
			#respond input#submit,
			.up-sells-bottom h2 span,
			.content-area .up-sells-bottom h2 span,
			.related h2 span,
			.content-area .related h2 span,
			.cross-sells h2 span,
			.woocommerce-page .content-area form .coupon h3 span,
			body .vc_tta.vc_general.vc_tta-color-white .vc_tta-tab.vc_active span,
			body.error404 .content-area a.btn,
			body .flexslider,
			body.woocommerce-page ul.products li.product a:hover img,
			.cg-primary-menu .menu > li:hover

			{
				border-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

			.post-tags a:hover:before,
			.cat-links a:hover:before,
			.tags-links a:hover:before {
				border-right-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a:before {
				border-top-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

			a,
			body.bbpress button,
			.cg-features i,
			.cg-features h2,
			.toggle-active i.fa,
			.cg-menu-beside .cg-cart-count,
			.widget_layered_nav ul.yith-wcan-list li a:before,
			.widget_layered_nav ul.yith-wcan-list li.chosen a:before,
			.widget_layered_nav ul.yith-wcan-list li.chosen a,
			.cg-menu-below .cg-extras .cg-header-details i,
			blockquote:before,
			blockquote:after,
			article.format-link .entry-content p:before,
			.container .ui-state-default a, 
			.container .ui-state-default a:link, 
			.container .ui-state-default a:visited,
			.logo a,
			.container .cg-product-cta a.button.added:after,
			.woocommerce-breadcrumb a,
			#cg-articles h3 a,
			.cg-recent-folio-title a, 
			.content-area h2.cg-recent-folio-title a,
			.cg-product-info .yith-wcwl-add-to-wishlist a:hover:before,
			.cg-product-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before,
			.cg-primary-menu-below-wrapper .menu > li.download a span:before,
			.cg-primary-menu-below-wrapper .menu > li.download a:before,
			.cg-primary-menu-below-wrapper .menu > li.arrow a span:before,
			.cg-primary-menu-below-wrapper .menu > li.arrow a:before,
			.widget_rss ul li a,
			.lightwrapper .widget_rss ul li a,
			.woocommerce-tabs .tabs li a:hover,
			.content-area .checkout-confirmed-payment p,
			.icon.cg-icon-bag-shopping-2, 
			.icon.cg-icon-basket-1, 
			.icon.cg-icon-shopping-1,
			#top-menu-wrap li a:hover,
			.cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before, 
			.cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover:before,
			.widget ul.product-categories ul.children li a:before,
			.widget_pages ul ul.children li a:before,
			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
			.container .wpb_tabs .wpb_tabs_nav li a:hover,
			.widget a:hover,
			.cg-product-cta a.button.added,
			.woocommerce-tabs .tabs li.active a,
			.summary .price ins .amount,
			.woocommerce div.product p.price,
			body.woocommerce-page ul.products li.product .price,
			ul.tiny-cart li a.cart_dropdown_link:before,
			button.mfp-close:hover,
			body .vc_custom_heading a:hover,
			body.error404 .content-area a.btn,
			.no-grid .vc_custom_heading a:hover,
			.cg-price-action .cg-product-cta a,
            .prev-product:hover:before, 
			.next-product:hover:before,
			.widget.woocommerce .amount,
			.woocommerce nav.woocommerce-pagination ul li span.current,
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover,
			.container .wpb_tour.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav li.ui-state-active a,
			.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a:hover,
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a:hover 

			{
				color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

			.owl-theme .owl-controls .owl-buttons div:hover,
			article.format-link .entry-content p:hover,
			.container .ui-state-hover,
			#filters button.is-checked,
			#filters button.is-checked:hover,
			.map_inner,
			h4.widget-title span,
			.wpb_teaser_grid .categories_filter li.active a,
			.cg-header-fixed .menu > li .cg-submenu-ddown, 
			body .wpb_teaser_grid .categories_filter li.active a,
			.cg-wp-menu-wrapper .menu li a:hover,
			.cg-primary-menu-beside .cg-wp-menu-wrapper .menu li:hover a,
			.cg-header-fixed .cg-wp-menu-wrapper .menu li:hover a,
			.container .cg-product-cta a.button.added,
			h4.widget-title span,
			#secondary h4.widget-title span,
			.container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active

			{
				border-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}


			ul.tabNavigation li a.active,
			.wpb_teaser_grid .categories_filter li.active a,
			ul.tiny-cart li ul.cart_list li.buttons .button.checkout,
			.cg-primary-menu .menu > li:before

			{
				background: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;

			}

			.tipr_point_top:after,
			.woocommerce .woocommerce-tabs ul.tabs li.active a:after {
				border-top-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

			.tipr_point_bottom:after,
			.content-area a:hover
			{
				border-bottom-color: <?php echo esc_attr( $factorycommercegurus_primary_color ); ?>;
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_active_link_color ) { ?>

			a,
			.logo a,
			#secondary .widget_rss ul li a,
			.navbar ul li.current-menu-item a, 
			.navbar ul li.current-menu-ancestor a, 
			body.woocommerce ul.products li.product a:hover,
			#cg-articles h3 a,
			.current-menu-item,
			.content-area table.my_account_orders td.order-actions a,
			body.blog.has-featured-image .header-wrapper p.sub-title a,
			.content-area .cart-collaterals table a.shipping-calculator-button,
			.content-area h6 a.email,
			#secondary .widget_recent_entries ul li a

			{
				color: <?php echo esc_attr( $factorycommercegurus_active_link_color ); ?>; 
			}


		<?php } ?>

		<?php if ( $factorycommercegurus_link_hover_color ) { ?>
			.page-container a:hover,
			.page-container a:focus,
			body.single footer.entry-meta a:hover,
			.content-area table a:hover,
			.cg-blog-date .comments-link a:hover,
			.widget ul.product-categories li a:hover,
			.widget ul.product-categories ul.children li a:hover,
			#top .dropdown-menu li a:hover, 
			ul.navbar-nav li .nav-dropdown li a:hover,
			.navbar ul li.current-menu-item a:hover, 
			.navbar ul li.current-menu-ancestor a:hover,
			.content-area a.post-edit-link:hover:before,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
			body .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
			.cg-submenu-ddown .container > ul > li > a:hover,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover,
			.blog-pagination ul li a:hover,
			.content-area .medium-blog footer.entry-meta a:hover,
			.widget.popular-posts ul li a.wpp-post-title:hover,
			body .content-area article h2 a:hover,
			body .vc_custom_heading a:hover,
			.widget_tag_cloud a:hover,
			body.woocommerce-page ul.products li.product .button:hover,
			#secondary .widget_recent_entries ul li a:hover

			{
				color: <?php echo esc_attr( $factorycommercegurus_link_hover_color ); ?>; 
			}

			.dropdown-menu > li > a:hover {
				background-color: <?php echo esc_attr( $factorycommercegurus_link_hover_color ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_header_text_color ) { ?>

			@media only screen and (min-width: 1100px) { 

				.rightnav,
				.rightnav h4.widget-title {
					color: <?php echo esc_attr( $factorycommercegurus_header_text_color ); ?>;
				}

			}
		<?php } ?>

		<?php if ( $factorycommercegurus_navigation_text_color ) { ?>

				.cg-primary-menu .menu > li > a,
				.cg-primary-menu-below-wrapper .menu > li.secondary.current_page_item > a,
				body .cg-primary-menu-left.cg-primary-menu .menu > li.secondary.current_page_item:hover > a {
					color: <?php echo esc_attr( $factorycommercegurus_navigation_text_color ); ?>;
				}

		<?php } ?>

		/* Sticky Header Text */

		<?php if ( $factorycommercegurus_header_fixed_text_color ) { ?>

			.cg-transparent-header.scroller .cg-primary-menu .menu > li > a,
			.cg-transparent-header.scroller .rightnav .cart_subtotal,
			.cg-transparent-header.scroller .search-button,
			body.transparent-light .cg-transparent-header.scroller .cg-primary-menu .menu > li > a, 
			body.transparent-light .cg-transparent-header.scroller .rightnav .cart_subtotal, 
			body.transparent-light .cg-transparent-header.scroller .search-button,
			body.transparent-dark .cg-transparent-header.scroller .cg-primary-menu .menu > li > a,
			body.transparent-dark .cg-transparent-header.scroller .rightnav .cart_subtotal,
			body.transparent-dark .cg-transparent-header.scroller .search-button,
			.cg-header-fixed-wrapper .rightnav .cart_subtotal,
			.cg-header-fixed .cg-primary-menu .menu > li > a {
				color: <?php echo esc_attr( $factorycommercegurus_header_fixed_text_color ); ?>;
			}


			.cg-transparent-header.scroller .burger span,
			body.transparent-light .cg-transparent-header.scroller .burger span,
			body.transparent-dark .cg-transparent-header.scroller .burger span {
				background: <?php echo esc_attr( $factorycommercegurus_header_fixed_text_color ); ?>;
			}

			.cg-transparent-header.scroller .leftnav a,
			.cg-header-fixed .leftnav a {
				color: <?php echo esc_attr( $factorycommercegurus_header_fixed_text_color ); ?>;
				border-color: <?php echo esc_attr( $factorycommercegurus_header_fixed_text_color ); ?>;
			}



		<?php } ?>

		<?php if ( $factorycommercegurus_mobile_header_bg_color ) { ?>

			@media only screen and (max-width: 1100px) { 
				body .cg-header-wrap .cg-transparent-header,
				body.transparent-light .cg-header-wrap .cg-transparent-header,
				body.transparent-dark .cg-header-wrap .cg-transparent-header,
				body .cg-menu-below,
				.scroller, 
				body.transparent-light .cg-header-wrap .scroller, 
				body.transparent-dark .cg-header-wrap .scroller {
					background: <?php echo esc_attr( $factorycommercegurus_mobile_header_bg_color ); ?>; 
				}
			}

		<?php } ?>

		/* Standard Logo */
		<?php if ( $factorycommercegurus_logo_height ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header,
				.cg-menu-below {
					height: <?php echo esc_attr( $factorycommercegurus_logo_height ); ?>px;
				}

				.leftnav .cg-main-logo img {
					height: <?php echo esc_attr( $factorycommercegurus_logo_height ); ?>px;
					width: auto;
				}

				.cg-extras {
					line-height: <?php echo esc_attr( $factorycommercegurus_logo_height ); ?>px;
				}

				.cg-menu-below,
				.cg-menu-below .ul.tiny-cart,
				.cg-logo-center .search-button,
				.cg-menu-below .leftnav a { 
					line-height: <?php echo esc_attr( $header_total_height ); ?>px;
				}

				.cg-menu-below .ul.tiny-cart,
				.cg-menu-below .cg-extras .site-search {
					height: <?php echo esc_attr( $header_total_height ); ?>px;
					line-height: <?php echo esc_attr( $header_total_height ); ?>px;
				}

				.rightnav .extra {
					height: <?php echo esc_attr( $header_total_height ); ?>px;
				}


			}

		<?php } ?>

		/* Sticky Logo */
		<?php if ( $factorycommercegurus_sticky_logo_height ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller,
				.cg-header-fixed,
				.cg-header-fixed-wrapper.cg-is-fixed .logo {
				/*	height: <?php echo esc_attr( $sticky_header_total_height ); ?>px; */
				}

				.cg-header-fixed .helper {
					height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
					line-height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.scroller .leftnav .cg-sticky-logo img,
				.cg-header-fixed .leftnav img {
					height: <?php echo esc_attr( $factorycommercegurus_sticky_logo_height ); ?>px;
					width: auto;
				}

				.scroller .cg-extras {
					line-height: <?php echo esc_attr( $factorycommercegurus_sticky_logo_height ); ?>px;
				}

				.scroller.cg-transparent-header .midnav li,
				.scroller.rightnav {
					line-height: <?php echo esc_attr( $factorycommercegurus_sticky_logo_height ); ?>px;
				}

				.cg-header-fixed-wrapper .cg-primary-menu .menu > li > a {
					line-height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				

			}

		<?php } ?>


		/* Standard Top Padding */
		<?php if ( $factorycommercegurus_padding_above_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header {
					height: <?php echo esc_attr( $header_top_padding_height ); ?>px;
					padding-top: <?php echo esc_attr( $factorycommercegurus_padding_above_logo ); ?>px;
				}

			}

		<?php } ?>

		/* Sticky Top Padding */
		<?php if ( $factorycommercegurus_padding_above_sticky_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller {
					height: <?php echo esc_attr( $sticky_header_top_padding_height ); ?>px;
					padding-top: <?php echo esc_attr( $factorycommercegurus_padding_above_sticky_logo ); ?>px;
				}
			}

		<?php } ?>

		/* Standard Bottom Padding */
		<?php if ( $factorycommercegurus_padding_below_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header,
				.cg-menu-below {
					height: <?php echo esc_attr( $header_total_height ); ?>px;
				}

				.cg-transparent-header .cg-primary-menu .menu > li > a {
					padding-bottom: <?php echo esc_attr( $factorycommercegurus_padding_below_logo ); ?>px;
				}
			}

		<?php } ?>

		/* Sticky Bottom Padding */
		<?php if ( $factorycommercegurus_padding_below_sticky_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller {
					height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.cg-transparent-header.scroller .cg-primary-menu .menu > li > a {
					padding-bottom: <?php echo esc_attr( $factorycommercegurus_padding_below_sticky_logo ); ?>px;
				}
			}

		<?php } ?>

		/* Dynamic Logo Width */
		<?php if ( $factorycommercegurus_dynamic_logo_width ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-menu-below .leftnav.dynamic-logo-width {
					width: <?php echo esc_attr( $factorycommercegurus_dynamic_logo_width ); ?>%;
				}

				.rightnav {
					width: <?php echo esc_attr( $factorycommercegurus_dynamic_widget_area_width ); ?>%;
				}

			}

				.cg-menu-below .leftnav.text-logo {
				  min-height: auto;
				  padding-bottom: inherit;
				}

		<?php } ?>

		/* Heading Top Margin */
		<?php if ( $factorycommercegurus_page_heading_top_margin ) { ?>

				.header-wrapper {
					padding-top: <?php echo esc_attr( $factorycommercegurus_page_heading_top_margin ); ?>px;
				}

		<?php } ?>

		/* Heading Bottom Margin */
		<?php if ( $factorycommercegurus_page_heading_bottom_margin ) { ?>

				.header-wrapper {
					padding-bottom: <?php echo esc_attr( $factorycommercegurus_page_heading_bottom_margin ); ?>px;
				}

		<?php } ?>

		<?php if ( $factorycommercegurus_mobile_header_height ) { ?>

			@media only screen and (max-width: 1100px) {

				.cg-wp-menu-wrapper .activate-mobile-search {
					line-height: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
				}

				.cg-menu-below .leftnav.text-logo {
					height: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
					line-height: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
				}

				.mean-container a.meanmenu-reveal {
					height: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
				}

				.cg-menu-below .logo a {
					line-height: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
				}

				.mean-container .mean-nav {
					margin-top: <?php echo esc_attr( $factorycommercegurus_mobile_header_height ); ?>px;
				}
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_mobile_logo_height ) { ?>

			@media only screen and (max-width: 1100px) {
				.logo img, .cg-menu-below .logo img {
					max-height: <?php echo esc_attr( $factorycommercegurus_mobile_logo_height ); ?>px;
				}
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_first_footer_bg ) { ?>
			.first-footer

			{
				background-color: <?php echo esc_attr( $factorycommercegurus_first_footer_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_second_footer_bg ) { ?>
			.second-footer

			{
				background-color: <?php echo esc_attr( $factorycommercegurus_second_footer_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_first_footer_text ) { ?>
			.first-footer, .first-footer h4.widget-title, .first-footer a:hover, .first-footer li  

			{
				color: <?php echo esc_attr( $factorycommercegurus_first_footer_text ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_first_footer_link ) { ?>
			.first-footer a  

			{
				color: <?php echo esc_attr( $factorycommercegurus_first_footer_link ); ?>; 
			}

		<?php } ?>

		<?php if ( $factorycommercegurus_second_footer_text ) { ?>

			.second-footer, .second-footer h4.widget-title, .second-footer a, .second-footer a:hover, .second-footer li  

			{
				color: <?php echo esc_attr( $factorycommercegurus_second_footer_text ); ?>; 
			}

		<?php } ?>


		<?php
		if ( $factorycommercegurus_custom_css ) {
			echo esc_attr( $factorycommercegurus_custom_css );
		}
		?>

	</style>

	<?php
}

function factorycommercegurus_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r	 = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g	 = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b	 = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r	 = hexdec( substr( $hex, 0, 2 ) );
		$g	 = hexdec( substr( $hex, 2, 2 ) );
		$b	 = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	return implode( ",", $rgb ); // returns the rgb values separated by commas
}

add_action( 'wp_head', 'factorycommercegurus_custom_css', 100 );
