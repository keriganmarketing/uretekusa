<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * THE THEME'S MAIN FUNCTION FILE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

if( !defined("GRANDPOZA_THEME_URI") ){
    define( "GRANDPOZA_THEME_URI" , get_template_directory_uri()."/" );
}

if( !defined("GRANDPOZA_THEME_DIR") ){
    define( "GRANDPOZA_THEME_DIR" , get_template_directory() );
}


require GRANDPOZA_THEME_DIR."/inc/plugin-activation.php";
require GRANDPOZA_THEME_DIR."/inc/custom-js.php";
require GRANDPOZA_THEME_DIR."/inc/custom-css.php";
require GRANDPOZA_THEME_DIR."/customizer/class-grandpoza-customizer.php";
require GRANDPOZA_THEME_DIR."/inc/woocommerce-setup.php";
require GRANDPOZA_THEME_DIR."/inc/template-tags.php";

/** Define content width */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/** Default Page Layout **/
$grandpoza_page_layout = "wr-sidebar";


/**
 * *************************************
 * HOOKS
 * ************************************
 * ****/

add_action( 'wp_enqueue_scripts', 'grandpoza_load_assets');
add_action( 'after_setup_theme', "grandpoza_theme_setup");
add_action( 'widgets_init', "grandpoza_register_widget_containers");
add_action( 'admin_enqueue_scripts' , 'grandpoza_admin_scripts' );

/**
 * ADMIN AREA STYLES
 */
function grandpoza_admin_scripts()
{
    wp_enqueue_style( 'grandpoza-admin-styles', GRANDPOZA_THEME_URI. 'assets/css/admin-styles.css', array(), '1.0' );
}

/**
 * *************************************
 * LOAD JAVASCRIPTS & CSS FILES
 * ************************************
 * ****/

function grandpoza_load_assets()
{

    /**
     * Load CSS Styles
     * */
    wp_enqueue_style( 'grandpoza-fonts', grandpoza_fonts_url(), array(), null );

    wp_enqueue_style( 'bootstrap',GRANDPOZA_THEME_URI. 'assets/css/bootstrap.min.css', array(), '3.3.7' );

    wp_enqueue_style( 'linearicons', GRANDPOZA_THEME_URI. 'assets/fonts/linearicons/css/linearicons.css', array(), '' );

    wp_enqueue_style( 'fontawesome',GRANDPOZA_THEME_URI. 'assets/vendors/font-awesome/css/font-awesome.min.css', array(), '4.3.0' );

    wp_enqueue_style( 'flaticon', GRANDPOZA_THEME_URI. 'assets/fonts/flaticon/flaticon.css', array(), '' );

    wp_enqueue_style( 'bootstrap-touchspin',GRANDPOZA_THEME_URI. 'assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.css', array(), '' );

    wp_enqueue_style( 'owl-corousel',GRANDPOZA_THEME_URI . 'assets/vendors/owl-carousel/owl.carousel.min.css', array(), '' );

    wp_enqueue_style( 'owl-theme-style', GRANDPOZA_THEME_URI. 'assets/vendors/owl-carousel/owl.theme.min.css', array(), '' );

    wp_enqueue_style( 'magnific-popup', GRANDPOZA_THEME_URI. 'assets/vendors/magnific-popup/css/magnific-popup.css', array(), '' );

    wp_enqueue_style( 'boostrap-touchspin', GRANDPOZA_THEME_URI. 'assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.css', array(  ), '' );

    wp_enqueue_style( 'vegas-slider', GRANDPOZA_THEME_URI. '"assets/vendors/vegas/vegas.min.css', array(  ), ']' );

    wp_enqueue_style( 'yt-player', GRANDPOZA_THEME_URI. 'assets/vendors/YTPlayer/css/jquery.mb.YTPlayer.min.css', array(  ), '' );

    wp_enqueue_style( 'grandpoza-base-style', GRANDPOZA_THEME_URI. 'assets/css/base.css', array( ), '' );

    wp_enqueue_style( 'grandpoza-style', GRANDPOZA_THEME_URI. 'style.css', array( 'grandpoza-base-style' , 'bootstrap', 'grandpoza-fonts' ), null );

    /** LOAD SCRIPTS **/

    wp_enqueue_script('bootstrap',GRANDPOZA_THEME_URI  . '/assets/js/bootstrap.min.js', array('jquery'), "3.3.7", true );
    wp_enqueue_script('jquery-easing', GRANDPOZA_THEME_URI  . '/assets/vendors/jquery.easing.1.3.min.js', array('jquery'), "", true);
    wp_enqueue_script('vegas', GRANDPOZA_THEME_URI . 'assets/vendors/vegas/vegas.min.js', array('jquery') , "", true );
    wp_enqueue_script('owl-slider', GRANDPOZA_THEME_URI . 'assets/vendors/owl-carousel/owl.carousel.min.js', array('jquery','jquery-easing') , "", true );
    wp_enqueue_script('jquery-popup-mg', GRANDPOZA_THEME_URI  . 'assets/vendors/magnific-popup/js/jquery.magnific-popup.min.js', array('jquery'), "", true);
    wp_enqueue_script('jquery-appear', GRANDPOZA_THEME_URI . 'assets/vendors/jquery-appear/jquery.appear.js', array( 'jquery' ) , "", true );
    wp_enqueue_script('bootstrap-touchspin',GRANDPOZA_THEME_URI . 'assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js', array('jquery','bootstrap') , "", true );
    wp_enqueue_script('jquery-mixitup', GRANDPOZA_THEME_URI . 'assets/vendors/jquery.mixitup.js', array('jquery') , "", true );
    wp_enqueue_script('jquery-masonary', GRANDPOZA_THEME_URI . 'assets/js/masonary.jquery.js', array('jquery') , "", true );
    wp_enqueue_script('grandpoza-script', GRANDPOZA_THEME_URI . 'assets/js/main.js', array('jquery','jquery-easing','vegas','jquery-appear','bootstrap','owl-slider') , "", true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
        wp_enqueue_script( 'comment-reply' );
    }
}

/**
 * *************************************
 * GENERAL THEME SETUP
 * ************************************
 * ****/
function grandpoza_theme_setup()
{
    /**
     * Image Sizes
     * */
    set_post_thumbnail_size( 600, 420, true );
    add_image_size( 'grandpoza-rectangular-sm-thumb',600,400,true);
    add_image_size( 'grandpoza-rectangular-md-thumb',750,500,true);
    add_image_size( 'grandpoza-rectangular-lg-thumb',800,400,true);
    add_image_size( 'grandpoza-rectangular-sms-thumb',400,300,true);
    add_image_size( 'grandpoza-product-thumb',350,400,true);
    add_image_size( 'grandpoza-square-thumb',200,200,true);
    /**
     * Add Navigation Menus
     * */
    register_nav_menus( array(
        'primary' => esc_html__( 'Header Top Menu', "grandpoza" ),
    ));

    /**
     * Theme Suppoty
     * */

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
    add_theme_support( 'post-formats', array( 'video' , 'quote', 'gallery', 'audio') );
    add_theme_support( 'woocommerce' );

    load_theme_textdomain( "grandpoza"  , get_template_directory() . '/languages' );

}


/**
 * *************************************
 * REGISTER WIDGET AREAS / CONTAINERS
 * ************************************
 * ****/

function grandpoza_register_widget_containers()
{
    $containers =
        [
        ["name"=> esc_html__( "Sidebar" , 'grandpoza' ) , "id"=>"sidebar" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Top Header Box 1" , 'grandpoza' ) , "id" => "top-header-box-1" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Top Header Box 2" , 'grandpoza' ) , "id" => "top-header-box-2" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Header Box 1" , 'grandpoza' ) , "id" => "header-box-1" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Header Box 2" , 'grandpoza' ) , "id" => "header-box-2" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Footer col 1" , 'grandpoza' ) , "id" => "footer-col-1" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Footer col 2" , 'grandpoza' ) , "id" => "footer-col-2" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Footer col 3" , 'grandpoza' ) , "id" => "footer-col-3" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Footer col 4" , 'grandpoza' ) , "id" => "footer-col-4" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Sidebar Shop" , 'grandpoza' ) , "id" => "sidebar-shop" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Sidebar Blog" , 'grandpoza' ) , "id" => "sidebar-blog" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>'],
        ["name"=> esc_html__( "Sidebar Service" , 'grandpoza' ) ,"id" => "sidebar-service" , 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget'  => '</aside>']
    ];

    if ( function_exists('register_sidebar') ){
        foreach($containers as $container){
            register_sidebar($container);
        }
    }
}

/**
 * *************************************
 * THE THEME'S GOOGLE FONTS
 * ************************************
 * ****/
function grandpoza_fonts_url()
{
    $fonts_to_load = array();

    $body_font = get_theme_mod( "body_font_family" , 0 );
    $heading_font = get_theme_mod("heading_font_family" , 0);

    if( class_exists( "Kapp_Core") ) {

        if($body_font == $heading_font )
        {
            $fonts_to_load[] = urlencode( Kapp_Core::$fonts[$body_font]).':300,400,500,600';

        }else {

            $fonts_to_load[] = Kapp_Core::$fonts[$body_font].':300,400,500,600';
            $fonts_to_load[] = Kapp_Core::$fonts[$heading_font].":300,400,500,600";
        }

    }else
    {
        //Load Default Font
        $fonts_to_load[] = "Montserrat:300,400,500,600";
    }

    return add_query_arg( array(
        'family' => urlencode( implode( '|', $fonts_to_load ) ),
    ), 'https://fonts.googleapis.com/css' );

}