<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php
	
	/**
	 * Fires before the tag is outputted
	 *
	 */
	do_action( 'kbe_template_before_tag' );

?>

<?php
	
	// Query for Category
	$kbe_tag_id	  = get_queried_object()->term_id;
	$kbe_tag_slug = get_queried_object()->slug;
	$kbe_tag_name = get_queried_object()->name;
	$kbe_tag_desc = get_queried_object()->description;

?>

<header class="kbe-category-header">
	<h1 class="kbe-category-title"><?php echo __( 'Tag', 'wp-knowledgebase' ) . ': ' . esc_attr( $kbe_tag_name ); ?></h1>

	<?php if( ! empty( $kbe_tag_desc ) ): ?>
		<div class="kbe-category-description"><?php echo wpautop( $kbe_tag_desc ); ?></div>
	<?php endif; ?>
</header>

<ul class="kbe-object-list kbe-no-padding kbe-no-margin">

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
					'taxonomy' => KBE_POST_TAGS,
					'field'    => 'slug',
					'terms'    => $kbe_tag_slug,
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
	 * Fires after the tag is outputted
	 *
	 */
	do_action( 'kbe_template_after_tag' );

?>