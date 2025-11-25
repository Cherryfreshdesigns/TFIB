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
	// Force CSS cache bust with manual version number
	wp_enqueue_style( 'tfib-woocommerce', get_stylesheet_directory_uri() . '/assets/css/woocommerce.css', [ 'tfib-style' ], '1.0.5' );

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
 * Filter WooCommerce Shipping Rates to Limit Options
 */
add_filter( 'woocommerce_package_rates', 'tfib_filter_shipping_rates', 100, 2 );
function tfib_filter_shipping_rates( $rates, $package ) {
	// Keywords to include - if a shipping option contains ANY of these, it will be shown
	$include_keywords = [
		'stamps.com',    // Stamps.com (USPS) options
		// 'ups',        // UPS options - Disabled for now
		// 'fedex',      // Uncomment to add FedEx options
	];
	
	// Keywords to exclude - these will be filtered out even if they match include
	$exclude_keywords = [
		'media mail',       // Exclude Media Mail (books/media only)
		'parcel select',    // Exclude slower Parcel Select
		'first class',      // Exclude First Class Mail
		'ground advantage', // Exclude Ground Advantage
	];
	
	$filtered_rates = [];
	
	foreach ( $rates as $rate_id => $rate ) {
		// Get the service name from the label
		$label = strtolower( $rate->label );
		
		// Check if this rate should be excluded based on keywords
		$should_exclude = false;
		foreach ( $exclude_keywords as $keyword ) {
			if ( stripos( $label, $keyword ) !== false ) {
				$should_exclude = true;
				break;
			}
		}
		
		// Check if this rate should be included based on keywords
		$should_include = false;
		foreach ( $include_keywords as $keyword ) {
			if ( stripos( $label, $keyword ) !== false ) {
				$should_include = true;
				break;
			}
		}
		
		// Add to filtered rates if included and not excluded
		if ( $should_include && ! $should_exclude ) {
			$filtered_rates[ $rate_id ] = $rate;
		}
	}
	
	// Return filtered rates (or all rates if filtering resulted in empty array)
	return ! empty( $filtered_rates ) ? $filtered_rates : $rates;
}

/**
 * Remove "Customer matched zone" notices from checkout
 */
add_filter( 'woocommerce_add_message', 'tfib_remove_zone_matching_notices' );
function tfib_remove_zone_matching_notices( $message ) {
	// Remove "Customer matched zone" messages
	if ( stripos( $message, 'Customer matched zone' ) !== false ) {
		return '';
	}
	return $message;
}

/**
 * Clean up shipping rate labels - remove carrier prefixes
 */
add_filter( 'woocommerce_cart_shipping_method_full_label', 'tfib_clean_shipping_labels', 10, 2 );
function tfib_clean_shipping_labels( $label, $method ) {
	// Remove "Stamps.com " prefix from USPS labels
	$label = str_replace( 'Stamps.com ', '', $label );
	
	// You can add more replacements here if needed for other carriers
	// Example: $label = str_replace( 'UPS ', '', $label );
	
	return $label;
}

/**
 * Customize "Added to Cart" message to include product name
 */
add_filter( 'wc_add_to_cart_message_html', 'tfib_custom_add_to_cart_message', 10, 2 );
function tfib_custom_add_to_cart_message( $message, $products ) {
	$titles = [];
	$count = 0;

	foreach ( $products as $product_id => $qty ) {
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$titles[] = sprintf(
				'<span class="product-name">%s</span>',
				$product->get_name()
			);
			$count += $qty;
		}
	}

	$titles_string = implode( ', ', $titles );
	
	$message = sprintf(
		'<div class="woocommerce-message-content"><strong>Added to Cart</strong>%s</div><a href="%s" class="button wc-forward">View Cart</a>',
		$titles_string,
		esc_url( wc_get_cart_url() )
	);

	return $message;
}

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