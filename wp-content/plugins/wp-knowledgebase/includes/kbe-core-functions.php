<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Enqueue scripts.
 *
 * Enqueue the required stylesheets and javascripts on the front end.
 *
 * @since 1.0
 *
 */
function kbe_styles() {

	if ( file_exists( get_stylesheet_directory() . '/wp_knowledgebase/style.css' ) ) {
		$stylesheet = get_stylesheet_directory_uri() . '/wp_knowledgebase/style.css';
	} elseif ( file_exists( get_stylesheet_directory() . '/wp_knowledgebase/kbe_style.css' ) ) {
		$stylesheet = get_stylesheet_directory_uri() . '/wp_knowledgebase/kbe_style.css';
	} else {
		$stylesheet = WP_KNOWLEDGEBASE . ( kbe_is_legacy_template_enabled() ? 'template-legacy/kbe_style.css' : 'template/style.css' );
	}

	if( get_option( 'kbe_output_style' ) ) {

		wp_register_style( 'kbe_theme_style', $stylesheet, array(), KBE_PLUGIN_VERSION );
		wp_enqueue_style( 'kbe_theme_style' );
		
	}

	if( kbe_is_legacy_template_enabled() ) {

		wp_register_script( 'kbe_live_search', WP_KNOWLEDGEBASE . '/assets/js/jquery.livesearch.js', array( 'jquery' ), KBE_PLUGIN_VERSION, true );
		wp_enqueue_script( 'kbe_live_search' );

	} else {

		wp_register_script( 'kbe_live_search_script', WP_KNOWLEDGEBASE . '/assets/js/script-live-search.js', array( 'jquery' ), KBE_PLUGIN_VERSION, true );
		wp_enqueue_script( 'kbe_live_search_script' );

	}

}
add_action( 'wp_enqueue_scripts', 'kbe_styles' );


/**
 * Outputs the "kbe" JS variable on the front-end on knowledge base pages
 *
 */
function kbe_output_global_js_variable() {

	// Bail if we're not on a KB page
	if( ! kbe_is_kbe_page() )
		return;

	$js_var = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'	   => wp_create_nonce( 'wp_knowledgebase' )
	);

	/**
	 * Filter the global JS variable before outputting it
	 *
	 * @param array $js_var
	 *
	 */
	$js_var = apply_filters( 'kbe_global_js_variable', $js_var );

	// Echo the variable
	echo '<script id="kbe-global-js-var">var wp_knowledgebase = ' . json_encode( $js_var ) . ';</script>';

}
add_action( 'wp_head', 'kbe_output_global_js_variable' );


/**
 * Register widget area.
 *
 * Register a widget area that is used on the KB pages.
 *
 * @since 1.0
 *
 */
function kbe_register_sidebar() {

	register_sidebar( array(
		'name'          => __( 'WP Knowledgebase Sidebar', 'wp-knowledgebase' ),
		'id'            => 'kbe_cat_widget',
		'description'   => __( 'WP Knowledgebase sidebar area', 'wp-knowledgebase' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'kbe_register_sidebar' );


/**
 * Inserts the JS code that initializes live search
 *
 */
function kbe_live_search_initializer() {

	if ( ( kbe_is_live_search_enabled() || kbe_is_live_search_outputted() ) && ( wp_script_is( 'kbe_live_search_script', 'enqueued' ) ) ) {

		?>

		<script type="text/javascript">

			jQuery(document).ready( function() {
				jQuery('#kbe-live-search [name="s"]').KBELiveSearch( { url : "<?php echo admin_url( 'admin-ajax.php' ); ?>" } );
			});

		</script>

		<?php
	}

}
add_action( 'wp_footer', 'kbe_live_search_initializer' );


/**
 * Knowledgebase shortcode.
 *
 * Register the [kbe_knowledgebase] shortcode.
 *
 * @param array $atts Attributes used with the shortcode (none available).
 * @param null $content Content passed through the shortcode.
 *
 * @return mixed Knowledgebase page contents.
 *
 */
function kbe_shortcode( $atts, $content = null ) {

	if( is_admin() )
		return;

	if( defined( 'REST_REQUEST' ) && REST_REQUEST )
        return;

    ob_start();

    kbe_get_template( 'shortcodes/kbe_knowledgebase.php' );

	$return_string = ob_get_contents();
	ob_end_clean();

	wp_reset_query();
	
	return $return_string;

}
add_shortcode( 'kbe_knowledgebase', 'kbe_shortcode' );


/**
 * Breadcrumbs shortcode.
 *
 * Register the [kbe_breadcrumbs] shortcode.
 *
 * @param array $atts    - Attributes used with the shortcode (none available).
 * @param null  $content - Content passed through the shortcode.
 *
 * @return mixed
 *
 */
function kbe_shortcode_breadcrumbs( $atts, $content = null ) {

	if( is_admin() )
		return;

	if( defined( 'REST_REQUEST' ) && REST_REQUEST )
        return;

    ob_start();

	kbe_output_breadcrumbs();

	$return_string = ob_get_contents();
	ob_end_clean();
	
	return $return_string;

}
add_shortcode( 'kbe_breadcrumbs', 'kbe_shortcode_breadcrumbs' );


/**
 * Live search shortcode.
 *
 * Register the [kbe_live_search] shortcode.
 *
 * @param array $atts    - Attributes used with the shortcode (none available).
 * @param null  $content - Content passed through the shortcode.
 *
 * @return mixed
 *
 */
function kbe_shortcode_live_search( $atts, $content = null ) {

	if( is_admin() )
		return;

	if( defined( 'REST_REQUEST' ) && REST_REQUEST )
        return;

    ob_start();

	kbe_output_live_search();

	$return_string = ob_get_contents();
	ob_end_clean();
	
	return $return_string;

}
add_shortcode( 'kbe_live_search', 'kbe_shortcode_live_search' );


/**
 * Dynamic CSS.
 *
 * Include the dynamic CSS that can be set on the settings page.
 * This includes the color for the number of articles badge.
 *
 */
function kbe_count_bg_color() {

	if ( KBE_BG_COLOR ) {

		if( kbe_is_legacy_template_enabled() ) {

			$dynamic_css = '
				#kbe_content h2 span.kbe_count,
				#kbe_content .kbe_child_category h3 span.kbe_count {
					background-color: ' . KBE_BG_COLOR . ' !important;
				}
				.kbe_widget .kbe_tags_widget a,
				.kbe_widget .kbe_tags_widget a:hover{
					text-decoration: underline;
					color: ' . KBE_BG_COLOR . ' !important;
				}
			';

		} else {

			$dynamic_css = '.kbe-category-header span.kbe-count { background-color: ' . esc_attr( KBE_BG_COLOR ) . '; }';

		}

		wp_add_inline_style( 'kbe_theme_style', $dynamic_css );

	}

}
add_action( 'wp_enqueue_scripts', 'kbe_count_bg_color' );


/**
 * Get page ID of KB.
 *
 * Get the page ID of the page that holds the Knowledgebase.
 *
 * @since 1.1.5
 *
 * @return int|bool Post ID when it has been found, false otherwise.
 *
 */
function kbe_get_knowledgebase_page_id() {

	return get_option( 'kbe_page_id', false );

}

/**
 * Sort by custom order
 *
 * Sort categories by custom order defined on the Order admin page
 *
 * @param  string $orderby ORDERBY clause of the terms query
 * @param  array  $args    array of terms query arguments
 *
 * @ since 1.1.5
 *
 * @return string string to replace $orderby
 */
function kbe_tax_order( $orderby, $args ) {
	$kbe_tax = 'kbe_taxonomy';
	if ( $args['orderby'] == 'terms_order' ) {
		return 't.terms_order';
	} elseif ( $kbe_tax == 1 && ! isset( $_GET['orderby'] ) ) {
		return 't.terms_order';
	} else {
		return $orderby;
	}
}
add_filter( 'get_terms_orderby', 'kbe_tax_order', 10, 2 );


/**
 * Returns the date and time format saved in WP's settings page
 *
 * @return string
 *
 */
function kbe_get_datetime_format() {

    $format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

    /**
     * Filter the default date time format before returning
     *
     * @param string $format
     *
     */
    $format = apply_filters( 'kbe_datetime_format', $format );

    return $format;

}


/**
 * Returns the current date and time in mysql format
 *
 * @return string
 *
 */
function kbe_mysql_gmdate() {
    
    return current_time( 'mysql', true );

}


/**
 * Returns the date and time in user's language
 * 
 * @param string $date
 * 
 * @return string
 * 
 */
function kbe_date_i18n( $date ) {

    return date_i18n( kbe_get_datetime_format(), strtotime( get_date_from_gmt( $date ) ) );

}


/**
 * Wrapper function to get a KB setting option
 *
 * @param string $option
 * @param mixed  $default
 *
 * @return mixed
 *
 */
function kbe_get_option( $option, $default = false ) {

	return get_option( 'kbe_' . $option, $default );

}


/**
 * Checks the DB to see if the breadcrumbs are enabled or not
 *
 * @return bool
 *
 */
function kbe_is_breadcrumbs_enabled() {

	return (bool)get_option( 'kbe_breadcrumbs_setting', false );

}


/**
 * Checks the DB to see if live search is enabled or not
 *
 * @return bool
 *
 */
function kbe_is_live_search_enabled() {

	return (bool)get_option( 'kbe_search_setting', false );

}


/**
 * Flags that live search was outputted to the page
 *
 */
function kbe_live_search_outputted() {

	global $kbe_live_search_outputted;

	$kbe_live_search_outputted = true;

}


/**
 * Verifies if live search was outputted in the page
 *
 * @return bool
 *
 */
function kbe_is_live_search_outputted() {

	global $kbe_live_search_outputted;

	return ( ! is_null( $kbe_live_search_outputted ) ? $kbe_live_search_outputted : false );

}