<?php
/**
 * TFIB child theme fallback index.
 *
 * As a Hello Elementor child theme, most layout is handled by Elementor
 * templates, but WordPress still requires an index.php file.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	endwhile;
else :
	echo '<p>' . esc_html__( 'No content found.', 'tfib' ) . '</p>';
endif;

get_footer();
