<?php

class Fabrique_Nav_Menu extends Walker_Nav_Menu
{
	public function start_lvl( &$output, $depth = 0, $args = array() )
	{
		if ( is_array( $args ) ) {
			return;
		}

		if ( $depth === 0 && $this->mega_menu_item ) {
			$output .= '<div class="' . esc_attr( $this->mega_menu_class() ) . '">';
			if ( $this->is_top_nav ) {
				$output .= '<div class="fbq-mega-menu-bg fbq-s-bg-bg" ' . fabrique_escape_content( $this->submenu_bg_style ) . '></div>';
			}
			$output .= '<div class="fbq-mega-menu-inner"><ul>';
		} else {
			$class = ' class="' . esc_attr( $this->submenu_class() ) . '"';
			$output .= '<ul' . fabrique_escape_content( $class . $this->submenu_bg_style ) . '>';
		}
	}

	public function end_lvl( &$output, $depth = 0, $args = array() )
	{
		if ( $depth === 0 && $this->mega_menu_item ) {
			$output .= '</ul></div></div>';
		} else {
			$output .= '</ul>';
		}
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		if ( is_array( $args ) ) {
			return;
		}

		$this->is_top_nav = ( !$args->mobile && $args->navbar_style && 'top' === $args->menu_position ) ? true : false;
		$this->submenu_bg_style = !empty( $item->nav_menu_sub_background ) && $this->is_top_nav ? ' style="background-image:url(\'' . $item->nav_menu_sub_background . '\');"' : ''; // background image for mega menu and sub menu
		$mega_menu_bp = $item->nav_menu_mega_blueprint;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
		$classes[] = 'menu-item-' . esc_attr( $item->ID );

		if ( $depth === 0 && (int)$item->nav_menu_mega_columns > 0 ) {
			$this->mega_menu_item = $item;
			$classes[] = 'menu-item-mega-menu';
		} else if ( $depth === 0 ) {
			if ( !empty( $mega_menu_bp ) ) {
				$classes[] = 'menu-item-mega-menu';
			}
			$this->mega_menu_item = null;
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . esc_attr( $item->ID ), $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$item_output = '';

		if ( isset( $args->breakpoint_id ) && $args->breakpoint_id == $item->ID ) {
			$output .= '</ul></div><div class="fbq-navbar-body-inner"><ul class="fbq-topnav-menu fbq-nav-menu fbq-menu fbq-menu-inline-right">';
		}

		if ( $depth === 1 && $this->mega_menu_item ) {
			$columns = $this->mega_menu_item->nav_menu_mega_columns;
			$column_class = ' fbq-mega-menu-column';
			$column_class .= ( 5 == $columns ) ? ' fbq-col-1-5' : ' fbq-col-' . 12 / $columns;
			$class_names = ( $class_names ) ? ' class="' . esc_attr( $class_names . $column_class . ' fbq-p-border-border' ) . '"' : '';
			$output .= '<li itemprop="name" ' . fabrique_escape_content( $id . $class_names ) . '>';

			$attributes = $this->get_menu_attribute( $item, $args );
			if ( !empty( $item->nav_menu_sub_sidebar ) ) {
				ob_start();
				dynamic_sidebar( $item->nav_menu_sub_sidebar );
				$item_output .= '<ul class="fbq-mega-menu-item menu-item-has-children fbq-widgets">';
				$item_output .= ob_get_clean();
			} else {
				$item_output .= '<div class="fbq-mega-menu-item menu-item-has-children">';
				$item_output .= '<div class="fbq-mega-menu-title">';
				$item_output .= 	$this->render_menu_item( $item, $attributes, $args );
				$item_output .= '</div>';
			}
		} else {
			if ( !empty( $item->nav_menu_sub_sidebar ) ) {
				ob_start();
				dynamic_sidebar( $item->nav_menu_sub_sidebar );
				$output .= ob_get_clean();
			} else {
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
				$output .= '<li itemprop="name" ' . fabrique_escape_content( $id . $class_names ) . '>';
				$attributes = $this->get_menu_attribute( $item, $args );
				$item_output .= $this->render_menu_item( $item, $attributes, $args );

				// blueprintblock in mega menu
				if ( $depth === 0 && !empty( $mega_menu_bp ) ) {
					$class = ' class="' . esc_attr( $this->mega_menu_class() ) . '"';
					$item_output .= '<div class="' . esc_attr( $this->mega_menu_class() ) . '">';

					if ( $this->is_top_nav ) {
						$item_output .= '<div class="fbq-mega-menu-bg fbq-s-bg-bg" ' . fabrique_escape_content( $this->submenu_bg_style ) . '></div>';
					}

					$item_output .= '<div class="fbq-mega-menu-inner">';
					ob_start();
					fabrique_template_item( array(
						'type' => 'blueprintblock',
						'blueprintblock_id' => $mega_menu_bp
					) );
					$item_output .= ob_get_clean();
					$item_output .= '</div></div>';
				}
			}
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $item, $depth=0, $args=array() )
	{
		if ( $depth === 1 && $this->mega_menu_item ) {
			$output .= empty( $item->nav_menu_sub_sidebar ) ? '</div></li>' : '</ul></li>';
		} elseif ( empty( $item->nav_menu_sub_sidebar ) ) {
			$output .= '</li>';
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output )
	{
		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		if ( !empty( $children_elements[$element->$id_field] ) ) {
			$element->is_parent = true;
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	protected function submenu_class()
	{
		return 'sub-menu fbq-s-bg-bg';
	}

	protected function mega_menu_class()
	{
		return 'fbq-mega-menu';
	}

	protected function get_menu_attribute( $item, $args )
	{
		$link_attributes = array();
		$link_attributes['title'] = ( !empty( $item->attr_title ) ) ? $item->attr_title : '';
		$link_attributes['target'] = ( !empty( $item->target ) ) ? $item->target : '';
		$link_attributes['rel'] = ( !empty( $item->xfn ) ) ? $item->xfn : '';
		$link_attributes['href'] = ( !empty( $item->url ) ) ? $item->url : '';
		$link_attributes = apply_filters( 'nav_menu_link_attributes', $link_attributes, $item, $args );

		$attributes = array();
		foreach ( $link_attributes as $key => $value ) {
			if ( !empty( $value ) ) {
				if ( 'href' === $key ) {
					$attributes[] = esc_attr( $key ) . '="' . fabrique_escape_url( $value ) . '"';
				} else {
					$attributes[] = esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
				}
			}
		}

		return $attributes;
	}

	protected function render_menu_item( $menu_item, $attributes, $args )
	{
		$menu_title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

		$output = $args->before;

		if ( !empty( $menu_item->nav_menu_icon ) ) {
			$output .= '<a ' . implode( ' ', $attributes ) . '>';
			$icon = $menu_item->nav_menu_icon;
			if ( empty( $menu_title ) ) {
				$output .= '<i class="twf twf-' . esc_attr( $icon ) . ' fbq-menu-icon"></i>';
			} elseif ( 'before' === $menu_item->nav_menu_icon_position ) {
				$output .= '<i class="twf twf-' . esc_attr( $icon ) . ' fbq-menu-icon fbq-menu-icon--before"></i>' . fabrique_escape_content( $args->link_before . $menu_title . $args->link_after );
			} else {
				$output .= fabrique_escape_content( $args->link_before . $menu_title . $args->link_after ) . '<i class="twf twf-' . esc_attr( $icon ) . ' fbq-menu-icon fbq-menu-icon--after"></i>';
			}
			$output .= '</a>';
		} elseif ( !empty( $menu_title ) ) {
			$output .= '<a ' . implode( ' ', $attributes ) . '>';
			$output .= fabrique_escape_content( $args->link_before . $menu_title . $args->link_after );
			$output .= '</a>';
		}

		$output .= fabrique_escape_content( $args->after );

		return $output;
	}

	protected function get_parent_menu_item( $menu_item )
	{
		if ( !empty( $menu_item->menu_item_parent ) ) {
			return get_post( $menu_item->menu_item_parent );
		} else {
			return null;
		}
	}
}
