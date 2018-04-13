<?php

if( class_exists('Kapp_Core') ){
    add_action("customize_register", array( Grandpoza_Customizer::class, "init" ) ,90);
}
class Grandpoza_Customizer {

    private static $customizer;
    /**
     * INITIALIZATION OF THE CUSTOMIZER
     * @param mixed $wp_customize
     */
    public static function init($wp_customize)
    {
        Kapp_Customizer::init();
        self::$customizer = $wp_customize;
        self::tagline();
        self::social_media();
        self::header();
        self::footer();
        self::general();
        self::colors();
        self::typography();
        self::layout();
    }



    /**
     * LOGO CUSTOMIZER
     */
    static function tagline()
    {
         /**
          * SITE TAGLINE SECTION
          * */

        (new Kapp_Customizer_Section(self::$customizer,"title_tagline"))
            ->add_control('main_logo',
            array(
                'label'     => esc_html__( 'Logo' , 'grandpoza' ),
                'type'      => 'image',
            )
            );
    }

    /**
     * SOCIAL MEDIA LINKS
     */
    static function social_media()
    {

        $social_icons_customizer_section = (new Kapp_Customizer_Section(self::$customizer))->add("social_media_section", array(
              'title'       => esc_html__("Social Media","grandpoza"),
              'description' => esc_html__("Social media page settings","grandpoza"),
              'priority'    => 40,
            ));

        foreach(Kapp_Core::$social_media_platforms as $platform)
        {

            $social_icons_customizer_section->add_control( $platform["id"] , array(
                 'label'    => ucfirst( $platform["id"] ),
                 'platform' => $platform,
                 'type'     => 'text',
                ));
        }


    }

    /**
     * HEADER CUSTOMIZER
     */
    static function header()
    {
        $args =    array(
          'title'       => esc_html__("Header","grandpoza"),
          'description' => esc_html__("Header settings","grandpoza"),
          'priority'    => 35,
        );

         ( new Kapp_Customizer_Section( self::$customizer ) )->add( "kapp_header_section" , $args )
            ->add_control( "enable_top_bar" , array(
                "type"               => "kapp_switch",
                "default"            => true,
                "label"              => esc_html__( "Enable Top Bar" , 'grandpoza' ),
                "sanitize_callback"  => function($checked){ return  ( isset( $checked ) && $checked == true ) ? true : false ; },
                "description"        => esc_html__( "Enabling the top bar of the header" , "grandpoza")
            ))

             ->add_control( "enable_custom_js" , array(
               "type"               => "kapp_switch",
               "default"            => false,
               "label"              => esc_html__( "Enable Header Custom JS" , "grandpoza" ),
               "sanitize_callback"  => function($checked){ return  ( isset( $checked ) && $checked == true ) ? true : false ; },
               "description"        => esc_html__( "When disabled your custom JS will be ignored" , "grandpoza" )
           ))

            ->add_control( "header_js" ,array(
                "type"   => "textarea",
                "label"  => esc_html__( "Header Javascript" , "grandpoza" )
            ));

    }

    /**
     * FOOTER CUSTOMIZER
     */
    static function footer()
    {
        $args = array(
              'title'       => esc_html__( "Footer" , "grandpoza" ),
              'description' => esc_html__( "Footer settings", "grandpoza" ),
              'priority'    => 50,
          );

        (new Kapp_Customizer_Section( self::$customizer ))->add( "footer_section", $args )
            ->add_control( "enable_subfooter" ,  array(
                    "type"            =>"kapp_switch",
                    "default"         => true,
                    "label"           => esc_html__( "Enable Subfooter" , "grandpoza" ),
                    "description"     => esc_html__( "If disabled subfooter will not show as well as the copyright text" , "grandpoza" )
            ))
            ->add_control( "copyright_text" ,  array(
                    "type"            =>"text",
                    "label"           => esc_html__( "Footer copyright text" ,"grandpoza" ),
                    "description"     => esc_html__( "Footer copy notice" , "grandpoza" ),
            ));
    }

    /**
     * GENERAL CUSTOMIZATIONS
     */
    static function general()
    {
        $panel = ( new Kapp_Customizer_Panel( self::$customizer ) )->add( "kapp_general_panel" , array(
            'title'         => esc_html__( 'General', 'grandpoza' ),
            'description'   =>  esc_html__( "General Settings" , "grandpoza" ),
            'priority'      => 30,
        ));

        $page_covers_section  = $panel->add_section( 'page_covers_section', array(
                'title'         => esc_html__("Page Covers","grandpoza"),
                'description'   => esc_html__("Page Cover Images","grandpoza"),
                'priority'      => 30,
            )
        );


        $misc_section  = $panel->add_section(
            'miscellaneous_section',
            array(
                'title'         => esc_html__( "Miscellaneous" , "grandpoza" ),
                'description'   => esc_html__( "Miscellaneous settings" ,"grandpoza" ),
                'priority'      => 30,
            )
        );

        $misc_section->add_control( "enable_boxed_layout", array(
                    "type"          => "kapp_switch",
                    "label"         => esc_html__( "Boxed  Layout" , "grandpoza" ),
                    "description"   => esc_html__( "Enable Boxed layout" ,"grandpoza" ),
                    "default"       => false,

        ));

        $misc_section->add_control( "enable_preloader", array(
                    "type"          => "kapp_switch",
                    "label"         => esc_html__( "Preloader", "grandpoza" ),
                    "description"   => esc_html__( "Enable preloading animation" , "grandpoza" ),
                    "default"       => false,

        ));

        $misc_section->add_control( "enable_back_to_top_btn" , array(
                    "type"          =>"kapp_switch",
                    "default"       => true,
                    "label"         =>  esc_html__( "Back to top button" , "grandpoza" ),
                    "description"   =>  esc_html__(  "Enable back to top button" , "grandpoza" ),
        ));

        $misc_section->add_control( "enable_menu_call_to_action_btn" , array(
                    "type"          => "kapp_switch",
                    "default"       => false,
                    "label"         =>  esc_html__( "Enable Top menu call to action" , "grandpoza" ),
        ));

        $misc_section->add_control( "menu_call_to_action_text" , array(
                    "type"          => "text",
                    "label"         => esc_html__(  "Menu Call to action title", "grandpoza" ),
                    "description"   => esc_html__(  "Menu Call to action link title", "grandpoza" ),
        ));

        $misc_section->add_control( "menu_call_to_action_url" , array(
                    "type"          => "url",
                    "default"       => '#',
                    "label"         =>  esc_html__( "Menu Call to action URL", "grandpoza" ),
                    "description"   =>  esc_html__( "Top menu Call-to-action link url", "grandpoza" ),
        ));


        $page_covers_section->add_control( "default_page_cover" , array(
                    "type"      => "image",
                    "default"   => '',
                    "label"     => esc_html__( "Default Page cover", "grandpoza" ),
        ));

        $page_covers_section->add_control( "shop_page_cover" , array(
                    "type"          =>"image",
                    "default"       => '',
                    "label"         => esc_html__( "Shop page cover", "grandpoza" ),
                    "description"   => esc_html__( "Default cover on shop/products page" , "grandpoza" ),
        ));

        $page_covers_section->add_control( "blog_page_cover" , array(
                    "type"          => "image",
                    "default"       => '',
                    "label"         => esc_html__( "Blog page cover" , "grandpoza" ),
                    "description"   => esc_html__( "Default cover on blog archives/blog post page" , "grandpoza" ),
        ));

        $page_covers_section->add_control( "404_page_cover" , array(
                "type"          =>"image",
                "default"       => '',
                "label"         =>  esc_html__( "Page Not Found cover" , "grandpoza" ),
                "description"   =>  esc_html__( "Default cover on 404 page" , "grandpoza" ),
        ));


    }

    /**
     * POSTS CUSTOMIZATIONS
     */
    static function layout()
    {

        (new Kapp_Customizer_Section( self::$customizer ))

        ->add("layout_section", array(
              'title'       => esc_html__("Layout","grandpoza"),
              'description' => esc_html__("Default Page Layout","grandpoza"),
              'priority'    => 40,
            ))

       ->add_control( "default_page_layout" , array(
           "type"       => "kapp_page_layout",
           "default"    => 'wr-sidebar',
           "label"      => esc_html__( "Page Layout" , "grandpoza" ),
       ));

    }

    /**
     * TYPOGRAPHY CUSTOMIZER
     */
    static function typography()
    {
        $panel = new Kapp_Customizer_Panel( self::$customizer );
        $panel->add('kapp_typography_panel', array(
            'title'         => __( 'Typography' , 'grandpoza' ),
            'description'   => __( 'Site typography' , 'grandpoza' ),
            'priority'      => 35,
        ));


        /**
        * BODY SECTION
        * */
        $panel->add_section( 'kapp_typography_body_section', array(
                'title'         => esc_html__("Body Text","grandpoza"),
                'description'   => esc_html__("Body Text Settings","grandpoza"),
                'priority'      => 10,
                'panel'         =>'kapp_typography_panel'
            ))
            ->add_control( "body_font_family" , array(
                "type"          => "select",
                "default"       => "0",
                "choices"       => Kapp_Core::$fonts,
                "label"         =>  esc_html__( "Body text font family" , "grandpoza" ),
                "description"   => esc_html__( "Body font family" , "grandpoza" ),
            ))
            ->add_control( "body_font_size" , array(
                "type"          =>"number",
                "default"       => 13,
                "label"         =>  esc_html__( "Body Text font size" , "grandpoza" ),
                "description"   =>  esc_html__( "Body font size in pixels" , "grandpoza" ),
            ));

            /**
            * HEADING SECTION
            * */

            $panel->add_section( 'kapp_typography_heading_section' ,
                array(
                    'title'         => esc_html__("Heading H1-H6","grandpoza"),
                    'description'   => esc_html__("Heading","grandpoza"),
                    'priority'      => 11,
                ))

                ->add_control( "heading_font_family" , array(
                    "type"          => "select",
                    "default"       => "0",
                    "choices"       => Kapp_Core::$fonts,
                    "label"         =>  esc_html__( "Heading font family" , "grandpoza" ),
                    "description"   =>  esc_html__( "H1 - H6" , "grandpoza") ,
                ))

                ->add_control( "h1_size" , array(
                    "type"          => "number",
                    "default"       => 36,
                    "label"         => esc_html__( "H1 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ))

                ->add_control( "h2_size" , array(
                    "type"          => "number",
                    "default"       => 28,
                    "label"         => esc_html__( "H2 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ))

                ->add_control( "h3_size" , array(
                    "type"          => "number",
                    "default"       => 20,
                    "label"         => esc_html__( "H3 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ))
                ->add_control( "h4_size" , array(
                    "type"          => "number",
                    "default"       => 18,
                    "label"         => esc_html__( "H4 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ))
                ->add_control( "h5_size" , array(
                    "type"          => "number",
                    "default"       => 16,
                    "label"         => esc_html__( "H5 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ))
                ->add_control( "h6_size" , array(
                    "type"          => "number",
                    "default"       => 14,
                    "label"         => esc_html__( "H6 - Font size" , "grandpoza" ),
                    "description"   => esc_html__( "In pixels" , "grandpoza" ),
                ));

    }

    /**
     * COLOR CUSTOMIZER
     */
    static function colors()
    {

        $panel_args = array(
              'title'       => esc_html__("Colors","grandpoza"),
              'description' => esc_html__("Site color settings","grandpoza"),
              'priority'    => 30,
          );


        $panel = (new Kapp_Customizer_Panel( self::$customizer ))->add( "colors_panel" , $panel_args );

        $general_section = $panel->add_section( "general_colors_section" , array( 'title'  => esc_html__("General","grandpoza") ) );
        $body_section = $panel->add_section( "body_colors_section" , array( 'title'  => esc_html__("Body","grandpoza") ) );
        $header_section = $panel->add_section( "header_colors_section" , array( 'title'  => esc_html__("Header","grandpoza") ) );
        $footer_section = $panel->add_section( "footer_colors_section" , array( 'title'  => esc_html__("Footer","grandpoza") ) );

        /** GENERAL COLORS **/
        $general_section->add_control( "primary_color" , array(
               "type"       => "color",
               "default"    => GRANDPOZA_PRIMARY_COLOR,
               "label"      => esc_html__( "Primary Color" , "grandpoza" ),
               "description"=> esc_html__( "Dominant theme color" , "grandpoza" ),
        ))

       ->add_control( "secondary_color" , array(
           "type"       => "color",
           "default"    => GRANDPOZA_SECONDARY_COLOR,
           "label"      => esc_html__( "Secondary Color" , "grandpoza" ),
       ))

       ->add_control( "link_color" , array(
          "type"        => "color",
          "default"     => GRANDPOZA_LINK_COLOR,
          "label"       => esc_html__( "Link Color" , "grandpoza" ),
          "description" => esc_html__( "Anchor color" , "grandpoza" ),
      ))

      ->add_control( "link_hover_color" , array(
          "type"        => "color",
          "default"     => GRANDPOZA_LINK_HOVER_COLOR,
          "label"       => esc_html__( "Link Hover color" , "grandpoza" )
      ));

        /** BODY COLORS **/
       $body_section->add_control( "body_text_color" , array(
          "type"    => "color",
          "default" => GRANDPOZA_BODY_TEXT_COLOR,
          "label"   => esc_html__( "Body Text Color" , "grandpoza" ),
      ))

      ->add_control( "body_background_color" , array(
          "type"        =>"color",
          "default"     => GRANDPOZA_BODY_BG_COLOR,
          "label"       => esc_html__( "Body Background Color" , "grandpoza" ),
      ));

       /** HEADER COLORS **/
      $header_section->add_control( "header_bg" , array(
          "type"        => "color",
          "default"     => GRANDPOZA_HEADER_BG_COLOR,
          "label"       => esc_html__( "Background of the header" , "grandpoza" ),
      ))
       ->add_control( "header_text_color" , array(
          "type"        => "color",
          "default"     => GRANDPOZA_HEADER_TEXT_COLOR,
          "label"       => esc_html__( "Header Text Color" , "grandpoza" ),
      ))

      ->add_control( "header_menu_bg" , array(
          "type"        =>"color",
          "default"     => GRANDPOZA_HEADER_MENU_BG,
          "label"       => esc_html__( "Background of the header menu" , "grandpoza" ),
      ))

       ->add_control( "header_menu_link_color" , array(
          "type"        =>"color",
          "default"     => GRANDPOZA_HEADER_MENU_LINK_COLOR,
          "label"       => esc_html__( "Header menu link color" , "grandpoza" ),
      ));

      /** FOOTER **/
      $footer_section ->add_control( "footer_bg" , array(
          "type"        =>"color",
          "default"     => GRANDPOZA_FOOTER_BG_COLOR,
          "label"       => esc_html__( "Background of the footer" , "grandpoza" ),
      ))
      ->add_control( "footer_text_color" , array(
          "type"        =>"color",
          "default"     => GRANDPOZA_FOOTER_TEXT_COLOR,
          "label"       => esc_html__( "Footer text color" , "grandpoza" ),
      ))

      ->add_control( "footer_link_color" , array(
          "type"        => "color",
          "default"     => GRANDPOZA_FOOTER_LINK_COLOR,
          "label"       => esc_html__( "Footer link color" , "grandpoza" ),
      ));

    }

}