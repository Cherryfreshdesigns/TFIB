/**
 * Theme Customizer JS
 *
 * @package TFIB
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // Site title and description
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Primary color
    wp.customize('tfib_primary_color', function(value) {
        value.bind(function(to) {
            $('a, .woocommerce a.button, .woocommerce button.button').css('color', to);
        });
    });

})(jQuery);
