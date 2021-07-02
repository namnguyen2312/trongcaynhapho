<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



/**
 * Includes the files needed for the Getting Started page
 *
 */
function kbe_include_files_admin_promo() {

    // Get legend admin dir path
    $dir_path = plugin_dir_path( __FILE__ );

    // Include submenu pages
    if( file_exists( $dir_path . 'class-submenu-page-search-analytics.php' ) )
        include $dir_path . 'class-submenu-page-search-analytics.php';

    if( file_exists( $dir_path . 'class-submenu-page-article-feedback.php' ) )
        include $dir_path . 'class-submenu-page-article-feedback.php';

}
add_action( 'kbe_include_files', 'kbe_include_files_admin_promo' );


/**
 * Register the Article Feedback admin submenu page
 *
 */
function kbe_register_submenu_page_promo_article_feedback( $submenu_pages ) {

    if( ! is_array( $submenu_pages ) )
        return $submenu_pages;

    if( kbe_is_website_registered() )
        return $submenu_pages;

    $submenu_pages['article_feedback'] = array(
        'class_name' => 'KBE_Submenu_Page_Article_Feedback',
        'data'       => array(
            'page_title' => __( 'Article Feedback', 'wp-knowledgebase' ),
            'menu_title' => __( 'Article Feedback', 'wp-knowledgebase' ),
            'capability' => 'manage_options',
            'menu_slug'  => 'kbe-article-feedback'
        )
    );

    return $submenu_pages;

}
add_filter( 'kbe_register_submenu_page', 'kbe_register_submenu_page_promo_article_feedback', 45 );


/**
 * Register the Search Analytics admin submenu page
 *
 */
function kbe_register_submenu_page_promo_search_analytics( $submenu_pages ) {

    if( ! is_array( $submenu_pages ) )
        return $submenu_pages;

    if( kbe_is_website_registered() )
        return $submenu_pages;

    $submenu_pages['search_analytics'] = array(
        'class_name' => 'KBE_Submenu_Page_Search_Analytics',
        'data'       => array(
            'page_title' => __( 'Search Analytics', 'wp-knowledgebase' ),
            'menu_title' => __( 'Search Analytics', 'wp-knowledgebase' ),
            'capability' => 'manage_options',
            'menu_slug'  => 'kbe-search-analytics'
        )
    );

    return $submenu_pages;

}
add_filter( 'kbe_register_submenu_page', 'kbe_register_submenu_page_promo_search_analytics', 50 );


/**
 * Adds a promotional card to the bottom of the settings page to promote
 * the content restriction add-on
 *
 */
function kbe_view_promo_content_restriction() {

	?>

		<!-- Content Restriction -->
        <div class="kbe-card">

            <div class="kbe-card-header">
                <?php echo __( 'Content Restriction', 'wp-knowledgebase' ); ?>
                <a class="kbe-promo-pill" href="http://usewpknowledgebase.com/" target="_blank"><?php echo __( 'Pro Feature', 'wp-knowledgebase' ); ?></a>
            </div>

            <div class="kbe-card-inner">

            	<div style="position: relative; background: #f6f6f6; border-radius: 4px; padding: 15px 15px 15px 60px;">
	                <span class="dashicons dashicons-lock" style="position: absolute; top: 15px; left: 15px; font-size: 30px; width: 30px; height: 30px;"></span>
	                <p style="margin-top: 0;"><?php echo __( 'Restrict access, by user role or individual users, to your knowledgebase articles and redirect unauthorized users to a custom link.', 'wp-knowledgebase' ); ?></p>
	                <a href="http://usewpknowledgebase.com/" target="_blank" class="kbe-button-secondary"><?php echo __( 'Learn more', 'wp-knowledgebase' ) ?></a>
	            </div>

            </div>

        </div><!-- / Content Restriction -->

	<?php

}
add_action( 'kbe_view_settings_tab_general_bottom', 'kbe_view_promo_content_restriction' );