<?php

$embeds = get_media_embedded_in_content( get_the_content());

if( count( $embeds ) > 0) :

?>

<figure class="entry-media embed-responsive embed-responsive-16by9">

    <?php echo $embeds[0]; ?>

    <div class="entry-date">
        <?php echo get_the_date(); ?>
    </div>

</figure>

<?php endif; ?>