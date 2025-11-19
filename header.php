<?php
/**
 * The header for our theme
 *
 * @package TFIB
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'tfib'); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-container">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) :
                    the_custom_logo();
                else :
                    ?>
                    <div class="site-identity">
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                        $tfib_description = get_bloginfo('description', 'display');
                        if ($tfib_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $tfib_description; ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                endif;
                ?>

                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="header-cart">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-contents">
                            <?php echo WC()->cart->get_cart_contents_count(); ?> items - <?php echo WC()->cart->get_cart_total(); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'fallback_cb' => false,
                ));
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="site-content">
        <div class="site-container">
