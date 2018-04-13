<?php

class Fabrique_Shortcode_Module extends Fabrique_Base_Module
{
	const MODULE_NAME = 'shortcode';

	public function get_name()
	{
		return self::MODULE_NAME;
	}


	public function start()
	{
		add_shortcode( 'bp_text', array( $this, 'shortcode_text' ) );
		add_shortcode( 'bp_align', array( $this, 'shortcode_align' ) );
		add_shortcode( 'bp_column', array( $this, 'shortcode_column' ) );
		add_shortcode( 'bp_dropcap', array( $this, 'shortcode_dropcap' ) );
		add_shortcode( 'bp_code', array( $this, 'shortcode_code' ) );
		add_shortcode( 'bp_tooltip', array( $this, 'shortcode_tooltip' ) );
		add_shortcode( 'bp_bullet', array( $this, 'shortcode_bullet' ) );
		add_shortcode( 'bp_strikethrough', array( $this, 'shortcode_del' ) );
		add_shortcode( 'bp_subscript', array( $this, 'shortcode_sub' ) );
		add_shortcode( 'bp_superscript', array( $this, 'shortcode_sup' ) );
		add_shortcode( 'bp_link', array( $this, 'shortcode_link' ) );
		add_shortcode( 'bp_title', array( $this, 'shortcode_title' ) );
		add_shortcode( 'bp_breadcrumb', array( $this, 'shortcode_breadcrumb' ) );
		add_shortcode( 'bp_excerpt', array( $this, 'shortcode_excerpt' ) );
		add_shortcode( 'bp_taxonomy', array( $this, 'shortcode_taxonomy' ) );
		add_shortcode( 'bp_ctf', array( $this, 'shortcode_customfield' ) );
		add_shortcode( 'bp_author', array( $this, 'shortcode_author' ) );
		add_shortcode( 'bp_date', array( $this, 'shortcode_date' ) );
		add_shortcode( 'bp_archive_title', array( $this, 'shortcode_archive_title' ) );
		add_shortcode( 'bp_icon', array( $this, 'shortcode_icon' ) );
		add_shortcode( 'bp_button', array( $this, 'shortcode_button' ) );
		add_shortcode( 'bp_heading', array( $this, 'shortcode_heading' ) );
		add_shortcode( 'bp_quote', array( $this, 'shortcode_quote' ) );
		add_shortcode( 'bp_gallery', array( $this, 'shortcode_gallery' ) );
		add_shortcode( 'bp_image', array( $this, 'shortcode_image' ) );
		add_shortcode( 'bp_video', array( $this, 'shortcode_video' ) );
		add_shortcode( 'bp_blueprint', array( $this, 'shortcode_blueprint' ) );
		add_shortcode( 'bp_cart', array( $this, 'shortcode_cart' ) );
		add_shortcode( 'bp_featured_media', array( $this, 'shortcode_featured_media' ) );
	}


	public function shortcode_init( $attrs = array(), $class = array(), $styles = array() )
	{
		if ( isset( $attrs['color'] ) ) {
			$styles['color'] = fabrique_c( $attrs['color'] );
		}

		if ( isset( $attrs['font_size'] ) ) {
			$font_size = ( is_numeric( $attrs['font_size'] ) ) ? $attrs['font_size'] . 'px' : $attrs['font_size'];
			$styles['font-size'] = $font_size;

			if ( 48 < (int)$attrs['font_size'] ) {
				$class[] = 'font-style-big';
			}
		}

		if ( isset( $attrs['font_weight'] ) ) {
			$styles['font-weight'] = ( is_numeric( $attrs['font_weight'] ) ) ? (int)$attrs['font_weight'] : $attrs['font_weight'];
		}

		if ( isset( $attrs['font'] ) ) {
			$class[] = 'fbq-' . $attrs['font'] . '-font';
		}

		if ( isset( $attrs['line_height'] ) ) {
			$styles['line_height'] = ( is_numeric( $attrs['line_height'] ) ) ? $attrs['line_height'] . 'px' : $attrs['line_height'];
		}

		if ( isset( $attrs['letter_spacing'] ) ) {
			$styles['letter-spacing'] = ( is_numeric( $attrs['letter_spacing'] ) ) ? $attrs['letter_spacing'] . 'px' : $attrs['letter_spacing'];
		}

		if ( isset( $attrs['text_indent'] ) ) {
			$styles['text-indent'] = ( is_numeric( $attrs['text_indent'] ) ) ? $attrs['text_indent'] . 'px' : $attrs['text_indent'];
		}

		return array(
			'class' => $class,
			'styles' => $styles
		);
	}


	public function shortcode_item( $type, $attrs, $content )
	{
		foreach ( $attrs as $key => $value ) {
			if ( 'true' === $value ) {
				$attrs[$key] = true;
			} elseif ( 'false' === $value ) {
				$attrs[$key] = false;
			}
		}

		$attrs['type'] = $type;
		$attrs['css_class'] = 'shortcode';

		if ( isset( $attrs['position'] ) ) {
			$attrs['css_class'] .= ' fbq-' . $attrs['position'] . '-position';
		}

		if ( isset( $attrs['fullscreen'] ) && $attrs['fullscreen'] && 'false' !== $attrs['fullscreen'] ) {
			$attrs['css_class'] .= ' fullscreen';
		}

		ob_start();
		fabrique_template_item( $attrs );
		$output = ob_get_clean();

		return $output;
	}


	public function shortcode_text( $attrs = array(), $content = null )
	{
		// [bp_text bg_color="{background color}" color="{text color}" font_size="{font size}" font_weight="{font weight}" font="{primary/secondary/...}" line_height="line height" letter_spacing="letter spacing"]{content}[/bp_text]
		if ( !is_array( $attrs ) ) $attrs = array();
		$init_attr = $this->shortcode_init( $attrs );
		$class = $init_attr['class'];
		$styles = $init_attr['styles'];

		if ( isset( $attrs['bg_color'] ) && 'transparent' !== $attrs['bg_color'] ) {
			$class[] = 'fbq-highlighted-text';
			$styles['background-color'] = fabrique_c( $attrs['bg_color'] );
		}

		if ( !empty( $class ) ) {
			$output =  '<span class="' . esc_attr( implode( ' ', $class ) ) . '" ' . fabrique_s( $styles ) . '>';
		} else {
			$output =  '<span ' . fabrique_s( $styles ) . '>';
		}

		$output .=    do_shortcode( $content );
		$output .= '</span>';

		return $output;
	}


	public function shortcode_align( $attrs = array(), $content = null )
	{
		// [bp_align position="{left/center/right}"]{content}[/bp_align]
		if ( !is_array( $attrs ) ) $attrs = array();
		if ( isset( $attrs['position'] ) && !empty( $content ) ) {
			$output =  '<span class="fbq-display-block fbq-' . esc_attr( $attrs['position'] ) . '-align">';
			$output .=    do_shortcode( $content );
			$output .= '</span>';
		} else {
			$output = do_shortcode( $content );
		}

		return $output;
	}


	public function shortcode_column( $attrs = array(), $content = null )
	{
		// [bp_column layout="{6-6/8-4}"]{column1}[SEPARATOR]{column2}[/bp_column]
		if ( !is_array( $attrs ) ) $attrs = array();
		$column_sum = 0;
		$output = do_shortcode( $content );

		if ( isset( $attrs['layout'] ) && !empty( $attrs['layout'] ) && !empty( $content ) ) {
			$column_width = explode( '-', $attrs['layout'] );
			$column_content = explode( '[SEPARATOR]', $content );

			$column_width_no = count( $column_width );
			$content_no = count( $column_content );

			if ( $column_width_no > 1 && $column_width_no == $content_no ) {

				$output =  '<div class="fbq-row">';

				foreach ( $column_width as $index => $column ) {
					$column_sum = $column_sum + (int)$column_width[$index];
					$output .=    '<div class="fbq-col-' . esc_attr( $column_width[$index] ) . '">';
					$output .=        do_shortcode( $column_content[$index] );
					$output .=    '</div>';
				}

				$output .= '</div>';
			}

			if ( 12 != $column_sum ) {
				$output = do_shortcode( $content );
			}
		}

		return $output;
	}


	public function shortcode_dropcap( $attrs = array(), $content = null )
	{
		// [bp_dropcap bg_color="{background color}" border_color="{border color}" circle="{true/false}"]{content}[/bp_dropcap]
		if ( !is_array( $attrs ) ) $attrs = array();
		$attributes = array();
		$init_attr = $this->shortcode_init( $attrs, array( 'fbq-dropcap fbq-p-brand-contrast-color fbq-p-brand-bg' ) );
		$class = $init_attr['class'];
		$styles = $init_attr['styles'];

		if ( isset( $attrs['bg_color'] ) ) {
			$styles['background-color'] = fabrique_c( $attrs['bg_color'] );

			if ( 'transparent' === $attrs['bg_color'] ) {
				$class[] = ' fbq-dropcap--without-background';
			}
		}

		if ( isset( $attrs['border_color'] ) ) {
			$styles['border-color'] = fabrique_c( $attrs['border_color'] );
		}

		if ( isset( $attrs['circle'] ) && 'true' === $attrs['circle'] ) {
			$styles['border-radius'] = '50%';
		}

		$output = '<span class="' . esc_attr( implode( ' ', $class ) ) . '" ' . fabrique_s( $styles ) . '>';
		$output .= 		do_shortcode( $content );
		$output .= '</span>';

		return $output;
	}


	public function shortcode_code( $attrs = array(), $content = null )
	{
		// [bp_code color="{color}" bg_color="{background color}" border_color="{border color}" font_size="{font size}" font="{primary/secondary/...}"]{content}[/bp_code]
		if ( !is_array( $attrs ) ) $attrs = array();
		$class = array();
		$styles = array();
		$code_styles = array();

		if ( isset( $attrs['color'] ) ) {
			$code_styles['color'] = fabrique_c( $attrs['color'] );
		}

		if ( isset( $attrs['bg_color'] ) ) {
			$styles['background-color'] = fabrique_c( $attrs['bg_color'] );
			$code_styles['background-color'] = fabrique_c( $attrs['bg_color'] );
		}

		if ( isset( $attrs['border_color'] ) ) {
			$styles['border-color'] = fabrique_c( $attrs['border_color'] );
		}

		if ( isset( $attrs['font_size'] ) ) {
			$font_size = ( is_numeric( $attrs['font_size'] ) ) ? $attrs['font_size'] . 'px' : $attrs['font_size'];
			$styles['font-size'] = $font_size;

			if ( 48 < (int)$attrs['font_size'] ) {
				$class[] = 'font-style-big';
			}
		}

		if ( isset( $attrs['font'] ) ) {
			$class[] = 'fbq-' .  $attrs['font'] . '-font';
		}

		$output = '<pre ' . fabrique_s( $styles ) . '><code class="' . esc_attr( implode( ' ', $class ) ) . '" ' . fabrique_s( $code_styles ) . '>';
		$output .=		do_shortcode( $content );
		$output .= '</code></pre>';

		return $output;
	}


	public function shortcode_tooltip( $attrs = array(), $content = null )
	{
		// [bp_tooltip position="{top/bottom/left/right}" content="{tooltip content}"][/bp_tooltip]
		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'position' => 'top', // left, right or top, bottom
			'content' => 'this is tooltip', // tooltip content
		);

		$attrs = array_merge( $defaults, $attrs );
		$class = 'fbq-tooltip';
		$class .= ' fbq-tooltip--' . $attrs['position'];

		$output =  '<span class="' . esc_attr( $class ) . '" data-tooltip="' . esc_attr( $attrs['content'] ) . '">';
		$output .=    do_shortcode( $content );
		$output .= '</span>';

		return $output;
	}


	public function shortcode_bullet( $attrs = array(), $content = null )
	{
		// [bp_bullet style="{disc/circle/etc}" image="{image url}" position="{inside/outside}"]{list content}[LI]{list content}[/bp_bullet]

		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'style' => '', // list style
			'image' => '' // url of image to be list bp_bullet
		);
		$attrs = array_merge( $defaults, $attrs );

		// divide each bullet with [LI]
		$lists = explode( '[LI]', $content );

		if ( count( $lists ) > 0 ) {
			if ( !is_array( $attrs ) ) $attrs = array();
			$init_attr = $this->shortcode_init( $attrs, array( 'fbq-text-bullet' ) );
			$class = $init_attr['class'];
			$styles = $init_attr['styles'];

			if ( !empty( $attrs['image'] ) ) {
				$styles['list-style-image'] = 'url(' . $attrs['image'] . ')';
			} else {
				$class[] = $attrs['style'];
			}

			$output =  '<ul class="' . esc_attr( implode( ' ', $class ) ) . '" ' . fabrique_s( $styles ) . '>';

			foreach ( $lists as $list ) {
				$list = trim( $list, '<br>' );
				$list = rtrim( $list, '<br>' );
				$output .= '<li>' . do_shortcode( $list ) . '</li>';
			}

			$output .= '</ul>';
		} else {
			$output = do_shortcode( $content );
		}

		return $output;
	}


	public function shortcode_del( $attrs = array(), $content = null )
	{
		// [bp_strikethrough]Subscript[/bp_strikethrough]
		if ( !is_array( $attrs ) ) $attrs = array();
		return '<del>' . do_shortcode( $content ) . '</del>';
	}


	public function shortcode_sub( $attrs = array(), $content = null )
	{
		// [bp_subscript]Subscript[/bp_subscript]
		if ( !is_array( $attrs ) ) $attrs = array();
		return '<sub>' . do_shortcode( $content ) . '</sub>';
	}


	public function shortcode_sup( $attrs = array(), $content = null )
	{
		// [bp_superscript]Subscript[/bp_superscript]
		if ( !is_array( $attrs ) ) $attrs = array();
		return '<sup>' . do_shortcode( $content ) . '</sup>';
	}


	public function shortcode_link( $attrs = array(), $content = null )
	{
		// [bp_link url="{url}" new_tab="{true/false}"]{content}[/bp_link]
		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'url' => '',
			'new_tab' => 'false',
			'title' => '',
			'rel' => ''
		);
		$attrs = array_merge( $defaults, $attrs );
		$style = array();
		$target = ( 'true' === $attrs['new_tab'] ) ? '_blank' : '_self';
		$title = empty( $attrs['title'] ) ? '' : ' title="' . $attrs['title'] . '"';
		$rel = empty( $attrs['rel'] ) ? '' : ' rel="' . $attrs['rel'] . '"';

		$output =  '<a href="' . fabrique_escape_url( do_shortcode( $attrs['url'] ) ) . '" target="' . esc_attr( $target ) . '"' . $title . $rel . '>';
		$output .=    do_shortcode( $content );
		$output .= '</a>';

		return $output;
	}


	public function shortcode_title( $attrs = array(), $content = null )
	{
		return get_the_title();
	}

	public function shortcode_breadcrumb( $attrs = array(), $content = null )
	{
		ob_start();
		get_template_part( 'templates/breadcrumb' );
		$output = ob_get_clean();

		return $output;
	}


	public function shortcode_excerpt( $attrs = array(), $content = null )
	{
		return get_the_excerpt();
	}


	public function shortcode_taxonomy( $attrs = array(), $content = null )
	{
		// [bp_taxonomy tag="{true/false}" link="{true/false}"][/bp_taxonomy]
		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'tag' => 'false',
			'link' => 'true'
		);
		$attrs = array_merge( $defaults, $attrs );
		$tag = ( 'true' === $attrs['tag'] ) ? true : false;
		$link = ( 'true' === $attrs['link'] ) ? 'link' : 'name';

		if ( !$tag ) {
			$taxonomy = fabrique_term_names( fabrique_get_taxonomy( '', $tag ) );
			$output = '<span class="fbq-inherit-font">' . implode( ', ', $taxonomy[$link] ) . '</span>';
		} else {
			$taxonomy = fabrique_term_names( fabrique_get_taxonomy( '', $tag ), 'fbq-s-bg-bg fbq-p-text-color fbq-p-brand-bg-hover' );
			$output = '<div class="fbq-post-tag fbq-secondary-font">' . implode( '', $taxonomy[$link] ) . '</div>';
		}

		return $output;
	}


	public function shortcode_customfield( $attrs = array(), $content = null )
	{
		// [bp_ctf name="{customfield name}"][/bp_ctf]
		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'name' => '',
			'id' => ''
		);
		$attrs = array_merge( $defaults, $attrs );

		if ( empty( $attrs['name'] ) ) {
			return;
		}

		$post_id = empty( $attrs['id'] ) ? get_the_ID() : $attrs['id'];
		$meta_value = get_post_meta( $post_id, $attrs['name'], true );

		if ( $meta_value ) {
			return $meta_value;
		} else {
			return;
		}
	}


	public function shortcode_author( $attrs = array(), $content = null )
	{
		// [bp_author link="{true/false}"][/bp_author]
		if ( !is_array( $attrs ) ) $attrs = array();
		if ( isset( $attrs['link'] ) && 'false' === $attrs['link'] ) {
			$output = '<span class="fbq-inherit-font">' . get_the_author() . '</span>';
		} else {
			$output = '<span class="fbq-inherit-font">';
			$output .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>';
			$output .= '</span>';
		}

		return $output;
	}


	public function shortcode_date( $attrs = array(), $content = null )
	{
		// [bp_date format="{date format (check in wordpress site)}"][/bp_date]
		if ( !is_array( $attrs ) ) $attrs = array();
		$format = ( isset( $attrs['format'] ) ) ? $attrs['format'] : null;
		$output = '<span class="fbq-inherit-font">' . get_the_date( $format ) . '</span>';

		return $output;
	}


	public function shortcode_archive_title( $attrs = array(), $content = null )
	{
		// [bp_archive_title]
		if ( !is_array( $attrs ) ) $attrs = array();
		$output = '<span class="fbq-inherit-font">' . get_the_archive_title() . '</span>';

		return $output;
	}


	public function shortcode_icon( $attrs = array(), $content = null )
	{
		// [bp_icon icon="{icon name}" style="{plain/fill/border/...}" hover_style="{none/plain/fill/border/...}" color="{color}" hover_color="{hover color}" size="{small/medium/large/x-large}"][/bp_icon]
		if ( !is_array( $attrs ) ) $attrs = array();
		$defaults = array(
			'icon' => 'anchor',
			'style' => 'plain',
			'hover_style' => 'none',
			'color' => 'default',
			'hover_color' => 'default',
			'size' => 'small'
		);
		$attrs = array_merge( $defaults, $attrs );
		if ( 'plain' === $attrs['style'] && 'none' === $attrs['hover_style'] ) {
			$styles = array( 'color' => fabrique_c( $attrs['color'] ) );
			$extra_class = ' shortcode fbq-icon--' . $attrs['size'];
			$output =  '<span class="twf twf-' . esc_attr( $attrs['icon'] ) . esc_attr( $extra_class ) . ' fbq-middle-vertical" ' . fabrique_s( $styles ) . '></span>';
		} else {
			$icon_args = array( 'icon' => $attrs['icon'] );
			$icon_args['icon_style'] = $attrs['style'];
			$icon_args['icon_inline'] = true;
			$icon_args['icon_color'] = $attrs['color'];
			$icon_args['icon_size'] = $attrs['size'];
			$icon_args['icon_hover_style'] = $attrs['hover_style'];
			$icon_args['icon_hover_color'] = $attrs['hover_color'];
			$icon_args['extra_class'] = 'shortcode';

			$output = fabrique_template_icon( $icon_args );
		}

		return $output;
	}


	public function shortcode_button( $attrs=array(), $content=null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		return $this->shortcode_item( 'button', $attrs, $content );
	}


	public function shortcode_heading( $attrs = array(), $content = null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		return $this->shortcode_item( 'heading', $attrs, $content );
	}


	public function shortcode_quote( $attrs=array(), $content=null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		return $this->shortcode_item( 'quote', $attrs, $content );
	}


	public function shortcode_gallery( $attrs = array(), $content = null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		$attrs['gallery_caption_on'] = true;
		return $this->shortcode_item( 'gallery', $attrs, $content );
	}


	public function shortcode_image( $attrs = array(), $content = null )
	{
		// [bp_image image_id="{image id}" fullwidth="{true/false}"][/bp_image]
		if ( !is_array( $attrs ) ) $attrs = array();
		$attrs['media_type'] = 'image';

		if ( isset( $attrs['image_id'] ) && !empty( $attrs['image_id'] ) ) {
			return $this->shortcode_item( 'image', $attrs, $content );
		} else {
			return;
		}
	}


	public function shortcode_video( $attrs = array(), $content = null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		if ( isset( $attrs['video_url'] ) && !empty( $attrs['video_url'] ) ) {
			$attrs['external_url'] = $attrs['video_url'];
			return $this->shortcode_item( 'video', $attrs, $content );
		} else {
			return;
		}
	}


	public function shortcode_blueprint( $attrs = array(), $content = null )
	{
		// [bp_blueprint id="{blueprintblock id}"][/bp_blueprint]
		if ( !is_array( $attrs ) ) $attrs = array();
		if ( isset( $attrs['id'] ) && !empty( $attrs['id'] ) ) {
			$attrs['blueprintblock_id'] = $attrs['id'];
			return $this->shortcode_item( 'blueprintblock', $attrs, $content );
		} else {
			return;
		}
	}


	public function shortcode_cart( $attrs = array(), $content = null )
	{
		// [bp_cart]
		if ( !is_array( $attrs ) ) $attrs = array();
		global $woocommerce;
		$defaults = array( 'icon' => 'cart' );
		$attrs = array_merge( $defaults, $attrs );
		$output = '';

		if ( $woocommerce->cart ) {
			$output .=    '<a href="' . wc_get_cart_url() . '" class="js-menu-cart"><i class="twf twf-' . esc_attr( $attrs['icon'] ) . '"></i>';
			$output .=      '<span class="fbq-menu-cart-count">' . esc_html( $woocommerce->cart->cart_contents_count ) . '</span>';
			$output .=    '</a>';
		}

		return $output;
	}


	public function shortcode_featured_media( $attrs = array(), $content = null )
	{
		if ( !is_array( $attrs ) ) $attrs = array();
		$output = '';
		$post_id = get_the_ID();
		$post_format = get_post_format( $post_id );
		$featured_media = get_post_meta( $post_id, 'bp_post_format_settings', true );
		$thumbnail_id = get_post_thumbnail_id( $post_id );

		if ( !$post_format ) {
			$post_format = 'standard';
		}

		$featured_media_args = array(
			'post_format' => $post_format,
			'image_id' => $thumbnail_id,
			'image_size' => 'full'
		);

		if ( true === is_array( $featured_media ) ) {
			$featured_media_args = array_merge( $featured_media_args, $featured_media );
		}

		ob_start();
		fabrique_template_featured_media( $featured_media_args );
		$output = ob_get_clean();

		return $output;
	}
}
