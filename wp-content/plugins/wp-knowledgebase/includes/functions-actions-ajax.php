<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * AJAX callback that returns an array of data from WP_User objects
 *
 */
function kbe_action_ajax_get_live_search_results() {

	if( ! isset( $_POST['search'] ) )
		wp_die( 0 );

	$posts_args = array(
		'post_type'      => KBE_POST_TYPE,
		'posts_per_page' => apply_filters( 'kbe_live_search_results_count', -1 ),
		's'				 => sanitize_text_field( $_POST['search'] )
	);

	$posts = new WP_Query( $posts_args );

	if( $posts->have_posts() ) {

		$search_excerpt = get_option( 'kbe_search_excerpt', false );

		?>

		<ul id="kbe-live-search-result" class="<?php echo ( $search_excerpt ? 'kbe-live-search-result-has-excerpt' : '' ); ?>">

			<?php while( $posts->have_posts() ): $posts->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>" data-article-id="<?php echo absint( get_the_ID() ); ?>">

						<?php echo kbe_get_svg_icon( 'document-text' ); ?>

						<div class="kbe-live-search-result-title"><?php the_title(); ?></div>

						<?php if( $search_excerpt ): ?>

							<div class="kbe-live-search-result-excerpt">

								<?php

									add_filter( 'excerpt_more', 'kbe_live_search_excerpt_more', 1000 );

									the_excerpt();

									remove_filter( 'excerpt_more', 'kbe_live_search_excerpt_more', 1000 );

								?>
								
							</div>

						<?php endif; ?>
					</a>
				</li>

			<?php endwhile; ?>

		</ul>

		<?php

	} else {

		$no_results_message = get_option( 'kbe_search_no_results_message' );
		
		?>
			
			<ul id="kbe-live-search-result">
				<li>
					<span class="kbe-live-search-no-result"><?php echo ( ! empty( $no_results_message ) ? $no_results_message : __( 'No results found.', 'wp-knowledgebase' ) ); ?></span>
				</li>
			</ul>

		<?php

	}

	/**
	 * Hook for extra functionality with search results
	 *
	 * @param string $posts_args['s'] - the search term the user inputed
	 * @param array  $posts 		  - the posts results from the search
	 *
	 */
	do_action( 'kbe_search_results', $posts_args['s'], ( ! empty( $posts->posts ) ? $posts->posts : array() ) );

	wp_die();

}
add_action( 'wp_ajax_nopriv_kbe_action_ajax_get_live_search_results', 'kbe_action_ajax_get_live_search_results' );
add_action( 'wp_ajax_kbe_action_ajax_get_live_search_results', 'kbe_action_ajax_get_live_search_results' );