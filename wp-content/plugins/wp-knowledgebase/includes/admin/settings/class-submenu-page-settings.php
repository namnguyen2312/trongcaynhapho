<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class KBE_Submenu_Page_Settings extends KBE_Submenu_Page {

	/**
	 * Helper init method that runs on parent __construct
	 *
	 */
	protected function init() {

		// Settings updated notice
		add_action( 'admin_notices', array( $this, 'output_notice_settings_updated' ) );

		add_action( 'update_option_kbe_plugin_slug', array( $this, 'set_slug_changed' ) );
		add_action( 'update_option_kbe_category_slug', array( $this, 'set_slug_changed' ) );

	}


	/**
	 * Settings updated notice
	 *
	 */
	function output_notice_settings_updated() {

		if( empty( $_GET['page'] ) || $_GET['page'] != 'kbe-settings' )
			return;

		if( empty( $_GET['settings-updated'] ) )
			return;

		// Echo the admin notice
		echo '<div class="notice notice-success is-dismissible">';

			echo '<p><strong>Settings saved!</strong></p>';

	    	echo '<p>' . sprintf( __( 'If your articles are not displaying properly, please navigate to %sSettings &rarr; Permalinks%s. This will refresh the permalinks data and your articles should work properly.', 'wp-knowledgebase' ), '<a href="' . esc_url( admin_url( 'options-permalink.php' ) ) . '">', '</a>' ) . '</p>';

	    echo '</div>';

	}


	/**
	 * Flags that the slug has changed
	 *
	 */
	public function set_slug_changed() {

		update_option( 'kbe_slug_changed', 1 );

	}


	/**
	 * Callback for the HTML output for the Settings page
	 *
	 */
	public function output() {

		// Settings tabs
		$tabs = array(
		    'general' => array(
		        'label' => __( 'General', 'wp-knowledgebase' ),
		        'icon'  => 'cog'
		    )
		);

		/**
		 * Filter settings tabs
		 *
		 * @param array $tabs
		 *
		 */
		$tabs = apply_filters( 'kbe_submenu_page_settings_tabs', $tabs );

		// Include view
		include 'views/view-settings.php';

	}

}