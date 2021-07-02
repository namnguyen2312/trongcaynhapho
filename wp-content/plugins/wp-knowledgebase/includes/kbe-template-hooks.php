<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Output content wrappers
add_action( 'kbe_template_before_main_content', 'kbe_output_content_wrapper_start', 50 );
add_action( 'kbe_template_after_main_content', 'kbe_output_content_wrapper_end', 50 );

// Output main content wrappers
add_action( 'kbe_template_before_main_content', 'kbe_output_main_content_wrapper_start', 75 );
add_action( 'kbe_template_after_main_content', 'kbe_output_main_content_wrapper_end', 25 );

add_action( 'kbe_template_before_shortcode_kbe_knowledgebase', 'kbe_output_main_content_wrapper_start', 75 );
add_action( 'kbe_template_after_shortcode_kbe_knowledgebase', 'kbe_output_main_content_wrapper_end', 25 );

// Output single KB article inside content (title, content)
add_action( 'kbe_template_single_article_inside', 'kbe_output_single_article_title', 10 );
add_action( 'kbe_template_single_article_inside', 'kbe_output_single_article_content', 20 );

// Output breadcrumbs
add_action( 'kbe_template_before_main_content', 'kbe_maybe_output_breadcrumbs', 60 );
add_action( 'kbe_template_before_shortcode_kbe_knowledgebase', 'kbe_maybe_output_breadcrumbs', 60 );

// Output live search
add_action( 'kbe_template_before_main_content', 'kbe_maybe_output_live_search', 70 );
add_action( 'kbe_template_before_shortcode_kbe_knowledgebase', 'kbe_maybe_output_live_search', 70 );

// Output the sidebar
add_action( 'kbe_template_sidebar', 'kbe_maybe_output_sidebar', 25 );


/**
 * Outputs the content wrapper start template before the main content area
 *
 */
function kbe_output_content_wrapper_start() {

	kbe_get_template( 'global/content-wrapper-start.php' );

}


/**
 * Outputs the content wrapper end template after the main content area
 *
 */
function kbe_output_content_wrapper_end() {

	kbe_get_template( 'global/content-wrapper-end.php' );

}


/**
 * Outputs the main content wrapper start template before the main content area
 * This wraps the main content of the KB, like articles, categories and main page
 *
 */
function kbe_output_main_content_wrapper_start() {

	kbe_get_template( 'global/main-content-wrapper-start.php' );

}


/**
 * Outputs the main content wrapper end template after the main content area
 * This wraps the main content of the KB, like articles, categories and main page
 *
 */
function kbe_output_main_content_wrapper_end() {

	kbe_get_template( 'global/main-content-wrapper-end.php' );

}


/**
 * Outputs the single article title
 *
 */
function kbe_output_single_article_title() {

	kbe_get_template( 'article/title.php' );

}


/**
 * Outputs the single article content
 *
 */
function kbe_output_single_article_content() {

	kbe_get_template( 'article/content.php' );

}


/**
 * Outputs the breadcrumbs of the KB before the main content if the option is enabled
 *
 */
function kbe_maybe_output_breadcrumbs() {

	if( kbe_is_breadcrumbs_enabled() ) {

		kbe_output_breadcrumbs();

	}

}


/**
 * Outputs the live search of the KB before the main content if the option is enabled
 *
 */
function kbe_maybe_output_live_search() {

	if( kbe_is_live_search_enabled() ) {

		kbe_output_live_search();

	}

}


/**
 * Outputs the sidebar if needed
 *
 */
function kbe_maybe_output_sidebar() {

	/**
	 * Filter the sidebar "id" attribute
	 *
	 * @param string
	 *
	 */
	$sidebar_id = apply_filters( 'kbe_template_sidebar_id', '' );

	// By default, don't output the sidebar
	$output_sidebar = false;

	// Check for custom KB page
	if( is_page() && get_the_ID() == kbe_get_option( 'page_id' ) && get_option( 'kbe_main_page_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	// Check for archive (main) page
	if( is_post_type_archive( KBE_POST_TYPE ) && get_option( 'kbe_main_page_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	// Check for categories
	if( is_tax( KBE_POST_TAXONOMY ) && get_option( 'kbe_category_page_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	// Check for tags
	if( is_tax( KBE_POST_TAGS ) && get_option( 'kbe_category_page_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	if( kbe_is_search() && get_option( 'kbe_category_page_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	// Check for single articles
	if( is_singular( KBE_POST_TYPE ) && get_option( 'kbe_single_article_template', 'wide' ) != 'wide' )
		$output_sidebar = true;

	// Output sidebar if needed
	if( $output_sidebar ) {

		kbe_get_template( 'global/sidebar.php', array( 'sidebar_id' => $sidebar_id ) );

	}

}