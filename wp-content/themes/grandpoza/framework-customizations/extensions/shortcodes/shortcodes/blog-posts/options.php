<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $blog_post_categories = array( "0" => esc_html__( "All" , "grandpoza" ) );

      foreach(get_categories() as $cat)
      {
          $blog_post_categories[$cat->cat_ID] = $cat->cat_name;
      }

      $options = array(
          'posts_count' => array(
              'type'  => 'text',
              'label' => esc_html__( 'Number of posts to show', 'grandpoza'  )
          ),
          'category'  => array(
              'type'      => 'select',
              'label'     => esc_html__( 'Category', 'grandpoza'  ),
              'desc'      => esc_html__( 'Category from which to pull the posts', 'grandpoza'  ),
              'choices'   => $blog_post_categories
          ),
          'style'     => array(
              'label'     =>  esc_html__( 'Style', 'grandpoza'  ),
              'type'      => 'select',
              'choices'   => array( esc_html__( 'Style 1' , 'grandpoza' ) , esc_html__( 'Style 2' , 'grandpoza' ) , esc_html__( 'Style 3' , 'grandpoza' ) )
          ),
          'enable_visit_blog_btn' => array(
              'label'     =>  esc_html__( 'Show visit blog button', 'grandpoza'  ),
              'type'      => 'switch',
              'value'     => true
          ),
           'blog_page_url'   => array(
              'label'      =>  esc_html__( 'Visit blog button destination url', 'grandpoza'  ),
              'type'       => 'text',
          ),
           'visit_blog_btn_text'   => array(
              'label'      =>  esc_html__( 'Visit blog button text', 'grandpoza'  ),
              'type'       => 'text',
              'value'      => 'Visit Our Blog'
          ),

      );
