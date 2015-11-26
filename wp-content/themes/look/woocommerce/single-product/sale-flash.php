<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<span class="sold-out"><?php _e('Sold Out','look')?></span>
<span class="new-arrival"><?php _e('New','look')?></span>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'look' ) . '</span>', $post, $product ); ?>

<?php endif; ?>
