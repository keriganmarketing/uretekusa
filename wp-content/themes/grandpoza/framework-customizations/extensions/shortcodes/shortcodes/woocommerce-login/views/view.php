
<?php 
if(function_exists("wc_print_notices")){
    wc_print_notices(); 
}
?>
<div class="account-area">

    <h3 class="h-title mb-30 is-inline-block t-uppercase">
      <?php echo esc_attr($atts["title"]);?>
    </h3>
    <form class="woocomerce-form woocommerce-form-login login" method="post">

        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <div class="form-group">
            <input placeholder="<?php esc_html_e( "Username or Email" , "grandpoza"); ?>" type="text" class="form-control input-lg" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
        </div>

       <div class="form-group">
           <input placeholder="<?php esc_html_e( "Password" , "grandpoza"); ?>" class="form-control input-lg" type="password" name="password" id="password" />
        </div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <p class="form-row">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <input type="submit" class="btn btn-block btn-lg" name="login" value="<?php esc_attr_e( 'Login', 'grandpoza' ); ?>" />
           
            <div class="custom-checkbox mb-20">
                <input type="checkbox" id="remember_account" checked="" name="rememberme" id="rememberme" value="forever" />
                <label class="color-mid" for="remember_account"><?php esc_html_e( 'Remember me', 'grandpoza' ); ?></label>
            </div>
        </p>

        <div class="form-group">
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="forgot-pass-link color-theme"><?php esc_html_e( 'Lost your password ?', 'grandpoza' ); ?></a>
        </div>


        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>

