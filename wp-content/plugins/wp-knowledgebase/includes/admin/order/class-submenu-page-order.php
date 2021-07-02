<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class KBE_Submenu_Page_Order extends KBE_Submenu_Page {

	/**
	 * Callback for the HTML output for the Order page
	 *
	 */
	public function output() {

		include 'views/view-order.php';

	}

}