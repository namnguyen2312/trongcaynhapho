<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Flush rewrite rules if the slug has changed
$slug_changed = get_option( 'kbe_slug_changed' );

if( $slug_changed ) {

    delete_option( 'kbe_slug_changed' );
    flush_rewrite_rules();

}

// Set active tab
$active_tab = ( ! empty( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general' );

?>

<div class="wrap kbe-wrap kbe-wrap-settings">

    <form method="post" action="options.php">

        <?php settings_fields( 'kbe_settings' ); ?>

        <!-- Page Heading -->
        <h1 class="wp-heading-inline"><?php echo __( 'Settings', 'wp-knowledgebase' ); ?></h1>
        <hr class="wp-header-end" />

        <?php

            global $wpdb;

            $tbl_posts = $wpdb->prefix . 'posts';

            if ( isset( $kbe_settings['update'] ) ) {

                $kbe_posts = $wpdb->get_results( "SELECT * FROM $tbl_posts WHERE post_content LIKE '%[kbe_knowledgebase]%' AND post_type = 'page'" );

                foreach ( $kbe_posts as $kbe_post ) {
                    $kbe_id   = $kbe_post->ID;
                    $kbe_slug = get_option( 'kbe_plugin_slug' );

                    $kbe_post_data = array(
                        'post_name' => $kbe_slug
                    );

                    $kbe_post_where = array(
                        'ID' => $kbe_id
                    );

                    $wpdb->update( $tbl_posts, $kbe_post_data, $kbe_post_where );
                }

                flush_rewrite_rules();

                ?><div class='updated' style='margin-top:10px;'>
                    <p><?php _e( 'Settings updated successfully', 'wp-knowledgebase' ); ?></p>
                </div><?php

                unset( $kbe_settings['update'] );
                update_option( 'kbe_settings', $kbe_settings );

            }

        ?>

        <div id="kbe-content-wrapper">

            <?php if( count( $tabs ) > 1 ): ?>

                <!-- Tab Navigation -->
                <div id="kbe-nav-tab-wrapper" class="kbe-card">

                    <!-- Navigation Tab Links -->
                    <ul>
                        <?php 
                            foreach( $tabs as $tab_slug => $tab ) {
                                echo '<li class="kbe-nav-tab ' . ( $tab_slug == $active_tab ? 'kbe-active' : '' ) . '" data-tab="' . esc_attr( $tab_slug ) . '"><a href="#">' . kbe_get_svg_icon( $tab['icon'] ) . '<span>' . esc_attr( $tab['label'] ) . '</span></a></li>';
                            }
                        ?>
                    </ul>

                    <!-- Hidden active tab -->
                    <input type="hidden" name="active_tab" value="<?php echo esc_attr( $active_tab ); ?>" />

                </div>

            <?php endif; ?>

            <!-- Primary Content -->
            <div id="kbe-primary">

                <!-- Tab: General Settings -->
                <div class="kbe-tab <?php echo ( $active_tab == 'general' ? 'kbe-active' : '' ); ?>" data-tab="general">

                    <!-- Register website -->
                    <?php if( kbe_add_ons_exist() ): ?>

                        <div class="kbe-card">

                            <div class="kbe-card-header">
                                <?php echo __( 'Register Website', 'wp-knowledgebase' ); ?>
                            </div>

                            <div class="kbe-card-inner">

                                <!-- License Key -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-field-wrapper-license-key kbe-last">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-license-key">
                                            <?php echo __( 'License Key', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>

                                    <div class="kbe-flex-wrapper">

                                        <input id="kbe-license-key" name="license_key" type="text" value="<?php echo esc_attr( get_option( 'kbe_license_key', '' ) ); ?>">
                                        <a id="kbe-register-license-key" class="kbe-button-secondary" href="#">
                                            <span class="kbe-register" <?php echo ( kbe_is_website_registered() ? 'style="display: none;"' : '' ); ?>><?php echo __( 'Register', 'wp-knowledgebase' ); ?></span>
                                            <span class="kbe-deregister" <?php echo ( ! kbe_is_website_registered() ? 'style="display: none;"' : '' ); ?>><?php echo __( 'Deregister', 'wp-knowledgebase' ); ?></span>
                                        </a>
                                        
                                    </div>

                                    <input id="kbe-is-website-registered" type="hidden" value="<?php echo ( kbe_is_website_registered() ? 'true' : 'false' ); ?>" />

                                </div><!-- / License Key -->

                            </div>

                        </div>

                    <?php endif; ?>
                    <!-- / Register website -->

                    <!-- General Settings -->
                    <div class="kbe-card">

                        <div class="kbe-card-header">
                            <?php echo __( 'General Settings', 'wp-knowledgebase' ); ?>
                        </div>

                        <div class="kbe-card-inner">

                            <!-- Knowledgebase Slug -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-knowledgebase-slug">
                                        <?php echo __( 'Knowledgebase Slug', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-knowledgebase-slug" name="kbe_plugin_slug" type="text" value="<?php echo esc_attr( get_option( 'kbe_plugin_slug', 'knowledgebase' ) ); ?>">

                            </div><!-- / Knowledgebase Slug -->

                            <!-- Category Slug -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-category-slug">
                                        <?php echo __( 'Knowledgebase Category Slug', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-category-slug" name="kbe_category_slug" type="text" value="<?php echo esc_attr( get_option( 'kbe_category_slug', 'knowledgebase_category' ) ); ?>">

                            </div><!-- / Category Slug -->

                            <!-- Knowledgebase Main Page -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-knowledgebase-main-page">
                                        <?php echo __( 'Knowledgebase Main Page', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <select id="kbe-knowledgebase-main-page" name="kbe_page_id" class="kbe-select2">

                                    <option value=""><?php echo( __( 'Select...', 'wp-knowledgebase' ) ); ?></option>
                                    
                                    <?php $pages = get_pages(); ?>

                                    <?php
                                        foreach( $pages as $page ) {
                                            echo '<option value="' . $page->ID . '"' . selected( ! empty( $_POST['kbe_page_id'] ) ? absint( $_POST['kbe_page_id'] ) : ( empty( $_POST ) ? get_option( 'kbe_page_id' ) : '' ), $page->ID ) . '>' . $page->post_title . '</option>';
                                        }
                                    ?>

                                </select>

                            </div>
                            <!-- / Knowledgebase Main Page -->

                            <!-- Number of Articles -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-number-of-articles">
                                        <?php echo __( 'Number of Articles to Show', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-number-of-articles" name="kbe_article_qty" type="number" value="<?php echo esc_attr( get_option( 'kbe_article_qty', 5 ) ); ?>">

                                <p class="description kbe-description">
                                    <strong><?php echo __( 'Note:', 'wp-knowledgebase' ); ?></strong>
                                    <?php echo __( 'Set the number of articles to show in each category on KB homepage', 'wp-knowledgebase' ); ?>
                                </p>

                            </div><!-- / Number of Articles -->

                            <!-- Output CSS -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-output-css">
                                        <?php echo __( 'Output CSS', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-output-css" class="kbe-toggle kbe-toggle-round" name="kbe_output_style" type="checkbox" value="1" <?php checked( get_option( 'kbe_output_style', 0 ), '1' ); ?> />
                                    <label for="kbe-output-css"></label>

                                </div>

                                <label for="kbe-output-css"><?php echo __( "If enabled, the plugin's stylesheet will be used.", 'wp-knowledgebase' ); ?></label>

                            </div><!-- / Output CSS -->

                            <!-- Wipe all data on uninstall -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-last">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-uninstall-data">
                                        <?php echo __( 'Wipe All Data on Uninstall', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-uninstall-data" class="kbe-toggle kbe-toggle-round" name="kbe_wipe_uninstall" type="checkbox" value="1" <?php checked( get_option( 'kbe_wipe_uninstall', 0 ), '1' ); ?> />
                                    <label for="kbe-uninstall-data"></label>

                                </div>

                                <label for="kbe-uninstall-data"><?php echo __( 'If enabled, when deleting the plugin all its data will be removed.', 'wp-knowledgebase' ); ?></label>

                                <p class="description kbe-description">
                                    <strong><?php echo __( 'Note:', 'wp-knowledgebase' ); ?></strong>
                                    <?php echo __( 'This also includes all your articles and CANNOT be undone.', 'wp-knowledgebase' ); ?>
                                </p>

                            </div><!-- / Wipe all data on uninstall -->

                        </div>

                    </div><!-- / General Settings -->

                    <!-- Design -->
                    <div class="kbe-card">

                        <div class="kbe-card-header">
                            <?php echo __( 'Knowledgebase Design', 'wp-knowledgebase' ); ?>
                        </div>

                        <div class="kbe-card-inner">

                            <!-- Use legacy templates -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-enable-legacy-templates">
                                        <?php echo __( 'Use Legacy Templates', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-enable-legacy-templates" class="kbe-toggle kbe-toggle-round" name="kbe_enable_legacy_templates" type="checkbox" value="1" <?php checked( get_option( 'kbe_enable_legacy_templates', 0 ), '1' ); ?> />
                                    <label for="kbe-enable-legacy-templates"></label>

                                </div>

                                <label for="kbe-enable-legacy-templates"><?php echo __( 'If enabled, the old template system will be used.', 'wp-knowledgebase' ); ?></label>

                                <div class="kbe-field-notice field-notice-warning" style="display: none;">
                                    <p><?php echo __( "We don't recommend using the lagacy template system.", 'wp-knowledgebase' ); ?></p>
                                    <p><?php echo __( "Legacy templates are supported only for temporary backwards compatibility. They will be removed in a future update.", 'wp-knowledgebase' ); ?></p>
                                    <p><?php echo __( "We recommend using the new default template system. If you find it isn't working properly on your theme, please contact us and we'll do our best to help you out.", 'wp-knowledgebase' ); ?></p>
                                </div>

                            </div>
                            <!-- / Use legacy templates -->

                            <div class="kbe-field-group kbe-field-group-current-templates" style="display: none;">

                                <!-- Knowledgebase Main Page Template -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-main-page-template">
                                            <?php echo __( 'Main Page Template', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>
                                    
                                    <select id="kbe-main-page-template" name="kbe_main_page_template" class="kbe-select2">
                                        <option value="wide" <?php echo selected( get_option( 'kbe_main_page_template', 'wide' ), 'wide' ); ?>><?php echo __( 'Full width, no sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-left" <?php echo selected( get_option( 'kbe_main_page_template', 'wide' ), 'sidebar-left' ); ?>><?php echo __( 'With left sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-right" <?php echo selected( get_option( 'kbe_main_page_template', 'wide' ), 'sidebar-right' ); ?>><?php echo __( 'With right sidebar', 'wp-knowledgebase' ); ?></option>
                                    </select>

                                </div><!-- / Knowledgebase Main Page Template -->

                                <!-- Knowledgebase Category Page Template -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-category-page-template">
                                            <?php echo __( 'Category Page Template', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>
                                    
                                    <select id="kbe-category-page-template" name="kbe_category_page_template" class="kbe-select2">
                                        <option value="wide" <?php echo selected( get_option( 'kbe_category_page_template', 'wide' ), 'wide' ); ?>><?php echo __( 'Full width, no sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-left" <?php echo selected( get_option( 'kbe_category_page_template', 'wide' ), 'sidebar-left' ); ?>><?php echo __( 'With left sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-right" <?php echo selected( get_option( 'kbe_category_page_template', 'wide' ), 'sidebar-right' ); ?>><?php echo __( 'With right sidebar', 'wp-knowledgebase' ); ?></option>
                                    </select>

                                </div><!-- / Knowledgebase Category Page Template -->

                                <!-- Knowledgebase Single Article Template -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-single-article-template">
                                            <?php echo __( 'Single Article Template', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>
                                    
                                    <select id="kbe-single-article-template" name="kbe_single_article_template" class="kbe-select2">
                                        <option value="wide" <?php echo selected( get_option( 'kbe_single_article_template', 'wide' ), 'wide' ); ?>><?php echo __( 'Full width, no sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-left" <?php echo selected( get_option( 'kbe_single_article_template', 'wide' ), 'sidebar-left' ); ?>><?php echo __( 'With left sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="sidebar-right" <?php echo selected( get_option( 'kbe_single_article_template', 'wide' ), 'sidebar-right' ); ?>><?php echo __( 'With right sidebar', 'wp-knowledgebase' ); ?></option>
                                    </select>

                                </div><!-- / Knowledgebase Single Article Template -->

                            </div>

                            <div class="kbe-field-group kbe-field-group-legacy-templates" style="display: none;">

                                <!-- Knowledgebase Home Page Sidebar -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-homepage-sidebar">
                                            <?php echo __( 'Main Page Template', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>
                                    
                                    <select id="kbe-homepage-sidebar" name="kbe_sidebar_home" class="kbe-select2">
                                        <option value="0" <?php echo selected( get_option( 'kbe_sidebar_home', 0 ), 0 ); ?>><?php echo __( 'Full width', 'wp-knowledgebase' ); ?></option>
                                        <option value="1" <?php echo selected( get_option( 'kbe_sidebar_home', 0 ), 1 ); ?>><?php echo __( 'With left sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="2" <?php echo selected( get_option( 'kbe_sidebar_home', 0 ), 2 ); ?>><?php echo __( 'With right sidebar', 'wp-knowledgebase' ); ?></option>
                                    </select>

                                </div><!-- / Knowledgebase Home Page Sidebar -->

                                <!-- Knowledgebase Inner Page Sidebar -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-inner-pages-sidebar">
                                            <?php echo __( 'Inner Pages Template', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>
                                    
                                    <select id="kbe-inner-pages-sidebar" name="kbe_sidebar_inner" class="kbe-select2">
                                        <option value="0" <?php echo selected( get_option( 'kbe_sidebar_inner', 0 ), 0 ); ?>><?php echo __( 'Full width', 'wp-knowledgebase' ); ?></option>
                                        <option value="1" <?php echo selected( get_option( 'kbe_sidebar_inner', 0 ), 1 ); ?>><?php echo __( 'With left sidebar', 'wp-knowledgebase' ); ?></option>
                                        <option value="2" <?php echo selected( get_option( 'kbe_sidebar_inner', 0 ), 2 ); ?>><?php echo __( 'With right sidebar', 'wp-knowledgebase' ); ?></option>
                                    </select>

                                </div><!-- / Knowledgebase Inner Page Sidebar -->

                                <!-- Knowledgebase Comments -->
                                <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                    <div class="kbe-field-label-wrapper">
                                        <label for="kbe-knowledgebase-comments">
                                            <?php echo __( 'Knowledgebase Comments', 'wp-knowledgebase' ); ?>
                                        </label>
                                    </div>

                                    <div class="kbe-switch">

                                        <input id="kbe-knowledgebase-comments" class="kbe-toggle kbe-toggle-round" name="kbe_comments_setting" type="checkbox" value="1" <?php checked( get_option( 'kbe_comments_setting', 0 ), '1' ); ?> />
                                        <label for="kbe-knowledgebase-comments"></label>

                                    </div>

                                    <label for="kbe-knowledgebase-comments"><?php echo __( 'Enables comments for your knowledgebase articles.', 'wp-knowledgebase' ); ?></label>

                                </div><!-- / Knowledgebase Comments -->

                            </div>

                            <!-- Knowledgebase Theme Color -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-last">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-knowledgebase-theme-color">
                                        <?php echo __( 'Theme Color', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input type="text" name="kbe_bgcolor" id="kbe_bgcolor" value="<?php echo esc_attr( get_option( 'kbe_bgcolor', '' ) ); ?>" class="cp-field">

                            </div><!-- / Knowledgebase Theme Color -->

                        </div>

                    </div><!-- / Design -->

                    <!-- Search -->
                    <div class="kbe-card">

                        <div class="kbe-card-header">
                            <?php echo __( 'Knowledgebase Search', 'wp-knowledgebase' ); ?>
                        </div>

                        <div class="kbe-card-inner">

                            <!-- Enable Knowledgebase Search -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-enable-knowledgebase-search">
                                        <?php echo __( 'Enable Search', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-enable-knowledgebase-search" class="kbe-toggle kbe-toggle-round" name="kbe_search_setting" type="checkbox" value="1" <?php checked( get_option( 'kbe_search_setting', 0 ), '1' ); ?> />
                                    <label for="kbe-enable-knowledgebase-search"></label>

                                </div>

                                <label for="kbe-enable-knowledgebase-search"><?php echo __( 'Enables live search across your knowledgebase.', 'wp-knowledgebase' ); ?></label>

                            </div><!-- / Enable Knowledgebase Search -->

                            <!-- Live Search Excerpt -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-search-excerpt">
                                        <?php echo __( 'Live Search Results Excerpt', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-search-excerpt" class="kbe-toggle kbe-toggle-round" name="kbe_search_excerpt" type="checkbox" value="1" <?php checked( get_option( 'kbe_search_excerpt', 0 ), '1' ); ?> />
                                    <label for="kbe-search-excerpt"></label>

                                </div>

                                <label for="kbe-search-excerpt"><?php echo __( 'Shows the article excerpt alongside the title in the search results drop-down.', 'wp-knowledgebase' ); ?></label>

                            </div><!-- / Live Search Excerpt -->

                            <!-- Search Field Placeholder -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-search-field-placeholder">
                                        <?php echo __( 'Search Field Placeholder', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-search-field-placeholder" name="kbe_search_field_placeholder" type="text" value="<?php echo esc_attr( get_option( 'kbe_search_field_placeholder', '' ) ); ?>">

                            </div><!-- / Search Field Placeholder -->

                            <!-- Search No Results Message -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-last">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-search-no-results-message">
                                        <?php echo __( 'No Results Message', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-search-no-results-message" name="kbe_search_no_results_message" type="text" value="<?php echo esc_attr( get_option( 'kbe_search_no_results_message', '' ) ); ?>">

                            </div><!-- / Search No Results Message -->

                        </div>

                    </div><!-- / Search -->

                    <!-- Breadcrumbs -->
                    <div class="kbe-card">

                        <div class="kbe-card-header">
                            <?php echo __( 'Knowledgebase Breadcrumbs', 'wp-knowledgebase' ); ?>
                        </div>

                        <div class="kbe-card-inner">

                            <!-- Knowledgebase Breadcrumbs -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-knowledgebase-breadcrumbs">
                                        <?php echo __( 'Enable Breadcrumbs', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-knowledgebase-breadcrumbs" class="kbe-toggle kbe-toggle-round" name="kbe_breadcrumbs_setting" type="checkbox" value="1" <?php checked( get_option( 'kbe_breadcrumbs_setting', 0 ), '1' ); ?> />
                                    <label for="kbe-knowledgebase-breadcrumbs"></label>

                                </div>

                                <label for="kbe-knowledgebase-breadcrumbs"><?php echo __( 'Enables breadcrumbs for your knowledgebase.', 'wp-knowledgebase' ); ?></label>

                            </div><!-- / Knowledgebase Breadcrumbs -->

                            <!-- Breadcrumbs Separator -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-last">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-breadcrumbs-separator">
                                        <?php echo __( 'Breadcrumbs Items Separator', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <input id="kbe-breadcrumbs-separator" name="kbe_breadcrumbs_separator" type="text" value="<?php echo esc_attr( get_option( 'kbe_breadcrumbs_separator', '/' ) ); ?>">

                            </div><!-- / Breadcrumbs Separator -->

                        </div>

                    </div><!-- / Breadcrumbs -->

                    <!-- Misc -->
                    <div class="kbe-card">

                        <div class="kbe-card-header">
                            <?php echo __( 'Misc', 'wp-knowledgebase' ); ?>
                        </div>

                        <div class="kbe-card-inner">

                            <!-- Show Getting Started Page -->
                            <div class="kbe-field-wrapper kbe-field-wrapper-inline kbe-last">

                                <div class="kbe-field-label-wrapper">
                                    <label for="kbe-show-page-getting-started">
                                        <?php echo __( 'Show Getting Started Page', 'wp-knowledgebase' ); ?>
                                    </label>
                                </div>

                                <div class="kbe-switch">

                                    <input id="kbe-show-page-getting-started" class="kbe-toggle kbe-toggle-round" name="kbe_show_page_getting_started" type="checkbox" value="1" <?php checked( get_option( 'kbe_show_page_getting_started', 0 ), '1' ); ?> />
                                    <label for="kbe-show-page-getting-started"></label>

                                </div>

                                <label for="kbe-show-page-getting-started"><?php echo __( "Shows the Getting Started page in the plugin's menu.", 'wp-knowledgebase' ); ?></label>

                            </div><!-- / Show Getting Started Page -->

                        </div>

                    </div><!-- / Misc -->

                    <?php 

                        /**
                         * Hook to add extra cards if needed to the General Settings tab
                         *
                         */
                        do_action( 'kbe_view_settings_tab_general_bottom' );

                    ?>

                </div>
                <!-- / Tab: General Settings -->

                <?php

                    /**
                     * Hooks to add additional tabs
                     *
                     */
                    do_action( 'kbe_view_settings_tabs_views', $active_tab );

                ?>

            </div><!-- / Primary -->

            <!-- Secondary -->
            <div id="kbe-secondary">

                <!-- Secondary content -->

            </div><!-- / Secondary -->

        </div><!-- / Content Wrapper -->

        <!-- Save Settings Button -->
        <input type="submit" class="kbe-form-submit button-primary" value="<?php echo __( 'Save Settings', 'wp-knowledgebase' ); ?>" />

        <!-- Action and nonce -->
        <input type="hidden" name="update" value="update" />
        <?php wp_nonce_field( 'kbe_save_settings', 'kbe_token', false ); ?>

    </form>

</div>