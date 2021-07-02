<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Remove the main content wrappers
remove_action( 'kbe_template_before_main_content', 'kbe_output_content_wrapper_start', 50 );
remove_action( 'kbe_template_after_main_content', 'kbe_output_content_wrapper_end', 50 );

// Output theme main content wrappers
add_action( 'kbe_template_before_main_content', 'kbe_theme_support_vantage_main_content_wrapper_start', 50 );
add_action( 'kbe_template_after_main_content', 'kbe_theme_support_vantage_main_content_wrapper_end', 50 );


/**
 * Outputs the start of the main content wrapper
 *
 */
function kbe_theme_support_vantage_main_content_wrapper_start() {
	echo '<div id="primary" class="content-area"><div id="content" class="site-content" role="main">';
}


/**
 * Outputs the end of the main content wrapper
 *
 */
function kbe_theme_support_vantage_main_content_wrapper_end() {
	echo '</div></div>';
}