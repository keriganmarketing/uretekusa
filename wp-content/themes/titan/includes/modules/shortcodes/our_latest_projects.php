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
			<!--Start single project-->
            <div class="single-project-item span-3 filter-item <?php echo esc_attr($term_slug); ?>">
                <div class="img-holder">
                    <?php the_post_thumbnail('titan_384x316'); ?>
                    <div class="overlay">
                        <div class="box">
                            <div class="content">
                                <ul>
                                    <li><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><i class="fa fa-link"></i></a></li>
                                    <li><a href="<?php echo esc_url($post_thumbnail_url); ?>" data-rel="prettyPhoto" title="<?php esc_html_e('Huge Construction', 'titan'); ?>"><i class="fa fa-search-plus"></i></a></li>
                                </ul>
                                <div class="text">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo implode( ', ', (array)$term_list ); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>    
            </div>
            <!--End single project-->
           
	<?php endwhile; wp_reset_postdata();
$data_posts = ob_get_contents();
ob_end_clean();
endif;
ob_start();
$terms = get_terms(array('projects_category')); ?>

<section id="project-area" class="project-gallery sec-padd">
    <div class="container-fluid">
        <div class="container">
            <div class="section-title center decoration">
                <h2><?php echo wp_kses_post($title); ?></h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="project-filter post-filter text-center">
                        <li class="active" data-filter=".filter-item"><span><?php esc_attr_e('All Project', 'titan'); ?></span></li>
                        <?php foreach( $fliteration as $t ): ?>
                        <li data-filter=".<?php echo esc_attr(titan_set($t, 'slug')); ?>"><span><?php echo wp_kses_post(titan_set($t, 'name')); ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="project-content masonary-layout filter-layout">
            <?php echo wp_kses_post($data_posts); ?>
        </div>
    </div>
</section>
