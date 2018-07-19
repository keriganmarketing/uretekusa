<?php $options = _WSH()->option();
	get_header(); 
	$settings  = titan_set(titan_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
	$meta = _WSH()->get_meta('_bunch_layout_settings');
	$meta1 = _WSH()->get_meta('_bunch_header_settings');
	$meta2 = _WSH()->get_meta();
	_WSH()->page_settings = $meta;
	if(titan_set($_GET, 'layout_style'))
	$layout = titan_set($_GET, 'layout_style');
	else
	$layout = titan_set( $meta, 'layout', 'right' );
	if( !$layout || $layout == 'full' || titan_set($_GET, 'layout_style')=='full' )
	$sidebar = '';
	else
	$sidebar = titan_set( $meta, 'sidebar', 'blog-sidebar' );
	$layout = ($layout) ? $layout : 'right';
	$sidebar = ($sidebar) ? $sidebar : 'blog-sidebar';
	$classes = ( !$layout || $layout == 'full' || titan_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-8 col-sm-12 col-xs-12 ' ;
	/** Update the post views counter */
	_WSH()->post_views( true );
	$bg = titan_set($meta1, 'header_img');
	$title = titan_set($meta1, 'header_title');
?>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" <?php if($bg):?>style="background-image:url('<?php echo esc_url($bg)?>');"<?php endif;?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>
<!--End breadcrumb area-->

<!--Sidebar Page-->
<section id="blog-area" class="blog-with-sidebar-area blog-single-area">
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
                <section class="default-section blog-section no-padd-top no-padd-bottom">
                    <div class="thm-unit-test">
					<?php while( have_posts() ): the_post(); 
                        $post_meta = _WSH()->get_meta();
                    ?>
                    <!--Blog Post-->
                    <div class="blog-post">
                        <div class="single-blog-post">
                            <div class="img-holder">
                                <?php the_post_thumbnail('titan_1200x450'); ?>
                            </div>
                            <div class="text-holder">
                                <div class="text">
                                    <?php the_content(); ?>
                                    <span class="tags"><?php the_tags('Tags: ', ', ');?></span>
                                </div>
                                <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'titan'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                                <br>
                                <div class="meta-info clearfix">
                                    <div class="left pull-left">
                                        <ul class="post-info">
                                            <li><?php esc_html_e('By', 'titan'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></li>
                                            <li><?php the_category(', '); ?></li>
                                            <li><a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"> <?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></li>
                                        </ul>    
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                        <!--Comments Template-->
                        <?php comments_template(); ?>
                    </div>
                    <?php endwhile;?>
                    </div>
                </section>
                <!--Content Side-->
                
            </div>
            
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
        </div>
    </div>
</section>

<?php get_footer(); ?>