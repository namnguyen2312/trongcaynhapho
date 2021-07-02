<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Adds custom CSS inline
add_action( 'wp_enqueue_scripts', 'kbe_theme_support_astra_inline_css', 100 );

// Set Astra's sidebar classes based on our selection of sidebars
add_filter( 'astra_page_layout', 'kbe_theme_support_astra_page_layout' );


/**
 * Set Astra's sidebar classes based on our selection of sidebars
 *
 * @param string $layout
 *
 * @return string
 *
 */
function kbe_theme_support_astra_page_layout( $layout ) {

	$template = '';

	// Check for archive (main) page
	if( is_post_type_archive( KBE_POST_TYPE ) )
		$template = get_option( 'kbe_main_page_template', 'wide' );

	// Check for categories, tags and search
	if( is_tax( KBE_POST_TAXONOMY ) || is_tax( KBE_POST_TAGS ) || kbe_is_search() )
		$template = get_option( 'kbe_category_page_template', 'wide' );

	// Check for single articles
	if( is_singular( KBE_POST_TYPE ) )
		$template = get_option( 'kbe_single_article_template', 'wide' );

	// If no template is found, return
	if( empty( $template ) )
		return $layout;

	switch ( $template ) {
		case 'sidebar-left':
			$layout = 'left-sidebar';
			break;
		case 'sidebar-right':
			$layout = 'right-sidebar';
			break;
		default:
			$layout = 'no-sidebar';
			break;
	}

	return $layout;

}


/**
 * Adds custom CSS inline
 *
 */
function kbe_theme_support_astra_inline_css() {

	$css  = 'body.wp-knowledgebase.kbe-template-sidebar-right #kbe-wrapper #primary { padding-right: 30px; }';
	$css .= 'body.wp-knowledgebase.kbe-template-sidebar-left #kbe-wrapper #primary { padding-left: 30px; }';
	$css .= 'body.wp-knowledgebase.kbe-template-sidebar-right #secondary { padding-left: 30px; }';
	$css .= 'body.wp-knowledgebase.kbe-template-sidebar-left #secondary { padding-right: 30px; position: relative; right: -1px; }';

	wp_add_inline_style( 'kbe_theme_style', $css );

}