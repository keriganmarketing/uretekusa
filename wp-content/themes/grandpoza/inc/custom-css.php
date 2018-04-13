<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * CUSTOM DYNAMIC CSS STYLES
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#


define( "GRANDPOZA_PRIMARY_COLOR" , "#ffa700" );
define( "GRANDPOZA_SECONDARY_COLOR" , "#041522" );
define( "GRANDPOZA_BODY_TEXT_COLOR" , "#384047");
define( "GRANDPOZA_LINK_COLOR" , "#ffa700" );
define( "GRANDPOZA_MENU_COLOR" , "#fffff" );
define( "GRANDPOZA_LINK_HOVER_COLOR" , "#e69800" );
define( "GRANDPOZA_HEADER_BG_COLOR" , "#ffFfff" );
define( "GRANDPOZA_BODY_BG_COLOR" , "#ffffff" );
define( "GRANDPOZA_HEADER_TEXT_COLOR" , "#384047" );
define( "GRANDPOZA_HEADER_MENU_BG" , "#041522" );
define( "GRANDPOZA_HEADER_MENU_LINK_COLOR" , "#ffffff" );
define( "GRANDPOZA_FOOTER_BG_COLOR" , "#062433" );
define( "GRANDPOZA_FOOTER_TEXT_COLOR" , "#eee" );
define( "GRANDPOZA_FOOTER_LINK_COLOR" , "#ffffff" );

function grandpoza_custom_css()
{
    $dark_primary_color = class_exists( "Kapp_Helpers" ) ? Kapp_Helpers::darken_hex_color( esc_attr( get_theme_mod( "primary_color" , GRANDPOZA_PRIMARY_COLOR ) ) , 91 ) : array( 255 , 167 , 0 );
    $primary_color = esc_attr( get_theme_mod( "primary_color" , GRANDPOZA_PRIMARY_COLOR ) );
    $secondary_color =  esc_attr( get_theme_mod( "secondary_color" , GRANDPOZA_SECONDARY_COLOR ) );
    $primary_color_rgb =  class_exists( "Kapp_Helpers" ) ? Kapp_Helpers::convert_to_rgb( $primary_color ) : array( 255 , 167 , 0 );
    $light_primary_color_rgb =  class_exists( "Kapp_Helpers" ) ? Kapp_Helpers::lighten_hex_color( $primary_color , 10 ) : array( 255 , 167 , 0 );
    $secondary_color_rgb =   class_exists( "Kapp_Helpers" ) ? Kapp_Helpers::convert_to_rgb( $secondary_color ) : array( 4 , 21 , 34 );
?>

<style type="text/css">

    a:hover,
    a:focus,
    .entry-details .entry-content a:hover,
    .entry-header .tag-info a {
        color: rgb(<?php echo implode( "," , $dark_primary_color ); ?>);
    }
    
   
    .bg-theme {
        background-color:<?php echo $primary_color; ?> !important
    }
    .header-menu .nav-bar {
        background-color: <?php echo esc_attr( get_theme_mod( "header_menu_bg" , GRANDPOZA_HEADER_MENU_BG ) ); ?>
    }

    .header-content {
        background-color: <?php echo esc_attr( get_theme_mod( "header_bg" , GRANDPOZA_HEADER_BG_COLOR ) ); ?>;
        color:<?php echo esc_attr( get_theme_mod( "header_text_color" , GRANDPOZA_HEADER_TEXT_COLOR ) ); ?>
    }

    .topbar {
        background:<?php echo $secondary_color; ?>
    }
    .main-footer {
        background-color: <?php echo esc_attr( get_theme_mod( "footer_bg" , GRANDPOZA_FOOTER_BG_COLOR ) ); ?>;
        color: <?php echo esc_attr( get_theme_mod( "footer_text_color" , GRANDPOZA_FOOTER_TEXT_COLOR ) ); ?>
    }

    .main-footer a {
        color: <?php echo esc_attr( get_theme_mod( "footer_link_color" , GRANDPOZA_FOOTER_LINK_COLOR ) ); ?>
    }

    .nav-menu > li > ul li:hover > a,
    .nav-menu > li > ul li.active > a .nav-menu-fixed > a
    {
        color:<?php echo $primary_color; ?>;
    }

    .nav-menu > li:hover > a,
    .nav-menu > li.active > a,
    .nav-menu > li.current-menu-item > a,
    .main-footer h2::after,
    .portfolio-area .portfolio-filter .filter.active::after,
    .tagcloud a:hover, .tags-list a:hover,
    .btn
     {
        background-color:<?php echo $primary_color; ?>;
        border-color:<?php echo $primary_color; ?>;
        color:#fff;
    }

    .nav-menu-fixed > a,
    .nav-menu > li:hover > a,
    .nav-menu > li.active > a,
    .nav-menu > li.current-menu-item > a,
    .current-menu-ancestor a {
        background-color: <?php echo $primary_color; ?>;
    }

    .nav-menu-fixed > a:hover,
    .nav-menu > li.active:hover > a {
        background-color: : rgba(<?php echo implode( "," , $primary_color_rgb ); ?>,0.8);
    }

    .sidebar-menu li a.active, .sidebar-menu .is-active a {
        background-color:<?php echo $primary_color; ?>;
        color:#fff
    }
    .widget-title::after, 
    .widgettitle::after,
    .h-title::after {
        background-color:<?php echo $primary_color; ?>;
    }
    .blog-grid .entry .entry-media-overlay,
    .about-us-box .link-overlay {
        background: rgba(<?php echo implode( "," , $light_primary_color_rgb ); ?>,0.6);
    }

    .skills-list .skill-percentage, 
    .our-skills-area h3::before {
        background-color:<?php echo $primary_color; ?>;
    }
    .features-area-3 .feature-icon,
    .services-video-area h2 > span {
        color:<?php echo $primary_color; ?>;
    }
    .features-area-1 .feature-icon i {
         color: <?php echo $primary_color; ?>;
         box-shadow:0 0px 0px 1px <?php echo $primary_color; ?> inset
    }

    .portfolio-area-3 .portfolio-single .portfolio-hover {
        background-color: rgba( <?php echo join( "," , $primary_color_rgb ); ?>  , .8 );
    }
    .timeline-block:before {
        background-color:<?php echo $primary_color; ?>;
        box-shadow: 0 0 0 5px rgba( <?php echo join( "," , $primary_color_rgb ); ?> , 0.4 ); 

    }

    .article blockquote {
        border-left-color: <?php echo $primary_color; ?>;
    }

    .page-pagination .page-numbers.current,
    .page-pagination a.page-numbers:hover {
        border-color:<?php echo $primary_color; ?>;
        background-color: <?php echo $primary_color; ?>;
        color: #fff;
    }
    .tabs-area .nav > li > a:hover,
    .tabs-area .nav > li > a:focus {
        background-color: transparent;
        color: <?php echo $primary_color; ?>;
    }

    .tabs-area .nav-tabs {
        border-bottom: 2px solid<?php echo $primary_color; ?>;
    }

    .tabs-area .nav-tabs > li.active > a,
    .tabs-area .nav-tabs > li.active > a:hover,
    .tabs-area .nav-tabs > li.active > a:focus {
        background-color: <?php echo $primary_color; ?>;
    }

    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span {
        background: <?php echo $primary_color; ?>;
    }

    .panel-title a,
    .panel-title a.active,
    .panel-title a:focus {
        background-color: <?php echo $primary_color; ?>;
    }

    .list-styled li:before {
        color: <?php echo $primary_color; ?>;
    }
    .custom-checkbox input[type="checkbox"]:checked + label::after,
    .custom-radio input[type="radio"]:checked + label::after {
        border-color:<?php echo $primary_color; ?>;
        background-color: <?php echo $primary_color; ?>;
    }

    .widget-title:after,
    .widgettitle:after {
        background: <?php echo $primary_color; ?>;
    }
    .article blockquote:after {
         color: <?php echo $primary_color; ?>;
    }
    .team-area-3 .social-icons .social-icons__item .fa {
        color:<?php echo $primary_color; ?>
    }
    .team-area-2 .single-member-name {
        background-color:<?php echo $primary_color; ?>
    }
    .info-list li::before {
        background-color:<?php echo $primary_color; ?>
    }

    .portfolio-area .portfolio-filter .filter.active::after,
    .portfolio-area .portfolio-filter .filter:hover::after {
        border-color:<?php echo $primary_color; ?>;
    }

    .topbar a {
        color: <?php echo $primary_color; ?>;
    }

    .nav-menu-fixed > a:hover, 
    .nav-menu > li.active:hover, 
     {
        background: rgb( <?php echo join( ',' , $dark_primary_color ); ?> ) 
    }

    .btn:active,
    .btn:focus,
    .btn:hover {
        background-color: rgb( <?php echo join( ',' , $dark_primary_color ); ?>) !important;
        border-color: rgb( <?php echo join( ',' , $dark_primary_color ); ?>) !important;
        color: #fff !important;
    }

    .nav-menu > li > a,
    .nav-menu-fixed > a {
        color:<?php echo esc_attr( get_theme_mod( "header_menu_link_color" , GRANDPOZA_HEADER_MENU_LINK_COLOR )); ?>
    }

    .blog-grid .entry .entry-date,
    .panel-title a,
    .panel-title a.active,
    .panel-title a:focus,
    .tabs-area .nav-tabs > li.active > a,
    .tabs-area .nav-tabs > li.active > a:hover,
    .tabs-area .nav-tabs > li.active > a:focus ,
    .nav-menu-fixed > a
    {
        background-color:<?php echo $primary_color; ?>   
    }

    .features-area-1 .feature-single:hover i,
    .features-area-2 .feature-icon i
    {
        box-shadow: 0 0px 0px 46px <?php echo $primary_color; ?> inset !important;
    }

    .features-area-2 .feature-single:hover .feature-icon i {
         box-shadow: 0 0px 0px 1px <?php echo $primary_color; ?> inset !important;
         color:<?php echo $primary_color; ?>;
    }


    .services-area .service-single::after {
        border-bottom-color:<?php echo esc_attr( get_theme_mod( "primary_color", GRANDPOZA_PRIMARY_COLOR ) ); ?>
    }

    .single-member .social-icons__item .fa {
        background-color:<?php echo $primary_color; ?>
    } 
    
    .read-more,
    .main-header .header-contact .icon,
    .portfolio-single a:hover {
        color:<?php echo $primary_color; ?>;
    }

    .portfolio-area-1 .inner-hover h2::after,
    .testimonials-area .testimonial-panel::before {
        background-color:<?php echo $primary_color; ?>
    }


    .btn:hover, 
    .btn.hover, 
    .btn:focus, 
    .btn.focus, 
    .btn:active, 
    .btn.active {
         background-color: rgb(<?php echo implode( "," , $dark_primary_color ); ?>);
         border-color: rgb(<?php echo implode( "," , $dark_primary_color ); ?>);
    }


    .btn.btn-o,
    .btn-link {
        color: <?php echo $primary_color; ?>;
        border-color:<?php echo $primary_color; ?>
    }

    .btn.btn-o:hover,
    .btn-link:hover {
        color: #fff;
        background:<?php echo $primary_color; ?>;
        border-color:<?php echo $primary_color; ?>
    }

    .list-styled li::before{
        color: <?php echo $primary_color; ?>;
    }

    body {
        color: <?php echo esc_attr( get_theme_mod( "body_text_color" , GRANDPOZA_BODY_TEXT_COLOR ) ); ?> !important;
        background-color: <?php echo esc_attr( get_theme_mod( "body_background_color" , GRANDPOZA_BODY_BG_COLOR ) ); ?> !important;
    }

    .color-theme {
        color: <?php echo esc_attr( get_theme_mod( "primary_color" , GRANDPOZA_PRIMARY_COLOR ) ); ?> !important;
    }

    .blog-classic .entry-date {
        background-color:<?php echo $primary_color; ?>
    }

    .blog-area .entry-meta {
        color:<?php echo $primary_color; ?>
    }

    .cart-list .sub-total {
        color:<?php echo $primary_color; ?>
    }
    .products .product-item .add-cart i:hover {
        border: 2px solid<?php echo $primary_color; ?>;
        color:<?php echo $primary_color; ?>;
    }

    .contact-us-area .contact-icon i {
        color:<?php echo $primary_color; ?>;
        box-shadow: 0 0px 0px 2px <?php echo $primary_color; ?> inset;
    }

    .contact-us-area.contact-box:hover .contact-icon i {
        box-shadow: 0 0px 0px 46px <?php echo $primary_color; ?> inset;
    }

     .main-footer .sub-footer {
         background-color: rgba( <?php echo join( ',' , $secondary_color_rgb ); ?> , 0.5 );
     }

    <?php if ( class_exists( 'Kapp_Fonts' ) ) { ?>
    body {
         font-family: '<?php echo Kapp_Fonts::$fonts[get_theme_mod( 'body_font_family' )]; ?>', Arial, sans-serif;
         font-size:<?php echo esc_attr( get_theme_mod( 'body_font_size' , '12') ); ?>px;
    }
   
    h1,h2,h3,h4,h5,h6 {
        font-family: '<?php echo Kapp_Fonts::$fonts[get_theme_mod( 'heading_font_family' )]; ?>', Arial, sans-serif;
    }

    <?php } ?>

    h1 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h1_size' , '36') ); ?>px;
    }

    h2 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h2_size' , '28') ); ?>px;
    }

    h3 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h3_size' , '20') ); ?>px;
    }

    h4 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h4_size' , '18') ); ?>px;
    }

    h5 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h5_size' , '16') ); ?>px;
    }

    h6 {
        font-size: <?php echo esc_attr( get_theme_mod( 'h6_size' , '14') ); ?>px;
    }

    @media only screen and (max-width: 991px) {
        .nav-menu {
            background-color: #fff;
        }

            .nav-menu li > a,
            .nav-menu li.active a {
                color: <?php echo $secondary_color; ?>;
                background-color: #fff;
            }

            .nav-menu li:hover > a,
            .nav-menu li.active-mobile > a {
                color: <?php echo $primary_color; ?>;
                background-color: #f1f1f1;
            }
    }

    .services-area .service-single:after {
        border-bottom: 2px solid <?php echo $primary_color; ?>;
    }

   
    .portfolio-area-1 .inner-hover h2:after {
        background: <?php echo $primary_color; ?>;
    }


    .blog-grid .entry .entry-date {
        background: <?php echo $primary_color; ?>;
    }

    .blog-quote-section,
    .quote-post-format blockquote {
        font-size: 16px;
        background-color:<?php echo $primary_color; ?>;
    }

    .comment-avatar:after {
        background-color:<?php echo $primary_color; ?>;
    }

    .comment-avatar img {
        border: solid 2px <?php echo $primary_color; ?>;
    }


    .comment-content {
        border-left: solid 2px <?php echo $primary_color; ?>;
    }

    .tagcloud a:hover,
    .tags-list a:hover {
        background-color: <?php echo $primary_color; ?>;
        color: #fff;
        border: 1px solid <?php echo $primary_color; ?>;
    }

    .services-video-area h2 > span,
    .products .product-item .product-content .price {
        color:<?php echo $primary_color; ?>;
    }

    .form-control:focus, 
    .input-text:focus {
        border-color:<?php echo $primary_color; ?>
    }

    .widget-title::after, .widgettitle::after {
        background: <?php echo $primary_color; ?>;
    }

</style>

<?php
  
}

add_action("wp_head","grandpoza_custom_css");