<?php

// Creating the widget
class Look_home_feature_product_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
            // Base ID of your widget
			'home_feature_product_widget',

            // Widget name will appear in UI
			__('Look - Products Widget', 'look'),

            // Widget description
			array( 'description' => __( 'Look Products Widget', 'look' ), )
			);
	}


	public function widget( $args, $instance ) {
		ob_start();
		$file =  THEME_DIR . '/includes/widget/views/feature_product.php';
		require($file);
		echo ob_get_clean();

	}


	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'look' );
		}
		if ( isset( $instance[ 'limit' ] ) ) {
			$limit = $instance[ 'limit' ];
		}
		else {
			$limit = 6;
		}
        $type = 'feature';
        if ( isset( $instance[ 'type' ] ) ) {
            $type = $instance[ 'type' ];
        }
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:','look' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Type:','look' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'Type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>">
                <option <?php echo (esc_attr( $type) == 'feature') ? 'selected':''; ?>  value="feature"><?php _e('Feature Products','look')?></option>
                <option <?php echo (esc_attr( $type ) == 'bestseller') ? 'selected':''; ?>   value="bestseller"><?php _e('Best Seller Products','look')?></option>
                <option <?php echo (esc_attr( $type ) == 'newarrived') ? 'selected':''; ?>   value="newarrived"><?php _e('New Arrivals Products','look')?></option>
                <option <?php echo (esc_attr( $type ) == 'sale') ? 'selected':''; ?>   value="sale"><?php _e('On Sales Products','look')?></option>
            </select>
        </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Limit:','look' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'Limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? (int)$new_instance['limit']  : '0';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? esc_attr( $new_instance['type'] )  : 'feature';
		return $instance;
	}
}

