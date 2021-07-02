<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class KBE_Submenu_Page_Getting_Started extends KBE_Submenu_Page {

	/**
	 * Helper init method that runs on parent __construct
	 *
	 */
	protected function init() {

	}


	/**
	 * Callback for the HTML output for the Settings page
	 *
	 */
	public function output() {

		// Include view
		include 'views/view-getting-started.php';

	}

}