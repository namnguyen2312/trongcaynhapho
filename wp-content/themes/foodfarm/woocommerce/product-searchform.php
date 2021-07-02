<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $foodfarm_settings;
$header_type = foodfarm_get_header_type();
?>

<form role="search" method="get" class="woocommerce-product-search product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<?php if($header_type == '7'):?>
		<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_html__( 'I’m looking for&hellip;', 'foodfarm' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'foodfarm' ); ?>" />
	<?php else:?>
		<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_html__( 'Search Products&hellip;', 'foodfarm' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'foodfarm' ); ?>" />
	<?php endif;?>
	<button type="submit" class="submit btn-search">
        <i class="fa fa-search"></i>
    </button>
	<input type="hidden" name="post_type" value="product" />
</form>
