<?php $args = array('post_type' => 'bunch_projects', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order);
$terms_array = explode(",",$exclude_cats);
if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'projects_category','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
$query = new WP_Query($args);

$t = $GLOBALS['_bunch_base'];

$data_filtration = '';
$data_posts = ''; ?>

<?php if( $query->have_posts() ):
	ob_start();
	$count = 0; 
	$fliteration = array();
	
	while( $query->have_posts() ): $query->the_post();
		global  $post;
		$meta = get_post_meta( get_the_id(), '_bunch_projects_meta', true );
		$meta1 = _WSH()->get_meta();
		$post_terms = get_the_terms( get_the_id(), 'projects_category');
		foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;
		$temp_category = get_the_term_list(get_the_id(), 'projects_category', '', ', ');
		
		$post_terms = wp_get_post_terms( get_the_id(), 'projects_category'); 
		$term_slug = '';
		if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';

			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			
			$term_list = wp_get_post_terms(get_the_id(), 'projects_category', array("fields" => "names"));
?>
        	<!--Item-->
            <div class="single-project-item span-2 filter-item <?php echo esc_attr($term_slug); ?>">
                <div class="inner-box">
                    <figure class="image"><?php the_post_thumbnail('titan_368x240'); ?></figure>
                    <div class="overlay2 anim-5-all">
                        <div class="pop-icon"><a href="<?php echo esc_url($post_thumbnail_url); ?>" data-rel="prettyPhoto" title="<?php esc_html_e('Architecture', 'titan'); ?>" class="fa fa-camera"></a></div>
                        <div class="title"><span><?php the_title(); ?></span></div>
                        <div class="link-icon"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="fa fa-link"></a></div>
                    </div>
                </div>
            </div>
           
	<?php endwhile; wp_reset_postdata();
$data_posts = ob_get_contents();
ob_end_clean();
endif;
ob_start();
$terms = get_terms(array('projects_category')); ?>

<!--Project Three Column-->
<section class="project three-col parallax-section text-center" style="background-image:url(<?php echo esc_url($bg_img); ?>);">
    <div class="container">
        <div class="row">
            <!--Section Title-->
            <header class="section-title2">
                <span class="double-line"></span> &ensp; <h1><?php echo wp_kses_post($title); ?></h1> &ensp; <span class="double-line"></span>
            </header>

            <!--Filters-->
            <ul class="project-filter style-two post-filter text-center">
                <li class="active" data-filter=".filter-item"><span><?php esc_html_e('All', 'titan'); ?></span></li>
                <?php foreach( $fliteration as $t ): ?>
                <li data-filter=".<?php echo esc_attr(titan_set($t, 'slug')); ?>"><span><?php echo wp_kses_post(titan_set($t, 'name')); ?></span></li>
                <?php endforeach; ?>
            </ul>
            
            <!--Items Container-->
            <div class="project-content masonary-layout filter-layout">
                <?php echo wp_kses_post($data_posts); ?>
            </div>

            <a href="<?php echo esc_url($btn_link); ?>" class="thm-btn bg-clr1"><?php echo wp_kses_post($btn_title); ?></a>
            
        </div>
    </div>
</section>
