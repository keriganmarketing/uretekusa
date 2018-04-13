<?php titan_bunch_global_variable(); 
	$options = _WSH()->option();
	get_header(); 
	$settings  = _WSH()->option(); 
	if(titan_set($_GET, 'layout_style')) $layout = titan_set($_GET, 'layout_style'); else
	$layout = titan_set( $settings, 'author_page_layout', 'right' );
	$sidebar = titan_set( $settings, 'author_page_sidebar', 'blog-sidebar' );
	$view = titan_set( $settings, 'author_page_view', 'list' );
	_WSH()->page_settings = array('layout'=>$layout, 'sidebar'=>$sidebar);
	$layout = ($layout) ? $layout : 'right';
	$sidebar = ($sidebar) ? $sidebar : 'blog-sidebar';
	$classes = ( !$layout || $layout == 'full' || titan_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12 ' ;
	$bg = titan_set($settings, 'author_page_header_img');
	$title = titan_set($settings, 'author_page_header_title');
?>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" <?php if($bg):?>style="background-image:url('<?php echo esc_url($bg)?>');"<?php endif;?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>
<!--End breadcrumb area-->

<!--Sidebar Page-->
<section id="blog-area" class="blog-with-sidebar-area">
    <div class="container">
        <div class="row">
            
            <!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">        
				<aside class="sidebar-wrapper">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
            </div>
			<?php } ?>
			<?php endif; ?>
            
            <!--Content Side-->	
            <div class="<?php echo esc_attr($classes);?>">
                
                <!--Default Section-->
                <section class="single-blog-post default-section blog-section no-padd-top no-padd-bottom">
                    <!--Blog Post-->
                    <div class="thm-unit-test">
					<?php while( have_posts() ): the_post();?>
						<!-- blog post item -->
						<!-- Post -->
						<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
							<?php get_template_part( 'blog' ); ?>
						<!-- blog post item -->
						</div><!-- End Post -->
					<?php endwhile;?>
                    </div>
                    <!--Start post pagination-->
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="post-pagination text-center">
                                <?php titan_the_pagination(); ?>
                            </div>
                        </div> 
                    </div>
                    <!--End post pagination-->
                </section>
            </div>
            <!--Content Side-->
            
            <!--Sidebar-->	
            <!-- sidebar area -->
			<?php if( $layout == 'right' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">        
				<aside class="sidebar-wrapper">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
            </div>
			<?php } ?>
			<?php endif; ?>
            <!--Sidebar-->
        </div>
    </div>
</section>

<?php get_footer(); ?>