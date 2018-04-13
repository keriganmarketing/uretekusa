
<article id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>

    <div class="entry-wrapper pb-15">
            <?php the_content(); ?>
    </div>

    <div class="tags-list mb-30">
        
        <?php
        if($post_tags = get_the_tags()): ?>

        <span class="color-theme mr-10">
            <i class="fa fa-tag"></i><?php esc_html_e( 'Tags: ' , 'grandpoza' ); ?>
        </span>

        <?php foreach($post_tags as $tag) : ?>
        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo esc_html($tag->name); ?></a>
        <?php endforeach; ?>

        <?php endif; ?>

    </div>
   
</article>

