<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php
	
	/**
	 * Fires before the shortcode's content is outputted
	 *
	 */
	do_action( 'kbe_template_before_shortcode_kbe_knowledgebase' );

?>

<?php kbe_get_template( 'content-main.php' ); ?>

<?php
	
	/**
	 * Fires after the shortcode's content is outputted
	 *
	 */
	do_action( 'kbe_template_after_shortcode_kbe_knowledgebase' );

?>