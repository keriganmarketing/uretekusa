<?php $options = _WSH()->option();
	titan_bunch_global_variable(); ?>
    
<!--Start header area-->
<header class="header-area style-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                <div class="logo">
                    <?php if(titan_set($options, 'logo_image')): ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(titan_set($options, 'logo_image'));?>" alt="<?php esc_html_e('Arctica', 'titan'); ?>" title="<?php esc_html_e('Arctica', 'titan');?>"></a>
                    <?php else: ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/images/logo/logo.png');?>" alt="<?php esc_html_e('Arctica', 'titan');?>"></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
                <div class="mainmenu-bg">
                    <!--Start mainmenu-->
                    <nav class="main-menu style-2">
                        <div class="navbar-header">     
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                        	<ul class="navigation clearfix">
								<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
                                    'container_class'=>'navbar-collapse collapse navbar-right',
                                    'menu_class'=>'nav navbar-nav',
                                    'fallback_cb'=>false, 
                                    'items_wrap' => '%3$s', 
                                    'container'=>false,
                                    'walker'=> new Bunch_Bootstrap_walker()  
                                ) ); ?>
                            </ul>
                        </div>
                    </nav>
                    <!--End mainmenu-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>