<?php

class Fabrique_Project_Module extends Fabrique_Base_Module
{
	const API_FABRIQUE_PROJECT_CATEGORIES = 'project/project-categories';

	public function get_name()
	{
		return 'project';
	}

	public function start()
	{
		// Register "fbq_project" post type and related taxonomy
		add_action( 'init', array( $this, 'register_new_post_type' ) );

		add_action( 'pre_get_posts', array( $this, 'project_per_page' ), 9 );

		// Add Taxonomy of this post type to blueprint
		add_filter( 'blueprint_options', array( $this, 'add_taxonomy_to_blueprint' ), 9 );

		// Register blueprint for this post type
		add_filter( 'support_blueprint_post_types', array( $this, 'include_project_post_type' ), 9 );

		// Add rating to comment
		add_filter( 'support_rating_post_types', array( $this, 'include_project_post_type' ) );

		// Add comment like/dislike
		add_filter( 'support_comment_like_dislike_post_types', array( $this, 'include_project_post_type' ) );
	}

	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_FABRIQUE_PROJECT_CATEGORIES:
				return $this->get_project_categories();
			default:
				return false;
		}
	}

	public function get_project_categories()
	{
		return get_terms( 'fbq_project_category', array(
			'hide_empty' => false
		) );
	}

	public function register_new_post_type()
	{
		$input_slug = get_theme_mod( 'project_slug' );

		if ( !empty( $input_slug ) ) {
			$project_label = apply_filters( 'fabrique_project_label', ucfirst( $input_slug ) );
			$project_slug = str_replace( ' ', '', $input_slug );
			$project_slug = strtolower( $project_slug );
			$project_category_slug = $project_slug . '_category';
			$project_tag_slug = $project_slug . '_tag';
		} else {
			$project_label = apply_filters( 'fabrique_project_label', _x( 'Project', 'project post type name' , 'fabrique-core' ) );
			$project_slug = 'project';
			$project_category_slug = 'project_category';
			$project_tag_slug = 'project_tag';
		}

		register_post_type( 'fbq_project', array(
			'labels' => array(
				'name' => $project_label,
				'add_new_item' => sprintf( __( 'Add New %s', 'fabrique-core' ), $project_label ),
				'edit_item' => sprintf( __( 'Edit %s', 'fabrique-core' ), $project_label ),
				'new_item' => sprintf( __( 'New %s', 'fabrique-core' ), $project_label ),
				'view_item' => sprintf( __( 'View %s', 'fabrique-core' ), $project_label ),
				'all_items' => sprintf( __( 'All %ss', 'fabrique-core' ), $project_label ),
				'archives' => sprintf( __( '% Archives', 'fabrique-core' ), $project_label )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => $project_slug
			),
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'page-attributes',
				'custom-fields'
			),
			'menu_icon' => 'dashicons-portfolio'
		) );

		register_taxonomy( 'fbq_project_category', 'fbq_project', array(
			'labels' => array(
				'name' => sprintf( __( '%s Categories', 'fabrique-core' ), $project_label ),
				'singular_name' => sprintf( __( '%s Categories', 'fabrique-core' ), $project_label ),
			),
			'rewrite' => array(
				'slug' => $project_category_slug
			),
			'show_admin_column' => true,
			'hierarchical' => true
		) );

		register_taxonomy( 'fbq_project_tag', 'fbq_project', array(
			'labels' => array(
				'name' => sprintf( __( '%s Tags', 'fabrique-core' ), $project_label ),
				'singular_name' => sprintf( __( '%s Tags', 'fabrique-core' ), $project_label ),
			),
			'rewrite' => array(
				'slug' => $project_tag_slug
			),
			'show_admin_column' => true,
			'hierarchical' => false
		) );
	}

	public function project_per_page( $query )
	{
		if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'fbq_project' ) ) {
			$query->set( 'posts_per_page', get_theme_mod( 'project_items' ) );
		}
	}

	public function add_taxonomy_to_blueprint( $opts )
	{
		$opts['project_categories'] = get_terms( 'fbq_project_category', array( 'hide_empty' => false) );
		return $opts;
	}

	public function include_project_post_type( $post_types )
	{
		$post_types[] = 'fbq_project';

		return $post_types;
	}
}
