<?php

remove_action('woocommerce_before_main_content' , 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop' , 'woocommerce_result_count' , 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta' , 40 );

add_action('woocommerce_after_shop_loop' , 'my_func' , 10);
add_action('woocommerce_before_shop_loop' , 'my_func' , 30);
function my_func(){
    echo 'TEST NAX';
    ?>
    <img src="https://img3.akspic.ru/previews/8/3/3/8/6/168338/168338-nyujork-ulice_nyu_jorka-ulica-manhetten-zdanie-500x.jpg" alt="">
    <?php
}

add_action('woocommerce_single_product_summary' , 'woocom_product_after_title_category', 7);
function woocom_product_after_title_category(){
    global $product;
    echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); 
}

			
add_filter('woocommerce_catalog_orderby', 'woocust_catalog_orderby');
function woocust_catalog_orderby($catalog){
   unset($catalog['popularity']);
   unset($catalog['rating']);
   unset($catalog['date']);

   return $catalog;
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// unset лишнего 
add_filter('woocommerce_checkout_fields' , 'woocoom_checkout_fields');
function woocoom_checkout_fields($fields){
    unset( $fields ['billing']['billing_first_name']);
    unset( $fields ['billing']['billing_country']);
    unset( $fields ['billing']['billing_address_1']);
    unset( $fields ['billing']['billing_last_name']);
    $fields ['state']['priority'] = 91;
    
    echo '<pre>';
     print_r ($fields);
   echo '</pre>';

   return $fields;
}
// меняем местами филды 
add_filter('woocommerce_default_address_fields' , 'woocom_default_adress_fields');
function woocom_default_adress_fields($fields){
    $fields ['state']['priority'] = 100;

    return $fields;
}


?>