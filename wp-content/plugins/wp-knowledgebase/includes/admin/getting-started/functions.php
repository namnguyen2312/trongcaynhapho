<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Includes the files needed for the Getting Started page
 *
 */
function kbe_include_files_admin_getting_started() {

	// Get legend admin dir path
	$dir_path = plugin_dir_path( __FILE__ );

	// Include AJAX actions
	if( file_exists( $dir_path . 'functions-actions-ajax.php' ) )
		include $dir_path . 'functions-actions-ajax.php';

	// Include submenu page
	if( file_exists( $dir_path . 'class-submenu-page-getting-started.php' ) )
		include $dir_path . 'class-submenu-page-getting-started.php';

}
add_action( 'kbe_include_files', 'kbe_include_files_admin_getting_started' );


/**
 * Register the Getting Started admin submenu page
 *
 */
function kbe_register_submenu_page_getting_started( $submenu_pages ) {

	if( ! is_array( $submenu_pages ) )
		return $submenu_pages;

	if( ! kbe_get_option( 'show_page_getting_started' ) )
		return $submenu_pages;

	$submenu_pages['getting_started'] = array(
		'class_name' => 'KBE_Submenu_Page_Getting_Started',
		'data' 		 => array(
			'page_title' => __( 'Getting Started', 'wp-knowledgebase' ),
			'menu_title' => __( 'Getting Started', 'wp-knowledgebase' ),
			'capability' => apply_filters( 'kbe_submenu_page_capability_getting_started', 'manage_options' ),
			'menu_slug'  => 'kbe-getting-started',
			'position'	 => -10
		)
	);

	return $submenu_pages;

}
add_filter( 'kbe_register_submenu_page', 'kbe_register_submenu_page_getting_started', 1 );


/**
 * Redirects the admin to the setup wizard when they activate WP Knowledgebase
 *
 */
function kbe_activated_redirect_to_page_getting_started() {

	if( false === get_transient( '_kbe_activated' ) )
		return;

	if( wp_doing_ajax() )
		return;

	if( is_network_admin() )
		return;

	if( isset( $_GET['activate-multi'] ) )
		return;

	if( ! kbe_get_option( 'show_page_getting_started' ) )
		return;

	$finished_lessons = kbe_get_option( 'getting_started_finished_lessons', array() );

	if( ! empty( $finished_lessons ) )
		return;

	// Remove the just activated transient
	delete_transient( '_kbe_activated' );

	// Redirect to setup wizard
	wp_redirect( add_query_arg( array( 'post_type' => KBE_POST_TYPE, 'page' => 'kbe-getting-started' ), admin_url( 'edit.php' ) ) );
	die();

}
add_action( 'admin_init', 'kbe_activated_redirect_to_page_getting_started' );


/**
 * Hides the getting started page
 *
 */
function kbe_admin_action_hide_page_getting_started() {

	if( empty( $_GET['kbe_token'] ) || ! wp_verify_nonce( $_GET['kbe_token'], 'kbe_hide_page_getting_started' ) )
		return;

	delete_option( 'kbe_show_page_getting_started', 1 );

	wp_redirect( remove_query_arg( array( 'kbe_token', 'kbe_action' ) ) );
	exit;

}
add_action( 'kbe_admin_action_hide_page_getting_started', 'kbe_admin_action_hide_page_getting_started' );


/**
 * For some reason the main admin menu redirects to "admin.php?page=kbe-getting-started", instead of
 * to the "edit.php?post_type=kbe_knowledgebase&page=kbe-getting-started" link
 *
 * This function is a workaround to for the previous link to redirect to the correct one
 *
 */
function kbe_redirect_main_plugin_menu_to_page_getting_started() {

	global $pagenow;

	if( $pagenow != 'admin.php' )
		return;

	if( empty( $_GET['page'] ) || $_GET['page'] != 'kbe-getting-started' )
		return;

	wp_redirect( add_query_arg( array( 'post_type' => KBE_POST_TYPE, 'page' => 'kbe-getting-started' ), admin_url( 'edit.php' ) ) );
	exit;

}
add_action( 'admin_init', 'kbe_redirect_main_plugin_menu_to_page_getting_started', 100 );