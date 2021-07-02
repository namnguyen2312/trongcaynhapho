<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php
	
	/**
	 * Fires before the article is outputted
	 *
	 */
	do_action( 'kbe_template_before_single_article' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

		/**
		 * Fires to output the inside content of an article
		 *
		 */
		do_action( 'kbe_template_single_article_inside' );

	?>

</article>

<?php
	
	/**
	 * Fires after the article is outputted
	 *
	 */
	do_action( 'kbe_template_after_single_article' );

?>