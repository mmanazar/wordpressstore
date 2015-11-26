<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'look' ) );

?>

<?php if ( $heading ): ?>
	<!-- <h2><?php echo sanitize_text_field($heading); ?></h2> -->
<?php endif; ?>

<?php $product->list_attributes(); ?>
