<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Includes the files needed for the Settings page
 *
 */
function kbe_include_files_admin_settings() {

	// Get legend admin dir path
	$dir_path = plugin_dir_path( __FILE__ );

	// Include submenu page
	if( file_exists( $dir_path . 'class-submenu-page-settings.php' ) )
		include $dir_path . 'class-submenu-page-settings.php';

}
add_action( 'kbe_include_files', 'kbe_include_files_admin_settings' );


/**
 * Register the Settings admin submenu page
 *
 */
function kbe_register_submenu_page_settings( $submenu_pages ) {

	if( ! is_array( $submenu_pages ) )
		return $submenu_pages;

	$submenu_pages['settings'] = array(
		'class_name' => 'KBE_Submenu_Page_Settings',
		'data' 		 => array(
			'page_title' => __( 'Settings', 'wp-knowledgebase' ),
			'menu_title' => __( 'Settings', 'wp-knowledgebase' ),
			'capability' => apply_filters( 'kbe_submenu_page_capability_settings', 'manage_options' ),
			'menu_slug'  => 'kbe-settings'
		)
	);

	return $submenu_pages;

}
add_filter( 'kbe_register_submenu_page', 'kbe_register_submenu_page_settings', 100 );