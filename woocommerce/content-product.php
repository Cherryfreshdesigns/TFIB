<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @package TFIB
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product); ?>>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     */
    do_action('woocommerce_before_shop_loop_item');
    ?>

    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         */
        do_action('woocommerce_before_shop_loop_item_title');

        /**
         * Hook: woocommerce_shop_loop_item_title.
         */
        do_action('woocommerce_shop_loop_item_title');

        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         */
        do_action('woocommerce_after_shop_loop_item_title');
        ?>
    </a>

    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     */
    do_action('woocommerce_after_shop_loop_item');
    ?>
</li>
