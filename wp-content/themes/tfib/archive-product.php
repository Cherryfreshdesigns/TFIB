<?php
/**
 * TFIB custom WooCommerce shop / archive template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' ); ?>

<div class="tfib-shop-wrapper">
	<div class="tfib-shop-header">
		<?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
			<nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
			</nav>
		<?php endif; ?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<?php
			// Show page title with product count, e.g. "Shop (13)".
			global $wp_query;
			$count = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
			?>
			<div class="tfib-shop-header-title">
				<h1 class="woocommerce-products-header__title page-title">
					<?php woocommerce_page_title(); ?><?php if ( $count > 0 ) : ?> <span class="tfib-product-count">(<?php echo esc_html( $count ); ?>)</span><?php endif; ?>
				</h1>
			</div>
		<?php endif; ?>

		<div class="tfib-shop-header-controls">
			<button class="tfib-filter-offcanvas-toggle" type="button" data-target="#tfib-filters">
				<span class="tfib-filter-label"><?php esc_html_e( 'Hide Filters', 'tfib' ); ?></span>
				<span class="tfib-filter-icon" aria-hidden="true"></span>
			</button>

			<div class="tfib-shop-header-sort">
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>
	</div>

	<div class="tfib-shop-layout">
		<aside class="tfib-shop-sidebar">
			<button class="tfib-shop-filters-toggle" type="button" data-target="#tfib-filters">
				<span><?php esc_html_e( 'Filters', 'tfib' ); ?></span>
			</button>

			<div id="tfib-filters" class="tfib-shop-filters">
				<?php if ( is_active_sidebar( 'tfib-shop-filters' ) ) : ?>
					<?php dynamic_sidebar( 'tfib-shop-filters' ); ?>
				<?php else : ?>
					<p class="tfib-no-filters">
						<?php esc_html_e( 'Add filters to the “TFIB Shop Filters” widget area to display them here.', 'tfib' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</aside>

		<main class="tfib-shop-main">
			<?php if ( woocommerce_product_loop() ) : ?>
				<?php do_action( 'woocommerce_before_main_content' ); ?>

				<?php do_action( 'woocommerce_archive_description' ); ?>

				<?php do_action( 'woocommerce_before_shop_loop' ); ?>

				<div class="tfib-products-grid">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				</div>

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

				<?php do_action( 'woocommerce_after_main_content' ); ?>
			<?php else : ?>
				<?php do_action( 'woocommerce_no_products_found' ); ?>
			<?php endif; ?>
		</main>
	</div>
</div>

<?php
get_footer( 'shop' );
