<?php

namespace TFIB\Waitlist\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Waitlist_Ajax {
	public function __construct() {
		add_action( 'wp_ajax_tfib_waitlist_submit', [ $this, 'handle_submit' ] );
		add_action( 'wp_ajax_nopriv_tfib_waitlist_submit', [ $this, 'handle_submit' ] );
	}

	public function handle_submit() : void {
		check_ajax_referer( 'tfib_waitlist_submit', 'nonce' );

		wp_send_json_error( [
			'message' => __( 'Waitlist submission endpoint not implemented yet.', 'waitlist' ),
		] );
	}
}
