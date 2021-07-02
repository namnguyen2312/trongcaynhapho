<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Locates a given template and returns its path
 *
 * @param string $template_name
 *
 * @return string
 *
 */
function kbe_locate_template( $template_name ) {

	$template_path  = 'wp_knowledgebase/';
	$default_path   = untrailingslashit( KBE_PLUGIN_DIR ) . '/template/';

	// Locate template in the theme
	$template = locate_template( array( trailingslashit( $template_path ) . $template_name, $template_name ) );

	// If no template in the theme, get default from plugin
	if( ! $template ) {
		$template = $default_path . $template_name;
	}

	return apply_filters( 'kbe_locate_template', $template );

}


/**
 * Locates a template and includes it if it exists
 *
 * @param string $template_name
 * @param array  $args
 *
 */
function kbe_get_template( $template_name, $args = array() ) {

	$located = kbe_locate_template( $template_name );

	if( ! file_exists( $located ) ) {
		sprintf( __( 'Template %s does not exist', 'wp-knowledgebase' ), '<code>' . $located . '</code>' );
		return;
	}

	include $located;

}


/**
 * Attempts to return the default sidebar used by the active theme.
 * Returns the plugin's sidebar as fallback.
 *
 * @return array
 *
 */
function kbe_get_theme_default_sidebar() {

	global $wp_registered_sidebars;

	// These are some of the most used sidebar IDs used by themes
	$general_sidebar_ids = array( 'sidebar-1', 'sidebar-primary', 'sidebar-right' );

	// Add to the general sidebar IDs the first registered sidebar that has "sidebar" in its name
	foreach( $wp_registered_sidebars as $sidebar_id => $sidebar_args ) {

		if( false !== strpos( $sidebar_id, 'sidebar' ) ) {
			$general_sidebar_ids[] = $sidebar_id;
			break;
		}

	}

	/**
	 * Filter the general sidebar IDs
	 *
	 * @param array
	 *
	 */
	$general_sidebar_ids = apply_filters( 'kbe_theme_general_sidebar_ids', $general_sidebar_ids );

	// Check to see if the general IDs are found in the registered sidebars and return if found
	foreach( $general_sidebar_ids as $sidebar_id ) {

		if( isset( $wp_registered_sidebars[$sidebar_id] ) )
			return $wp_registered_sidebars[$sidebar_id];

	}

	// Fallback to our own sidebar
	return $wp_registered_sidebars['kbe_cat_widget'];

}


/**
 * Returns a SVG element for the provided icon slug
 *
 * @param string $icon_slug
 *
 * @return string
 *
 */
function kbe_get_svg_icon( $icon_slug ) {

	$icons = array(
		'arrow-circle-right' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
		'chevron-right'		 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>',
		'folder-open'   	 => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" /><path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" /></svg>',
		'document-text' 	 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
		'search'			 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>',
		'dots-horizontal'	 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>',
		'selector'			 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" /></svg>',
		'thumb-up'			 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>',
		'thumb-down'		 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" /></svg>',
		'emoji-happy'		 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
		'emoji-sad'			 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
		'check'				 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>',
		'x'					 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
		'check-circle'		 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
		'x-circle'			 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
		'cog'				 => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
	);

	/**
	 * Filters the SVG icons
	 *
	 */
	$icons = apply_filters( 'kbe_svg_icons', $icons );

	return ( ! empty( $icons[$icon_slug] ) ? $icons[$icon_slug] : '' );

}


/**
 * Returns the HTML for the loading spinner
 *
 * @return string
 *
 */
function kbe_get_loading_spinner_html() {

	$html  = '<div class="kbe-loading-spinner">';
		$html .= '<div class="kbe-loading-spinner-bounce-1"><!-- --></div>';
		$html .= '<div class="kbe-loading-spinner-bounce-2"><!-- --></div>';
		$html .= '<div class="kbe-loading-spinner-bounce-3"><!-- --></div>';
	$html .= '</div>';

	/**
	 * Filter the HTML of the loading spinner before returning it
	 *
	 * @param string $html
	 *
	 */
	return apply_filters( 'kbe_loading_spinner_html', $html );

}


/**
 * Adds the "wp-knowledgebase" class to the body element
 *
 * @param array $classes
 *
 * @return array 
 *
 */
function kbe_add_global_body_class( $classes ) {

	if( is_singular( KBE_POST_TYPE ) || is_post_type_archive( KBE_POST_TYPE ) || is_tax( KBE_POST_TAXONOMY ) || is_tax( KBE_POST_TAGS ) || ( is_page() && get_the_ID() == kbe_get_option( 'page_id' ) ) )
		$classes[] = 'wp-knowledgebase';

	return $classes;

}
add_filter( 'body_class', 'kbe_add_global_body_class' );


/**
 * Adds the "kbe-template-sidebar-right", "kbe-template-sidebar-left" or "kbe-template-wide" classes to the
 * body element based on the template shown and the selected layout setting
 *
 * @param array $classes
 *
 * @return array
 *
 */
function kbe_add_sidebar_body_class( $classes ) {

	// Check for custom KB page
	if( is_page() && get_the_ID() == kbe_get_option( 'page_id' ) )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_main_page_template', 'wide' ) );

	// Check for archive (main) page
	if( is_post_type_archive( KBE_POST_TYPE ) )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_main_page_template', 'wide' ) );

	// Check for categories
	if( is_tax( KBE_POST_TAXONOMY ) )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_category_page_template', 'wide' ) );

	// Check for tags
	if( is_tax( KBE_POST_TAGS ) )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_category_page_template', 'wide' ) );

	// Check for search
	if( kbe_is_search() )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_category_page_template', 'wide' ) );

	// Check for single articles
	if( is_singular( KBE_POST_TYPE ) )
		$classes[] = 'kbe-template-' . esc_attr( get_option( 'kbe_single_article_template', 'wide' ) );

	return $classes;

}
add_filter( 'body_class', 'kbe_add_sidebar_body_class' );


/**
 * Resets the $post global to the current post in the main query
 *
 */
function kbe_resetpost_data_after_main_content() {

	wp_reset_postdata();

}
add_action( 'kbe_template_after_main_content', 'kbe_resetpost_data_after_main_content' );
add_action( 'kbe_template_after_shortcode_kbe_knowledgebase', 'kbe_resetpost_data_after_main_content' );


/**
 * Change the excerpt more string for the live search
 *
 * @param string $more
 *
 * @return string
 *
 */
function kbe_live_search_excerpt_more( $more ) {

	return '&hellip;';

}


/**
 * Outputs the breadcrumbs of the KB
 *
 * @param array $args
 *
 */
function kbe_output_breadcrumbs( $args = array() ) {

	$defaults = array(
		'id'    	   => 'kbe-breadcrumbs',
		'class' 	   => array(),
		'separator'    => get_option( 'kbe_breadcrumbs_separator', '/' )
	);

	$args = wp_parse_args( $args, $defaults );

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

		// Get all terms ancestors
		$ancestors = get_ancestors( get_queried_object()->term_id, KBE_POST_TAXONOMY, 'taxonomy' );

		foreach( array_reverse( $ancestors ) as $term_id ) {

			$parent = get_term( $term_id, KBE_POST_TAXONOMY );

			$parts[] = array(
				'text' => $parent->name,
				'href' => get_term_link( $parent->term_id, KBE_POST_TAXONOMY )
			);

		}

		// Add the current term
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

	/**
	 * Filter the breadcrumbs parts
	 *
	 * @param array $parts
	 *
	 */
	$parts = apply_filters( 'kbe_breadcrumbs_parts', $parts );

	$wrapper_attributes = array(
		( ! empty( $args['id'] ) ? 'id="' . esc_attr( $args['id'] ) . '"' : '' ),
		( ! empty( $args['class'] ) ? 'class="' . esc_attr( implode( ' ', $args['class'] ) ) . '"' : '' )
	);

	$wrapper_attributes = array_filter( $wrapper_attributes );

	?>

		<div<?php echo ( ! empty( $wrapper_attributes ) ? ' ' . implode( ' ', $wrapper_attributes ) : '' ); ?>>

			<ol>
				<?php foreach ( $parts as $k => $part ): ?>

					<?php
						$part = wp_parse_args( $part, array( 'text' => '', 'href' => '' ) );
						$keys = array_keys( $parts );
					?>

					<li class="kbe-breadcrumbs-part"><a href="<?php echo esc_url( $part['href'] ); ?>"><?php echo wp_kses_post( $part['text'] ); ?></a></li>

					<?php if ( $k !== end( $keys ) ): ?>
						<li class="kbe-breadcrumbs-separator"> <?php echo $args['separator']; ?> </li>
					<?php endif; ?>

				<?php endforeach; ?>

			</ol>

		</div>

	<?php

}


/**
 * Outputs the breadcrumbs of the KB
 *
 * @param array $args
 *
 */
function kbe_output_live_search() {

	// Search field placeholder settings value
	$search_field_placeholder = get_option( 'kbe_search_field_placeholder', '' );

	?>

	<div id="kbe-live-search">
        <div class="kbe-search-field">
            <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
            	<?php echo kbe_get_svg_icon( 'search' ); ?>
                <input type="text" placeholder="<?php echo esc_attr( $search_field_placeholder ); ?>" value="" name="s" />
                <!--<ul id="kbe-search-dropdown"></ul>-->
                <input type="hidden" name="post_type" value="kbe_knowledgebase" />

                <?php echo kbe_get_loading_spinner_html(); ?>

            </form>
        </div>
    </div>
    
    <?php

    // Flag that live search has been outputted
    kbe_live_search_outputted();

}


/**
 * Checks if the legacy template system should be used or not
 *
 * @return bool
 *
 */
function kbe_is_legacy_template_enabled() {

	$legacy_template = get_option( 'kbe_enable_legacy_templates', false );

	return (bool)$legacy_template;

}


/**
 * Determines whether the query is a KB search one
 *
 * @return bool
 *
 */
function kbe_is_search() {

	global $wp_query;

	return ( $wp_query->is_search && get_query_var( 'post_type' ) == KBE_POST_TYPE );

}


/**
 * Determines whether the current displayed page is from the KB
 *
 * @return bool
 *
 */
function kbe_is_kbe_page() {

	// Check for single articles
	if( is_singular( KBE_POST_TYPE ) )
		return true;
	
	// Check for archive (main) page
	if( is_post_type_archive( KBE_POST_TYPE ) )
		return true;

	// Check for categories
	if( is_tax( KBE_POST_TAXONOMY ) )
		return true;

	// Check for tags
	if( is_tax( KBE_POST_TAGS ) )
		return true;

	// Check for search
	if( kbe_is_search() )
		return true;

	return false;

}


/**
 * Load a template.
 *
 * Handles template usage so that we can use our own templates instead of the themes.
 *
 * Templates are in the 'templates' folder. knowledgebase looks for theme
 * overrides in /theme/wp_knowledgebase/ by default
 *
 * @param  mixed  $template
 *
 * @return string
 *
 */
function kbe_template_chooser( $template ) {

	/**
	 * Filter to modify the KB template path
	 *
	 * @param string
	 *
	 */
	$template_path = apply_filters( 'kbe_template_path', 'wp_knowledgebase/' );

	/**
	 * Template type
	 *
	 */
	$template_type   = ( kbe_is_legacy_template_enabled() ? 'legacy' : '' );

	$find = array();
	$file = '';
	
	if ( is_single() && get_post_type() == 'kbe_knowledgebase' ) {
		$file   = 'single-kbe_knowledgebase.php';
		$find[] = $file;
		$find[] = $template_path . $file;
	} elseif ( is_tax( 'kbe_taxonomy' ) || is_tax( 'kbe_tags' ) ) {
		$term = get_queried_object();

		if ( is_tax( 'kbe_taxonomy' ) || is_tax( 'kbe_tags' ) ) {
			$file = 'taxonomy-' . $term->taxonomy . '.php';
		} else {
			$file = 'archive.php';
		}

		$find[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
		$find[] = $template_path . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
		$find[] = 'taxonomy-' . $term->taxonomy . '.php';
		$find[] = $template_path . 'taxonomy-' . $term->taxonomy . '.php';
		$find[] = $file;
		$find[] = $template_path . $file;
	} elseif ( is_post_type_archive( 'kbe_knowledgebase' ) || ( KBE_PAGE_TITLE != false && is_page( KBE_PAGE_TITLE ) ) ) {
		$file   = ( kbe_is_legacy_template_enabled() ? 'kbe_knowledgebase.php' : 'archive-kbe_knowledgebase.php' );
		$find[] = 'kbe_knowledgebase.php';
		$find[] = $template_path . 'kbe_knowledgebase.php';
		$find[] = $file;
		$find[] = $template_path . $file;
	}

	if ( $file ) {

		$template = locate_template( array_unique( $find ) ) ;
		
		if ( ! $template ) {
			$template = trailingslashit( dirname( __FILE__ ) ) . '../' . ( kbe_is_legacy_template_enabled() ? 'template-legacy' : 'template' ) . '/' . $file;
		}

	}

	return $template;

}
add_filter( 'template_include', 'kbe_template_chooser' );


/**
 * Replace KB search template.
 *
 * @since 1.0
 *
 * @param $template
 * @return string
 */
function template_chooser( $template ) {

	global $wp_query;
	
	/*
	* Fixed Securty Issue: XSS - Vulnerable
	* Removing special character on query
	*/
	if (is_search()) {
	   $_GET["s"] = preg_replace('/[^a-zA-Z0-9-_ \.]/','', $_GET["s"]);
	}

	$post_type = get_query_var( 'post_type' );

	if ( $wp_query->is_search && $post_type == KBE_POST_TYPE ) {
		if ( file_exists( get_stylesheet_directory() . '/wp_knowledgebase/kbe_search.php' ) ) {
			return get_stylesheet_directory() . '/wp_knowledgebase/kbe_search.php';
		} else {

			if( kbe_is_legacy_template_enabled() )
				return plugin_dir_path( __FILE__ ) . '/../template-legacy/kbe_search.php';
			else
				return plugin_dir_path( __FILE__ ) . '/../template/search.php';

		}
	}

	return $template;
	
}
add_filter( 'template_include', 'template_chooser' );


/**
 * Filters comments_open on the KB articles to enable or disable comments
 *
 * @param bool $open
 * @param int  $post_id
 *
 * @return bool
 *
 */
function kbe_post_type_comments_open( $open, $post_id ) {

	if( ! is_singular( KBE_POST_TYPE ) )
		return $open;

	return ( KBE_COMMENT_SETTING == 1 ? true : false );

}
add_filter( 'comments_open', 'kbe_post_type_comments_open', 10, 2 );