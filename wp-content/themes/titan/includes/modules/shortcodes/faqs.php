<?php $count = 1;
$query_args = array('post_type' => 'bunch_faqs' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['faqs_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<!--Start faq content area-->
<section class="faq-content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="accordion-box">
                	<?php while($query->have_posts()): $query->the_post();
					global $post;
					$faqs_meta = _WSH()->get_meta(); ?>
                    <!--Start single accordion box-->
                    <div class="accordion accordion-block">
                        <div class="accord-btn <?php if($count == 2) { echo 'active'; } ?>"><h4><?php the_title(); ?></h4></div>
                        <div class="accord-content <?php if($count == 2) { echo 'collapsed'; } ?>">
                            <p><?php echo wp_kses_post(get_the_content()); ?></p>
                        </div>
                    </div>
                    <!--End single accordion box-->
                    <?php $count++; endwhile; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="question-form">
                    <h1><?php echo wp_kses_post($contact_title); ?></h1>
                    <?php echo do_shortcode($contact_shortcode); ?>
                </div>
            </div>
        </div>
    </div>
</section> 
<!--End faq content area-->   

<?php endif; wp_reset_postdata(); ?>