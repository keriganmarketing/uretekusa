<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package commercegurus
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function factorycommercegurus_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

add_filter( 'wp_page_menu_args', 'factorycommercegurus_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function factorycommercegurus_body_classes( $classes ) {
	
	$factorycommercegurus_sticky_menu_class	 = '';
	$factorycommercegurus_hide_prices			 = '';
	$factorycommercegurus_header_bg_style		 = '';

	$factorycommercegurus_sticky_menu_class = factorycommercegurus_getoption( 'factorycommercegurus_sticky_menu' );

	$factorycommercegurus_hide_prices = factorycommercegurus_getoption( 'factorycommercegurus_hide_prices' );

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( $factorycommercegurus_hide_prices == 'yes' ) {
		$classes[] = 'cg-hide-prices';
	}

	$global_trans_header_style = '';

	$global_trans_header_style = factorycommercegurus_getoption( 'global_trans_header_style' );

	$factorycommercegurus_header_bg_style = get_post_meta( get_the_ID(), '_cgcmb_header_style', true );

	if ( ( "" !== $factorycommercegurus_header_bg_style ) && ( 'header-globaloption' !== $factorycommercegurus_header_bg_style ) ) {
		$classes[] = $factorycommercegurus_header_bg_style;
	} else if ( "" !== $global_trans_header_style ) {
		$classes[] = $global_trans_header_style;
	} else {
		$classes[] = 'cg-header-style-default';
	}

	//if ( $factorycommercegurus_sticky_menu_class == 'yes' ) {
	$classes[] = 'cg-sticky-enabled';
	//}

	return $classes;
}

add_filter( 'body_class', 'factorycommercegurus_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function factorycommercegurus_enhanced_image_navigation( $url, $id ) {
	if ( !is_attachment() && !wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( !empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}

add_filter( 'attachment_link', 'factorycommercegurus_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function factorycommercegurus_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
	//	return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'factory' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'factorycommercegurus_wp_title', 10, 2 );

function factorycommercegurus_add_menu_parent( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	return $items;
}

add_filter( 'wp_nav_menu_objects', 'factorycommercegurus_add_menu_parent' );


/* Boxed class */
if ( !function_exists( 'factorycommercegurus_boxed_class' ) ) {

	function factorycommercegurus_boxed_class( $classes ) {
		
		$factorycommercegurus_boxed_status = '';
		$factorycommercegurus_boxed_status = factorycommercegurus_getoption( 'container_style' );
	
		
		if ( !empty( $_SESSION['factorycommercegurus_boxed'] ) ) {
			$factorycommercegurus_boxed_status = esc_html( $_SESSION['factorycommercegurus_boxed'] );
		}

		if ( (  $factorycommercegurus_boxed_status == 'yes' ) || ( $factorycommercegurus_boxed_status == 'boxed' ) ) :
			$classes[] = 'boxed';
		else:
			$classes[] = "";
		endif;

		return $classes;
	}

}

add_filter( 'body_class', 'factorycommercegurus_boxed_class' );

// Initialize some global js vars
//add_action( 'wp_head', 'factorycommercegurus_js_init' );
if ( !function_exists( 'factorycommercegurus_js_init' ) ) {

	function factorycommercegurus_js_init() {
		
		?>
		<script type="text/javascript">
		    var view_mode_default = '<?php echo esc_js( $factorycommercegurus_options['product_layout'] ) ?>';
		    var cg_sticky_default = '<?php echo esc_js( $factorycommercegurus_options['factorycommercegurus_sticky_menu'] ) ?>';
		</script>
		<?php
	}

}

// Util function for building VC row styles - replaces default VC buildstyle function

if ( !function_exists( 'factorycommercegurus_build_style' ) ) {

	function factorycommercegurus_build_style( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '',
						  $padding_bottom = '', $padding_top = '', $margin_bottom = '' ) {
		$has_image	 = false;
		$style		 = '';
		if ( (int) $bg_image > 0 && ( $image_url	 = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
			$has_image = true;
			$style .= "background-image: url(" . $image_url . ");";
		}
		if ( !empty( $bg_color ) ) {
			$style .= 'background-color: ' . $bg_color . ';';
		}
		if ( !empty( $bg_image_repeat ) && $has_image ) {
			if ( $bg_image_repeat === 'cover' ) {
				$style .= "background-repeat:no-repeat;background-size: cover;";
			} elseif ( $bg_image_repeat === 'contain' ) {
				$style .= "background-repeat:no-repeat;background-size: contain;";
			} elseif ( $bg_image_repeat === 'no-repeat' ) {
				$style .= 'background-repeat: no-repeat;';
			}
		}
		if ( !empty( $font_color ) ) {
			$style .= 'color: ' . $font_color . ';';
		}
		if ( $padding != '' ) {
			$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
		}
		if ( $padding_bottom != '' ) {
			$style .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_bottom ) ? $padding_bottom : $padding_bottom . 'px' ) . ';';
		}
		if ( $padding_top != '' ) {
			$style .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_top ) ? $padding_top : $padding_top . 'px' ) . ';';
		}
		if ( $margin_bottom != '' ) {
			$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
		}
		return empty( $style ) ? $style : ' style="' . $style . '"';
	}

}

// Hi ThemeForest review team! This is a safe filter for cleaning up CommerceGurus shortcode output only!
// Credits to bitfade for this solution - https://gist.github.com/bitfade/4555047
// Ref - http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848

add_filter( "the_content", "factorycommercegurus_content_filter" );

function factorycommercegurus_content_filter( $content ) {

	// array of custom shortcodes requiring the fix
	$block = join( "|", array( "factorycommercegurus_content_strip", "vc_button", "cg_video_banner" ) );

	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	return $rep;
}

add_action( 'factorycommercegurus_page_title', 'factorycommercegurus_page_title_callback' );

function factorycommercegurus_page_title_callback() {
	global $post, $factorycommercegurus_options;
	$factorycommercegurus_is_page_title_bg_color				 = '';
	$factorycommercegurus_show_page_title						 = '';
	$factorycommercegurus_page_title_background_color			 = '';
	$factorycommercegurus_page_title_font_color				 = '';
	$factorycommercegurus_page_title_background_color_style	 = '';
	$factorycommercegurus_page_title_font_color_style			 = '';
	$factorycommercegurus_cta_heading							 = '';
	$factorycommercegurus_share_options 						 = '';
	$factorycommercegurus_header_image						 = '';
	$factorycommercegurus_header_image_style					 = '';

	$factorycommercegurus_share_options = factorycommercegurus_getoption( 'factorycommercegurus_share_options' );

	if ( function_exists( 'get_field' ) ) {

		$factorycommercegurus_show_page_title			 = get_field( 'show_page_title' );
		$factorycommercegurus_is_page_title_bg_color	 = get_field( 'factorycommercegurus_is_page_title_bg_color' );

		if ( $factorycommercegurus_is_page_title_bg_color == 'true' ) {
			$factorycommercegurus_page_title_background_color		 = get_field( 'page_title_background_color' );
			$factorycommercegurus_page_title_background_opacity	 = get_field( 'page_title_background_opacity' );
			$factorycommercegurus_page_title_font_color			 = get_field( 'page_title_font_color' );
			if ( !empty( $factorycommercegurus_page_title_background_color ) ) {
				$factorycommercegurus_page_title_background_color_style = 'style="background-color:' . $factorycommercegurus_page_title_background_color . '; opacity:' . $factorycommercegurus_page_title_background_opacity . ';"';
			}
			if ( !empty( $factorycommercegurus_page_title_font_color ) ) {
				$factorycommercegurus_page_title_font_color_style = 'style="color:' . $factorycommercegurus_page_title_font_color . '"';
			}
		}
	}
	?>

	<?php 

	$factorycommercegurus_cta_heading = factorycommercegurus_getoption( 'factorycommercegurus_cta_heading' );

	?>

	<?php if ( $factorycommercegurus_show_page_title !== 'Hide' ) { ?>

	<?php if (has_post_thumbnail( $post->ID ) ):
	$factorycommercegurus_header_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	endif; 

	if ( $factorycommercegurus_header_image ) {
	$factorycommercegurus_header_image_style = 'background-image: url('. $factorycommercegurus_header_image[0] . '); ';
	}
	?>

		<div class="header-wrapper">
			<div class="cg-hero-bg" style="<?php echo $factorycommercegurus_header_image_style; ?>" data-center-top="top:-10%;" data-top-top="top: 0%;"></div>
			<div class="overlay"></div> 

			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-12 col-md-12">
						<header class="entry-header">
							<h1 class="cg-page-title"><?php the_title(); ?></h1>
						</header>
					</div>
				</div>
			</div>
		</div>
		<?php echo factorycommercegurus_get_bcrumbs(); ?>



	<?php }
	?>

	<?php
}

function factorycommercegurus_get_page_title() {
	do_action( 'factorycommercegurus_page_title' );
}

function factorycommercegurus_get_share_options_title() {
?>
	
<?php 
}

function factorycommercegurus_get_share_options_content() {
?>



<div class="cg-share btn-group pull-right">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span id="cg-share-toggle"><?php esc_html_e( 'Share', 'factory' ); ?></span>
    </a>
    <ul class="dropdown-menu">
      <li><a class="facebook" target="_blank" href="https://facebook.com/sharer.php?u=<?php echo get_permalink(); ?>"><?php esc_html_e( 'Facebook', 'factory' ); ?></a></li>
      <li><a class="twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>"><?php esc_html_e( 'Twitter', 'factory' ); ?></a></li>
      <li><a class="linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php echo get_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>"><?php esc_html_e( 'LinkedIn', 'factory' ); ?></a></li>
      <li><a class="googleplus" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"><?php esc_html_e( 'Google+', 'factory' ); ?></a></li>
      <li><a class="email-link" href="mailto:?body=<?php echo get_permalink(); ?>"><?php esc_html_e( 'Email', 'factory' ); ?></a></li>
    </ul>
  </div>

<script type='text/javascript'>
( function ( $ ) { "use strict";
$(window).load(function(){
     $(function(){
         $(".dropdown-menu").on("click", "li")
     })
});
}( jQuery ) );

</script>

<?php
}


// Dynamic blog header banner
function factorycommercegurus_blog_header_banner() {
    global $wp_query, $factorycommercegurus_options;
    $post_id = '';

    if ( !is_404() ) {
        if ( isset( $wp_query ) ) {
            if ( $wp_query->have_posts() ) {
                $post_id = $wp_query->post->ID;                    
            }
        }
    }

    $factorycommercegurus_blog_header_bg = '';
    $factorycommercegurus_blog_archive_title_bg_img = '';
    $factorycommercegurus_blog_banner_css = '';
    $factorycommercegurus_blog_archive_banner_css = '';

    if ( is_single() || is_page() ) {
        if ( !empty( $post_id ) ) {
            $factorycommercegurus_blog_header_bg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        }
        $factorycommercegurus_blog_banner_css .= "
            .cg-hero-bg {
                background-image: url( $factorycommercegurus_blog_header_bg[0] );
            }
        ";
        wp_add_inline_style( 'cg-commercegurus', $factorycommercegurus_blog_banner_css );

    } else if ( is_wc_active() ) {
		if ( ( is_archive() || is_home() ) && ( !is_wc_shop() && !is_product_category() && !is_product_tag() ) ) {
        	$factorycommercegurus_blog_archive_title_bg_img_array = factorycommercegurus_getoption( 'factorycommercegurus_blog_archive_title_bg_img' );
			if ( $factorycommercegurus_blog_archive_title_bg_img_array ) {
				$factorycommercegurus_blog_archive_title_bg_img = $factorycommercegurus_blog_archive_title_bg_img_array['url'];
			}
    
        	$factorycommercegurus_blog_archive_banner_css .= "
            	body .cg-hero-bg {
                	background-image: url( $factorycommercegurus_blog_archive_title_bg_img );
            	}
        	";
        	wp_add_inline_style( 'cg-commercegurus', $factorycommercegurus_blog_archive_banner_css );
    	}

    }
    else if ( ( is_archive() || is_home() ) ) {

        $factorycommercegurus_blog_archive_title_bg_img_array = factorycommercegurus_getoption( 'factorycommercegurus_blog_archive_title_bg_img' );
		if ( $factorycommercegurus_blog_archive_title_bg_img_array ) {
			$factorycommercegurus_blog_archive_title_bg_img = $factorycommercegurus_blog_archive_title_bg_img_array['url'];
		}
    
        $factorycommercegurus_blog_archive_banner_css .= "
            body .cg-hero-bg {
                background-image: url( $factorycommercegurus_blog_archive_title_bg_img );
            }
        ";
        wp_add_inline_style( 'cg-commercegurus', $factorycommercegurus_blog_archive_banner_css );

    } 
}

add_action( 'wp_enqueue_scripts', 'factorycommercegurus_blog_header_banner' );


// WooCommerce Header

add_action( 'factorycommercegurus_woo_title', 'factorycommercegurus_woo_title_callback' );

function factorycommercegurus_woo_title_callback() {
	global $post;
	$factorycommercegurus_is_page_title_bg_color				 = '';
	$factorycommercegurus_show_page_title						 = '';
	$factorycommercegurus_page_title_background_color			 = '';
	$factorycommercegurus_page_title_font_color				 = '';
	$factorycommercegurus_page_title_background_color_style	 = '';
	$factorycommercegurus_page_title_font_color_style			 = '';
	$factorycommercegurus_share_options 						 = '';
	$factorycommercegurus_share_options = factorycommercegurus_getoption( 'factorycommercegurus_share_options' );

	if ( function_exists( 'get_field' ) ) {

		$factorycommercegurus_show_page_title			 = get_field( 'show_page_title' );
		$factorycommercegurus_is_page_title_bg_color	 = get_field( 'factorycommercegurus_is_page_title_bg_color' );

		if ( $factorycommercegurus_is_page_title_bg_color == 'true' ) {
			$factorycommercegurus_page_title_background_color		 = get_field( 'page_title_background_color' );
			$factorycommercegurus_page_title_background_opacity	 = get_field( 'page_title_background_opacity' );
			$factorycommercegurus_page_title_font_color			 = get_field( 'page_title_font_color' );
			if ( !empty( $factorycommercegurus_page_title_background_color ) ) {
				$factorycommercegurus_page_title_background_color_style = 'style="background-color:' . $factorycommercegurus_page_title_background_color . '; opacity:' . $factorycommercegurus_page_title_background_opacity . ';"';
			}
			if ( !empty( $factorycommercegurus_page_title_font_color ) ) {
				$factorycommercegurus_page_title_font_color_style = 'style="color:' . $factorycommercegurus_page_title_font_color . '"';
			}
		}
	}
	?>

	
	<?php if ( $factorycommercegurus_show_page_title !== 'Hide' ) { ?>

		<div class="header-wrapper">
		<div class="cg-hero-bg" data-center-top="top:-10%;" data-top-top="top: 0%;"></div>
			<div class="overlay"></div> 
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-12 col-md-12">
						<header class="entry-header">
							<h1 class="cg-page-title"><?php woocommerce_page_title(); ?></h1>
						</header>
					</div>
					
				</div>
			</div>
		</div>
		<?php echo factorycommercegurus_get_bcrumbs(); ?>
	
	<?php }
	?>

	<?php
}

function factorycommercegurus_get_woo_title() {
	do_action( 'factorycommercegurus_woo_title' );
}

// End Woo Header

add_action( 'factorycommercegurus_blog_page_title', 'factorycommercegurus_blog_page_title_callback' );

function factorycommercegurus_blog_page_title_callback() {
	
	$factorycommercegurus_blog_page_title	 = '';
	$factorycommercegurus_blog_header_bg	 = '';

	$factorycommercegurus_is_page_title_bg_color				 = '';
	$factorycommercegurus_show_page_title						 = '';
	$factorycommercegurus_page_title_background_color			 = '';
	$factorycommercegurus_page_title_font_color				 = '';
	$factorycommercegurus_page_title_background_color_style	 = '';
	$factorycommercegurus_page_title_font_color_style			 = '';
	$factorycommercegurus_cta_heading 						 = '';
	$factorycommercegurus_cta_heading = factorycommercegurus_getoption( 'factorycommercegurus_cta_heading' );

	$factorycommercegurus_share_options 						 = '';
	$factorycommercegurus_share_options = factorycommercegurus_getoption( 'factorycommercegurus_share_options' );

	$factorycommercegurus_blog_page_title = factorycommercegurus_getoption( 'factorycommercegurus_blog_page_title' );

	if ( function_exists( 'get_field' ) ) {
		$factorycommercegurus_show_page_title			 = get_field( 'show_page_title' );
		$factorycommercegurus_is_page_title_bg_color	 = get_field( 'factorycommercegurus_is_page_title_bg_color' );

		if ( $factorycommercegurus_is_page_title_bg_color == 'true' ) {
			$factorycommercegurus_page_title_background_color		 = get_field( 'page_title_background_color' );
			$factorycommercegurus_page_title_background_opacity	 = get_field( 'page_title_background_opacity' );
			$factorycommercegurus_page_title_font_color			 = get_field( 'page_title_font_color' );
			if ( !empty( $factorycommercegurus_page_title_background_color ) ) {
				$factorycommercegurus_page_title_background_color_style = 'style="background-color:' . $factorycommercegurus_page_title_background_color . '; opacity:' . $factorycommercegurus_page_title_background_opacity . ';"';
			}
			if ( !empty( $factorycommercegurus_page_title_font_color ) ) {
				$factorycommercegurus_page_title_font_color_style = 'style="color:' . $factorycommercegurus_page_title_font_color . '"';
			}
		}
	}
	?>

<div class="header-wrapper">
			<div class="cg-hero-bg" data-center-top="top:-10%;" data-top-top="top: 0%;"></div>
			<div class="overlay"></div> 
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-12 col-md-12">
						<header class="entry-header">
							<h1 class="cg-page-title"><?php echo wp_kses_post( $factorycommercegurus_blog_page_title ); ?></h1>
						</header>
					</div>
					
				</div>
			</div>
		</div>
		<?php echo factorycommercegurus_get_bcrumbs(); ?>


	
	<?php
}

function factorycommercegurus_get_blog_page_title() {
	do_action( 'factorycommercegurus_blog_page_title' );
}

/* Logo helper */
if ( !function_exists( 'factorycommercegurus_get_logo' ) ) {

	function factorycommercegurus_get_logo( $logo_type ) {
		global $factorycommercegurus_mobile_light_logo;
		$factorycommercegurus_protocol = ( is_ssl() ) ? "https:" : "http:";
		$factorycommercegurus_logo				 = '';
		$factorycommercegurus_logo_array = '';
		$factorycommercegurus_trans_logo			 = '';
		$trans_site_logo_light	 = '';
		$trans_site_logo_dark	 = '';

		// Logo vars

		if ( $logo_type == 'main' ) {

			// Main logo
			$factorycommercegurus_logo_array = factorycommercegurus_getoption( 'site_logo' );
			if ( $factorycommercegurus_logo_array ) {
				$factorycommercegurus_logo =  $factorycommercegurus_logo_array['url'];
			}
			
			if ( !empty( $factorycommercegurus_logo ) ) {
				$factorycommercegurus_logo = $factorycommercegurus_protocol . str_replace( array( 'http:', 'https:' ), '', $factorycommercegurus_logo );
			}

			// Header styles
			$global_trans_header_style	 = '';
			$factorycommercegurus_header_bg_style			 = '';

			$factorycommercegurus_logo_position = '';
			$factorycommercegurus_logo_position = factorycommercegurus_getoption( 'factorycommercegurus_logo_position' );
			
			if ( isset( $_GET['logo_position'] ) ) {
				$factorycommercegurus_logo_position = $_GET['logo_position'];
			}

			$global_trans_header_style = factorycommercegurus_getoption( 'global_trans_header_style' );
			$factorycommercegurus_header_bg_style = get_post_meta( get_the_ID(), '_cgcmb_header_style', true );

			if ( ( $factorycommercegurus_logo_position == 'beside' ) || ( $factorycommercegurus_logo_position == 'right' ) ) {

				if ( ( "" !== $factorycommercegurus_header_bg_style ) && ( 'header-globaloption' !== $factorycommercegurus_header_bg_style ) ) {
					if ( $factorycommercegurus_header_bg_style == 'header-default' ) {
						$factorycommercegurus_trans_logo = esc_url( $factorycommercegurus_logo );
						return $factorycommercegurus_trans_logo;
					} else if ( $factorycommercegurus_header_bg_style == 'transparent-light' ) {
						$factorycommercegurus_trans_logo		 = esc_url( $trans_site_logo_light );
						$factorycommercegurus_dark_mobile_logo = esc_url( $factorycommercegurus_logo );
						return array( $factorycommercegurus_trans_logo, $factorycommercegurus_dark_mobile_logo );
					} else if ( $factorycommercegurus_header_bg_style == 'transparent-dark' ) {
						$factorycommercegurus_trans_logo = esc_url( $trans_site_logo_dark );
						return $factorycommercegurus_trans_logo;
					}
				} else if ( "" !== $global_trans_header_style ) {
					if ( $global_trans_header_style == 'header-default' ) {
						$factorycommercegurus_trans_logo = esc_url( $factorycommercegurus_logo );
						return $factorycommercegurus_trans_logo;
					} else if ( $global_trans_header_style == 'transparent-light' ) {
						$factorycommercegurus_trans_logo = esc_url( $trans_site_logo_light );
						return $factorycommercegurus_trans_logo;
					} else {
						$factorycommercegurus_trans_logo = esc_url( $trans_site_logo_dark );
						return $factorycommercegurus_trans_logo;
					}
				} else if ( $factorycommercegurus_logo ) {
					return $factorycommercegurus_logo;
				} else {
					return false;
				}
			} else if ( $factorycommercegurus_logo ) {
				return $factorycommercegurus_logo;
			} else {
				return false;
			}
		} else if ( $logo_type == 'sticky' ) {
				
			// Sticky logo
			$factorycommercegurus_alt_site_logo_array = '';
			$factorycommercegurus_alt_site_logo_array = factorycommercegurus_getoption( 'factorycommercegurus_alt_site_logo' );
			
			if ( $factorycommercegurus_alt_site_logo_array ) {
				$factorycommercegurus_sticky_logo =  $factorycommercegurus_alt_site_logo_array['url'];	
			}
			
			if ( !empty( $factorycommercegurus_sticky_logo ) ) {
				$factorycommercegurus_sticky_logo = $factorycommercegurus_protocol . str_replace( array( 'http:', 'https:' ), '', $factorycommercegurus_sticky_logo );
				return $factorycommercegurus_sticky_logo;

			}
		}
	}
}


/* Logo helper */
if ( !function_exists( 'factorycommercegurus_get_bcrumbs' ) ) {
	function factorycommercegurus_get_bcrumbs() {

		$factorycommercegurus_share_options = '';
		$factorycommercegurus_share_options = factorycommercegurus_getoption( 'factorycommercegurus_share_options' );

		if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
		?>
		<div class="breadcrumbs-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9">
					<?php
						yoast_breadcrumb( '<p class="sub-title">', '</p>' );
					?>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3">
						<?php 
						if ( $factorycommercegurus_share_options == 'yes' ) {
							factorycommercegurus_get_share_options_content();
						}
						?>
					</div>
				</div>
			</div>
		</div>		
		<?php }
	}
}