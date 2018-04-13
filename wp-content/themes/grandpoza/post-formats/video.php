<?php 
/**
 * CHECK FOR EMBED MEDIA
 * */
$embeds = get_media_embedded_in_content( get_the_content() ); 

if( !empty($embeds) || has_post_thumbnail() ) :

?>

<figure class="entry-media embed-responsive embed-responsive-16by9" <?php if( empty($embeds) ){ ?> data-bg-img="<?php echo get_the_post_thumbnail_url( get_the_ID(), "grandpoza-rectangular-lg-thumb" ); ?>" <?php } ?>>
    <?php

    if( !empty($embeds) )
    {
        echo $embeds[0];
    }

    ?>

    <div class="entry-date">
        <?php echo get_the_date(); ?>
    </div>

</figure>

<?php endif; ?>