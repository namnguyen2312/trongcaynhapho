<?php
$theme = wp_get_theme();
define('foodfarm_version', $theme->get('Version'));
define('foodfarm_lib', get_template_directory() . '/inc');
define('foodfarm_admin', foodfarm_lib . '/admin');
define('foodfarm_plugins', foodfarm_lib . '/plugins');
define('foodfarm_functions', foodfarm_lib . '/functions');
define('foodfarm_metaboxes', foodfarm_functions . '/metaboxes');
define('foodfarm_css', get_template_directory_uri() . '/css');
define('foodfarm_js', get_template_directory_uri() . '/js');

require_once(foodfarm_admin . '/functions.php');
require_once(foodfarm_functions . '/functions.php');
require_once(foodfarm_metaboxes . '/functions.php');
require_once(foodfarm_plugins . '/functions.php');
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 1140;
}
global $foodfarm_settings;
if (!function_exists('foodfarm_setup')) {

    function foodfarm_setup() {
        load_theme_textdomain('foodfarm', get_template_directory() . '/languages');
        add_editor_style( array( 'style.css', 'style_rtl.css' ) );
        add_theme_support( 'title-tag' );
        add_theme_support('automatic-feed-links');
        // register menus
        register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'foodfarm'),
            'primary_services' => esc_html__('Services Menu', 'foodfarm'),
            'vertical_menu' => esc_html__('Vertical Menu', 'foodfarm'),
            'bakery_menu' => esc_html__('Bakery Menu', 'foodfarm'),
            'fruit_menu' => esc_html__('Fruits Menu', 'foodfarm'),
            'flower_menu' => esc_html__('Flower Farm Menu', 'foodfarm'),
        ));
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'post-thumbnails' );
        add_image_size('foodfarm-recipes-carousel', 498, 305, true);
        add_image_size('foodfarm-recipes-grid', 295, 295, true);
        add_image_size('foodfarm-recipe-grid-2', 555, 367, true);
        add_image_size('foodfarm-gallery-grid', 480, 352, true);
        add_image_size('foodfarm-gallery-grid_2', 480, 407, true);
        add_image_size('foodfarm-blog-small', 132, 127, true);
        add_image_size('foodfarm-blog-grid', 365, 392, true);
        add_image_size('foodfarm-blog-grid-2', 360, 208, true);
        add_image_size('foodfarm-blog-grid-3', 555, 280, true);
        add_image_size('foodfarm-blog-grid-4', 555, 300, true);
        add_image_size('foodfarm-blog-grid-6', 356, 231, true);
        add_image_size('foodfarm-blog-sticky-1', 554, 350, true);
        add_image_size('foodfarm-blog-sticky-2', 554, 610, true);
        add_image_size('foodfarm-blog-list', 848, 380, true);
        add_image_size('foodfarm-recipe-list', 475, 262, true);
        add_image_size('foodfarm-knowledge-list', 458, 264, true);
        add_image_size('foodfarm-recipe-single', 859, 527, true);     
        add_image_size('foodfarm-member', 100, 100, true);  
        add_image_size('foodfarm-testimonial', 234, 141, true);  

        /** Added version 1.7 ( Woo 3.3+ removed product image size for mini cart) */
        add_image_size('foodfarm-minicart',100,100,true);
        
    }

}
add_action('after_setup_theme', 'foodfarm_setup');


add_action('admin_enqueue_scripts', 'foodfarm_admin_scripts_js');
function foodfarm_admin_scripts_js() {

    $screen = get_current_screen();
    $foodfarm_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    wp_register_script('foodfarm_admin_js', foodfarm_js . '/un-minify/admin'.$foodfarm_suffix.'.js', array('common', 'jquery', 'media-upload', 'thickbox'), foodfarm_version, true);    

    if ( isset($screen->id) && in_array( $screen->id, array( 'nav-menus', 'post','page','recipe','product','gallery' ) ) ){

        wp_enqueue_script('iris');
        wp_enqueue_script('foodfarm_admin_js');
        wp_localize_script('foodfarm_admin_js', 'foodfarm_params', array(
            'foodfarm_version' => foodfarm_version,
        ));             
    }

    if(is_rtl()){
        wp_enqueue_style('foodfarm_admin_rtl_css', foodfarm_css . '/admin-rtl'.$foodfarm_suffix.'.css', false);
    }
    else{
        wp_enqueue_style('foodfarm_admin_css', foodfarm_css . '/admin'.$foodfarm_suffix.'.css', false);
    }   

}

if(!function_exists('foodfarm_optimize_plugin_enqueue')){
    function foodfarm_optimize_plugin_enqueue($post_content){
        if(get_post_type()!='product' && !stripos($post_content,'foodfarm_product') && !stripos($post_content,'foodfarm_product_cate') && !stripos($post_content,'product')){
            wp_dequeue_style('yith-woocompare-widget');
            wp_dequeue_style('jquery-colorbox');

            wp_dequeue_style('woocommerce_prettyPhoto_css');
            wp_dequeue_style('jquery-selectBox');
            wp_dequeue_style('yith-wcwl-main');
            wp_dequeue_script('jquery-cookie');

            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('yith-woocompare-main');
            wp_dequeue_script('jquery-colorbox');
            wp_dequeue_script('yith-wcqv-frontend');
            wp_dequeue_script('jquery-selectBox');
            wp_dequeue_script('jquery-yith-wcwl');   

        }  
        if(get_post_type() !='kbe_knowledgebase'){
            wp_dequeue_style('kbe_theme_style');
        }    
    }    
}


function foodfarm_scripts_styles() {
    if(!is_admin()){
        global $foodfarm_settings;

        $foodfarm_main_color = foodfarm_get_meta_value('main_color');
        $foodfarm_h_color = foodfarm_get_meta_value('h_color');
        $foodfarm_custom_css ='';
        $foodfarm_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        //Custom font
        if (isset($foodfarm_h_color) && $foodfarm_h_color != '' ){
            $foodfarm_custom_css .= "
            .footer-v4 .newsletter-footer button.btn-default:hover,
            .footer-v5 .newsletter-footer button.btn-default:hover,
            .woocommerce-tabs #tab-revssiews .form-submit input:hover,
            .price_slider_amount .button:hover,
            .btn-default:hover, 
            .btn-default:focus, 
            .btn-default:active, 
            .btn-default:active:focus, 
            .btn-default:focus:active,
            .vc_btn3.vc_btn3-color-grey.vc_general.btn , 
            .vc_btn3.vc_btn3-color-grey.vc_btn3-style-custom.vc_general.btn:hover,
            .woocommerce table.wishlist_table tr.cart_item td.product-add-to-cart div.add-to-cart a.button:hover,
            .woocommerce-account .woocommerce-MyAccount-content input[type='submit']:hover,
            .footer-v6 .newsletter-footer button.btn-default:hover,
            .prd_cat_count:hover,.h-bg .ubtn,.h-bg .ubtn-link,
            .main-bg .ubtn:hover, .main-bg .ubtn-link:hover,
            .prd_cat_count:before, .prd_cat_count:after,.main-bg .ubtn-top-bg .ubtn-hover,
            .footer-v9 .newsletter-footer form button[type='submit']:hover,.btn-primary:hover{
                background: {$foodfarm_h_color}; 
            }
            @media (min-width: 768px){
                .prd_cat_count:hover{
                 background: {$foodfarm_h_color};  
             }
         }
         .blog-grid-style4 .read-more a:hover,
            #pre_order_prd .pre_order_price{
         color: {$foodfarm_h_color};
         }
         ";
        }
        if (isset($foodfarm_main_color) && $foodfarm_main_color != '' ) :
            ?>
            <?php 
            $foodfarm_custom_css .= "
            .blog-grid-style3.blog-content .post-name a:hover,
            .blog-grid-style3 .blog-info .info:hover i,
            .blog-grid-style3 .read-more a,
            .blog-grid-style3 .blog-info .info a:hover,
            .product_type_2 .star-rating::before,
            .footer-v7 .footer-contact-time .icon-title .icon-8,
            .header-v7 .main-navigation .mini-cart .cart_label i,
            .header-v7 .main-navigation .mega-menu > li > a:hover,
            .main_color,.header-v7 .mega-menu li.megamenu .dropdown-menu li a:hover,
            .header-v7 .main-navigation .mini-cart .cart_label i,
            .blog-grid-style3 .read-more a,
            .header-v5 .top-link .customlinks > a i,
            .header-v5 .cart_label i,
            .header-v5 .contact_v5 i,
            .header-v4 .top-link .customlinks i,
            .services-part .services-icon i,
            .footer-v4 .widget li a:hover,
            .footer-v1 address a:hover,
            .icon-2 .path1::before, .icon-2 .path2::before, .icon-2 .path3::before,
            .vc_icon_element.about-icon:not(.hover-off) .icon .vc_icon_element-inner .vc_icon_element-icon span::before,
            .about-icon .desc h5,
            .about-icon .desc h3,
            .vc_icon_element.about-icon:not(.hover-off) .icon .vc_icon_element-inner .vc_icon_element-icon,
            .widget_shopping_cart_content .cart-info .product-name a:hover,
            .widget_shopping_cart_content .remove-product:hover,
            a:focus, a:hover,
            .search-block-top .btn-search:hover,
            .top-link .customlinks > a:hover,
            .mega-menu .dropdown-menu li a:hover,
            .vc_icon_element.about-icon
            .icon .vc_icon_element-inner .vc_icon_element-icon,
            .custom-icon-class,
            .vc_icon_element.icon .vc_icon_element-inner .vc_icon_element-icon > span,
            .widget.widget_tag_cloud a:hover,
            .blog-info .info:hover i,
            .links-info .info a.liked,
            .woocommerce-account form.login p.lost_password a,
            .category .blog-info a:hover,
            .promo-banner h2 a:hover,
            .my_account header.title a,
            .woocommerce-account table.my_account_orders tbody a.view,
            .shop_table .product-thumbnail > a:hover,
            .product-desc .add-to-cart span,
            .product-desc .add-to a,
            .product-desc h3 a:hover,
            .star-rating span::before,
            .single_add_to_cart_button,
            .recipes-content .blog-item .post-name a,
            .icon-title .icon-8,
            .gallery-desc a:hover,
            .blog-content .post-name a:hover,
            .blog-ful .blog-item .post-name a,
            .blog-info .read-more a,
            .list-info li i,
            .search-block-top .btn-search:focus, .search-block-top .btn-search:active,
            .header-v2 .link-contact p a:hover,
            .header-v2 .top-link .customlinks:hover > a,
            .featured-package .product-desc h3 a,
            .vertical-menu .mega-menu li a:hover,
            .star-rating::before,
            .footer-v3 address a:hover,
            .controls-custom .owl-controls .owl-buttons div:hover,
                        #yith-quick-view-close:hover,
            table.compare-list .stock td span,
            table.compare-list .remove td a:hover,
            .page-numbers .current,
            .page-numbers > li:hover a, .page-numbers > li:hover span,
            .viewmode-toggle a:hover, .viewmode-toggle a:focus, .viewmode-toggle a.active,
            .images .views-block .controls-custom .owl-controls .owl-buttons div:hover,
            .info .summary .share-email a:hover,
            .nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
            .addthis_sharing_toolbox .f-social li:hover a,
            .nav-tabs > li.active > a,
            .stars a.active::after,
            .yith-woocompare-widget ul.products-list li a.title:hover,
            .blog .blog-ful .blog-item .post-name a:hover,
            .blog .blog-info a:hover,
            .widget_post_blog .blog-content .post-name a:hover,
            .widget_post_blog .blog-info .info a:hover,
            .recentcomments a:hover,
            .blog .blog-ful .blog-post-info .info:hover i,
            .blog_post_desc p a,
            .links-info .info:hover a,
            .breadcrumb li a:hover,
            .recipes-list-container .read-more a,
            .knowledge-list-content ul li::before,
            .knowledge-list-content ul li a:hover,
            .recipes-list-container .blog-info a:hover,
            .press-media .read-more a,
            .recipes-prep .icon, .recipes-servings .icon,
            .vc_tta-tabs.vc_tta-style-foodfarm_style ul.vc_tta-tabs-list li.vc_active a,
            .vc_tta-tabs.vc_tta-style-foodfarm_style ul.vc_tta-tabs-list li:hover a,
            .tooltip-content a,
            .content-desc .button-404 .btn-default-2,
            .coming-sub h2 span,
            .footer-location-container .location-info .phone-number,
            .footer-location-container .location-info p a:hover,
            .contact-desc .number,
            .vertical-menu .mega-menu li .dropdown-menu li a:hover,
            .shop_table td.product-name a:hover, 
            .side-breadcrumb-2 .page-title h2,
            .category .blog-info a:hover, 
            .search.search-results .blog-info a:hover,
            .date .blog-info a:hover,
            .blog-info .blog-comment:hover,
            .vc_wp_custommenu.wpb_content_element .widget_nav_menu ul > li > a:hover,
            .vc_wp_custommenu.wpb_content_element .widget_nav_menu ul > li > a:before,
            .ads_border_1 span,
            .btn.btn-organic:hover,
            .header-v4 .link-contact p i,
            .header-v4 .mega-menu li a:hover, .header-v4 .mega-menu li a:focus,
            .right-services .services-button,
            .vc_wp_custommenu.wpb_content_element .widget_nav_menu .menu-service-detail-container ul > li > a::before,
            .vc_wp_custommenu.wpb_content_element .widget_nav_menu .menu-service-detail-container ul > li > a:hover,.main_color, .home7_btn_slider:hover,
            .footer-v7 .footer-contact-info a:hover,.product-loadmore > a.btn:hover{
                color: {$foodfarm_main_color};
            }
            .home7_btn_slider:hover{
                border-bottom-color: {$foodfarm_main_color};
            }
            .blog-grid-style3 .read-more a,
            .product_type_2 .product-grid .product-content .add-to-cart:hover,
            .product_type_2 .product-grid .product-content .add-to:hover,
            .product_type_2 .product-grid .product-content .quick-view:hover,
            .footer-v7 .menu-footer-social ul > li a:hover{
                border:1px solid {$foodfarm_main_color};
            }
            .blog-grid-style3 .read-more a:hover,
            product_type_2 .product-grid .product-content .add-to-cart:hover,
            .product_type_2 .product-grid .product-content .add-to-cart:hover a,
            .product_type_2 .product-grid .product-content .add-to:hover,
            .product_type_2 .product-grid .product-content .add-to:hover a,
            .product_type_2 .product-grid .product-content .quick-view:hover,
            .header-v7 .main-navigation .mega-menu > li > a:before,
            .header-v7 .header-bottom .header_contact_info .search-block-top .top-search .btn-search,
            .footer-v7 .newsletter-footer button.btn,
            .footer-v7 .menu-footer-social ul > li a:hover,
            .mc4wp-alert.mc4wp-success,
            .footer-v7 .widget-title-border:before,.product-loadmore > a.btn,.btn-primary{
                background: {$foodfarm_main_color};
            }
            .blog-grid-style3 .read-more a,.product-loadmore > a.btn,
            a#product-loadmore:focus, a#product-loadmore:active, a#product-loadmore:active:focus,
            .product_type_2 .product-grid .product-content .add-to-cart:hover a,
            .contact-us textarea:focus, .contact-us textarea:active{
                border-color: {$foodfarm_main_color};
            }
            .header-v7 .main-navigation .mega-menu > li > a:before,
            .header-v7 .header-top,
            .header-v7 .header-bottom .header_contact_info .search-block-top .top-search .btn-search,
            .footer-v7 .menu-footer-social ul > li a:hover,
            .button_member, .footer-v4 .newsletter-footer button.btn-default, 
            .footer-v5 .newsletter-footer button.btn-default, .style_middle .line, 
            .promo-banner .text_block_over h3::before, .ares .tp-bullet:hover, 
            .ares .tp-bullet.selected, .header-v5 .menu-primary-menu-container, 
            .header-v5 .mini-cart .number-product, .services-overlay::before, 
            .woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, 
            .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, 
            .woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a, 
            .woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a, 
            .link-network li:hover, .tooltip-inner, .content-desc .button-404 .btn-default-2:hover,
            .page-numbers.page-secondary > li:hover a, .page-numbers.page-secondary > li:hover span, 
            .page-numbers.page-secondary .current, .blog_post_desc ul li::before, 
            .woocommerce-tabs #tab-reviews .form-submit input, 
            .header-v2 .top-link .customlinks.link-checkout .number-product, 
            .footer .widget-title-border::before, .recipes .owl-theme .owl-controls .owl-buttons div:hover, .recipes .owl-theme .owl-controls .owl-buttons div:active, .recipes .owl-theme .owl-controls .owl-buttons div:focus, .product-desc .add-to-cart span:hover, .nav-tabs.btn-filter li a.active, .nav-tabs.btn-filter li a:hover, .nav-tabs.btn-filter li a:focus, .btn-default, .vc_btn3.vc_btn3-style-custom.btn-default, .vc_btn3.vc_btn3-style-custom.btn-default:hover, blockquote:before, .vc_btn3.vc_btn3-color-grey.vc_general.btn:hover, .vc_btn3.vc_btn3-color-grey.vc_btn3-style-custom.vc_general.btn, .product-desc .add-to a:hover, .single_add_to_cart_button span, .blog-date, .vc_tta-style-foodfarm_style .vc_tta-panel-title > a i, .text-center .icon-title::before, .icon-title::before, .text-center .icon-title::after, .footer .widget-title-border::before, .footer-v2 .newsletter-footer .btn, .widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle, .price_slider_amount .button, .woocommerce .woocommerce-message, .nav-tabs > li.active > a::before, .main-sidebar .searchform .button, .vc_tta-tabs.vc_tta-style-foodfarm_style ul.vc_tta-tabs-list li.vc_active a .vc_tta-title-text::before, .woocommerce table.wishlist_table tr.cart_item td.product-add-to-cart div.add-to-cart a.button, .header-v1 .mini-cart .number-product, .header-v3 .mini-cart .number-product, .product_type_2 .product-grid .product-content .add-to-cart:hover, .product_type_2 .product-grid .product-content .add-to-cart:hover a, .product_type_2 .product-grid .product-content .add-to:hover, .product_type_2 .product-grid .product-content .add-to:hover a, .product_type_2 .product-grid .product-content .quick-view:hover, .woocommerce-account .woocommerce-MyAccount-content input[type='submit'],
            .footer-v7 .newsletter-footer button.btn,
            .blog-grid-style3 .read-more a:hover, .mc4wp-alert.mc4wp-success,
            .footer-v7 .widget-title-border:before,.product-loadmore > a.btn{
                background: {$foodfarm_main_color};
            }
            ";                 
            ?>        
        <?php endif;  
        if(isset($foodfarm_settings['header8-bg'])){
            $foodfarm_custom_css .= "
            .header-v8{background: {$foodfarm_settings['header8-bg']}; }
            ";
        }
        if(isset($foodfarm_settings['header8-top-bg']) || isset($foodfarm_settings['header8-top-text-color'])){
            $foodfarm_custom_css .= "
            .header-v8 .header-top {
                background: {$foodfarm_settings['header8-top-bg']}; 
                color: {$foodfarm_settings['header8-top-text-color']};
            }
            ";
        }   
        if(isset($foodfarm_settings['header7-menu-text']) 
            || isset($foodfarm_settings['header8-menu-hover'])){
            $foodfarm_custom_css .= "
        .header-v8 .mega-menu > li > a{color: {$foodfarm_settings['header7-menu-text']}; }
        .header-v8 .mega-menu > li > a:hover{color: {$foodfarm_settings['header8-menu-hover']}; }
        ";
        }   
        if(isset($foodfarm_settings['header8-menu-border'])){
            $foodfarm_custom_css .= "
            .header-v8 .main-navigation{border-color: {$foodfarm_settings['header8-menu-border']}; }
            ";
        }    
        if(isset($foodfarm_settings['header8-text-phonenumber_color'])){
            $foodfarm_custom_css .= "
            .header-v8 .header-top .header-contact span{color: {$foodfarm_settings['header8-text-phonenumber_color']}; }
            ";            
        }   
        if(isset($foodfarm_settings['footer-bg-8']) || isset($foodfarm_settings['footer-text-8'])){
            $foodfarm_custom_css .= "
            .footer-v8  {
                background: {$foodfarm_settings['footer-bg-8']}; 
                color: {$foodfarm_settings['footer-text-8']};
            }
            .footer-v8 .footer-bottom address{
                color: {$foodfarm_settings['footer-text-8']};
            }
            ";            
        }  
        if(isset($foodfarm_settings['footer-title-7'])){
            $foodfarm_custom_css .= "
            .footer-v8.footer .widget-title  {
                color: {$foodfarm_settings['footer-title-7']};
            }
            ";            
        }  

        if(isset($foodfarm_settings['menu_spacing']) && $foodfarm_settings['menu_spacing'] !=''){
            $foodfarm_custom_css .= "
            @media (min-width: 992px){
                .mega-menu > li > a{
                    padding-left: {$foodfarm_settings['menu_spacing']['margin-left']} !important;
                    padding-top: {$foodfarm_settings['menu_spacing']['margin-top']} !important;
                    padding-right: {$foodfarm_settings['menu_spacing']['margin-right']} !important;
                    padding-bottom: {$foodfarm_settings['menu_spacing']['margin-bottom']} !important;
                }
            }
            ";        
        } 
        if(isset($foodfarm_settings['logo_width']) && $foodfarm_settings['logo_width'] !=''){
            $foodfarm_custom_css .= "
            .header-logo img{
                width: {$foodfarm_settings['logo_width']['width']} !important;
            }
            ";         
        }             
        if(isset($foodfarm_settings['header-top-bg']) && $foodfarm_settings['header-top-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-top  {
                background: {$foodfarm_settings['header-top-bg']};
            }
            ";            
        }  
        if(isset($foodfarm_settings['header-menu-color']) && $foodfarm_settings['header-menu-color'] != ''){
            $foodfarm_custom_css .= "
            @media (min-width:992px){
                .mega-menu > li > a   {
                    color: {$foodfarm_settings['header-menu-color']};
                }
            }
            ";            
        }    
        if(isset($foodfarm_settings['header-nav-border_color']) && $foodfarm_settings['header-nav-border_color'] != ''){
            $foodfarm_custom_css .= "
            .main-navigation,.mega-menu > li > a,.mega-menu > li:first-child > a   {
                border-color: {$foodfarm_settings['header-nav-border_color']};
            }
            ";            
        } 
        if(isset($foodfarm_settings['header-top_color']) && $foodfarm_settings['header-top_color'] != ''){
            $foodfarm_custom_css .= "
            .link-contact p a,.header-v1 .top-link .customlinks > a{
                color: {$foodfarm_settings['header-top_color']};
            }
            ";            
        }
        if(isset($foodfarm_settings['header2-bg']) && $foodfarm_settings['header2-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v2{
                background: {$foodfarm_settings['header2-bg']};
            }
            ";            
        }  
        if(isset($foodfarm_settings['header2-menu-color']) && $foodfarm_settings['header2-menu-color'] != ''){
            $foodfarm_custom_css .= "
            @media (min-width:992px){
                .header-v2 .mega-menu>li>a {
                    color: {$foodfarm_settings['header2-menu-color']};
                }
            }
            ";            
        }
        if(isset($foodfarm_settings['header2-nav-border_color']) && $foodfarm_settings['header2-nav-border_color'] != ''){
            $foodfarm_custom_css .= "
            .header-v2 .main-navigation    {
                border-color: {$foodfarm_settings['header2-nav-border_color']};
            }
            ";            
        }
        if(isset($foodfarm_settings['header2-top_color']) && $foodfarm_settings['header2-top_color'] != ''){
            $foodfarm_custom_css .= "
            .header-v2 .link-contact p a{
                color: {$foodfarm_settings['header2-top_color']};
            }
            ";            
        }                    
        if(isset($foodfarm_settings['header3-menu-color']) && $foodfarm_settings['header3-menu-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v3 .right-header .btn-search,.header-v3 .right-header .cart_label,
            .header-v3.top-link .customlinks>a{
                color: {$foodfarm_settings['header3-menu-color']};
            }
            @media (min-width:992px){
                ..header-v3 .main-navigation .mega-menu>li>a{
                    color: {$foodfarm_settings['header3-menu-color']};
                }
            }
            ";            
        }           
        if(isset($foodfarm_settings['header3-border_color']) && $foodfarm_settings['header3-border_color'] != ''){
            $foodfarm_custom_css .= "
            .header-v3 .right-header .search-block-top, .header-v3 .right-header .mini-cart, .header-v3 .right-header .top-link   {
                border-color: {$foodfarm_settings['header3-border_color']};
            }
            ";            
        }          
        if(isset($foodfarm_settings['header4-top-color']) && $foodfarm_settings['header4-top-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v4 .link-contact p a,.header-v4 .top-link .customlinks > a{
                color: {$foodfarm_settings['header4-top-color']};
            }
            ";            
        }
        if(isset($foodfarm_settings['header4-top-bg']) && $foodfarm_settings['header4-top-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v4 .header-top {
                background: {$foodfarm_settings['header4-top-bg']};
            }
            ";            
        }         
        if(isset($foodfarm_settings['header4-bg']) && $foodfarm_settings['header4-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v4 .main-navigation{
                background: {$foodfarm_settings['header4-bg']};
            }
            ";            
        }  
        if(isset($foodfarm_settings['header4-menu-color']) && $foodfarm_settings['header4-menu-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v4 .right-header{
                color: {$foodfarm_settings['header4-menu-color']};
            }
            @media (min-width:992px){
                .header-v4 .mega-menu > li > a{
                    color: {$foodfarm_settings['header4-menu-color']};
                }
            }
            ";            
        }            
        if(isset($foodfarm_settings['header5-top-bg']) && $foodfarm_settings['header5-top-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v5 .header-top {
                background: {$foodfarm_settings['header5-top-bg']};
            }
            ";            
        }         
        if(isset($foodfarm_settings['header5-bg']) && $foodfarm_settings['header5-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v5{
                background: {$foodfarm_settings['header5-bg']};
            }
            ";            
        } 
        if(isset($foodfarm_settings['header5-top-color']) && $foodfarm_settings['header5-top-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v5 .header-slogan .link-contact p,.header-v5 .top-link .customlinks>a{
                color: {$foodfarm_settings['header5-top-color']};
            }
            ";            
        }                
        if(isset($foodfarm_settings['header5-menu-color']) && $foodfarm_settings['header5-menu-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v5 .search-block-top>.btn-search,.header-v5 .mini-cart span{
                color: {$foodfarm_settings['header5-menu-color']};
            }
            @media (min-width:992px){
                .header-v5 .main-navigation .mega-menu>li>a{
                    color: {$foodfarm_settings['header5-menu-color']};
                }
            }
            ";            
        } 
        if(isset($foodfarm_settings['header6-bg']) && $foodfarm_settings['header6-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v6{
                background: {$foodfarm_settings['header6-bg']};
            }
            ";            
        } 
        if(isset($foodfarm_settings['header6-top-color']) && $foodfarm_settings['header6-top-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v6 .link-contact span,.header-v6 .top-link .customlinks>a{
                color: {$foodfarm_settings['header6-top-color']};
            }
            ";            
        }     
        if(isset($foodfarm_settings['header6-menu-color']) && $foodfarm_settings['header6-menu-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v6 .right-header{
                color: {$foodfarm_settings['header6-menu-color']};
            }
            @media (min-width:992px){
                .header-v6 .mega-menu>li>a{
                    color: {$foodfarm_settings['header6-menu-color']};
                }
            }
            ";            
        }  
        if(isset($foodfarm_settings['footer-bottom-bg']) && $foodfarm_settings['footer-bottom-bg'] != ''){
            $foodfarm_custom_css .= "
            .footer-v1 .footer-bottom, .footer-v3 .footer-bottom{
                background: {$foodfarm_settings['footer-bottom-bg']};
            }
            ";
        }   
        if(isset($foodfarm_settings['footer2-bottom-bg']) && $foodfarm_settings['footer2-bottom-bg'] != ''){
            $foodfarm_custom_css .= "
            .footer-v2 .footer-bottom{
                background: {$foodfarm_settings['footer2-bottom-bg']};
            }
            ";
        }          
        if(isset($foodfarm_settings['footer-left-color']) && $foodfarm_settings['footer-left-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-home p, .footer-home .list-info li, .footer-home .list-info li a{
                color: {$foodfarm_settings['footer-left-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer-wtitle-color']) && $foodfarm_settings['footer-wtitle-color'] != ''){
            $foodfarm_custom_css .= "
            .footer .widget-title, .footer .newsletter-footer .newsletter-title,
            .footer-v3 .newsletter-footer h4{
                color: {$foodfarm_settings['footer-wtitle-color']};
            }
            ";
        }           
        if(isset($foodfarm_settings['footer-link-color']) && $foodfarm_settings['footer-link-color'] != ''){
            $foodfarm_custom_css .= "
            .footer a,.footer-v4 .widget li a,.footer-v5 .widget li a{
                color: {$foodfarm_settings['footer-link-color']} !important;
            }
            ";
        }      
        if(isset($foodfarm_settings['footer-bottom-text-color']) && $foodfarm_settings['footer-bottom-text-color'] != ''){
            $foodfarm_custom_css .= "
            .footer address,.footer-v1 address a{
                color: {$foodfarm_settings['footer-bottom-text-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer-col-border']) && $foodfarm_settings['footer-col-border'] != ''){
            $foodfarm_custom_css .= "
            .footer-menu-list .list-style,.footer-menu-list .list-style:last-child,.newsletter-footer{
                border-color: {$foodfarm_settings['footer-col-border']};
            }
            ";
        }
        if(isset($foodfarm_settings['footer2-wtitle-color']) && $foodfarm_settings['footer2-wtitle-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v2 .newsletter-footer h4,.footer .footer-v2 .widget-title{
                color: {$foodfarm_settings['footer2-wtitle-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer2-left-color']) && $foodfarm_settings['footer2-left-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v2 .footer-home p,.footer-v2 .footer-home .list-info li, .footer-v2 .footer-home .list-info li a{
                color: {$foodfarm_settings['footer2-left-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer3-left-color']) && $foodfarm_settings['footer3-left-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v3 .footer-home p{
                color: {$foodfarm_settings['footer3-left-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer-bg-4']) && $foodfarm_settings['footer-bg-4'] != ''){
            $foodfarm_custom_css .= "
            .footer-v4 .footer-top,.footer-v5 .footer-top{
                background: {$foodfarm_settings['footer-bg-4']};
            }
            ";
        }   
        if(isset($foodfarm_settings['footer4-bottom-bg']) && $foodfarm_settings['footer4-bottom-bg'] != ''){
            $foodfarm_custom_css .= "
            .footer-v4 .footer-bottom,.footer-v5 .footer-bottom{
                background: {$foodfarm_settings['footer4-bottom-bg']};
            }
            ";
        }  
        if(isset($foodfarm_settings['footer4-left-color']) && $foodfarm_settings['footer4-left-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v4 .footer-home p,.footer-v4 .footer-home .list-info li, .footer-v4 .footer-home .list-info li a,.footer-v5 .footer-home p,.footer-v5 .footer-home .list-info li, .footer-v5 .footer-home .list-info li a{
                color: {$foodfarm_settings['footer4-left-color']};
            }
            ";
        }       
        if(isset($foodfarm_settings['footer6-bottom-text-color']) && $foodfarm_settings['footer6-bottom-text-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v6 .footer-bottom address{
                color: {$foodfarm_settings['footer6-bottom-text-color']};
            }
            ";
        }     
        if(isset($foodfarm_settings['footer6-left-color']) && $foodfarm_settings['footer6-left-color'] != ''){
            $foodfarm_custom_css .= "
            .footer-v6 .footer-center .list-info li,.footer-v6 .footer-center .list-info li a{
                color: {$foodfarm_settings['footer6-left-color']};
            }
            ";
        }     
        if(isset($foodfarm_settings['header9-bg']) && $foodfarm_settings['header9-bg'] != ''){
            $foodfarm_custom_css .= "
            .header-v9 .main-navigation{
                background: {$foodfarm_settings['header9-bg']};
            }
            ";
        }  
        if(isset($foodfarm_settings['header9-menu-color']) && $foodfarm_settings['header9-menu-color'] != ''){
            $foodfarm_custom_css .= "
            .header-v9 .mega-menu > li > a, .header-v9 .right-header, .header-v9 a.cart_label,
            .header-v9 .search-block-top > .btn-search,.header-v9 .header-right .h_icon,.header-v9 .open-menu-mobile{
                color: {$foodfarm_settings['header9-menu-color']};
            }
            ";
        }  
        if(isset($foodfarm_settings['footer9-bg']) && $foodfarm_settings['footer9-bg'] !=''){
            $foodfarm_custom_css .= "
            .footer-v9{
                background-image: url('{$foodfarm_settings['footer9-bg']['background-image']}');
                background-repeat: {$foodfarm_settings['footer9-bg']['background-repeat']};
                background-position: {$foodfarm_settings['footer9-bg']['background-position']};
                background-size: {$foodfarm_settings['footer9-bg']['background-size']};
                background-attachment: {$foodfarm_settings['footer9-bg']['background-attachment']};  
                background-color:  {$foodfarm_settings['footer9-bg']['background-color']};  
            }
            ";            
        }    
        if(isset($foodfarm_settings['footer9-newletter_bg']) && $foodfarm_settings['footer9-newletter_bg'] !=''){
            $foodfarm_custom_css .= "
            .footer-v9 .newsletter-footer{ 
                background-color:  {$foodfarm_settings['footer9-newletter_bg']};  
            }
            ";             
        }  
        if(isset($foodfarm_settings['footer9-newletter-color']) && $foodfarm_settings['footer9-newletter-color']){
           $foodfarm_custom_css .= "
           .footer-v9 .newsletter-footer .newsletter-title h4{ 
            color:  {$foodfarm_settings['footer9-newletter-color']};  
        }
        ";            
        }    
        if(isset($foodfarm_settings['footer9-text-color']) && $foodfarm_settings['footer9-text-color'] !=''){
           $foodfarm_custom_css .= "
           .footer-v9 .list-info li, .footer-v9 .list-info li a, .footer-v9 a{ 
            color:  {$foodfarm_settings['footer9-text-color']};  
        }
        ";              
        }  
        if(isset($foodfarm_settings['footer9-bottom-color']) && $foodfarm_settings['footer9-bottom-color'] !=''){
           $foodfarm_custom_css .= "
           .footer-v9 .footer-bottom address, .footer-v9 .payment li a{ 
            color:  {$foodfarm_settings['footer9-bottom-color']};  
        }
        ";             
        }  
        if(isset($foodfarm_settings['footer9-bottom-bg']) && $foodfarm_settings['footer9-bottom-bg'] !=''){
           $foodfarm_custom_css .= "
           .footer-v9 .footer-bottom{ 
            background:  {$foodfarm_settings['footer9-bottom-bg']};  
        }
        ";             
        }           
        if(isset($foodfarm_settings['footer9-title-color']) && $foodfarm_settings['footer9-title-color'] !=''){
           $foodfarm_custom_css .= "
           .footer .footer-v9 .widget-title{ 
            color:  {$foodfarm_settings['footer9-title-color']};  
        }
        ";             
        } 
        if(isset($foodfarm_settings['footer9-social-color'])&& $foodfarm_settings['footer9-social-color'] !=''){
            $foodfarm_custom_css .= "
            .footer-v9 .menu-footer-social li a{
                border-color: {$foodfarm_settings['footer9-social-color']};
                color: {$foodfarm_settings['footer9-social-color']};
            }
            ";
        }         

        $foodfarm_breadcrumbs_bg = foodfarm_get_meta_value('breadcrumbs_bg');
        $foodfarm_breadcrumbs_color = foodfarm_get_meta_value('breadcrumbs_color');
        if ($foodfarm_breadcrumbs_bg != '') {
            $foodfarm_custom_css .="
            .side-breadcrumb{
                background-image: url({$foodfarm_breadcrumbs_bg}) !important;
            }
            ";
        }     


        if ($foodfarm_breadcrumbs_color != '') {
            $foodfarm_custom_css .="
            .side-breadcrumb .page-title h1,.side-breadcrumb .page-title h1, .breadcrumb li a, .breadcrumb > li + li::before, .breadcrumb li {
                color: {$foodfarm_breadcrumbs_color} !important;
            }
            ";
        }       


        //Load font icon css
        wp_enqueue_style('foodfarm-font-common', get_template_directory_uri() . '/css/icon-font.css?ver=' . foodfarm_version);
        wp_enqueue_style('foodfarm-font', get_template_directory_uri() . '/css/pe-icon/pe-icon-7-stroke'.$foodfarm_suffix.'.css?ver=' . foodfarm_version);

        wp_enqueue_style('foodfarm-prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css?ver=' . foodfarm_version);
        wp_enqueue_style('slick', get_template_directory_uri() . '/css/slick.min.css?ver=' . foodfarm_version);

        if (is_rtl()) {
                    //Load plugins RTL css
            wp_enqueue_style('foodfarm-plugins-rtl', get_template_directory_uri() . '/css/plugins_rtl'.$foodfarm_suffix.'.css?ver=' . foodfarm_version);
                    //Load theme RTL css
            wp_enqueue_style('foodfarm-theme-rtl', get_template_directory_uri() . '/css/theme_rtl'.$foodfarm_suffix.'.css?ver=' . foodfarm_version);
        }

        else{
                    //Load plugins css
            wp_enqueue_style('foodfarm-plugins', get_template_directory_uri() . '/css/plugins'.$foodfarm_suffix.'.css?ver=' . foodfarm_version);
                    //Load theme css
            wp_enqueue_style('foodfarm-theme', get_template_directory_uri() . '/css/theme'.$foodfarm_suffix.'.css?ver=' . foodfarm_version);
        }
                // Load skin stylesheet
        wp_enqueue_style('foodfarm-skin', foodfarm_css . '/config/skin.css?ver=' . foodfarm_version);
        wp_add_inline_style( 'foodfarm-skin', $foodfarm_custom_css );
                // Loads our main stylesheet.
        wp_enqueue_style('foodfarm-style', get_stylesheet_uri());
                // Load Google Fonts
                // 
        $gfont = array('Open+Sans','Courgette','Lora','Dancing+Script');
        if (isset($foodfarm_settings['general-font']['google']) && $foodfarm_settings['general-font']['google']) {
            $font = urlencode($foodfarm_settings['general-font']['font-family']);
            if (!in_array($font, $gfont))
                $gfont[] = $font;

        }
        $font_family = '';
        foreach ($gfont as $font)
            $font_family .= $font . ':300,300italic,400,400italic,600,600italic,700,700italic,800,800italic%7C';


        if ($font_family) {
            wp_register_style( 'foodfarm-google-fonts', "//fonts.googleapis.com/css?family=" . $font_family . "&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
            wp_enqueue_style( 'foodfarm-google-fonts' );
        }        
    }

}
add_action('wp_enqueue_scripts', 'foodfarm_scripts_styles');

//Disable all woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_false');

function foodfarm_scripts_js() {

    global $foodfarm_settings, $wp_query;

    $foodfarm_product = '';
    $foodfarm_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    $cat = $wp_query->get_queried_object();
    if(isset($cat->term_id)){
        $woo_cat = $cat->term_id;
    }else{
        $woo_cat = '';
    }
    $shop_list = '';
    if ( class_exists( 'WooCommerce' ) ) {
        $shop_list = is_product_category();
    }
    $product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
    $header_sticky_mobile = isset($foodfarm_settings['header-sticky-mobile'])? $foodfarm_settings['header-sticky-mobile'] : '';    
    $ff_main_color = isset($foodfarm_settings['primary-color'])? $foodfarm_settings['primary-color'] : '#94c347';
    $ff_text_day = (isset($foodfarm_settings['under_contr-day']) && $foodfarm_settings['under_contr-day'] != '') ? $foodfarm_settings['under_contr-day'] : 'Days'; 
    $ff_text_hour = (isset($foodfarm_settings['under_contr-hour']) && $foodfarm_settings['under_contr-hour'] != '') ? $foodfarm_settings['under_contr-hour'] : 'Hours';  
    $ff_text_min = (isset($foodfarm_settings['under_contr-min']) && $foodfarm_settings['under_contr-min'] != '') ? $foodfarm_settings['under_contr-min'] : 'Minutes';  
    $ff_text_sec = (isset($foodfarm_settings['under_contr-sec']) && $foodfarm_settings['under_contr-sec'] != '') ? $foodfarm_settings['under_contr-sec'] : 'Seconds';           
    // comment reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    // Loads our main js.
    
    if(get_the_ID()!=''){
        $post = get_post(get_the_ID());
        $post_content = $post->post_content;  

        foodfarm_optimize_plugin_enqueue($post_content);

    }
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), foodfarm_version, true);

    wp_enqueue_script('prety-photo', get_template_directory_uri() . '/js/un-minify/jquery.prettyPhoto.js', array('jquery'), foodfarm_version, true);

    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), foodfarm_version, true);

    wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), foodfarm_version, true);

    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), foodfarm_version, true);

    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), foodfarm_version, true);

    wp_enqueue_script('time-circles', get_template_directory_uri() . '/js/un-minify/time-circles'.$foodfarm_suffix.'.js', array(), foodfarm_version, true);

    if(get_post_type()=='product'){
        $foodfarm_product = 'yes';
        wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/js/un-minify/scrollReveal'.$foodfarm_suffix.'.js', array(), foodfarm_version, true);
        wp_enqueue_script('elevate-zoom', get_template_directory_uri() . '/js/un-minify/jquery.elevatezoom.min.js', array('jquery'), foodfarm_version, true);
    }

    if( post_type_supports( get_post_type(), 'comments' ) ) {
        if( comments_open() ) {
            $foodfarm_valid_form = 'yes';
            wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), foodfarm_version);
        }
    }

    wp_enqueue_script('foodfarm-script', get_template_directory_uri() . '/js/un-minify/functions'.$foodfarm_suffix.'.js', array(), foodfarm_version, true);
    wp_localize_script('foodfarm-script', 'foodfarm_params', array(
        'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
        'ajax_loader_url' => esc_js(str_replace(array('http:', 'https'), array('', ''), foodfarm_css . '/images/ajax-loader.gif')),
        'ajax_cart_added_msg' => esc_html__('A product has been added to cart.', 'foodfarm'),
        'ajax_compare_added_msg' => esc_html__('A product has been added to compare', 'foodfarm'),
        'type_product' => $product_list_mode,
        'shop_list' => $shop_list,
        'ff_text_day' => $ff_text_day,
        'ff_text_hour' => $ff_text_hour,
        'ff_text_min' => $ff_text_min,
        'ff_text_sec' => $ff_text_sec,        
        'ff_main_color' => $ff_main_color,
        'header_sticky' => $foodfarm_settings['header-sticky'],
        'header_sticky_mobile' => $header_sticky_mobile
    ));


}
add_action('wp_enqueue_scripts', 'foodfarm_scripts_js');
function foodfarm_override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
} 
add_filter('tiny_mce_before_init', 'foodfarm_override_mce_options'); 

function foodfarm_get_current_url($echo = true) {
    global $wp;
    if($echo) {
        echo home_url(add_query_arg(array(),$wp->request));
    } else {
        return home_url(add_query_arg(array(),$wp->request));
    }
}

if (class_exists( 'YITH_WOOCOMPARE' ) ){
    function foodfarm_compare_page_title($sep = '', $display = true, $title = '') {
        if($title != '') {
            return esc_attr($title);
        }
    }
    add_filter( 'wp_title', 'foodfarm_compare_page_title', 100, 3 );
}

