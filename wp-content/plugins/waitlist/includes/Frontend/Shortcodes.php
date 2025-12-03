<?php

namespace TFIB\Waitlist\Frontend;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Shortcodes {
	public function __construct() {
		add_shortcode( 'tfib_waitlist', [ $this, 'render_waitlist' ] );
		add_shortcode( 'tfib_waitlist_page', [ $this, 'render_waitlist_page' ] );
	}

	public function render_waitlist( $atts = [], $content = '' ) : string {
		ob_start();
		echo '<!-- tfib_waitlist shortcode placeholder -->';
		return ob_get_clean();
	}

	public function render_waitlist_page( $atts = [], $content = '' ) : string {
		ob_start();
		echo '<!-- tfib_waitlist_page shortcode placeholder -->';
		return ob_get_clean();
	}
}
