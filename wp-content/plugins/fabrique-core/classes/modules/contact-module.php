<?php

class Fabrique_Contact_Module extends Fabrique_Base_Module
{
	public function get_name()
	{
		return 'contact';
	}


	public function start()
	{
		// Register "fbq_contact" post type and related taxonomy
		add_action( 'init', array( $this, 'register_new_post_type' ) );

		// Add extra fields to fbq_contact post type
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'meta_box_save' ) );

		// Add columns to fbq_contact post admin page
		add_filter( 'manage_edit-fbq_contact_columns', array( $this, 'columns_head' ) );
		add_filter( 'manage_edit-fbq_contact_sortable_columns', array( $this, 'sortable_column' ) );
		add_action( 'manage_fbq_contact_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
	}


	public function register_new_post_type()
	{
		$fbq_contact_slug = apply_filters( 'fbq_contact_slug', 'fbq_contact' );
		$fbq_contact_label = apply_filters( 'fbq_contact_label', _x( 'Contact Info', 'label for contact post type', 'fabrique-core' ) );

		// Register Post type "fbq_contact"
		register_post_type( 'fbq_contact', array(
			'labels' => array(
				'name' => $fbq_contact_label,
				'add_new_item' => sprintf( __( 'Add New %s', 'fabrique-core' ), $fbq_contact_label ),
				'edit_item' => sprintf( __( 'Edit %s', 'fabrique-core' ), $fbq_contact_label ),
				'new_item' => sprintf( __( 'New %s', 'fabrique-core' ), $fbq_contact_label ),
				'view_item' => sprintf( __( 'View %s', 'fabrique-core' ), $fbq_contact_label ),
				'all_items' => sprintf( __( 'All %ss', 'fabrique-core' ), $fbq_contact_label ),
				'archives' => sprintf( __( '%s Archives', 'fabrique-core' ), $fbq_contact_label )
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_admin_bar' => false,
			'show_in_nav_fbq_menus' => false,
			'publicly_queryable' => false,
			'query_var' => false,
			'has_archive' => false,
			'rewrite' => array(
				'slug' => $fbq_contact_slug
			),
			'supports' => array(
				'title',
				'thumbnail',
				'custom-fields',
				'page-attributes',
				'publicize',
				'wpcom-markdown'
			),
			'menu_icon' => 'dashicons-phone'
		) );
	}


	public function add_meta_box()
	{
		add_meta_box( 'fbq_contact-extra-field', esc_html__( 'Contact Fields', 'fabrique-core' ), array( $this, 'extra_meta_box' ), 'fbq_contact', 'advanced', 'high' );
	}


	public function extra_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		$name = isset( $values['fbq_contact_name'] ) ? $values['fbq_contact_name'][0] : '';
		$address = isset( $values['fbq_contact_address'] ) ? $values['fbq_contact_address'][0] : '';
		$hours = isset( $values['fbq_contact_hours'] ) ? $values['fbq_contact_hours'][0] : '';
		$phone = isset( $values['fbq_contact_phone'] ) ? $values['fbq_contact_phone'][0] : '';
		$email = isset( $values['fbq_contact_email'] ) ? $values['fbq_contact_email'][0] : '';
		$website = isset( $values['fbq_contact_website'] ) ? $values['fbq_contact_website'][0] : '';

		wp_nonce_field( 'fbq_contact_meta_box_nonce', 'fbq_contact_nonce' );
		?>
		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_name"><?php esc_html_e( 'Name', 'fabrique-core' ); ?></label>
			<input style="display:inline-block;width:60%;" type="text" name="fbq_contact_name" id="fbq_contact_name"  value="<?php echo esc_attr( $name ); ?>" />
		</p>

		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_address"><?php esc_html_e( 'Address', 'fabrique-core' ); ?></label>
			<textarea style='display:inline-block;width:60%;min-height:100px;' name="fbq_contact_address" id="fbq_contact_address" /><?php echo fabrique_core_escape_content( $address ); ?></textarea>
		</p>

		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_hours"><?php esc_html_e( 'Opening Hours', 'fabrique-core' ); ?></label>
			<textarea style='display:inline-block;width:60%;min-height:100px;' name="fbq_contact_hours" id="fbq_contact_hours" /><?php echo fabrique_core_escape_content( $hours ); ?></textarea>
		</p>

		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_phone"><?php esc_html_e( 'Phone', 'fabrique-core' ); ?></label>
			<input style="display:inline-block;width:60%;" type="text" name="fbq_contact_phone" id="fbq_contact_phone"  value="<?php echo esc_attr( $phone ); ?>" />
		</p>

		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_email"><?php esc_html_e( 'Email', 'fabrique-core' ); ?></label>
			<input style="display:inline-block;width:60%;" type="text" name="fbq_contact_email" id="fbq_contact_email"  value="<?php echo esc_attr( $email ); ?>" />
		</p>

		<p>
			<label style="display:inline-block;width:25%;vertical-align:top;" for="fbq_contact_website"><?php esc_html_e( 'Website', 'fabrique-core' ); ?></label>
			<input style="display:inline-block;width:60%;" type="text" name="fbq_contact_website" id="fbq_contact_website"  value="<?php echo esc_attr( $website ); ?>" />
		</p>
		<?php
	}


	public function meta_box_save( $post_id )
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( !isset( $_POST['fbq_contact_nonce'] ) || !wp_verify_nonce( $_POST['fbq_contact_nonce'], 'fbq_contact_meta_box_nonce' ) ) return;
		if ( !current_user_can( 'edit_post' ) ) return;


		if ( isset( $_POST['fbq_contact_name'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_name', esc_attr( $_POST['fbq_contact_name'] ) );
		}

		if ( isset( $_POST['fbq_contact_address'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_address', htmlspecialchars( $_POST['fbq_contact_address'] ) );
		}

		if ( isset( $_POST['fbq_contact_hours'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_hours', htmlspecialchars( $_POST['fbq_contact_hours'] ) );
		}

		if ( isset( $_POST['fbq_contact_phone'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_phone', esc_attr( $_POST['fbq_contact_phone'] ) );
		}

		if ( isset( $_POST['fbq_contact_email'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_email', esc_attr( $_POST['fbq_contact_email'] ) );
		}

		if ( isset( $_POST['fbq_contact_website'] ) ) {
			update_post_meta( $post_id, 'fbq_contact_website', esc_attr( $_POST['fbq_contact_website'] ) );
		}
	}


	public function columns_head( $columns )
	{
		unset($columns['date']);
		$columns['name'] = esc_html__( 'Name', 'fabrique-core' );
		$columns['address'] = esc_html__( 'Address', 'fabrique-core' );
		$columns['hours'] = esc_html__( 'Opening Hours', 'fabrique-core' );
		$columns['phone'] = esc_html__( 'Phone', 'fabrique-core' );
		$columns['email'] = esc_html__( 'Email', 'fabrique-core' );

		return $columns;
	}


	public function columns_content( $column_name, $post_id )
	{
		$columns = array(
			'name',
			'address',
			'hours',
			'phone',
			'email'
		);

		foreach ( $columns as $column ) {
			if ( $column === $column_name ) {
				echo get_post_meta( $post_id, 'fbq_contact_' . $column_name, true );
			}
		}
	}


	public function sortable_column( $columns ) {
		$columns['name'] = 'meta_value';
		$columns['hours'] = 'meta_value';

		return $columns;
	}
}
