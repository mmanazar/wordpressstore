<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}
	?>

	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('product-page'); ?>>
		<div class="content-item row">
			<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 row product-info">
				<div class="summary entry-summary">

					<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
            <?php
                $size_guide_img = look_get_option('default_product_size_guide');
                if(get_post_meta(get_the_ID(),'_product_size_guide',true) != '')
                {
                    $size_guide_img = get_post_meta(get_the_ID(),'_product_size_guide',true);
                }
            ?>
            <?php if(look_get_option('enable_product_size_guide') && $size_guide_img != ''):?>

			<div class="size-guide"><a href="javascript:void(0);" data-target="#sizeModal" data-toggle="modal" class="btn-modal"><?php _e('Size Guide','look')?></a></div>
			<?php endif; ?>
			<?php look_social_share(); ?>



		</div><!-- .summary -->

	</div>
</div>
<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />
		
	</div><!-- #product-<?php the_ID(); ?> -->

	<?php do_action( 'woocommerce_after_single_product' ); ?>

<?php if(look_get_option('enable_product_size_guide') && $size_guide_img != ''):?>
	<section id="sizeModal" class="modal fade" aria-hidden="false" aria-labelledby="sizeModalLabel" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<button class="close" aria-label="Close" data-dismiss="modal" type="button">
					<span aria-hidden="true">&#xD7;</span>
				</button>
				<div class="content-item">
					<img src="<?php echo $size_guide_img; ?>" alt="<?php _e('Size Chart','look')?>" width="838"/>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

