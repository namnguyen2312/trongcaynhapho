<?php

class foodfarm_instagram_settings {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
                'Instagram Settings', 'Instagram Settings', 'manage_options', 'instagram-feed', array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('foodfarm_instagram');
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>          
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('foodfarm_instagram_group');
                do_settings_sections('instagram-feed');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
                'foodfarm_instagram_group', // Option group
                'foodfarm_instagram' // Option name
        );

        add_settings_section(
                'general_setting', // ID
                'General Settings', // Title
                array($this, 'print_section_info'), // Callback
                'instagram-feed' // Page
        );

        add_settings_field(
                'access_token', 'Access token', array($this, 'access_token_id_callback'), 'instagram-feed', 'general_setting'
        );
        
        add_settings_field(
                'type', 'User ID', array($this, 'type_callback'), 'instagram-feed', 'general_setting'
        );
    }

    /**
     * Print the Section text
     */
    public function print_section_info() {
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function access_token_id_callback() {
        printf(
                '<input type="text" id="access_token" size="100" name="foodfarm_instagram[access_token]" value="%s" />', isset($this->options['access_token']) ? esc_attr($this->options['access_token']) : ''
        );
    }
    
    public function type_callback() {
        printf(
                '<input type="text" name="foodfarm_instagram[user_id]" value="%s"/><br>',
                isset($this->options['user_id']) ? esc_attr($this->options['user_id']) : ''
        );
    }

}

new foodfarm_instagram_settings();