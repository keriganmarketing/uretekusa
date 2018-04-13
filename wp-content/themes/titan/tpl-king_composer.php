<?php /* Template Name: KC Page */
	get_header() ;
	$meta = _WSH()->get_meta('_bunch_header_settings');
	$bg = titan_set($meta, 'header_img');
	$title = titan_set($meta, 'header_title');
?>
<?php if(titan_set($meta, 'breadcrumb')):?>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area"<?php if($bg):?>style="background-image:url('<?php echo esc_url($bg)?>');"<?php endif;?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>
<!--End breadcrumb area-->

<?php endif;?>
<?php while( have_posts() ): the_post(); ?>
    <?php the_content(); ?>
<?php endwhile;  ?>
<?php get_footer() ; ?>