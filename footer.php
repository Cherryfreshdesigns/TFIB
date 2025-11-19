<?php
/**
 * The template for displaying the footer
 *
 * @package TFIB
 * @since 1.0.0
 */

?>

        </div><!-- .site-container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-container">
            <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
                <div class="footer-widgets">
                    <div class="footer-widget-area">
                        <?php if (is_active_sidebar('footer-1')) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('footer-2')) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('footer-3')) : ?>
                            <div class="footer-widget-column">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="site-info">
                <?php
                printf(
                    esc_html__('&copy; %1$s %2$s. All rights reserved.', 'tfib'),
                    date('Y'),
                    get_bloginfo('name')
                );
                ?>
                <span class="sep"> | </span>
                <?php
                printf(
                    esc_html__('Theme: %1$s by %2$s.', 'tfib'),
                    'The Focus is Betterment',
                    '<a href="https://github.com/Cherryfreshdesigns">Cherry Fresh Designs</a>'
                );
                ?>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
