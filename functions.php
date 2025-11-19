<?php
/**
 * The Focus is Betterment Theme Functions
 *
 * @package TFIB
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function tfib_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tfib'),
        'footer' => __('Footer Menu', 'tfib'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'tfib_setup');

/**
 * Set the content width
 */
function tfib_content_width() {
    $GLOBALS['content_width'] = apply_filters('tfib_content_width', 1200);
}
add_action('after_setup_theme', 'tfib_content_width', 0);

/**
 * Register widget areas
 */
function tfib_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'tfib'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'tfib'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 1', 'tfib'),
        'id' => 'footer-1',
        'description' => __('Add widgets here to appear in footer column 1.', 'tfib'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'tfib'),
        'id' => 'footer-2',
        'description' => __('Add widgets here to appear in footer column 2.', 'tfib'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer 3', 'tfib'),
        'id' => 'footer-3',
        'description' => __('Add widgets here to appear in footer column 3.', 'tfib'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'tfib_widgets_init');

/**
 * Enqueue scripts and styles
 */
function tfib_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style('tfib-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue theme script
    wp_enqueue_script('tfib-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tfib_scripts');

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility file
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';
