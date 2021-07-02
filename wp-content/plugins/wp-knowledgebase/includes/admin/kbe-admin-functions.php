<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Adds a central action hook on the admin_init that the plugin and add-ons
 * can use to do certain actions, like adding a new affiliate, editing an affiliate, deleting, etc.
 *
 */
function kbe_register_admin_do_actions() {

	if( ! current_user_can( 'manage_options' ) )
		return;

	if( empty( $_REQUEST['kbe_action'] ) )
		return;

	$action = sanitize_text_field( $_REQUEST['kbe_action'] );

	/**
	 * Hook that should be used by all processes that make a certain action
	 * withing the plugin, like adding a new affiliate, editing an affiliate, deleting, etc.
	 *
	 */
	do_action( 'kbe_admin_action_' . $action );

}
add_action( 'admin_init', 'kbe_register_admin_do_actions' );


/**
 * Add custom plugin CSS classes to the admin body classes
 *
 */
function kbe_admin_body_class( $classes ) {

	$screen = get_current_screen();

	if( empty( $screen ) )
		return $classes;

	if( ! empty( $_GET['page'] ) && false !== strpos( $_GET['page'], 'kbe' ) )
		$classes .= ' kbe-pagestyles';

	if( $screen->base == 'post' && $screen->post_type == 'kbe_knowledgebase' )
		$classes .= ' kbe-pagestyles-edit-post';

	return $classes;

}
add_filter( 'admin_body_class', 'kbe_admin_body_class' );


/**
 * Enqueue scripts.
 *
 * Enqueue the required stylesheets and javascripts in the admin.
 *
 * @param string $hook_suffix Current page ID.
 *
 */
function kbe_admin_scripts( $hook_suffix ) {

	// Settings page
	if( ( ! empty( $_GET['page'] ) && false !== strpos( $_GET['page'], 'kbe' ) ) || get_post_type() == 'kbe_knowledgebase' ) {

		wp_enqueue_style( 'wp-color-picker' );

		// Select2
		wp_register_script( 'select2-js', WP_KNOWLEDGEBASE . 'assets/libs/select2/select2.min.js', array( 'jquery' ), KBE_PLUGIN_VERSION );
		wp_enqueue_script( 'select2-js' );

		wp_register_style( 'select2-css', WP_KNOWLEDGEBASE . 'assets/libs/select2/select2.min.css', array(), KBE_PLUGIN_VERSION );
		wp_enqueue_style( 'select2-css' );

		// Datepicker Custom
		wp_enqueue_style( 'kbe-datepicker', WP_KNOWLEDGEBASE . 'assets/css/datepicker.css', array(), KBE_PLUGIN_VERSION );

	}

	if( ! empty( $_GET['post_type'] ) && false !== strpos( $_GET['post_type'], 'kbe_knowledgebase' ) ) {

		wp_enqueue_script( 'kbe-script', WP_KNOWLEDGEBASE . 'assets/js/script-admin.js', array( 'wp-color-picker', 'jquery-ui-datepicker' ), KBE_PLUGIN_VERSION, true );
	
	}

	// Order page
	if ( ! empty( $_GET['page'] ) && $_GET['page'] == 'kbe-order' ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	// Old plugin styles
	wp_register_style( 'kbe_admin_css', WP_KNOWLEDGEBASE . '/assets/css/kbe-admin-style.css', array(), KBE_PLUGIN_VERSION );
	if ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'kbe_knowledgebase' ) {
		wp_enqueue_style( 'kbe_admin_css' );
	}

	// New plugin styles
	wp_register_style( 'kbe-style', WP_KNOWLEDGEBASE . '/assets/css/style-admin.css', array(), KBE_PLUGIN_VERSION );
	if ( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'kbe_knowledgebase' ) || get_post_type() == 'kbe_knowledgebase' ) {
		wp_enqueue_style( 'kbe-style' );
	}

}
add_action( 'admin_enqueue_scripts', 'kbe_admin_scripts' );


/**
 * Register the plugin's general settings
 *
 */
function kbe_register_settings() {

	// Register each setting for automated $_POST handling
	foreach ( kbe_get_settings() as $id => $setting ) {

		switch ( $setting['type'] ) {

			case 'number' :
				$sanitize_callback = 'absint';
				break;
			case 'text' :
				$sanitize_callback = 'sanitize_text_field';
				break;
			case 'title' :
				$sanitize_callback = 'sanitize_title';
				break;
			case 'array' :
				$sanitize_callback = '_kbe_array_wp_kses_post';
				break;
			case 'kbe_radio_switch' :
				$sanitize_callback = 'sanitize_kbe_radio_switch';
				break;
			default:
				$sanitize_callback = 'wp_kses_post';

		}

		register_setting( 'kbe_settings', $id, $sanitize_callback );

	}

}
add_action( 'admin_init', 'kbe_register_settings' );


/**
 * Returns the plugin's settings options
 *
 * @return array
 *
 */
function kbe_get_settings() {

	$settings = array(
		'kbe_plugin_slug' => array(
			'type' => 'title',
		),
		'kbe_category_slug' => array(
			'type' => 'text'
		),
		'kbe_page_id' => array(
			'type' => 'number'
		),
		'kbe_article_qty' => array(
			'type' => 'number',
		),
		'kbe_search_setting' => array(
			'type' => 'kbe_radio_switch_on_off',
		),
		'kbe_search_field_placeholder' => array(
			'type' => 'text'
		),
		'kbe_search_no_results_message' => array(
			'type' => 'text_html'
		),
		'kbe_breadcrumbs_setting' => array(
			'type' => 'kbe_radio_switch_on_off',
		),
		'kbe_breadcrumbs_separator' => array(
			'type' => 'text_html'
		),
		'kbe_search_excerpt' => array(
			'type' => 'kbe_radio_switch_on_off',
		),
		'kbe_enable_legacy_templates' => array(
			'type' => 'kbe_radio_switch_on_off'
		),
		'kbe_main_page_template' => array(
			'type' => 'text'
		),
		'kbe_category_page_template' => array(
			'type' => 'text'
		),
		'kbe_single_article_template' => array(
			'type' => 'text'
		),
		'kbe_sidebar_home' => array(
			'type' => 'kbe_radio_switch_lrn', // left, right, none option
		),
		'kbe_sidebar_inner' => array(
			'type' => 'kbe_radio_switch_lrn', // left, right, none option
		),
		'kbe_comments_setting' => array(
			'type' => 'kbe_radio_switch_on_off',
		),
		'kbe_output_style' => array(
			'type' => 'kbe_radio_switch_on_off',
		),
		'kbe_bgcolor' => array(
			'type' => 'color',
		),
		'kbe_show_page_getting_started' => array(
			'type' => 'kbe_radio_switch_on_off'
		),
		'kbe_wipe_uninstall' => array(
			'type' => 'kbe_radio_switch_on_off',
		)
	);

	/**
	 * Filter the settings array
	 *
	 * @param array $settings
	 *
	 */
	return apply_filters( 'kbe_settings', $settings );

}

function kbe_radio_switch_on_off( $v ) {
	if ( $v == 1 ) {
		return 1;
	}
	return 0;
}

function kbe_radio_switch_lrn( $v ) {
	if ( $v == 1 ) {
		return 1;
	} elseif ( $v == 2 ) {
		return 2;
	}
	return 0;
}

/**
 * Sanitizes the values of an array recursivelly and allows HTML tags
 *
 * @param array $array
 *
 * @return array
 *
 */
function _kbe_array_wp_kses_post( $array = array() ) {

    if( empty( $array ) || ! is_array( $array ) )
        return array();

    foreach( $array as $key => $value ) {

        if( is_array( $value ) )
            $array[$key] = _kbe_array_wp_kses_post( $value );

        else
            $array[$key] = wp_kses_post( $value );

    }

    return $array;

}


/**
 * Migrations check
 *
 */
function kbe_migrations_check() {

	require_once plugin_dir_path( __FILE__ ) . '../migrations/class-migration-manager.php';
	$migration_manager = new KBE_Migration_Manager( 'wp-knowledgebase' );

}
add_action( 'admin_init', 'kbe_migrations_check' );
register_activation_hook( __FILE__, 'kbe_migrations_check' );


/**
 * Determines whether or not there are WP Knowledgebase add-ons on the server
 *
 * @return bool
 *
 */
function kbe_add_ons_exist() {

	$plugins = get_plugins();

	foreach( $plugins as $plugin_slug => $plugin_details ) {

		if( 0 === strpos( $plugin_slug, 'wp-knowledgebase-add-on' ) )
			return true;

	}

	return false;

}


/**
 * Determines whether the current website is registered with a license key or not
 *
 * @return bool
 *
 */
function kbe_is_website_registered() {

	$registered = get_option( 'kbe_website_registered' );

	return ( false === $registered ? false : true );

}


/**
 * Handle admin notices dismissals
 *
 */
function kbe_admin_notice_dismiss() {

	// Do nothing if the user doesn't have privileges
	if( ! current_user_can( 'activate_plugins' ) )
		return;

	if( isset( $_GET['kbe_admin_notice_plugin_version_1_2_4'] ) )
		add_user_meta( get_current_user_id(), 'kbe_admin_notice_plugin_version_1_2_4', 1, true );

}
add_action( 'admin_init', 'kbe_admin_notice_dismiss' );


/**
 * Adds external links to the admin submenu
 *
 */
function kbe_add_admin_menu_external_items() {

	global $submenu;

	if( empty( $submenu ) || ! is_array( $submenu ) )
		return;

	if( ! isset( $submenu['edit.php?post_type=kbe_knowledgebase'] ) )
		return;

	$submenu['edit.php?post_type=kbe_knowledgebase'][1000] = array( '<span style="color: #4cd137;">' . __( 'Upgrade', 'wp-knowledgebase' ) . '&nbsp;&rarr;' . '</span>', 'manage_options', 'https://usewpknowledgebase.com/' );

}
add_action( 'admin_init', 'kbe_add_admin_menu_external_items', 1000 );


/**
 * Adds a script to make external links to the site open in a new tab
 *
 */
function kbe_external_menu_items_script() {
	?>

	<script>
		jQuery( function($) {
			$('a[href="https://usewpknowledgebase.com/"]').attr( 'target', '_blank' );
		});
	</script>

	<?php
}
add_action( 'admin_footer', 'kbe_external_menu_items_script', 1000 );


/**
 * Adds a header to the plugin's settings pages
 *
 */
function kbe_admin_header() {

	if( empty( $_GET['post_type'] ) || false === strpos( $_GET['post_type'], 'kbe_knowledgebase' ) )
		return;

	?>

	<div id="kbe-header">
		<a href="https://usewpknowledgebase.com/" target="_blank">
			<img src="<?php echo KBE_PLUGIN_DIR_URL; ?>/assets/images/kbe-logo.png" />
			WP Knowledgebase
		</a>

		<nav>
			<a href="https://usewpknowledgebase.com/contact/?topic=Technical%20Issue&amp;utm_source=header&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
				Report bug
			</a>

			<span>|</span>

			<a href="https://usewpknowledgebase.com/contact/?topic=Feature%20Request&amp;utm_source=header&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
				Request feature
			</a>

			<span>|</span>

			<a href="https://usewpknowledgebase.com/contact/?utm_source=header&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
				Get help
			</a>

			<?php if( ! kbe_is_website_registered() ): ?>
				<a href="https://usewpknowledgebase.com/?utm_source=header&amp;utm_medium=plugin-admin&amp;utm_campaign=KBEFree" target="_blank" class="kbe-header-button-upgrade"><?php echo __( 'Upgrade to PRO', 'wp-knowledgebase' ); ?></a>
			<?php endif; ?>
		</nav>

	</div>

	<?php

}
add_action( 'admin_notices', 'kbe_admin_header', 1 );