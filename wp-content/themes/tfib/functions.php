<?php
/**
 * TFIB Theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Theme setup
function tfib_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'custom-logo' );

	// Elementor compatibility
	add_theme_support( 'elementor-location-experiment', [
		'header',
		'footer',
		'single',
		'archive',
	] );
}
add_action( 'after_setup_theme', 'tfib_theme_setup' );

// Enqueue styles and scripts
function tfib_enqueue_assets() {
	$theme       = wp_get_theme();
	$parent_slug = $theme->Template; // hello-elementor
	$version     = $theme->get( 'Version' );

	// Make sure parent Hello stylesheet is loaded first
	if ( $parent_slug && wp_get_theme( $parent_slug )->exists() ) {
		wp_enqueue_style( 'hello-elementor', get_template_directory_uri() . '/style.css', [], wp_get_theme( $parent_slug )->get( 'Version' ) );
	}

	// Child theme main stylesheet
	wp_enqueue_style( 'tfib-style', get_stylesheet_uri(), [ 'hello-elementor' ], $version );
	wp_enqueue_style( 'tfib-woocommerce', get_stylesheet_directory_uri() . '/assets/css/woocommerce.css', [ 'tfib-style' ], $version );

	wp_enqueue_script( 'tfib-filters', get_stylesheet_directory_uri() . '/assets/js/filters.js', [ 'jquery' ], $version, true );
}
add_action( 'wp_enqueue_scripts', 'tfib_enqueue_assets', 20 );

// Disable default WooCommerce styles so we can fully override
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove default WooCommerce breadcrumb from main content; we render breadcrumb in header instead
add_action( 'init', function() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
} );

// Register widget area for TFIB shop filters sidebar
function tfib_register_sidebars() {
	register_sidebar( [
		'name'          => __( 'TFIB Shop Filters', 'tfib' ),
		'id'            => 'tfib-shop-filters',
		'before_widget' => '<div class="tfib-filter-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	] );
}
add_action( 'widgets_init', 'tfib_register_sidebars' );

// Customize WooCommerce catalog ordering labels
function tfib_customize_woocommerce_orderby( $sortby ) {
	// Map WooCommerce keys to custom labels
	if ( isset( $sortby['menu_order'] ) ) {
		$sortby['menu_order'] = __( 'Sort By', 'tfib' );
	}
	if ( isset( $sortby['date'] ) ) {
		$sortby['date'] = __( 'Newest', 'tfib' );
	}
	if ( isset( $sortby['price'] ) ) {
		$sortby['price'] = __( 'Price: Low to High', 'tfib' );
	}
	if ( isset( $sortby['price-desc'] ) ) {
		$sortby['price-desc'] = __( 'Price: High to Low', 'tfib' );
	}
	if ( isset( $sortby['popularity'] ) ) {
		$sortby['popularity'] = __( 'Most Popular', 'tfib' );
	}
	if ( isset( $sortby['rating'] ) ) {
		$sortby['rating'] = __( 'Top Rated', 'tfib' );
	}

	return $sortby;
}
add_filter( 'woocommerce_catalog_orderby', 'tfib_customize_woocommerce_orderby' );

/**
 * Klarna promo shortcode.
 * Usage: [tfib_klarna_promo]
 
function tfib_klarna_promo_shortcode() {
    ob_start();
    ?>
    <div class="tfib-klarna-promo">
        Pay in 4 interest-free payments with Klarna. <a href="#">Learn more</a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'tfib_klarna_promo', 'tfib_klarna_promo_shortcode' );*/