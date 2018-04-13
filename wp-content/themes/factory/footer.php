</div>
</div><!--/page-container -->

</div><!--/wrapper-->
</div><!-- close #cg-page-wrap -->



<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package commercegurus
 */

$factorycommercegurus_footer_top_active	 	 = '';
$factorycommercegurus_footer_top_active	 	 = factorycommercegurus_getoption( 'factorycommercegurus_footer_top_active' );
$factorycommercegurus_footer_bottom_active 	 = '';
$factorycommercegurus_footer_bottom_active 	 = factorycommercegurus_getoption( 'factorycommercegurus_footer_bottom_active' );
$factorycommercegurus_back_to_top 			 = '';
$factorycommercegurus_back_to_top 			 = factorycommercegurus_getoption( 'factorycommercegurus_back_to_top' );

?>

<footer class="footercontainer"> 
	<?php if ( $factorycommercegurus_footer_top_active == 'yes' ) { ?>
		<?php if ( is_active_sidebar( 'first-footer' ) ) : ?>
			<div class="first-footer">
				<div class="container">
					<div class="row row-eq-height">
						<?php dynamic_sidebar( 'first-footer' ); ?>   
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.lightwrapper -->
		<?php endif; ?>
	<?php } ?>

	<?php if ( $factorycommercegurus_footer_bottom_active == 'yes' ) { ?>
		<?php if ( is_active_sidebar( 'second-footer' ) ) : ?>
	
		<script>
	    ( function ( $ ) {
	        "use strict";
	        /* Curtain Effect */
	        $( document ).ready( function () {

			var cg_secondfooter_height = $('.second-footer'); /* cache the selector */

			$('.second-footer').css({ height: cg_secondfooter_height.outerHeight() });
			$('.first-footer').css({ "margin-bottom": cg_secondfooter_height.outerHeight() });

	        } );

	    }( jQuery ) );
		</script>

			<div class="second-footer">
				<div class="container">
					<div class="row">
                    <div class="divider"></div>
						<?php dynamic_sidebar( 'second-footer' ); ?>            
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.subfooter -->
		<?php endif; ?>
	<?php } ?>

</footer>


<?php if ( $factorycommercegurus_back_to_top == 'yes' ) { ?>
	<a href="#0" class="cd-top">Top</a>
<?php } ?>
<?php
if ( factorycommercegurus_is_live_demo() ) {
	include_once( get_template_directory() . '/live-preview.php' );	
}


?>
<?php wp_footer(); ?>
</body>
</html>