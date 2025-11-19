/**
 * Theme JavaScript
 *
 * @package TFIB
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Mobile menu toggle
        var mobileMenuToggle = $('<button class="mobile-menu-toggle" aria-label="Toggle Menu"><span></span><span></span><span></span></button>');
        $('.main-navigation').prepend(mobileMenuToggle);

        mobileMenuToggle.on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation ul').slideToggle();
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Back to top button
        var backToTop = $('<a href="#" class="back-to-top" aria-label="Back to Top">↑</a>');
        $('body').append(backToTop);

        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                backToTop.fadeIn();
            } else {
                backToTop.fadeOut();
            }
        });

        backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
        });
    });

})(jQuery);
