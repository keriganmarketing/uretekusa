<?php

class Fabrique_Widget_Contact extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_contact',
			'title' => esc_html__( 'Fabrique Contact', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Contact', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-contact'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'style' => 'stacked',
			'default_contact' => '',
			'orderby' => 'post_date',
			'order' => 'desc'
		);

		$instance = array_merge( $default, $instance );
		$query_args = array(
			'post_type' => 'fbq_contact',
			'posts_per_page' => -1,
			'orderby' => $instance['orderby'],
			'order' => $instance['order']
		);

		$query = new WP_Query( $query_args );

		$widget = '<div class="fbq-widget-contact-inner ' . esc_attr( $instance['style'] ) . '">';

		if ( !empty( $query->posts ) ) {
			$contact_info = array(
				'name',
				'address',
				'hours',
				'phone',
				'email',
				'website'
			);

			$widget .= '<select class="fbq-widget-contact-select">';
			$default_contact = empty( $instance['default_contact'] ) ? $query->posts[0]->ID : $instance['default_contact'];
			foreach ( $query->posts as $post ) {
				$widget .= '<option value="'. esc_attr( $post->ID ) .'" '. selected( $default_contact, $post->ID, false ) .'>';
				$widget .=    esc_html( $post->post_title );
				$widget .= '</option>';
			}
			$widget .= '</select>';

			$index = 1;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$id = get_the_ID();
					$custom_fields = get_post_custom();
					$list_class = ( $id == $default_contact ) ? 'fbq-widget-contact-list active' : 'fbq-widget-contact-list';
					$widget .= '<div class="' . esc_attr( $list_class ) . '" data-contact="' . esc_attr( $id ) . '">';
					foreach ( $contact_info as $info ) {
						if ( isset( $custom_fields['fbq_contact_' . $info] ) && !empty( $custom_fields['fbq_contact_' . $info][0] ) ) {
							$widget .= '<div class="fbq-widget-contact-' . esc_attr( $info ) . '">';

							if ( ( 'address' === $info || 'hours' === $info ) && 'stacked' === $instance['style'] ) {
								$widget .= do_shortcode( nl2br( $custom_fields['fbq_contact_' . $info][0] ) );
							} else {
								$widget .= do_shortcode( $custom_fields['fbq_contact_' . $info][0] );
							}

							$widget .= '</div>';
						}
					}
					$widget .= '</div>';

					$index++;
				}
				wp_reset_postdata();
			}
		} else {
			esc_html__( 'Contact is now empty', 'fabrique-core' );
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

		$contact_query = new WP_Query( array(
			'post_type' => 'fbq_contact',
			'posts_per_page' => -1
		) );
		$contact_list = array( '' => __( '--select default--', 'fabrique-core' ) );
		if ( !empty( $contact_query->posts ) ) {
			foreach ( $contact_query->posts as $list ) {
				$contact_list[$list->ID] = $list->post_title;
			}
		}

		$style = ( !empty( $instance['style'] ) ) ? $instance['style'] : 'stacked';
		$output .= $this->render_select( 'style', $style, array(
			'label' => esc_html__( 'Style', 'fabrique-core' ),
			'choices' => array(
				'stacked' => __( 'Stacked', 'fabrique-core' ),
				'inline' => __( 'Inline', 'fabrique-core' )
			)
		) );

		$default_contact = ( !empty( $instance['default_contact'] ) ) ? $instance['default_contact'] : '';
		$output .= $this->render_select( 'default_contact', $default_contact, array(
			'label' => esc_html__( 'Default', 'fabrique-core' ),
			'choices' => $contact_list
		) );

		$orderby = ( !empty( $instance['orderby'] ) ) ? $instance['orderby'] : 'post_date';
		$output .= $this->render_select( 'orderby', $orderby, array(
			'label' => esc_html__( 'Sort By', 'fabrique-core' ),
			'choices' => array(
				'post_date' => __( 'Recent Publish', 'fabrique-core' ),
				'modified' => __( 'Recent Update', 'fabrique-core' ),
				'menu_order' => __( 'Menu Order', 'fabrique-core' ),
				'title' => __( 'Title', 'fabrique-core' ),
				'rand' => __( 'Random', 'fabrique-core' )
			)
		) );

		$order = ( !empty( $instance['order'] ) ) ? $instance['order'] : 'desc';
		$output .= $this->render_select( 'order', $order, array(
			'label' => esc_html__( 'Order By', 'fabrique-core' ),
			'choices' => array(
				'desc' => __( 'Descending', 'fabrique-core' ),
				'asc' => __( 'Ascending', 'fabrique-core' )
			)
		) );

		echo fabrique_core_escape_content( $output );
	}
}
