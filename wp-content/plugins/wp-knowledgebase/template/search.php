<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php get_header( 'knowledgebase' ); ?>

<?php
		
	/**
	 * Fires before the wrapper is outputted
	 *
	 */
	do_action( 'kbe_template_before_wrapper' );

?>

<div id="kbe-wrapper">

	<?php
		
		/**
		 * Fires before the main content is outputted
		 *
		 */
		do_action( 'kbe_template_before_main_content' );

	?>

	<?php kbe_get_template( 'content-search.php' ); ?>

	<?php
		
		/**
		 * Fires after the main content is outputted
		 *
		 */
		do_action( 'kbe_template_after_main_content' );

	?>

	<?php
		
		/**
		 * Fires to output the sidebar
		 *
		 */
		do_action( 'kbe_template_sidebar' );

	?>

</div>

<?php
		
	/**
	 * Fires after the wrapper is outputted
	 *
	 */
	do_action( 'kbe_template_after_wrapper' );

?>

<?php get_footer( 'knowledgebase' );