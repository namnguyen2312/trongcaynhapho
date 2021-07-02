<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Adds custom CSS inline
add_action( 'wp_enqueue_scripts', 'kbe_theme_support_go_inline_css', 100 );


/**
 * Adds custom CSS inline
 *
 */
function kbe_theme_support_go_inline_css() {

	$css  = '#kbe-wrapper { padding: 2vw var(--go-block--padding--x,var(--go-block--padding--x)); }';
	$css .= '#kbe-wrapper .entry-header { padding-top: 0; }';
	$css .= '#kbe-wrapper .entry-title { margin-top: 0; }';
	$css .= '#kbe-wrapper .entry-content > :not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide) { max-width: 100%; width: 100%; }';

	$css .= '#kbe-wrapper .widget-area.sidebar .widget { margin-bottom: 2em; }';
	$css .= '#kbe-wrapper .widget-area.sidebar .widget > h6:first-of-type { margin-top: 0; margin-bottom: 1em; }';

	wp_add_inline_style( 'kbe_theme_style', $css );

}