<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Main content area
add_action( 'kbe_template_before_main_content', 'kbe_theme_support_generatepress_main_content_wrapper_start', 55 );
add_action( 'kbe_template_after_main_content', 'kbe_theme_support_generatepress_main_content_wrapper_end', 35 );

// Sidebar
add_action( 'kbe_template_before_sidebar_content', 'kbe_theme_support_generatepress_sidebar_wrapper_start', 25 );
add_action( 'kbe_template_after_sidebar_content', 'kbe_theme_support_generatepress_sidebar_wrapper_end', 15 );


/**
 * Outputs the start of the single article inside wrapper
 *
 */
function kbe_theme_support_generatepress_main_content_wrapper_start() {
	echo '<div class="inside-article">';
}


/**
 * Outputs the end of the single article inside wrapper
 *
 */
function kbe_theme_support_generatepress_main_content_wrapper_end() {
	echo '</div>';
}


/**
 * Outputs the start of the sidebar inside wrapper
 *
 */
function kbe_theme_support_generatepress_sidebar_wrapper_start() {
	echo '<div class="inside-right-sidebar">';
}


/**
 * Outputs the end of the sidebar inside wrapper
 *
 */
function kbe_theme_support_generatepress_sidebar_wrapper_end() {
	echo '</div>';
}