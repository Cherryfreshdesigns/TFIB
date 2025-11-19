<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TFIB
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'tfib'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'tfib'); ?></p>

                <?php
                get_search_form();

                if (class_exists('WooCommerce')) :
                    ?>

                    <div class="widget widget_products">
                        <h2 class="widget-title"><?php esc_html_e('Featured Products', 'tfib'); ?></h2>
                        <?php
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 4,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field' => 'name',
                                    'terms' => 'featured',
                                )
                            )
                        );
                        $loop = new WP_Query($args);
                        if ($loop->have_posts()) {
                            echo '<ul class="products">';
                            while ($loop->have_posts()) : $loop->the_post();
                                wc_get_template_part('content', 'product');
                            endwhile;
                            echo '</ul>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div>

                <?php endif; ?>

            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
