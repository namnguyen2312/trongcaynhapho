<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Adds custom CSS inline
add_action( 'wp_enqueue_scripts', 'kbe_theme_support_twentynineteen_inline_css', 100 );


/**
 * Adds custom CSS inline
 *
 */
function kbe_theme_support_twentynineteen_inline_css() {

	$css  = 'body.wp-knowledgebase #kbe-wrapper { margin: 0 1rem; max-width: calc(100% - (2 * 1rem)); }';
	$css .= '@media only screen and (min-width: 768px) {
				body.wp-knowledgebase #kbe-wrapper { margin: 0 calc(10% + 60px); max-width: calc(80% - 120px); }
			}';
	$css .= 'body.wp-knowledgebase .entry .entry-header,
			 body.wp-knowledgebase .entry .entry-content {
			 	margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; max-width: 100%;
			 }';
	$css .= 'body.wp-knowledgebase .entry .entry-header { margin-top: 0; }';

	wp_add_inline_style( 'kbe_theme_style', $css );

}