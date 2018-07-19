<?php $options = _WSH()->option();
get_header(); 
$settings  = titan_set(titan_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
$meta = _WSH()->get_meta('_bunch_layout_settings');
$meta1 = _WSH()->get_meta('_bunch_header_settings');
$meta2 = _WSH()->get_meta();
_WSH()->page_settings = $meta;
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

<?php while( have_posts() ): the_post();
global $post;
$projects_meta = _WSH()->get_meta();
$term_list = wp_get_post_terms(get_the_id(), 'projects_category', array("fields" => "names")); ?>
<section class="project-single sec-padd">
    <div class="container">
        <div class="row">
            <div class="img-box">
                <img src="<?php echo esc_url(titan_set($projects_meta, 'left_image')); ?>" alt="">
            </div>
            <div class="img-box">
                <img src="<?php echo esc_url(titan_set($projects_meta, 'right_top')); ?>" alt="">
            </div>
            <div class="img-box">
                <img src="<?php echo esc_url(titan_set($projects_meta, 'right_bottom')); ?>" alt="">
            </div>
            <div class="clearfix"></div>
            
            <div class="col-md-8 col-sm-12">
            	<?php the_content(); ?>
            </div>
            <div class="col-md-4 col-sm-12">
                <h4><?php esc_html_e('PROJECT INFO', 'titan'); ?></h4>
                <p><?php echo wp_kses_post(titan_set($projects_meta, 'project_info')); ?></p>
                <div class="content">
                    <h5><?php esc_html_e('CLIENTS', 'titan'); ?></h5>
                    <p><?php echo wp_kses_post(titan_set($projects_meta, 'client')); ?></p>
                    <h5><?php esc_html_e('CATEGORIES', 'titan'); ?></h5>
                    <p><?php echo implode( ', ', (array)$term_list ); ?></p>
                    <h5><?php esc_html_e('COMPLETED', 'titan'); ?></h5>
                    <p><?php echo wp_kses_post(titan_set($projects_meta, 'date')); ?></p>
                    <h5><?php esc_html_e('PROJECT BUDGETS', 'titan'); ?></h5>
                    <p><?php echo wp_kses_post(titan_set($projects_meta, 'price')); ?></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>