<?php

class Fabrique_Widget_Post extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_post',
			'title' => esc_html__( 'Fabrique Post', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Post', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-post'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'thumbnail_style' => 'square',
			'image_size' => 'medium',
			'entry_link' => 'post',
			'alignment' => 'left',
			'no_of_items' => 5,
			'order_by' => 'post_date',
			'show_meta' => 'off',
			'show_separator' => 'off',
			'category_filter' => array()
		);

		$instance = array_merge( $default, $instance );
		$item_class = 'fbq-widget-item';
		$widget = '<div class="fbq-widget-post-inner ' . esc_attr( $instance['thumbnail_style'] ) . '-thumbnail-style">';
		$query_args = array(
			'posts_per_page' => $instance['no_of_items'],
			'orderby' => $instance['order_by']
		);

		if ( !empty( $instance['category_filter'] ) ) {
			$query_args['category__in'] = $instance['category_filter'];
		}

		if ( 'on' === $instance['show_separator'] ) {
			$item_class .= ' fbq-p-border-border with-border';
		}

		$query = new WP_Query( $query_args );

		$index = 1;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id = get_the_ID();
				$permalink = get_permalink();

				if ( $bp_data = fabrique_bp_data( $post_id ) ) {
					$post_setting = $bp_data['builder'];
					if ( isset( $post_setting['entry_link'] ) && 'default' !== $post_setting['entry_link'] ) {
						$instance['entry_link'] = $post_setting['entry_link'];
					}
					if ( 'alternate' === $instance['entry_link'] && isset( $post_setting['alternate_link'] ) && !empty( $post_setting['alternate_link'] ) ) {
						$permalink = $post_setting['alternate_link'];
					}
				}

				$widget .= '<a href="'. esc_url( $permalink ) .'" class="' . esc_attr( $item_class ) . '">';

				if ( 'number' === $instance['thumbnail_style'] ) {
					$widget .= '<div class="fbq-widget-number fbq-p-bg-bg fbq-p-border-border fbq-s-text-color">'. esc_html( $index ) .'</div>';
				} else if ( 'none' !== $instance['thumbnail_style'] ) {
					$widget .= '<div class="fbq-widget-media">';
					$widget .=    fabrique_template_media( array(
						'image_id' => get_post_thumbnail_id(),
						'image_ratio' => ( 'wide' !== $instance['thumbnail_style'] ) ? '1x1' : 'auto',
						'image_size' => $instance['image_size']
					) );

					if ( 'square' === $instance['thumbnail_style'] || 'circle' === $instance['thumbnail_style'] ) {
						$widget .= '<div class="fbq-widget-media-overlay">';
						$widget .= 		'<i class="twf twf-arrow-bold-right-up"></i>';
						$widget .= '</div>';
					}

					$widget .= '</div>';
				}

				$widget .=    '<div class="fbq-widget-body fbq-' . esc_attr( $instance['alignment'] ) . '-align">';
				$widget .=        '<div class="fbq-widget-title">' . get_the_title() . '</div>';

				if ( 'on' === $instance['show_meta'] ) {
					$categories = fabrique_term_names( fabrique_get_taxonomy( 'category' ) );
					if ( !empty( $categories['name'] ) ) {
						$widget .= '<div class="fbq-widget-category">' . esc_html( implode( ', ', $categories['name'] ) ) . '</div>';
					}
				}

				$widget .=    '</div>';
				$widget .= '</a>';

				$index++;
			}
			wp_reset_postdata();
		}

		$widget .= '</div>';

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		$title =  ( !empty( $instance['title'] ) ) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', $title, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		) );

		$choices = array();
		$categories = get_terms( 'category', array( 'hide_empty' => false ) );
		foreach ( $categories as $category ) {
			$choices[$category->term_id] = $category->name;
		}

		$category_filter = ( !empty( $instance['category_filter'] ) ) ? $instance['category_filter'] : array();
		$output .= $this->render_select( 'category_filter', $category_filter, array(
			'label' => esc_html__( 'Categories Filter', 'fabrique-core' ),
			'class' => 'widefat',
			'choices' => $choices,
			'multiple' => true
		) );

		$show_meta = ( !empty( $instance['show_meta'] ) ) ? $instance['show_meta'] : false;
		$output .= $this->render_checkbox( 'show_meta', $show_meta, array(
			'label' => esc_html__( 'Display Category', 'fabrique-core' )
		) );

		$show_separator = ( !empty( $instance['show_separator'] ) ) ? $instance['show_separator'] : false;
		$output .= $this->render_checkbox( 'show_separator', $show_separator, array(
			'label' => esc_html__( 'Display Separator', 'fabrique-core' )
		) );

		$no_of_items = ( !empty( $instance['no_of_items'] ) ) ? $instance['no_of_items'] : 5;
		$output .= $this->render_select( 'no_of_items', $no_of_items, array(
			'label' => esc_html__( 'No. of Items', 'fabrique-core' ),
			'choices' => array(
				'-1' => esc_html__( 'all', 'fabrique-core' ),
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10
			)
		) );

		$orderby = ( !empty( $instance['order_by'] ) ) ? $instance['order_by'] : 'post_date';
		$output .= $this->render_select( 'order_by', $orderby, array(
			'label' => esc_html__( 'Order By', 'fabrique-core' ),
			'choices' => array(
				'post_date' => esc_html__( 'Recent Publish', 'fabrique-core' ),
				'modified' => esc_html__( 'Recent Update', 'fabrique-core' ),
				'rand' => esc_html__( 'Random', 'fabrique-core' ),
				'menu_order' => esc_html__( 'Menu Order', 'fabrique-core' ),
				'author' => esc_html__( 'Author', 'fabrique-core' ),
				'title' => esc_html__( 'Title', 'fabrique-core' ),
				'name' => esc_html__( 'Name (Post Slug)', 'fabrique-core' ),
				'comment_count' => esc_html__( 'Comment Count', 'fabrique-core' )
			)
		) );

		$alignment = ( !empty( $instance['alignment'] ) ) ? $instance['alignment'] : 'left';
		$output .= $this->render_select( 'alignment', $alignment, array(
			'label' => esc_html__( 'Alignment', 'fabrique-core' ),
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) );

		$style = ( !empty( $instance['thumbnail_style'] ) ) ? $instance['thumbnail_style'] : 'square';
		$output .= $this->render_select( 'thumbnail_style', $style, array(
			'label' => esc_html__( 'Thumbnail Style', 'fabrique-core' ),
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'square' => esc_html__( 'Square', 'fabrique-core' ),
				'circle' => esc_html__( 'Circle', 'fabrique-core' ),
				'number' => esc_html__( 'Number', 'fabrique-core' ),
				'wide' => esc_html__( 'Wide', 'fabrique-core' ),
				'hover' => esc_html__( 'Hover', 'fabrique-core' )
			)
		) );

		$image_size = ( !empty( $instance['image_size'] ) ) ? $instance['image_size'] : 'medium';
		$output .= $this->render_select( 'image_size', $image_size, array(
			'label' => esc_html__( 'Thumbnail Size', 'fabrique-core' ),
			'choices' => array(
				'thumbnail' => esc_html__( 'Thumbnail', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'twist_medium' => esc_html__( 'Twist Medium', 'fabrique-core' ),
				'medium_large' => esc_html__( 'Medium Large', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' ),
				'twist_large' => esc_html__( 'Twist Large', 'fabrique-core' ),
				'full' => esc_html__( 'Full', 'fabrique-core' )
			)
		));

		$entry_link = ( !empty( $instance['entry_link'] ) ) ? $instance['entry_link'] : 'post';
		$output .= $this->render_select( 'entry_link', $entry_link, array(
			'label' => esc_html__( 'Entry Link To', 'fabrique-core' ),
			'choices' => array(
				'post' => esc_html__( 'Post URL', 'fabrique-core' ),
				'alternate' => esc_html__( 'Alternate URL', 'fabrique-core' )
			)
		) );

		echo fabrique_core_escape_content( $output );
	}
}
