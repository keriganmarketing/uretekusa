<section class="brand-logo">
    <div class="container">
        <ul class="brand-carousel">
        	<?php foreach( $atts['our_clients'] as $key => $item ): ?>
            <li><a href="<?php echo esc_url($item->url); ?>"><img src="<?php echo esc_url($item->img); ?>" alt=""></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
