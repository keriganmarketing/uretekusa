<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head();?>

</head>
<?php

    /**
     * BOXED LAYOUT
     * */
    $grandpoza_is_boxed_layout = get_theme_mod( "enable_boxed_layout", false );
    $grandpoza_extra_body_class = $grandpoza_is_boxed_layout ? "boxed-layout" :  "wide-layout";

    /**
     * PAGE LAYOUT
     * */
    global $grandpoza_page_layout;
    $grandpoza_page_layout =  get_theme_mod( 'default_page_layout' , 'wr-sidebar' );
    
    if( ( is_single() || is_page() ) && $post != null)
    {
        $post_defined_layout = get_post_meta( $post->ID , 'kapp-page-layout' , true );
        $grandpoza_page_layout = '' == $post_defined_layout   ? $grandpoza_page_layout  : $post_defined_layout ;
    }

?>
<body id="body" <?php body_class( $grandpoza_extra_body_class ); ?>>

    <?php if( get_theme_mod('enable_preloader' , false)) { ?>
    <!--PRELOADER-->
    <div id="preloader" class="preloader">
        <div class="loader-cube">
            <div class="loader-cube__item1 loader-cube__item"></div>
            <div class="loader-cube__item2 loader-cube__item"></div>
            <div class="loader-cube__item4 loader-cube__item"></div>
            <div class="loader-cube__item3 loader-cube__item"></div>
        </div>
    </div>
    <!--END PRELOADER-->
    <?php } ?>
    <div id="pageWrapper" class="page-wrapper">
        <?php 
        if(get_theme_mod("enable_top_bar",true)) {
        ?>
        <div id="topbar" class="topbar ptb-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 left-header-area pt-5 is-hidden-xs-down">
                        <?php 
                        if(is_active_sidebar("top-header-box-1")){
                            dynamic_sidebar("top-header-box-1");
                        }
                        ?>
                    </div>
                    <div class="col-md-4 right-header-area">
                        <?php
                        if(is_active_sidebar("top-header-box-2")){
                            dynamic_sidebar("top-header-box-2");
                        }
                        ?>
                       
                    </div>
                </div>
            </div>
        </div>
       <?php } ?>
        <header id="mainHeader" class="main-header bg-white">
            <?php
            $site_logo = get_theme_mod( "main_logo" , get_stylesheet_directory_uri()."/assets/images/logo.png" );
            ?>
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 t-center t-md-left">
                            <a class="header-brand ptb-10" href="<?php echo esc_url( get_site_url() ); ?>">
                                <img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo( "name" ); ?>">
                            </a>
                        </div>
                        <div class="col-md-3 col-md-offset-0 col-sm-4 col-sm-offset-2 pt-15 is-hidden-xs-down">
                            <div class="header-contact clearfix">
                                <?php if(is_active_sidebar("header-box-1")){
                                          dynamic_sidebar("header-box-1");
                                      }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-4 pt-15 is-hidden-xs-down">
                            <div class="header-contact clearfix">
                                <?php dynamic_sidebar("header-box-2"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-menu">
                <div class="container">
                    <nav class="nav-bar">

                        <div class="nav-header">
                            <span class="nav-toggle" data-toggle="#header-navbar">
                                <i></i>
                                <i></i>
                                <i></i>
                            </span>
                        </div>

                        <div id="header-navbar" class="nav-collapse header-primary-menu">
                            
                            <?php
                                wp_nav_menu(
                                    array(
                                    'container_class'   =>'nav-menu',
                                    'items_wrap'        => '<ul class="nav-menu">%3$s</ul>',
                                    'fallback_cb'       => '',
                                    'theme_location'    => 'primary',
                                    ) );

                            ?>

                        </div>

                        <?php if( get_theme_mod( "enable_menu_call_to_action_btn" , false ) ){  ?>

                        <div class="nav-menu nav-menu-fixed">
                            <a href="<?php echo esc_url( get_theme_mod( "menu_call_to_action_url" ) ); ?>"><?php echo esc_html( get_theme_mod( "menu_call_to_action_text" ) ); ?></a>
                        </div>

                        <?php } ?>

                    </nav>
                </div>
            </div>
        </header>