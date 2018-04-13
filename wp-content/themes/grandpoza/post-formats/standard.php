<?php

if( has_post_thumbnail() ) :

?>

<figure class="entry-media embed-responsive embed-responsive-16by9" data-bg-img="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-lg-thumb" ); ?>">

    <div class="entry-date">
        <?php echo get_the_date(); ?>
    </div>

</figure>

<?php endif; ?>