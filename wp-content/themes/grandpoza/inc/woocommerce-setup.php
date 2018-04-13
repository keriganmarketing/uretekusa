<?php

/**
 * woocommerce setup
 *
 * @version 1.0
 * @author KappStudio
 */


/**
 * ADD FIRSTNAME AND LASTNAME FIELD ON REGISTRATION FORM
 * @param mixed $customer_id
 */
function grandpoza_woo_save_reg_form_fields( $customer_id ) {

    //First name field
    if (isset($_POST['customer_firstname'])) {
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['customer_firstname']));
        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
    }

    //Last name field
    if (isset($_POST['billing_last_name'])) {
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['customer_lastname']));
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
    }
}

add_action('woocommerce_created_customer', 'grandpoza_woo_save_reg_form_fields');
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action('woocommerce_register_post', 'grandpoza_woo_save_reg_form_fields', 10, 3);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );