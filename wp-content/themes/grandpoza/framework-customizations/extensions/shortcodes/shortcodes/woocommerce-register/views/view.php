
<?php 
if(function_exists("wc_print_notices")){
    wc_print_notices(); 
}
?>
<div class="account-area">

    <h3 class="h-title mb-30 is-inline-block t-uppercase">
      <?php echo esc_attr($atts["title"]);?>
    </h3>
    <form method="post" class="register">

        <?php do_action( 'woocommerce_register_form_start' ); ?>

        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
   

        <?php endif; ?>

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="sr-only"><?php esc_html__( 'First Name' , 'grandpoza' ) ; ?></label>
                    <input name="customer_firstname" value="<?php echo ( ! empty( $_POST['customer_firstname'] ) ) ? esc_attr( $_POST['customer_firstname'] ) : ''; ?>" type="text" class="form-control input-lg" placeholder="<?php esc_html_e( "First Name" , "grandpoza"); ?>" />
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="sr-only"><?php esc_html__( 'Last Name' , 'grandpoza' ); ?></label>
                    <input name="customer_lastname" value="<?php echo ( ! empty( $_POST['customer_lastname'] ) ) ? esc_attr( $_POST['customer_lastname'] ) : ''; ?>" type="text" class="form-control input-lg" placeholder="<?php esc_html_e( "Last Name" , "grandpoza"); ?>" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="sr-only"><?php esc_html_e( 'Email address', 'grandpoza' ); ?></label>
            <input type="text" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" class="form-control input-lg" name="email" id="reg_email" placeholder="<?php esc_html_e( "Email Address" , "grandpoza"); ?>" />
        </div>

        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

        <div class="form-group">
            <label class="sr-only"><?php esc_html_e( 'Password', 'grandpoza' ); ?></label>
            <input type="password" name="password" id="reg_password" class="form-control input-lg" placeholder="<?php esc_html_e( "Password" , "grandpoza"); ?>" />
        </div>

        <div class="form-group">
            <label class="sr-only">
                <?php esc_html_e( 'Password', 'grandpoza' ); ?>
            </label>
            <input type="password" name="password_confirm" id="password_confirm" class="form-control input-lg" placeholder="<?php esc_html_e( "Confirm password" , "grandpoza"); ?>" />
        </div>

        <?php endif; ?>

        <!-- Spam Trap -->
        <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">
            <label for="trap">
                <?php esc_html_e( 'Anti-spam', 'grandpoza' ); ?>
            </label>
            <input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" />
        </div>

        <?php do_action( 'woocommerce_register_form' ); ?>

        <p class="woocomerce-FormRow form-row">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <input type="submit" class="btn btn-block btn-lg" name="register" value="<?php esc_attr_e( 'Register', 'grandpoza' ); ?>" />
        </p>

        <?php do_action( 'woocommerce_register_form_end' ); ?>

    </form>
    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>

