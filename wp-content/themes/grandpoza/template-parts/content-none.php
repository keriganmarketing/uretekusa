<h2 class="t-uppercase mb-30">
    <?php esc_html_e( "OOPS! NOTHING WAS FOUND MATCHING YOUR CRITERIA !" , "grandpoza" ); ?>
</h2>
<h6 class="color-mid mb-40">
    <a href="<?php echo site_url(); ?>" class="color-theme"><?php esc_html_e( 'Back To Home' , 'grandpoza' ); ?></a>
    <?php esc_html_e( "Or try the search below to find matching contents:" , "grandpoza" ); ?>
</h6>
<?php get_search_form(); ?>