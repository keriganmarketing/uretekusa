<?php

/**
 * *************************************
 * THE THEME'S MAIN FOOTER
 * ************************************
 * ****/

?>

<footer class="main-footer pt-60">
    <div class="container">
        <div class="footer-widgets">
            <div class="row row-masnory">
                <div class="col-md-3 col-sm-6 pb-50">
                    <?php 
                    if( is_active_sidebar( "footer-col-1" ) ){
                        dynamic_sidebar( "footer-col-1" );
                    }
                    ?>
                </div>

                <div class="col-md-3 col-sm-6 pb-50">
                    <?php
                    if( is_active_sidebar( "footer-col-3" ) ){
                        dynamic_sidebar( "footer-col-2" );
                    }
                    ?>
                </div>

                <div class="col-md-3 col-sm-6 pb-50">
                    <?php 
                    if( is_active_sidebar( "footer-col-3" ) ){
                        dynamic_sidebar( "footer-col-3" );
                    }
                    ?>
                </div>

                <div class="col-md-3 col-sm-6 pb-50">
                    <?php 
                    if( is_active_sidebar ( "footer-col-4" ) ){
                        dynamic_sidebar ( "footer-col-4" );
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php if(get_theme_mod( "enable_subfooter" , true )) { ?>
    <div class="sub-footer">
        <div class="container">
            <h6 class="copyright">
            <?php echo wp_kses( get_theme_mod( "copyright_text", "&copy; 2017 Your Company Allrights reserved" ) , array( "a" , 'b' , 'strong' ) , array() ); ?>
            </h6>
        </div>
    </div>
    <?php } ?>
</footer>
</div>

 <?php if( get_theme_mod( 'enable_back_to_top_btn' , true ) ){ ?>

<div id="backTop" class="back-top is-hidden-sm-down">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
