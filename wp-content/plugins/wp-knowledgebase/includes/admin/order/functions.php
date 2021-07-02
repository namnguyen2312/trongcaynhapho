<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Includes the files needed for the Order page
 *
 */
function kbe_include_files_admin_order() {

	// Get legend admin dir path
	$dir_path = plugin_dir_path( __FILE__ );

	// Include submenu page
	if( file_exists( $dir_path . 'class-submenu-page-order.php' ) )
		include $dir_path . 'class-submenu-page-order.php';

}
add_action( 'kbe_include_files', 'kbe_include_files_admin_order' );


/**
 * Register the Order admin submenu page
 *
 */
function kbe_register_submenu_page_order( $submenu_pages ) {

	if( ! is_array( $submenu_pages ) )
		return $submenu_pages;

	$submenu_pages['order'] = array(
		'class_name' => 'KBE_Submenu_Page_Order',
		'data' 		 => array(
			'page_title' => __( 'Order', 'wp-knowledgebase' ),
			'menu_title' => __( 'Order', 'wp-knowledgebase' ),
			'capability' => apply_filters( 'kbe_submenu_page_capability_order', 'manage_options' ),
			'menu_slug'  => 'kbe-order'
		)
	);

	return $submenu_pages;

}
add_filter( 'kbe_register_submenu_page', 'kbe_register_submenu_page_order', 30 );