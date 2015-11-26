<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<dl class="variation">
	<?php
		foreach ( $item_data as $data ) :
			$key = sanitize_text_field( $data['key'] );
	?>
		<dt class="variation-<?php echo sanitize_html_class( $key ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:</dt>
		<dd class="variation-<?php echo sanitize_html_class( $key ); ?>"><?php echo wp_kses_post( wpautop( $data['value'] ) ); ?></dd>
	<?php endforeach; ?>
</dl>
