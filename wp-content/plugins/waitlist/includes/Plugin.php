<?php

namespace TFIB\Waitlist;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {
	/** @var Plugin */
	protected static $instance;

	public static function instance() : Plugin {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct() {
		$this->define_constants();
		$this->init_hooks();
	}

	protected function define_constants() : void {
		define( 'TFIB_WAITLIST_VERSION', '0.1.0' );
		define( 'TFIB_WAITLIST_PLUGIN_FILE', dirname( __DIR__ ) . '/waitlist.php' );
		define( 'TFIB_WAITLIST_PLUGIN_DIR', plugin_dir_path( TFIB_WAITLIST_PLUGIN_FILE ) );
		define( 'TFIB_WAITLIST_PLUGIN_URL', plugin_dir_url( TFIB_WAITLIST_PLUGIN_FILE ) );
	}

	protected function init_hooks() : void {
		// Core components.
		new Admin\Menu();
		new Admin\Settings();
		new Admin\Entries_List();

		new Frontend\Assets();
		new Frontend\Woocommerce_Integration();
		new Frontend\Shortcodes();
		new Frontend\Countdown();

		new Ajax\Waitlist_Ajax();
		new Mailchimp\Integration();

		new Waitlist_CPT();
	}
}
