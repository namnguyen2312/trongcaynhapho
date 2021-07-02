<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;

?>

<div class="kbe-categories kbe-cols-2">

    <?php

		$kbe_cat_args = array(
			'orderby'    => 'terms_order',
			'order'      => 'ASC',
			'hide_empty' => true,
			'parent'     => 0
		);

		$kbe_terms = get_terms( KBE_POST_TAXONOMY, $kbe_cat_args );
		$kbe_terms_current = 1;

	?>

	<?php foreach ( $kbe_terms as $kbe_taxonomy ): ?>

		<?php

			$kbe_term_id   = $kbe_taxonomy->term_id;
			$kbe_term_slug = $kbe_taxonomy->slug;
			$kbe_term_name = $kbe_taxonomy->name;

			$kbe_taxonomy_parent_count = $kbe_taxonomy->count;

			$children = get_term_children( $kbe_term_id, KBE_POST_TAXONOMY );

			$kbe_count_sum = $wpdb->get_var( "
				SELECT Sum(count)
				FROM {$wpdb->prefix}term_taxonomy
				WHERE taxonomy = '" . KBE_POST_TAXONOMY . "'
				And parent = $kbe_term_id
			" );

			$kbe_count_sum_parent = '';

			if ( $children ) {
				$kbe_count_sum_parent = $kbe_count_sum + $kbe_taxonomy_parent_count;
			} else {
				$kbe_count_sum_parent = $kbe_taxonomy_parent_count;
			}

		?>

		<div class="kbe-category <?php echo ( $kbe_terms_current % 2 == 0 ? 'kbe-no-margin-right' : '' ); ?>">
            
            <header class="kbe-category-header">
	            <h2 class="kbe-category-title">
	                <a href="<?php echo get_term_link( $kbe_term_slug, 'kbe_taxonomy' ); ?>"><?php echo esc_attr( $kbe_term_name ); ?></a>
	                <span class="kbe-count"><?php echo sprintf( _n( '%d Article', '%d Articles', $kbe_count_sum_parent, 'wp-knowledgebase' ), $kbe_count_sum_parent ); ?></span>
	            </h2>
	        </header>

            <ul class="kbe-object-list kbe-no-padding kbe-no-margin">

            	<!-- Child category items -->
            	<?php

            		$kbe_child_cat_args = array(
						'orderby'    => 'terms_order',
						'order'      => 'ASC',
						'parent'     => $kbe_term_id,
						'hide_empty' => true,
					);

					$kbe_child_terms = get_terms( KBE_POST_TAXONOMY, $kbe_child_cat_args );

            	?>

            	<?php if( $kbe_child_terms ): ?>

            		<?php foreach( $kbe_child_terms as $kbe_child_term ): ?>

            			<li class="kbe-object-list-item kbe-list-item-is-child-category">

            				<?php echo kbe_get_svg_icon( 'folder-open' ); ?>
            				<a href="<?php echo get_term_link( $kbe_child_term->slug, 'kbe_taxonomy' ); ?>"><?php echo esc_attr( $kbe_child_term->name ); ?></a>

            				<ul class="kbe-object-list kbe-no-margin kbe-no-padding">

            					<?php

									$kbe_child_post_args = array(
										'post_type'      => KBE_POST_TYPE,
										'posts_per_page' => KBE_ARTICLE_QTY,
										'orderby'        => 'menu_order',
										'order'          => 'ASC',
										'tax_query'      => array(
											array(
												'taxonomy' => KBE_POST_TAXONOMY,
												'field'    => 'term_id',
												'terms'    => $kbe_child_term->term_id
											)
										)
									);

									$kbe_child_post_qry = new WP_Query( $kbe_child_post_args );

								?>

								<?php if( $kbe_child_post_qry->have_posts() ): ?>

									<?php while ( $kbe_child_post_qry->have_posts() ): $kbe_child_post_qry->the_post(); ?>

										<li class="kbe-object-list-item kbe-list-item-is-article">
											<?php echo kbe_get_svg_icon( 'document-text' ); ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </li>

									<?php endwhile; ?>

								<?php endif; ?>

            				</ul>

            			</li>

            		<?php endforeach; ?>

            	<?php endif; ?>
            	<!-- / Child category items -->

            	<!-- Article items -->
            	<?php

            		$kbe_tax_post_args = array(
						'post_type'      => KBE_POST_TYPE,
						'posts_per_page' => KBE_ARTICLE_QTY,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'post_parent'    => 0,
						'tax_query'      => array(
							array(
								'taxonomy' => KBE_POST_TAXONOMY,
								'field'    => 'slug',
								'terms'    => $kbe_term_slug,
								'include_children' => false
							)
						)
					);

					$kbe_tax_post_qry = new WP_Query( $kbe_tax_post_args );

            	?>

            	<?php if( $kbe_tax_post_qry->have_posts() ): ?>

            		<?php while ( $kbe_tax_post_qry->have_posts() ): $kbe_tax_post_qry->the_post(); ?>

            			<li class="kbe-object-list-item kbe-list-item-is-article">
							<?php echo kbe_get_svg_icon( 'document-text' ); ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>

            		<?php endwhile; ?>

            	<?php endif; ?>
            	<!-- / Article items -->

            	<!-- View all articles item -->
            	<?php if( $kbe_tax_post_qry->found_posts > KBE_ARTICLE_QTY ): ?>

            		<li class="kbe-object-list-item kbe-list-item-is-view-all-articles">
						<?php echo kbe_get_svg_icon( 'arrow-circle-right' ); ?>
						<a href="<?php echo get_term_link( $kbe_term_slug, 'kbe_taxonomy' ); ?>"><?php echo __( 'View all articles', 'wp-knowledgebase' ); ?></a>
					</li>

            	<?php endif; ?>
            	<!-- / View all articles item -->

            </ul>

        </div>

    	<?php $kbe_terms_current++; ?>

	<?php endforeach; ?>

</div>