<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Sets the "id" attribute for the sidebar template
add_filter( 'kbe_template_sidebar_id', 'kbe_theme_support_customify_template_sidebar_id' );


/**
 * Sets the "id" attribute for the sidebar template
 *
 * @param string $id
 *
 * @return string
 *
 */
function kbe_theme_support_customify_template_sidebar_id( $id ) {

	return 'sidebar-primary';

}