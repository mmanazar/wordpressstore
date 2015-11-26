<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
	);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

<div class="upsells products">
	<div class="text-heading">
		<h2 class="module-title"><span><?php _e( 'You may also like&hellip;', 'look' ) ?></span></h2>
	</div>
	<?php woocommerce_product_loop_start(); ?>

	<?php while ( $products->have_posts() ) : $products->the_post(); ?>

		<?php global $look_quickview; $look_quickview = 'no'; wc_get_template_part( 'content', 'product' ); ?>

	<?php endwhile; // end of the loop. ?>

	<?php woocommerce_product_loop_end(); ?>

</div>

<?php endif;

wp_reset_postdata();
