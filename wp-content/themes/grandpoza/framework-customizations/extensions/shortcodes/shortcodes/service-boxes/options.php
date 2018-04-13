<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$service_categories = array( "0" => esc_html( "All" , "grandpoza" ) );

$_service_categories =  get_terms( array(
            'taxonomy' => 'service_category',
            'hide_empty' => false
        ) );

foreach( $_service_categories as $category)
{
    $service_categories[$category->term_id] = $category->name;
}

$options = array(
    'style'=> array(
		'type'      => 'select',
		'label'     => esc_html__( 'Display style', 'grandpoza'  ),
        'choices'   => array( esc_html__( "Style 1" , 'grandpoza' ) , esc_html__( "Style 2" , "grandpoza" ) , esc_html__( "Style 3" , "grandpoza" ) ),
	),
	'posts_count'       => array(
		'type'  => 'text',
		'label' => esc_html__( 'Number of posts to show', 'grandpoza'  )
	),
	'category'    => array(
		'type'      => 'select',
		'label'     => esc_html__( 'Category', 'grandpoza'  ),
		'desc'      => esc_html__( 'Category from which to pull the services posts', 'grandpoza'  ),
        'choices'   => $service_categories
	)

    );
