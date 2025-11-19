<?php
/**
 * Theme Customizer
 *
 * @package TFIB
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tfib_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'tfib_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'tfib_customize_partial_blogdescription',
        ));
    }

    // Add theme color setting
    $wp_customize->add_setting('tfib_primary_color', array(
        'default' => '#0066cc',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tfib_primary_color', array(
        'label' => __('Primary Color', 'tfib'),
        'section' => 'colors',
    )));
}
add_action('customize_register', 'tfib_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function tfib_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function tfib_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tfib_customize_preview_js() {
    wp_enqueue_script('tfib-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0.0', true);
}
add_action('customize_preview_init', 'tfib_customize_preview_js');
