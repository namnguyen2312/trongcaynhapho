<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Output breadcrumbs.
 *
 * Output the breadcrumbs. Used within the knowledgebase templates.
 *
 * @since 1.0
 */
function kbe_breadcrumbs() {
	$parts = array(
		array(
			'text' => __( 'Home', 'wp-knowledgebase' ),
			'href' => home_url(),
		),
		array(
			'text' => ucwords( strtolower( KBE_PLUGIN_SLUG ) ),
			'href' => home_url( KBE_PLUGIN_SLUG ),
		),
	);

	if ( is_tax( array( 'kbe_taxonomy', 'knowledgebase_category', 'kbe_tags', 'knowledgebase_tags' ) ) ) {
		$parts[] = array(
			'text' => get_queried_object()->name,
		);
	} elseif ( is_search() ) {
		$parts[] = array(
			'text' => esc_html( $_GET['s'] ),
		);
	} elseif ( is_single() ) {
		$kbe_bc_term = get_the_terms( get_the_ID(), KBE_POST_TAXONOMY );
		foreach ( $kbe_bc_term as $kbe_tax_term ) {
			$parts[] = array(
				'text' => $kbe_tax_term->name,
				'href' => get_term_link( $kbe_tax_term->slug, KBE_POST_TAXONOMY ),
			);
		}

		$title   = strlen( get_the_title() ) >= 50 ? substr( get_the_title(), 0, 50 ) . '&hellip;' : get_the_title();
		$parts[] = array(
			'text' => $title,
		);
	}

	$parts = apply_filters( 'wp_knowledgebase_breadcrumb_parts', $parts );
	?><ul><?php
	foreach ( $parts as $k => $part ) {
		$part = wp_parse_args( $part, array( 'text' => '', 'href' => '' ) );
		?><li class="breadcrumb-part"><a href="<?php echo esc_url( $part['href'] ); ?>"><?php echo wp_kses_post( $part['text'] ); ?></a></li><?php

		$keys = array_keys( $parts );
		if ( $k !== end( $keys ) ) {
			?><li class="separator"> <?php echo get_option( 'kbe_breadcrumbs_separator', '/' ); ?> </li><?php
		}
	}
	?></ul><?php
}


/**
 * Output search form.
 *
 * Output the default search form, located at the top of KB pages by default.
 *
 * @since 1.0
 *
 */
function kbe_search_form() {

	// Search field placeholder settings value
	$search_field_placeholder = get_option( 'kbe_search_field_placeholder', '' );

	// Live search
	?>
	<div id="live-search">
        <div class="kbe_search_field">
            <form role="search" method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
                <input type="text" onfocus="if (this.value == '<?php echo esc_attr( $search_field_placeholder ); ?>') {this.value = '';}" onblur="if (this.value == '')  {this.value = '<?php echo esc_attr( $search_field_placeholder ); ?>';}" value="<?php echo esc_attr( $search_field_placeholder ); ?>" name="s" id="s" />
                <!--<ul id="kbe_search_dropdown"></ul>-->
                <input type="hidden" name="post_type" value="kbe_knowledgebase" />
            </form>
        </div>
    </div>
    <?php
}


/**
 * Required search JS code.
 *
 * Javascript code required for the Search feature to work properly.
 *
 * @todo use this function only for legacy templates
 *
 * @since 1.0
 */
function kbe_search_drop() {
	if ( KBE_SEARCH_SETTING == 1 ) {
		?><script type="text/javascript">
			jQuery(document).ready(function () {

				var tree_id = 0;
				jQuery('div.kbe_category:has(.kbe_child_category)').addClass('has-child').prepend('<span class="switch"><img src="<?php echo plugins_url( '../template-legacy/images/kbe_icon-plus.png', __FILE__ ); ?>" /></span>').each(function () {
					tree_id++;
					jQuery(this).attr('id', 'tree' + tree_id);
				});

				jQuery('div.kbe_category > span.switch').click(function () {
					var tree_id = jQuery(this).parent().attr('id');
					if (jQuery(this).hasClass('open')) {
						jQuery(this).parent().find('div:first').slideUp('fast');
						jQuery(this).removeClass('open');
						jQuery(this).html('<img src="<?php echo plugins_url( '../template-legacy/images/kbe_icon-plus.png', __FILE__ ); ?>" />');
					} else {
						jQuery(this).parent().find('div:first').slideDown('fast');
						jQuery(this).html('<img src="<?php echo plugins_url( '../template-legacy/images/kbe_icon-minus.png', __FILE__ ); ?>" />');
						jQuery(this).addClass('open');
					}
				});

			});
		</script><?php

		if ( ( KBE_SEARCH_SETTING == 1 ) && ( wp_script_is( 'kbe_live_search', 'enqueued' ) ) ) {

			?><script type="text/javascript">
				jQuery(document).ready(function() {
					var kbe = jQuery('#live-search #s').val();
					jQuery('#live-search #s').liveSearch({url: '<?php echo home_url(); ?>/?ajax=on&post_type=kbe_knowledgebase&s='});
				});
			</script><?php
		}
	}
}
add_action( 'wp_footer', 'kbe_search_drop' );