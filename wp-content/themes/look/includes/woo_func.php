<?php

//Declare WooCommerce support
add_action( 'after_setup_theme', 'look_woocommerce_support' );
function look_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}


//breadcrumb
add_filter( 'woocommerce_breadcrumb_defaults', 'look_change_breadcrumb_delimiter' );
function look_change_breadcrumb_delimiter( $defaults ) {
// Change the breadcrumb delimeter from '/' to '->'
	$defaults['delimiter'] = ' &nbsp;&nbsp;&rarr;&nbsp; ';
	return $defaults;
}

// product search
add_filter( 'get_product_search_form' , 'look_wc_product_searchform' );
function look_wc_product_searchform( $form ) {
	$form = '
	<form class="look-product-search mini-search" role="search" method="get" action="' . esc_url( home_url( '/'  ) ) . '">
		<input class="search-field" type="text" value="' . esc_attr( get_search_query() ) . '" name="s" placeholder="' . __( 'Search products...', 'look' ) . '" />
		<input type="submit" value="'.__( 'Search','look' ).'" class="hidden" />
		<input type="hidden" name="post_type" value="product" />
	</form>';
	return $form;
}


//Product detail
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing');

add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55);


// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//NUMBER OF PRODUCTS TO DISPLAY ON SHOP PAGE


if(!function_exists('look_shop_per_page'))
{
    function look_shop_per_page()
    {
       return (int)look_get_option('loop_shop_per_page');
    }
}
add_filter('loop_shop_per_page','look_shop_per_page');


$preview = THEME_DIR . '/woocommerce/emails/woo-preview-emails.php';

if(file_exists($preview)) {
	require $preview;
}

// attribute filter

add_action('woocommerce_product_query','look_woocommerce_product_query',55);

function look_woocommerce_product_query($q)
{
    global $wpdb;
    $attrs_setting = look_get_option('look_attribute_filters');
    $attrs = array();
    if(is_array($attrs_setting))
    {
        foreach($attrs_setting as $k => $a)
        {
            if($a == 1)
            {
                $attrs[] = $k;
            }

        }

    }
    $post_in = array();
    $check = false;

    foreach($_REQUEST as $key => $val)
    {
        if(in_array($key,$attrs) && $val != '')
        {
            $meta_key = esc_attr('attribute_'.$key);
            $meta_value = esc_attr(sanitize_title($val));
            $sql = "SELECT post.post_parent FROM ".$wpdb->postmeta." meta LEFT JOIN ".$wpdb->posts." post ON meta.post_id = post.ID WHERE meta_key = '".$meta_key."' AND meta_value = '".$meta_value."'";
            $rows = $wpdb->get_results( $sql,ARRAY_A );
            foreach($rows as $row)
            {
                $post_in[] = $row['post_parent'];
            }
            $check = true;
        }

    }

    if(isset($_REQUEST['min_price']) && $_REQUEST['max_price'] != '')
    {
        if(!empty($post_in))
        {
            $post_in = WC()->query->price_filter($post_in);
        }else{

            $post_in = WC()->query->price_filter();
        }
    }

    if(!empty($post_in))
    {
        $q->set( 'post__in',$post_in );
    }else{
        if($check)
        {
            $sql = "SELECT ID FROM ".$wpdb->posts."  WHERE post_type = 'product' AND post_status = 'publish' ";
            $rows = $wpdb->get_results( $sql,ARRAY_A );
            foreach($rows as $row)
            {
                $post_in[] = $row['ID'];
            }
            $q->set( 'post__in',$post_in );
        }
    }


}



add_action('wp_enqueue_scripts', 'look_woo_assets');
function look_woo_assets()
{
    $suffix               = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    $assets_path          = str_replace( array( 'http:', 'https:' ), '', plugins_url().'/woocommerce' ) . '/assets/';
    wp_register_script( 'prettyPhoto', $assets_path . 'js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), '3.1.6', true );
    wp_register_script( 'prettyPhoto-init', $assets_path . 'js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery','prettyPhoto' ) );
    wp_enqueue_style( 'woocommerce_prettyPhoto_css', $assets_path . 'css/prettyPhoto.css' );
    wp_enqueue_script('prettyPhoto');
    wp_enqueue_script('prettyPhoto-init');
}

