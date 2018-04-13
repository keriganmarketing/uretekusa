<?php if($slider_slug): ?>

<!--Start rev slider wrapper-->     
<section class="rev_slider_wrapper">
    <div id="slider1" class="rev_slider" data-version="5.0">
	    <?php if( ($slider_slug) && function_exists ( 'putRevSlider' ) ) putRevSlider( $slider_slug ); ?>
    </div>
</section>
<!--End Main Slider-->

<?php endif; ?>