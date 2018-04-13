<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h3 class="h-title mb-30 is-inline-block t-uppercase"><?php esc_html_e( 'DASHBOARD' , 'grandpoza' ); ?></h3>
<h4><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		 wp_kses(  __( 'Hello %1$s (not %1$s? <a class="color-theme" href="%2$s">Log out</a>)', 'grandpoza' ) , array(  'a' => array(
            'href' => array(),
            'class' => array(),
            'title' => array()
        )) ),
		'<strong>' . esc_html( $current_user->first_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></h4>

<p><?php
	printf(
		wp_kses( __('From your account dashboard you can view your <a class="color-theme" href="%1$s">recent orders</a>, manage your <a class="color-theme" href="%2$s">shipping and billing addresses</a> and <a class="color-theme" href="%3$s">edit your password and account details</a>.', 'grandpoza') , array(  'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ) ) ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */