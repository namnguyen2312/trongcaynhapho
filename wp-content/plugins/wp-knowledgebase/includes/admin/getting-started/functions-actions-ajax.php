<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Attempts to register a website with our server
 *
 */
function kbe_action_ajax_mark_lesson_complete() {

	if( empty( $_POST['kbe_token'] ) || ! wp_verify_nonce( $_POST['kbe_token'], 'kbe_getting_started' ) )
		wp_die(0);

	if( empty( $_POST['lesson'] ) )
		wp_die(0);

	$lesson = sanitize_text_field( $_POST['lesson'] );
	
	$finished_lessons 	= get_option( 'kbe_getting_started_finished_lessons', array() );
	$finished_lessons[] = $lesson;

	update_option( 'kbe_getting_started_finished_lessons', $finished_lessons );

	wp_die(1);

}
add_action( 'wp_ajax_kbe_action_ajax_mark_lesson_complete', 'kbe_action_ajax_mark_lesson_complete' );