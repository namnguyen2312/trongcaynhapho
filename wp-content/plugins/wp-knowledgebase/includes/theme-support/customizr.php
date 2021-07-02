<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Adds custom CSS inline
add_action( 'wp_enqueue_scripts', 'kbe_theme_support_customizr_inline_css', 100 );

// Main content area
add_action( 'kbe_template_before_wrapper', 'kbe_theme_support_customizr_content_wrapper_start', 50 );
add_action( 'kbe_template_after_wrapper', 'kbe_theme_support_customizr_content_wrapper_end', 50 );


/**
 * Adds custom CSS inline
 *
 */
function kbe_theme_support_customizr_inline_css() {

	$css  = 'body.wp-knowledgebase .entry-content ul, body.wp-knowledgebase .entry-content ol { padding: .5rem 0 1rem 3rem; }';
	
	$css .= 'body.wp-knowledgebase .entry-content ul { list-style: square outside; }';
	$css .= 'body.wp-knowledgebase .entry-content ul > li { padding: .25rem .5rem; }';
	
	$css .= 'body.wp-knowledgebase .entry-content ol > li { position: relative; padding: .25rem .5rem; }';
	$css .= 'body.wp-knowledgebase .entry-content ol > li:before { content: counters(item, ".") "."; counter-increment: item; margin-right: .5em; left: -1em; position: absolute; width: 1em; }';

	wp_add_inline_style( 'kbe_theme_style', $css );

}


/**
 * Outputs the start of the page wrapper
 *
 */
function kbe_theme_support_customizr_content_wrapper_start() {
	echo '<div id="main-wrapper" class="section"><div class="container" role="main">';
}

/**
 * Outputs the end of the page wrapper
 *
 */
function kbe_theme_support_customizr_content_wrapper_end() {
	echo '</div></div>';
}