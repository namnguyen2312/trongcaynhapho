<?php
/**
 * Sidebar
 *
 * This template can be overridden by copying it to yourtheme/wp_knowledgebase/global/sidebar.php
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div <?php echo ( ! empty( $args['sidebar_id'] ) ? 'id="' . esc_attr( $args['sidebar_id'] ) . '"' : 'id="secondary"' ); ?> class="widget-area sidebar">

	<?php
	
		/**
		 * Fires before the sidebar content is outputted
		 *
		 */
		do_action( 'kbe_template_before_sidebar_content' );

	?>

	<?php dynamic_sidebar( 'kbe_cat_widget' ); ?>

	<?php
	
		/**
		 * Fires after the sidebar content is outputted
		 *
		 */
		do_action( 'kbe_template_after_sidebar_content' );

	?>

</div>