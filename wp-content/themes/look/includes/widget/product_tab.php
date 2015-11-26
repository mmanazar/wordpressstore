<?php

// Creating the widget
class Look_product_tab_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'look_product_tab_widget',

            // Widget name will appear in UI
            __('Look - Products Tab Widget', 'look'),

            // Widget description
            array( 'description' => __( 'Look Products Tab Widget', 'look' ), )
        );
    }


    public function widget( $args, $instance ) {
        $types = json_decode($instance['type']);
        $limit = (int)$instance['limit'];
        if(!empty($types)) {
            $tabs = array();
            foreach($types as $type)
            {
                switch($type)
                {
                    case 'feature':
                        $tabs[] = array(
                            'title' => __('Featured','look'),
                            'shortcode' => 'featured_products'
                        );
                        break;
                    case 'bestseller':
                        $tabs[] = array(
                            'title' => __('Best Seller','look'),
                            'shortcode' => 'best_selling_products'
                        );
                        break;
                    case 'newarrived':
                        $tabs[] = array(
                            'title' => __('New arrivals','look'),
                            'shortcode' => 'recent_products'
                        );
                        break;
                    case 'sale':
                        $tabs[] = array(
                            'title' => __('Sale','look'),
                            'shortcode' => 'sale_products'
                        );
                        break;
                }
            }
            ?>
            <div class="product-tab">
                <!-- Nav tabs -->
                <div class="tablist">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach($tabs as $key => $tab): ?>
                        <li role="<?php echo $tab['shortcode']; ?>" class="<?php if($key == 0): ?>active  <?php endif; ?>">
                            <a href="#<?php echo $tab['shortcode']; ?>" aria-controls="<?php echo $tab['shortcode']; ?>" role="tab" data-toggle="tab"><?php echo $tab['title']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php foreach($tabs as $key => $tab): ?>
                        <div role="tabpanel" class="tab-pane <?php echo $tab['shortcode']; ?> fade in <?php if($key == 0): ?>active  <?php endif; ?>" id="<?php echo $tab['shortcode']; ?>">
                            <p><?php echo do_shortcode('['.$tab['shortcode'].' per_page="'.$limit.'"]'); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
        }
    }


    public function form( $instance ) {


        if ( isset( $instance[ 'limit' ] ) ) {
            $limit = $instance[ 'limit' ];
        }
        else {
            $limit = 6;
        }
        $type = array();
        if ( isset( $instance[ 'type' ] )) {
            $type = (array)json_decode($instance[ 'type' ]);

        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Type:','look' ); ?></label>
            <p><input type="checkbox" <?php echo in_array('feature',$type) ? 'checked':''; ?>  name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>[]"  value="feature"/><?php _e('Feature Products','look')?></p>
            <p><input type="checkbox" <?php echo in_array('bestseller',$type) ? 'checked':''; ?>  name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>[]" value="bestseller"/><?php _e('Best Seller Products','look')?></p>
            <p><input type="checkbox" <?php echo in_array('newarrived',$type) ? 'checked':''; ?>  name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>[]"  value="newarrived"/><?php _e('New Arrivals Products','look')?></p>
            <p><input type="checkbox" <?php echo in_array('sale',$type) ? 'checked':''; ?>  name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>[]"  value="sale"/><?php _e('On Sales Products','look')?></p>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Limit:','look' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'Limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? (int)$new_instance['limit']  : '0';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ?  json_encode($new_instance['type'])  : json_encode(array());
        return $instance;
    }
}

