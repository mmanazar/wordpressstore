<?php
/**
 * Customer note email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( "Hello, a note has just been added to your order:", 'look' ); ?></p>

<blockquote><?php echo wpautop( wptexturize( $customer_note ) ) ?></blockquote>

<p><?php _e( "For your reference, your order details are shown below.", 'look' ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<h2><?php printf( __( 'Order #%s', 'look' ), $order->get_order_number() ); ?></h2>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #111;" border="1" bordercolor="#111">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #111;"><?php _e( 'Product', 'look' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #111;"><?php _e( 'Quantity', 'look' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #111;"><?php _e( 'Price', 'look' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo (string)$order->email_order_items_table( $order->is_download_permitted(), true ); ?>
	</tbody>
	<tfoot>
		<?php
		if ( $totals = $order->get_order_item_totals() ) {
			$i = 0;
			foreach ( $totals as $total ) {
				$i++;
				?><tr>
				<th scope="row" colspan="2" style="text-align:left; border: 1px solid #111; <?php if ( $i == 1 ) echo 'border-top-width: 1px;'; ?>"><?php echo (string)$total['label']; ?></th>
				<td style="text-align:left; border: 1px solid #111; <?php if ( $i == 1 ) echo 'border-top-width: 1px;'; ?>"><?php echo (string)$total['value']; ?></td>
			</tr><?php
		}
	}
	?>
</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
