<?php
/**
 * TFIB product card template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<li <?php wc_product_class( 'tfib-product-card', $product ); ?>>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="<?php the_permalink(); ?>">
		<?php
		/**
		 * Product thumbnail
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>

		<?php
		/**
		 * Price / rating
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>
