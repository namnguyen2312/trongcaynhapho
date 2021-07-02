<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class KBE_Migration_1_3_1
 *
 * Migration that runs when updating to version 1.3.1
 *
 */
class KBE_Migration_1_3_1 extends KBE_Abstract_Migration {

	/**
	 * Constructor.
	 *
	 */
	public function __construct() {

		// Force notice type to be none, even though we'll still forcely show the admin notice for existing users
		$this->id          = 'kbe-install-1-3-1';
		$this->notice_type = 'none';

		parent::__construct();

	}


	/**
	 * Checks whether the current instance is a fresh install
	 *
	 * @return bool
	 *
	 */
	public function is_fresh_install() {

		// Make sure the migration notice is shown only for existing users
		$plugin_prev_version = get_option( 'kbe_previous_version', '' );
		$wp_posts_count 	 = wp_count_posts( KBE_POST_TYPE );

		if( empty( $plugin_prev_version ) && empty( $wp_posts_count->publish ) )
			return true;

		return false;

	}


	/**
	 * Actually run the migration.
	 *
	 */
	public function migrate() {

		if( ! $this->is_fresh_install() )
			return;

		update_option( 'kbe_show_page_getting_started', 1 );

	}

}