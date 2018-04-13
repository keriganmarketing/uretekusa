<?php

/**
 * @see /wp-admin/includes/nav-menu.php
 */
class Fabrique_Nav_Menu_Edit extends Walker_Nav_Menu
{
	/**
	 *
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 * @version 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @version 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @version 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		global $_wp_nav_menu_max_depth;

		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';

		if ( 'taxonomy' === $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
		if ( is_wp_error( $original_title ) )
			$original_title = false;
		} elseif ( 'post_type' === $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$menu_item_edit_class = ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive';

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . $menu_item_edit_class,
		);

		$title = $item->title;

		if ( !empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			$title = sprintf( '%s' . esc_html__( '(Invalid)', 'fabrique-core' ), esc_attr( $item->title ) );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			$title = sprintf( '%s' . esc_html__( '(Pending)', 'fabrique-core' ), esc_attr( $item->title ) );
		}

		$title = ( !isset( $item->label ) || empty( $item->label ) ) ? $title : $item->label;

		$submenu_text = '';

		if ( 0 == $depth ) {
			$submenu_text = 'style="display: none;"';
		}

		?>
		<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title">
						<span class="menu-item-title">
							<?php echo esc_html( $title ); ?>
						</span>
						<span class="is-submenu" <?php echo fabrique_core_escape_content( $submenu_text ); ?>>
							<?php esc_html_e( 'sub item', 'fabrique-core' ); ?>
						</span>
					</span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'fabrique-core' ); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'fabrique-core' ); ?>">&#8595;</abbr></a>
						</span>
						<?php
							$item_edit_attr = 'class="item-edit"';
							$item_edit_attr .= ' id="edit-' . esc_attr( $item_id ) . '"';
							$item_edit_attr .= ' title="' . esc_attr__( 'Edit Menu Item', 'fabrique-core' ) . '"';
							if ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) {
								$item_edit_attr_url = admin_url( 'nav-menus.php' );
							} else {
								$item_edit_attr_url = add_query_arg(
									'edit-menu-item',
									$item_id,
									remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) )
								);
							}
							$item_edit_attr .= ' href="' . esc_url( $item_edit_attr_url ) . '"'
						?>
						<a <?php echo fabrique_core_escape_content( $item_edit_attr ) ; ?>>
							<?php esc_html_e( 'Edit', 'fabrique-core' ); ?>
						</a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'URL', 'fabrique-core' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Navigation Label', 'fabrique-core' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Title Attribute', 'fabrique-core' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
			<!-- Theme Fields -->
			<?php echo fabrique_core_escape_content( $this->fabrique_fields( $item, $item_id ) ); ?>
			<!-- Theme Fields End -->
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'fabrique-core' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'fabrique-core' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'fabrique-core' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Description', 'fabrique-core' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]">
							<?php echo esc_html( $item->description ); // textarea_escaped ?>
						</textarea>
						<span class="description">
							<?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'fabrique-core' ); ?>
						</span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move', 'fabrique-core' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'fabrique-core' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'fabrique-core' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'fabrique-core' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' !== $item->type && false !== $original_title ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__( 'Original:', 'fabrique-core' ) . ' %s', '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						);
					?>">
						<?php esc_html_e( 'Remove', 'fabrique-core' ); ?></a>
						<span class="meta-sep hide-if-no-js"> | </span>
						<a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) ); ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Cancel', 'fabrique-core' ); ?>
					</a>
					<div class="clear"></div>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
	}

	protected function fabrique_fields( $item, $item_id )
	{
		$output  = '<div class="description description-wide">';
		$output .= 	'<label for="nav_menu_icon_' . esc_attr( $item_id ) . '">';
		$output .= 		esc_html__( 'Menu Icon', 'fabrique-core' ) . '<br />';
		$output .= 		'<div class="js-general-icon-chooser bp-input-group bp-icon-chooser" data-input-name="nav_menu_icon[' . esc_attr( $item_id ) . ']" data-value="' . esc_attr( $item->nav_menu_icon ) . '"></div>';
		$output .= 	'</label>';
		$output .= '</div>';

		$output .= '<p class="description">';
		$output .= 	'<label for="nav_menu_icon_position_' . esc_attr( $item_id ) . '">';
		$output .= 		esc_html__( 'Menu Icon Position', 'fabrique-core' ) . '<br />';
		$output .= 		'<select id="nav_menu_icon_position_' . esc_attr( $item_id ) . '" name="nav_menu_icon_position[' . esc_attr( $item_id ) . ']">';
		$output .=   		'<option value="before" ' . selected( $item->nav_menu_icon_position, 'before', false ) . '>' . esc_html__( 'Before', 'fabrique-core' ) . '</option>';
		$output .=   		'<option value="after" ' . selected( $item->nav_menu_icon_position, 'after', false ) . '>' . esc_html__( 'After', 'fabrique-core' ) . '</option>';
		$output .= 		'</select>';
		$output .= 	'</label>';
		$output .= '</p>';

		// Mega Menu blueprint
		$bp_args_loop = new WP_Query( array(
			'post_type' => 'twcbp_block',
			'posts_per_page' => -1
		) );
		if ( !empty( $bp_args_loop->posts ) ) {
			$output .= '<p class="description description-wide">';
			$output .= 	'<label for="nav_menu_mega_blueprint_' . esc_attr( $item_id ) . '">';
			$output .= 		esc_html__( 'Mega Menu Blueprint block', 'fabrique-core' ) . '<br />';
			$output .= 		esc_html__( '(mega menu column will no longer work when blueprint is selected)', 'fabrique-core' ) . '<br />';
			$output .= 		'<select id="nav_menu_mega_blueprint_' . esc_attr( $item_id ) . '" name="nav_menu_mega_blueprint['. esc_attr( $item_id ) .']">';
			$output .=			'<option value="" '. selected( esc_attr( $item->nav_menu_sub_sidebar ), '', false ) .'>' . esc_html__( '--select blueprint--', 'fabrique-core' ) . '</option>';

			foreach ( $bp_args_loop->posts as $bp_block ) {
				$output .= 		'<option value="'. esc_attr( $bp_block->ID ) .'" '. selected( esc_attr( $item->nav_menu_mega_blueprint ), $bp_block->ID, false ) .'>';
				$output .=    		esc_html( $bp_block->post_title );
				$output .= 		'</option>';
			}

			$output .= 		'</select>';
			$output .= 	'</label>';
			$output .= '</p>';
		}

		// Mega Menu Columns
		$output .= '<p class="description">';
		$output .= 	'<label for="nav_menu_mega_columns_' . esc_attr( $item_id ) . '">';
		$output .= 		esc_html__( 'Mega Menu Columns', 'fabrique-core' ) . '<br />';
		$output .= 		'<select id="nav_menu_mega_columns_' . esc_attr( $item_id ) .'" name="nav_menu_mega_columns[' . esc_attr( $item_id ) . ']">';
		$output .= 			'<option value="0" ' . selected( $item->nav_menu_mega_columns, '0', false ) .'>' . esc_html__( 'None', 'fabrique-core' ) . '</option>';
		$output .= 			'<option value="1" ' . selected( $item->nav_menu_mega_columns, '1', false ) .'>1</option>';
		$output .= 			'<option value="2" ' . selected( $item->nav_menu_mega_columns, '2', false ) .'>2</option>';
		$output .= 			'<option value="3" ' . selected( $item->nav_menu_mega_columns, '3', false ) .'>3</option>';
		$output .= 			'<option value="4" ' . selected( $item->nav_menu_mega_columns, '4', false ) .'>4</option>';
		$output .= 			'<option value="5" ' . selected( $item->nav_menu_mega_columns, '5', false ) .'>5</option>';
		$output .= 			'<option value="6" ' . selected( $item->nav_menu_mega_columns, '6', false ) .'>6</option>';
		$output .= 		'</select>';
		$output .= 	'</label>';
		$output .= '</p>';

		// Mega Menu or Sub Menu Background image
		$output .= '<div class="description description-wide">';
		$output .=  esc_html__( 'Mega Menu/Sub Menu Background Image', 'fabrique-core' ) . '<br />';
		$output .= 	'<label for="nav_menu_sub_background_' . esc_attr( $item_id ) . '">';
		$output .=    '<div class="bp-input-group js-media-control">';
		$output .=      '<input type="text" name="nav_menu_sub_background[' . esc_attr( $item_id ) . ']" class="js-media-input bp-input" value="' . esc_attr( $item->nav_menu_sub_background ) . '" />';
		$output .=      '<span class="js-media-library bp-input-group-addon" data-media-type="image">Choose</span>';
		$output .=    '</div>';
		$output .= 	'</label>';
		$output .= '</div>';

		// Mega Menu or Sub Menu widget
		global $wp_registered_sidebars;
		$output .= '<p class="description description-wide">';
		$output .= 	'<label for="nav_menu_sub_sidebar_' . esc_attr( $item_id ) . '">';
		$output .= 		esc_html__( 'Mega Menu/Sub Menu Widgets', 'fabrique-core' ) . '<br />';
		$output .= 		'<select id="nav_menu_sub_sidebar_' . esc_attr( $item_id ) . '" name="nav_menu_sub_sidebar['. esc_attr( $item_id ) .']">';
		$output .=			'<option value="" '. selected( esc_attr( $item->nav_menu_sub_sidebar ), '', false ) .'>' . esc_html__( '--select sidebar--', 'fabrique-core' ) . '</option>';

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$output .= 		'<option value="'. esc_attr( $sidebar['id'] ) .'" '. selected( esc_attr( $item->nav_menu_sub_sidebar ), $sidebar['id'], false ) .'>';
			$output .=    		esc_html( $sidebar['name'] );
			$output .= 		'</option>';
		}

		$output .= 		'</select>';
		$output .= 	'</label>';
		$output .= '</p>';

		return $output;
	}
}
