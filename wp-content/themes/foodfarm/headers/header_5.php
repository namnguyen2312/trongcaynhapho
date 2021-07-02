<?php
$foodfarm_settings = foodfarm_check_theme_options();
?>
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-9 col-xs-8">
                <div class="header-contact header-slogan">
                    <div class="dib link-contact">
                        <?php if (!empty($foodfarm_settings['header-slogan'])): ?>
                            <p><?php echo $foodfarm_settings['header-slogan']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-4">
                <?php
                $compare = false;
                if (class_exists('YITH_WOOCOMPARE')) {
                    $compare = true;
                }
                $wishlist = false;
                if (class_exists('YITH_WCWL')) {
                    $wishlist = true;
                }
                $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                $logout_url = wp_logout_url(get_permalink($myaccount_page_id));
                if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
                    $logout_url = str_replace('http:', 'https:', $logout_url);
                }
                ?>
                <div class="top-link">
                    <ul class="hidden-sm hidden-xs display-inline">
                        <?php
                            foodfarm_show_language_dropdown();
                            foodfarm_show_currencies_dropdown();   
                        ?>                     
                        <li class="customlinks"><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><i class="fa fa-user"></i> <?php echo esc_html__('My Account', 'foodfarm') ?></a>
                        </li>
                        <?php if (!is_user_logged_in()): ?>
                            <li class="customlinks"><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><i class="fa fa-lock" aria-hidden="true"></i>
 <?php echo esc_html__('Login / Register', 'foodfarm') ?></a></li>
                        <?php else: ?>
                            <li class="customlinks"><a href="<?php echo esc_url($logout_url) ?>"><i class="fa fa-lock" aria-hidden="true"></i>
 <?php echo esc_html__('Logout', 'foodfarm') ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <ul class="hidden-lg hidden-md display-inline">
                        <li class="dib customlinks">
                            <a href="#" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown">
                                <i class="fa fa-user"></i><span><?php echo esc_html__('My Account','foodfarm');?></span> 
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <div class="dib header-profile dropdown-menu">
                                <ul>
                                    <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('My Account', 'foodfarm') ?></a></li>
                                    <?php if ($wishlist): ?>
                                        <li><a class="update-wishlist" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>"><?php echo esc_html__('Wishlist', 'foodfarm') ?> <span>(<?php echo yith_wcwl_count_products(); ?>)</span></a></li>
                                    <?php endif; ?>
                                    <?php if (class_exists('YITH_WOOCOMPARE')) { ?>
                                        <li>
                                            <?php foodfarm_compare_toplink(); ?>
                                        </li>
                                    <?php } ?>
                                    <?php if (!is_user_logged_in()): ?>
                                        <li><a href="<?php echo esc_url(get_permalink($myaccount_page_id)); ?>"><?php echo esc_html__('Login / Register', 'foodfarm') ?></a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo esc_url($logout_url) ?>"><?php echo esc_html__('Logout', 'foodfarm') ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom">
    <div class="container">
        <div class="row">
            <?php if (!empty($foodfarm_settings['header-contact-phonenumber'])): ?>
            <div class="col-md-4 hidden-sm hidden-xs text-left padding_10 contact_v5">
                    <p><a href="callto:<?php echo $foodfarm_settings['header-contact-phonenumber'] ?>"><i class="fa fa-phone"></i><span><?php echo $foodfarm_settings['header-contact-phonenumber'] ?></span></a></p>
            </div>
            <?php endif; ?>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <?php if (is_front_page()) : ?>
                    <h1 class="header-logo">
                    <?php else : ?>
                        <h2 class="header-logo">
                        <?php endif; ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php
                            if ($foodfarm_settings['logo_5'] && $foodfarm_settings['logo_5']['url']):
                                echo '<img class="" src="' . esc_url(str_replace(array('http:', 'https:'), '', $foodfarm_settings['logo_5']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            else:
                                bloginfo('name');
                            endif;
                            ?>
                        </a>
                        <?php if (is_front_page()) : ?>
                    </h1>
                <?php else : ?>
                    </h2>
                <?php endif; ?>
            </div>
            <?php if ($foodfarm_settings['header-minicart'] && class_exists('WooCommerce')) :?>
            <div class="col-md-4 hidden-sm hidden-xs text-right cart_5 padding_10">
                <?php 
                    global $woocommerce;  
                    $minicart_template = foodfarm_get_minicart_template();
                    $totalamount = $woocommerce->cart->get_cart_total();  
                ?>
                <div id="mini-scart" class="mini-cart">
                    <?php echo $minicart_template;?>
                    <span><?php echo esc_html__('Cart', 'foodfarm');?></span>
                </div>
                <?php echo $totalamount;?>
            </div>
            <?php endif;?>
        </div>    
    </div>
</div>
<!-- Menu -->
<nav id="site-navigation" class="main-navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 menu-left">
                <div class="menu-primary-menu-container">
                    <?php
                    $before_items_wrap = '<button class="btn-open"><i class="fa fa-bars"></i></button>';
                    if ($foodfarm_settings['header-sticky']) {
                        $sticky_logo_img = '';
                        if ($foodfarm_settings['logo-header-sticky'] && $foodfarm_settings['logo-header-sticky']['url']) {
                            $sticky_logo_img = '<img src="' . esc_url(str_replace(array('http:', 'https:'), '', $foodfarm_settings['logo-header-sticky']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                        }
                        $before_items_wrap .= '<div class="sticky-logo">
                                                    <h2 class="header-logo">
                                                        <a href="' . esc_url(home_url('/')) . '" rel="home">' . $sticky_logo_img . '</a>
                                                    </h2>
                                                </div>';
                    }
                    $after_item_wrap = '<div class="right-header">';
                    if ($foodfarm_settings['header-search']) {
                        $search_template = foodfarm_get_search_form();
                        $after_item_wrap .= '<div class="search-block-top">' . $search_template . '</div>';
                    }
                    if ($foodfarm_settings['header-minicart'] && class_exists('WooCommerce')) {
                        $minicart_template = foodfarm_get_minicart_template();
                        $after_item_wrap .= '<div id="mini-scart" class="mini-cart hidden-md hidden-lg">' . $minicart_template . '</div>';
                    }
                    $after_item_wrap .= '</div>';
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class' => 'mega-menu',
                            'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
                            'walker' => new Foodfarm_Primary_Walker_Nav_Menu()
                                )
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>