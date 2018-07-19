<?php $options = get_option('titan'.'_theme_options'); ?>
	<div class="clearfix"></div>
    
	<!--Main Footer-->
    <footer>
    	<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
        <div class="footer-main sec-padd2">
            <div class="container">
                <div class="row">
                	<?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        </div>
		<?php } ?>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <p class="copyright"><?php echo wp_kses_post(titan_set($options, 'copyrights')); ?></p>
                    </div>
                    <div class="col-md-9">
                        <nav class="footer-menu pull-right">
                            <ul class="list-inline">
                            	<?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'container_id' => 'navbar-collapse-1',
                                    'container_class'=>'navbar-collapse collapse navbar-right',
                                    'menu_class'=>'nav navbar-nav',
                                    'fallback_cb'=>false, 
                                    'items_wrap' => '%3$s', 
                                    'container'=>false,
									'depth' => 1,
                                    'walker'=> new Bunch_Bootstrap_walker()  
                                ) ); ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<?php wp_footer(); ?>
</body>
</html>