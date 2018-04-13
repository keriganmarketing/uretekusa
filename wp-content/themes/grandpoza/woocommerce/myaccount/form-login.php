<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="account-area" id="customer_login">

    <div class="row">

        <div class="col-md-6">
            <h3 class="h-title mb-30 is-inline-block t-uppercase">
                <?php esc_html_e( 'LOGIN' , 'grandpoza' ); ?>
            </h3>

            <form class="" method="post">
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'grandpoza' ); ?>
                        <span class="required">*</span>
                    </label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
                </p>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php esc_html_e( 'Password', 'grandpoza' ); ?>
                        <span class="required">*</span>
                    </label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'grandpoza' ); ?></a>
                </p>

                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

                    <div class="custom-checkbox mb-20">
                        <input type="checkbox" id="remember_account" checked="" name="rememberme" value="forever" />
                        <label class="color-mid" for="remember_account"><?php esc_html_e( 'Keep me signed in on this computer', 'grandpoza' ); ?></label>
                    </div>

                <?php do_action( 'woocommerce_login_form_end' ); ?>

                <input type="submit" class="btn" name="login" value="<?php esc_attr_e( 'Login', 'grandpoza' ); ?>" />
            </form>
        </div>

        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

        <div class="col-md-6">

            <h3 class="h-title mb-30 is-inline-block t-uppercase">
                <?php esc_html_e( 'REGISTER' , 'grandpoza' ); ?>
            </h3>

            <form class="" method="post">

                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_username">
                        <?php esc_html_e( 'Username', 'grandpoza' ); ?>
                        <span class="required">*</span>
                    </label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
                </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email">
                        <?php esc_html_e( 'Email address', 'grandpoza' ); ?>
                        <span class="required">*</span>
                    </label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
                </p>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_password">
                        <?php esc_html_e( 'Password', 'grandpoza' ); ?>
                        <span class="required">*</span>
                    </label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
                </p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <p class="woocommerce-FormRow form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <input type="submit" class="btn" name="register" value="<?php esc_attr_e( 'Register', 'grandpoza' ); ?>" />
                </p>

                <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>

           
        </div>

        <?php endif; ?>

    </div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
