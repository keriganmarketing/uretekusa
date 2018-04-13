<?php

require_once get_template_directory() . '/classes/menu/nav-menu.php';

function fabrique_nav_menu_args( $args )
{
	$defaults = array(
		'navbar_style' => false,
		'menu_position' => 'top',
		'mobile' => false,
		'search_on' => false,
		'cart_on' => false
	);

	$args = array_merge( $defaults, $args );
	$args['container'] = false;
	$args['fallback_cb'] = false;
	$args['walker'] = new Fabrique_Nav_Menu();

	if ( $args['navbar_style'] ) {
		if ( 'inline' === $args['navbar_style'] ) {
			$args['menu_class'] = 'fbq-' . $args['menu_position'] . 'nav-menu fbq-nav-menu fbq-menu fbq-menu-inline-left';

			if ( !empty( $args['menu'] ) ) {
				$menu = wp_get_nav_menu_object( $args['menu'] );
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
			} else {
				$theme_locations = get_nav_menu_locations();
				$menu = wp_get_nav_menu_object( $theme_locations['fbq-primary-menu'] );
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
			}

			$new_menu = array();
			foreach ( $menu_items as $menu_item ) {
				if ( $menu_item->menu_item_parent != 0 ) continue;
				array_push( $new_menu, $menu_item );
			}

			$menu_numbers = count( $new_menu );

			if ( $menu_numbers > 1 ) {
				$breakpoint = ( $args['search_on'] && $args['cart_on'] ) ? ceil( $menu_numbers / 2 ) + 1 : ceil( $menu_numbers / 2 );
				$args['breakpoint_id'] = $new_menu[$breakpoint]->ID;
			}
		} else {
			$args['menu_class'] .= ' fbq-' . $args['menu_position'] . 'nav-menu fbq-nav-menu fbq-menu';
		}
	} else {
		$args['menu_class'] .= ' fbq-menu';
	}

	return $args;
}
add_filter( 'wp_nav_menu_args', 'fabrique_nav_menu_args', 9 );


function fabrique_nav_menu_items( $output, $args )
{
	if ( 'split' !== $args->navbar_style ) {
		if ( $args->search_on ) {
			$output .= fabrique_template_menu_search( true, $args->menu_position );
		}

		if ( $args->cart_on ) {
			$output .= fabrique_template_menu_cart( true, $args->menu_position );
		}
	}

	return $output;
}
add_filter( 'wp_nav_menu_items', 'fabrique_nav_menu_items', 9, 2 );


function fabrique_nav_menu_add_attribute( $attr, $item, $args )
{
	$attr['itemprop'] = 'url';

	return $attr;
}
add_filter( 'nav_menu_link_attributes', 'fabrique_nav_menu_add_attribute', 10, 3 );
