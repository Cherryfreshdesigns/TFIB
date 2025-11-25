<?php
/**
 * Template part for displaying post content in TFIB child theme.
 *
 * This simple template ensures themes call `the_content()` so page builders
 * like Elementor can find and render the content area in the editor.
 *
 * Place this file at `template-parts/content.php` so `get_template_part()`
 * used in `index.php` will find it.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_singular() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php
		// THIS is critical for Elementor and other page builders: use the_content()
		the_content();
		?>
	</div>

	<footer class="entry-footer">
		<?php
		// Optional: edit link for logged-in users
		edit_post_link( esc_html__( 'Edit', 'tfib' ), '<span class="edit-link">', '</span>' );
		?>
	</footer>
</article>
