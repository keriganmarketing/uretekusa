<?php
add_action('after_setup_theme', 'titan_bunch_theme_setup');
function titan_bunch_theme_setup()
{
	global $wp_version;
	if(!defined('TITAN_VERSION')) define('TITAN_VERSION', '1.0');
	if( !defined( 'TITAN_ROOT' ) ) define('TITAN_ROOT', get_template_directory().'/');
	if( !defined( 'TITAN_URL' ) ) define('TITAN_URL', get_template_directory_uri().'/');	
	include_once get_template_directory() . '/includes/loader.php';
	
	
	load_theme_textdomain('titan', get_template_directory() . '/languages');
	
	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support('menus'); //Add menu support
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( "title-tag" );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => esc_html__('Main Menu', 'titan'),
				'footer_menu' => esc_html__('Footer Menu', 'titan'),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	add_image_size( 'titan_384x316', 384, 316, true ); // '384x316 Our Latest Projects'
	add_image_size( 'titan_220x300', 220, 300, true ); // '220x300 Our Team'
	add_image_size( 'titan_350x251', 350, 251, true ); // '350x251 Latest News'
	add_image_size( 'titan_285x220', 285, 220, true ); // '285x220 We Are Builder'
	add_image_size( 'titan_368x240', 368, 240, true ); // '368x240 Project'
	add_image_size( 'titan_250x200', 250, 200, true ); // '250x200 Our Team'
	add_image_size( 'titan_310x200', 310, 200, true ); // '310x200 Blog'
	add_image_size( 'titan_370x182', 370, 182, true ); // '370x182 Wecome to ConstructPress'
	add_image_size( 'titan_165x165', 165, 165, true ); // '165x165 Our Dedicated Team'
	add_image_size( 'titan_1200x450', 1200, 450, true ); // '1200x450 Blog'
	add_image_size( 'titan_80x80', 80, 80, true ); // '80x80 Recent News Sidebar'
	
}
function titan_bunch_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = _WSH()->option();
	if( class_exists( 'Bunch_Brochures' ) )register_widget( 'Bunch_Brochures' );
	if( class_exists( 'Bunch_Services_Menu' ) )register_widget( 'Bunch_Services_Menu' );
	if( class_exists( 'Bunch_Services_Menu2' ) )register_widget( 'Bunch_Services_Menu2' );
	if( class_exists( 'Bunch_Recent_News' ) )register_widget( 'Bunch_Recent_News' );
	if( class_exists( 'Bunch_About_Us' ) )register_widget( 'Bunch_About_Us' );
	if( class_exists( 'Bunch_Get_in_Touch' ) )register_widget( 'Bunch_Get_in_Touch' );
	
	
	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', 'titan' ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'titan' ),
	  'before_widget'=>'<div id="%1$s" class="widget single-sidebar %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sec-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', 'titan' ),
	  'id' => 'footer-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'titan' ),
	  'before_widget'=>'<div id="%1$s" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-widget column footer-col %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h3 class="footer-title">',
	  'after_title' => '</h3>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'titan' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'titan' ),
	  'before_widget'=>'<div id="%1$s" class="widget single-sidebar %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sec-title"><h3>',
	  'after_title' => '</h3><span class="border"></span></div>'
	));
	if( !is_object( _WSH() )  )  return;
	$sidebars = titan_set(titan_set( $theme_options, 'dynamic_sidebar' ) , 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(titan_set($sidebar , 'topcopy')) continue ;
		
		$name = titan_set( $sidebar, 'sidebar_name' );
		
		if( ! $name ) continue;
		$slug = titan_bunch_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  sanitize_title( $slug ) ,
			'before_widget' => '<div id="%1$s" class="side-bar widget sidebar_widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<div class="inner-title"><h4>',
			'after_title' => '</h4><span class="decor"></span></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action( 'widgets_init', 'titan_bunch_widget_init' );
// Update items in cart via AJAX
function titan_load_head_scripts() {
	$options = _WSH()->option();
    if ( !is_admin() ) {
		$protocol = is_ssl() ? 'https://' : 'http://';
		$map_path = '?key='.titan_set($options, 'map_api_key');
		wp_enqueue_script( 'map_api', ''.$protocol.'maps.google.com/maps/api/js'.$map_path, array(), false, false );
		wp_enqueue_script( 'jquery-googlemap', get_template_directory_uri().'/js/gmaps.js', array(), false, false );
	}
}
add_action( 'wp_enqueue_scripts', 'titan_load_head_scripts' );
//global variables
function titan_bunch_global_variable() {
    global $wp_query;
}

function titan_enqueue_scripts() {
    //styles
	wp_enqueue_style( 'imp', get_template_directory_uri() . '/css/imp.css' );
	wp_enqueue_style( 'gui', get_template_directory_uri() . '/css/gui.css' );
	wp_enqueue_style( 'hover', get_template_directory_uri() . '/css/hover.css' );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/css/bootstrap-select.min.css' );
	wp_enqueue_style( 'bootstrap-touchspin', get_template_directory_uri() . '/css/jquery.bootstrap-touchspin.css' );
	wp_enqueue_style( 'fontawesom', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/css/flaticon.css' );
	wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'language-switcher', get_template_directory_uri() . '/css/polyglot-language-switcher.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );
	wp_enqueue_style( 'nouislider', get_template_directory_uri() . '/css/nouislider.css' );
	wp_enqueue_style( 'nouislider.pips', get_template_directory_uri() . '/css/nouislider.pips.css' );
	wp_enqueue_style( 'menuzord', get_template_directory_uri() . '/css/menuzord.css' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style( 'imagehover', get_template_directory_uri() . '/css/imagehover.min.css' );
	wp_enqueue_style( 'titan-main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'titan-custom-style', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'titan-responsive', get_template_directory_uri() . '/css/responsive.css' );
	if(class_exists('woocommerce')) wp_enqueue_style( 'titan_woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	
	
	
    //scripts
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri().'/js/jquery.bxslider.min.js', array(), false, true );
	wp_enqueue_script( 'countTo', get_template_directory_uri().'/js/jquery.countTo.js', array(), false, true );
	wp_enqueue_script( 'owl', get_template_directory_uri().'/js/owl.carousel.min.js', array(), false, true );
	wp_enqueue_script( 'mixitup', get_template_directory_uri().'/js/jquery.mixitup.min.js', array(), false, true );
	wp_enqueue_script( 'jquery.easing', get_template_directory_uri().'/js/jquery.easing.min.js', array(), false, true );
	wp_enqueue_script( 'map-helper', get_template_directory_uri().'/js/map-helper.js', array(), false, true );
	wp_enqueue_script( 'fancybox.pack', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array(), false, true );
	wp_enqueue_script( 'appear', get_template_directory_uri().'/js/jquery.appear.js', array(), false, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/isotope.js', array(), false, true );
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array(), false, true );
	wp_enqueue_script( 'bootstrap-touchspin', get_template_directory_uri().'/js/jquery.bootstrap-touchspin.js', array(), false, true );
	wp_enqueue_script( 'SmoothScroll', get_template_directory_uri().'/js/SmoothScroll.js', array(), false, true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/js/wow.min.js', array(), false, true );
	wp_enqueue_script( 'titan-main-script', get_template_directory_uri().'/js/custom.js', array(), false, true );
	if( is_singular() ) wp_enqueue_script('comment-reply');
	
}
add_action( 'wp_enqueue_scripts', 'titan_enqueue_scripts' );

/*-------------------------------------------------------------*/
function titan_theme_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $oswald = _x( 'on', 'Oswald: on or off', 'titan' );
	$lato = _x( 'on', 'Lato font: on or off', 'titan' );
	$poppins = _x( 'on', 'Poppins font: on or off', 'titan' );
 
    if ( 'off' !== $oswald || 'off' !== $lato || 'off' !== $poppins ) {
        $font_families = array();
 
        if ( 'off' !== $oswald ) {
            $font_families[] = 'Oswald:400,600,700';
        }
		
		if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:400,400i';
        }
		
		if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
 
        $opt = get_option('titan'.'_theme_options');
		if ( titan_set( $opt, 'body_custom_font' ) ) {
			if ( $custom_font = titan_set( $opt, 'body_font_family' ) )
				$font_families[] = $custom_font . ':300,300i,400,400i,600,700';
		}
		if ( titan_set( $opt, 'use_custom_font' ) ) {
			$font_families[] = titan_set( $opt, 'h1_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = titan_set( $opt, 'h2_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = titan_set( $opt, 'h3_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = titan_set( $opt, 'h4_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = titan_set( $opt, 'h5_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = titan_set( $opt, 'h6_font_family' ) . ':300,300i,400,400i,600,700';
		}
		$font_families = array_unique( $font_families);
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}
function titan_theme_slug_scripts_styles() {
    wp_enqueue_style( 'titan-theme-slug-fonts', titan_theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'titan_theme_slug_scripts_styles' );
/*---------------------------------------------------------------------*/
function titan_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'titan_add_editor_styles' );
/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function titan_woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'titan_jk_related_products_args' );
  function titan_jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}