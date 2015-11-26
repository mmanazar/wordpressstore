<?php
/**
 * Edit address form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'look' ) : __( 'Shipping Address', 'look' );

get_currentuserinfo();

?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<form method="post">

		<div class="text-heading">
			<h2 class="module-title"><span><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></span></h2>
		</div>

		<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

		<?php foreach ( $address as $key => $field ) : ?>

			<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

		<?php endforeach; ?>

		<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

		<div class="submit-btn">
			<input type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save Address', 'look' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
			<input type="hidden" name="action" value="edit_address" />
		</div>

	</form>

<?php endif; ?>
