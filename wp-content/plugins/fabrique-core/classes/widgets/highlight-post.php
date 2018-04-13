<?php

class Fabrique_Widget_Highlight_Post extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_highlight_post',
			'title' => esc_html__( 'Fabrique Highlight Post', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Highlight Post', 'fabrique-core' ),
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
			'post_id' => null,
			'show_meta' => 'off',
			'show_separator' => 'off'
		);

		$instance = array_merge( $default, $instance );
		$post_id = explode( ' ', $instance['post_id'] );
		$widget = '';

		$item_class = 'fbq-widget-item';
		if ( 'on' === $instance['show_separator'] ) {
			$item_class .= ' fbq-p-border-border with-border';
		}

		if ( $post_id ) {
			$widget .= '<div class="fbq-widget-post-inner ' . esc_attr( $instance['thumbnail_style'] ) . '-thumbnail-style">';

			foreach ( $post_id as $index => $id ) {
				if ( isset( $id ) && is_numeric( $id ) ) {
					$post = get_post( $id );

					if ( $post && !empty( $post ) ) {
						if ( isset( $post->guid ) ) {
							$permalink = $post->guid;

							if ( $bp_data = fabrique_bp_data( $id ) ) {
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
								$widget .= '<div class="fbq-widget-number fbq-p-bg-bg fbq-p-border-border fbq-s-text-color">'. esc_html( $index + 1 ) .'</div>';
							} else if ( 'none' !== $instance['thumbnail_style'] ) {

								$widget .= '<div class="fbq-widget-media">';
								$widget .=    fabrique_template_media( array(
									'image_id' => get_post_thumbnail_id( $id ),
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
							$widget .=        '<div class="fbq-widget-title fbq-secondary-font">' . esc_html( $post->post_title ) . '</div>';

							if ( 'on' === $instance['show_meta'] ) {
								$categories = fabrique_term_names( fabrique_get_taxonomy( null, false, $id ) );
								if ( !empty( $categories['name'] ) ) {
									$widget .= '<div class="fbq-widget-category">' . esc_html( implode( ', ', $categories['name'] ) ) . '</div>';
								}
							}

							$widget .=    '</div>';
							$widget .= '</a>';
						}
					}
				}
			}

			$widget .= '</div>';
		}

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		// Title
		$title =  ( !empty( $instance['title'] ) ) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', $title, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		) );

		$post_id = ( !empty( $instance['post_id'] ) ) ? $instance['post_id'] : null;
		$output .= $this->render_text( 'post_id', $post_id, array(
			'label' => esc_html__( 'Post ID (Ex: ID1 ID2 ID3)', 'fabrique-core' )
		));

		$show_meta = ( !empty( $instance['show_meta'] ) ) ? $instance['show_meta'] : false;
		$output .= $this->render_checkbox( 'show_meta', $show_meta, array(
			'label' => esc_html__( 'Display Category', 'fabrique-core' )
		) );

		$show_separator = ( !empty( $instance['show_separator'] ) ) ? $instance['show_separator'] : false;
		$output .= $this->render_checkbox( 'show_separator', $show_separator, array(
			'label' => esc_html__( 'Display Separator', 'fabrique-core' )
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


		$style = ( !empty( $instance['image_size'] ) ) ? $instance['image_size'] : 'medium';
		$output .= $this->render_select( 'image_size', $style, array(
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
