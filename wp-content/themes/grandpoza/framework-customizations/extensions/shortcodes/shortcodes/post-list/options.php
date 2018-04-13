<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$post_categories = array( "0" => "All" );

foreach(get_categories() as $cat)
{
    $post_categories[$cat->cat_ID] = $cat->cat_name;
}

$options = array(
	'posts_count'       => array(
		'type' => 'text',
		'label' => esc_html__( 'Number of posts to show', 'grandpoza'  )
	),
	'category'    => array(
		'type'      => 'select',
		'label'     => esc_html__( 'Category', 'grandpoza'  ),
		'desc'      => esc_html__( 'Category from which to pull the posts', 'grandpoza'  ),
        'choices'   => $post_categories
	)

);
