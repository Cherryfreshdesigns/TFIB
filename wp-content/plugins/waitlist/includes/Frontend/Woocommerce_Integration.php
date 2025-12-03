<?php

namespace TFIB\Waitlist\Frontend;

use TFIB\Waitlist\Waitlist_CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woocommerce_Integration {
	public function __construct() {
		// Placeholder hooks: later we will integrate with variation availability and render UI.
		add_action( 'woocommerce_single_product_summary', [ $this, 'maybe_render_placeholder' ], 35 );
	}

	public function maybe_render_placeholder() : void {
		if ( ! is_product() ) {
			return;
		}

		// Temporary stub so we can verify plugin loads without breaking the theme.
		// Actual waitlist UI will be implemented later.
		echo '<!-- TFIB Waitlist placeholder: UI not implemented yet -->';
	}
}
