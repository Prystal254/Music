<?php 
    add_theme_support( 'woocommerce' );
    

    add_filter( 'woocommerce_is_purchasable', 'bbloomer_deny_purchase_if_already_purchased', 9999, 2 );
  
    function bbloomer_deny_purchase_if_already_purchased( $is_purchasable, $product ) {
        if ( is_user_logged_in() && wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) {
            $is_purchasable = false;
        }
        return $is_purchasable;
    }


//------------------------------------



add_action('wp_enqueue_scripts', 'my_register_script_method');

function my_register_script_method () {
    wp_deregister_script('jquery');
    wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.min.js');
}

// ============================================


add_filter('woocommerce_add_to_cart_validation' , 'shalior_flag_already_added_products_as_invalid' , 10 , 2);
function shalior_flag_already_added_products_as_invalid ($result , $product_id){
    if (false === $result){
        return $result;
    }

    $url = wc_get_cart_url();
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        $cart_item_product_id = $cart_item['product_id'];
        if($product_id === $cart_item['product_id'] ) {
            $result = false;
        }
    }
    if (false === $result){
        add_filter('woocommerce_cart_redirect_after_error' , function (){
            return wc_get_cart_url();
        } , 999 );
    }
    return $result;
}

// adds the product to cart on form submission
function add_product_to_cart_on_form_submission( $entry, $form ) {
    // Get the product ID from the hidden field
    $product_id = rgar( $entry, '13' );
    //var_dump($product_id);
    // Debugging statement to check the product ID
    $radio_button_value = rgar( $entry, '15');

    // If the product ID is valid, add it to the cart

    if ( $product_id ) {
        // Add the product to the cart
        WC()->cart->add_to_cart($product_id,1 ,"","",array('isExclusive'=>$radio_button_value));
        //WC()->cart->add_to_cart($product_id);

        // Debugging statement to check the cart contents
        //error_log( 'Cart Contents: ' . print_r( WC()->cart->get_cart(), true ) );

        // Redirect the user to the cart page
        // wp_redirect( wc_get_cart_url() );
        // exit;
    }
}
add_action( 'gform_after_submission_4', 'add_product_to_cart_on_form_submission', 10, 2 );


// adds the product to user meta
function add_product_id_to_user_meta( $order_id ) {
    // Get the current user ID
    $user_id = get_current_user_id();

    // Get the product ID from the order
    $order = wc_get_order( $order_id );
    $items = $order->get_items();
    $product_id = null;
    foreach ( $items as $item ) {
        $product_id = $item->get_product_id();
        break;
    }

    // Add the product ID to the user meta
    if ( $user_id && $product_id ) {
        $product_ids = get_user_meta( $user_id, 'purchased_product_ids', true );
        if ( ! is_array( $product_ids ) ) {
            $product_ids = array();
        }
        if ( ! in_array( $product_id, $product_ids ) ) {
            $product_ids[] = $product_id;
            update_user_meta( $user_id, 'purchased_product_ids', $product_ids );
        }
    }
}



add_action( 'woocommerce_checkout_update_order_meta', 'add_product_id_to_user_meta' );






//checks if the user has purchased a product
function has_purchased_product($user_id, $product_id) {
    // Get the purchased product IDs for the user
    $purchased_product_ids = get_user_meta($user_id, 'purchased_product_ids', true);

    // Check if the product ID is in the purchased product IDs
    if (in_array($product_id, $purchased_product_ids)) {
        return true;
    } else {
        return false;
    }
}





// updates the price
add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 1000, 1);
function add_custom_price( $cart ) {
    // This is necessary for WC 3.0+
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    // Avoiding hook repetition (when using price calculations for example | optional)
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;
    // Loop through cart items
    foreach ( $cart->get_cart() as $cart_item ) {
        if($cart_item['isExclusive'] == 'ex'){
        }else{
            $cart_item['data']->set_price( 500 );
        }
        
    }
}



/**
 * When an item is added to the cart, remove other products
 */
function woo_cart_ensure_only_one_item( $cart_contents ) {
    return array( end( $cart_contents ) );
}
add_filter( 'woocommerce_cart_contents_changed', 'woo_cart_ensure_only_one_item' );





?>