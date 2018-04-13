<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
      }

$portfolio_categories = array( "0" =>  esc_html__( "All" , "grandpoza") );

$grandpoza_portfolio_categories =  get_terms( array(
            'taxonomy' => 'project_category',
            'hide_empty' => false
        ) );

foreach( FW_Shortcode_Portfolio::get_categories() as $cat)
{
    $portfolio_categories[$cat->term_id] = $cat->name;
}

$options = array(
    'style'=> array(
        'label'=> esc_html__('Style', 'grandpoza'),
        'type'=>'select',
        'choices'=> array(
            esc_html__( 'Style 1', 'grandpoza'  ),
            esc_html__( 'Style 2', 'grandpoza'  ),
            esc_html__( 'Style 3', 'grandpoza'  ),
            esc_html__( 'Style 4', 'grandpoza'  ),
            esc_html__( 'Style 5', 'grandpoza'  )
            ),
        'value' => 0,
    ),
    'posts_count'       => array(
        'type' => 'text',
        'label' => esc_html__( 'Number of items to show', 'grandpoza'  )
    ),
    'category'    => array(
        'type'  => 'select',
        'label' => esc_html__( 'Category', 'grandpoza'  ),
        'desc'  => esc_html__( 'Category from which to pull the posts', 'grandpoza'  ),
        'choices'=> $portfolio_categories
    )

);
