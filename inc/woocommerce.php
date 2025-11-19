<?php
/**
 * WooCommerce Compatibility File
 *
 * @package TFIB
 * @since 1.0.0
 */

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrappers
 */
add_action('woocommerce_before_main_content', 'tfib_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'tfib_wrapper_end', 10);

function tfib_wrapper_start() {
    echo '<div id="primary" class="content-area">';
    echo '<main id="main" class="site-main">';
}

function tfib_wrapper_end() {
    echo '</main><!-- #main -->';
    echo '</div><!-- #primary -->';
}

/**
 * Declare WooCommerce support
 */
function tfib_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'tfib_woocommerce_support');

/**
 * Customize WooCommerce product columns
 */
function tfib_loop_columns() {
    return 3; // 3 products per row
}
add_filter('loop_shop_columns', 'tfib_loop_columns');

/**
 * Products per page
 */
function tfib_loop_shop_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'tfib_loop_shop_per_page', 20);

/**
 * Add cart icon to header
 */
function tfib_woocommerce_cart_link() {
    ?>
    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'tfib'); ?>">
        <?php
        $item_count_text = sprintf(
            _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'tfib'),
            WC()->cart->get_cart_contents_count()
        );
        ?>
        <span class="cart-count"><?php echo esc_html($item_count_text); ?></span>
        <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
    </a>
    <?php
}

/**
 * Update cart count via AJAX
 */
function tfib_add_to_cart_fragment($fragments) {
    ob_start();
    tfib_woocommerce_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'tfib_add_to_cart_fragment');
