<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php
	
	/**
	 * Fires before the category is outputted
	 *
	 */
	do_action( 'kbe_template_before_category' );

?>

<?php
	
	// Query for Category
	$kbe_cat_id	  = get_queried_object()->term_id;
	$kbe_cat_slug = get_queried_object()->slug;
	$kbe_cat_name = get_queried_object()->name;
	$kbe_cat_desc = get_queried_object()->description;

?>

<header class="kbe-category-header">
	<h1 class="kbe-category-title"><?php echo esc_attr( $kbe_cat_name ); ?></h1>

	<?php if( ! empty( $kbe_cat_desc ) ): ?>
		<div class="kbe-category-description"><?php echo wpautop( $kbe_cat_desc ); ?></div>
	<?php endif; ?>
</header>

<ul class="kbe-object-list kbe-no-padding kbe-no-margin">

	<!-- Child category items -->
	<?php

		$kbe_child_cat_args = array(
			'orderby'    => 'terms_order',
			'order'      => 'ASC',
			'parent'     => $kbe_cat_id,
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
							'posts_per_page' => -1,
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
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_parent'    => 0,
			'tax_query'      => array(
				array(
					'taxonomy' => KBE_POST_TAXONOMY,
					'field'    => 'slug',
					'terms'    => $kbe_cat_slug,
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

</ul>

<?php
	
	/**
	 * Fires after the category is outputted
	 *
	 */
	do_action( 'kbe_template_after_category' );

?>