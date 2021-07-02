<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$foodfarm_settings = foodfarm_check_theme_options();
$labels = '';
$labels = '';
$featured = false;
$carhub_new_lable_day = isset($foodfarm_settings['new_date']) ? $foodfarm_settings['new_date'] :1;
$postdate = get_the_date( 'F d, Y g:i a', $post->ID );
$today = date("F j, Y, g:i a"); 
$old_date = (( 60 * 60 * 24 ) * $carhub_new_lable_day);
$postdatestamp  = strtotime( $postdate) + $old_date;
$postdatestamp_today  = strtotime( $today ) ; 
if ($foodfarm_settings['product-hot']) {
    $featured = $product->is_featured();
    if ($featured) {
        $hot_html = '<span class="onhot">'. esc_html__('Hot', 'foodfarm') .'</span>';
        $labels .= $hot_html;
    }
}
if ($foodfarm_settings['product-sale']) {
    if ($product->is_on_sale()) {
        $percentage = 0;
        if ($product->get_regular_price())
            $percentage = - round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
        if ($foodfarm_settings['product-sale-percent'] && $percentage)
            $sales_html = '<span class="onsale">'. $percentage .'%</span>';
        else
            $sales_html = apply_filters('woocommerce_sale_flash', '<span class="onsale">'.esc_html__( 'Sale', 'foodfarm' ).'</span>', $post, $product);
        $labels .= $sales_html;
    }
}
if ($foodfarm_settings['product-news']){ 
    if ( $postdatestamp > $postdatestamp_today) { // If the product was published within the newness time frame display the new badge
        $new_html = '<span class="new">' . esc_html__( 'New', 'foodfarm' ) . '</span>';
        $labels .= $new_html;
		
    }
}
$label_class= '';
if($featured){
    $label_class = "hot-label";
}else if($product->is_on_sale() && !$featured){
    $label_class = "sale-label";
}else if ( $postdatestamp > $postdatestamp_today){
    $label_class = "new-label";
}
else if ($product->is_on_sale() && ( time() - ( 60 * 60 * 24 ) ) < $postdatestamp){
    $label_class = "sale-label";
}
else if ($featured && ( time() - ( 60 * 60 * 24 ) ) < $postdatestamp){
    $label_class = "hot-label";
}
else if ($product->is_on_sale() && $featured){
    $label_class = "hot-label";
}
else if ($product->is_on_sale() && $featured && ( time() - ( 60 * 60 * 24 ) ) < $postdatestamp){
    $label_class = "hot-label";
}
else{
    $label_class = "";
}
if($foodfarm_settings['product-sale'] && $product->is_on_sale() || $featured || $postdatestamp > $postdatestamp_today){
echo '<div class="product-label '. $label_class .'">';

echo  $labels;

echo '</div>';
}
