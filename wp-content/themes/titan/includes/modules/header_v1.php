<?php $options = _WSH()->option();
	titan_bunch_global_variable(); ?>

<!--Start header area-->
<header class="header-area">
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
                <div class="header-contact-info">
                    <ul>
                    	<?php if(titan_set($options, 'address')): ?>
                        <li>
                            <div class="iocn-holder">
                                <span class="fa fa-home"></span>
                            </div>
                            <div class="text-holder">
                                <?php echo wp_kses_post(titan_set($options, 'address')); ?>
                            </div>
                        </li>
                        <?php endif; if(titan_set($options, 'phone')): ?>
                        <li>
                            <div class="iocn-holder">
                                <span class="icon-technology-1"></span>
                            </div>
                            <div class="text-holder">
                                <h6><?php esc_html_e('Call Us On', 'titan'); ?></h6>
                                <p><?php echo wp_kses_post(titan_set($options, 'phone')); ?></p>
                            </div>
                        </li>
                        <?php endif; if(titan_set($options, 'email')): ?>
                        <li>
                            <div class="iocn-holder">
                                <span class="icon-letter-1"></span>
                            </div>
                            <div class="text-holder">
                                <h6><?php esc_html_e('Mail Us @', 'titan'); ?></h6>
                                <a href="mailto:<?php echo sanitize_email(titan_set($options, 'email')); ?>"><p><?php echo sanitize_email(titan_set($options, 'email')); ?></p></a>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>  
<!--End header area--> 

<!--Start mainmenu area-->
<section class="mainmenu-area stricky">
    <div class="container">
        <div class="mainmenu-bg">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <!--Start mainmenu-->
                    <nav class="main-menu">
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
            
            <div class="right-column">
                <div class="right-area">
                    <div class="nav_side_content">
                        <div class="search_option">
                            <button class="search tran3s dropdown-toggle color1_bg" id="searchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <?php get_template_part('searchform2'); ?>
                       </div>
                   </div>
                   <?php if(titan_set($options, 'get_quote')): ?>
                   <div class="link_btn float_right">
                       <a href="<?php echo esc_url(titan_set($options, 'get_quote')); ?>" class="thm-btn bg-clr1"><?php esc_html_e('GET A Quote', 'titan'); ?></a>
                   </div>
                   <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End mainmenu area-->