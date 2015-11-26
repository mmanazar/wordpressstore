<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $look_quickview;
global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<?php if(look_get_option('product_listing')== 2): ?>
	<li <?php post_class( 'grid-item col-lg-6 col-md-6 col-sm-6 col-xs-12' ); ?>>
<?php elseif(look_get_option('product_listing')== 3): ?>
	<li <?php post_class( 'grid-item col-lg-4 col-md-4 col-sm-6 col-xs-12' ); ?>>
<?php else: ?>
	<li <?php post_class( 'grid-item col-lg-3 col-md-3 col-sm-6 col-xs-12' ); ?>>
<?php endif ?>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="item-wrap">
        <?php if(!isset($look_quickview) || $look_quickview != 'no'): ?>
		<a class="quick-view"  href="javascript:void(0);"  product-data="<?php echo esc_attr($product->id); ?>" data-target="#myModal"><?php _e('+ Quick View','look')?></a>
		<?php endif; ?>
        <span class="sold-out"><?php _e('Sold Out','look')?></span>
		<span class="new-arrival"><?php _e('New','look')?></span>
		<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>


				<div class="item-info">
					<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>




				<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

		?>
	</div>
</li>
