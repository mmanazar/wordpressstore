<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'look' ) ) );

?>

<?php if ( $heading ): ?>
	<!-- <h2><?php echo sanitize_text_field($heading); ?></h2> -->
<?php endif; ?>

<?php the_content(); ?>
