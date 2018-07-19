<?php $options = _WSH()->option();
$bg = get_template_directory_uri()  . '/images/background/3.jpg';
get_header(); ?>

<!--Page Title-->  
<section class="breadcrumb-area" <?php if($bg):?>style="background-image:url('<?php echo esc_url($bg)?>');"<?php endif;?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>

<section class="not-found-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="not-found-content text-center">
                    <h1><?php esc_html_e('404', 'titan')?></h1>
                    <h3><?php esc_html_e("OOPPS! THE PAGE YOU WERE LOOKING FOR, COULDN'T BE FOUND.", "titan")?></h3>
                    <p><?php esc_html_e('Try the search below to find matching pages:', 'titan')?></p>
                    <?php get_template_part('searchform3'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>