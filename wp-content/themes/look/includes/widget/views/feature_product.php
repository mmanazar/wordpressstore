<?php

$title = apply_filters( 'widget_title', $instance['title'] );

echo (string)$args['before_widget'];
if ( ! empty( $title ) )
{
	echo (string)$args['before_title'] . $title . $args['after_title'];
}
$shortcode = '';
$limit = (int)$instance['limit'];
switch($instance['type'])
{
    case 'feature':
        $shortcode = 'featured_products';
        break;
    case 'bestseller':
        $shortcode = 'best_selling_products';
        break;
    case 'newarrived':
        $shortcode = 'recent_products';
        break;
    case 'sale':
        $shortcode = 'sale_products';
        break;
    default:
        $shortcode = 'featured_products';
        break;
}

echo do_shortcode('['.$shortcode.' per_page="'.$limit.'"]');

?>
<?php echo (string)$args['after_widget']; ?>

