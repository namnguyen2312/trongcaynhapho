<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php
	
	/**
	 * Fires before the search results are outputted
	 *
	 */
	do_action( 'kbe_template_before_search' );

?>

<header class="kbe-search-header">
	<h1 class="kbe-search-title"><?php echo sprintf( __( 'Search Results for: %s', 'wp-knowledgebase' ), esc_html( $_GET['s'] ) ); ?></h1>
</header>

<ul class="kbe-object-list kbe-no-padding kbe-no-margin">

	<!-- Article items -->
	<?php if( have_posts() ): ?>

		<?php while ( have_posts() ): the_post(); ?>

			<li class="kbe-object-list-item kbe-list-item-is-article">
				<?php echo kbe_get_svg_icon( 'document-text' ); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>

		<?php endwhile; ?>

	<?php endif; ?>
	<!-- / Article items -->

</ul>

<?php
	
	/**
	 * Fires after the search results are outputted
	 *
	 */
	do_action( 'kbe_template_after_search' );

?>