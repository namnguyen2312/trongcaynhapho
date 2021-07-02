<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action('woocommerce_before_mini_cart'); ?>
<div class="wrap-mini-cart">
    <ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">

        <?php if (!WC()->cart->is_empty()) : ?>

            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);

                    $attachment_id = get_post_thumbnail_id($product_id);

                    $attachment_grid  = foodfarm_get_attachment($attachment_id, 'foodfarm-minicart');

                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);

                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                    ?>
                    <li class="<?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <?php echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-product" title="%s" data-cart_id="%s" data-product_id="' . $product_id . '"><i class="fa fa-close"></i></a>', esc_url(wc_get_cart_remove_url($cart_item_key)), esc_html__('Remove this item', 'foodfarm'), $cart_item_key), $cart_item_key); ?>
                        
                        <?php if (!$_product->is_visible()) : ?>

                            <?php echo str_replace(array('http:', 'https:'), '', $thumbnail) . $product_name . '&nbsp;'; ?>

                        <?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="cart-images">
                                <img width="<?php echo esc_attr($attachment_grid['width']) ?>" height="<?php echo esc_attr($attachment_grid['height']) ?>" src="<?php echo esc_url($attachment_grid['src']) ?>" alt="<?php echo esc_attr($attachment_grid['alt']) ?>" />
                            </a>

                        <?php endif; ?>

                        <div class="cart-info">
                            <div class="product-name">
                                <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo wp_kses_post($product_name); ?></a>
                                <div class="qty-cart">
                                    <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times;', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
                                    <span class="price"><?php echo $product_price ?></span>
                                    <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>

        <?php else : ?>

            <li class="empty"><?php echo esc_html__('No products in the cart.', 'foodfarm'); ?></li>

        <?php endif; ?>

    </ul><!-- end product list -->

    <?php if (!WC()->cart->is_empty()) : ?>
        <div class="cart-actions">
            <p class="total"><span><?php echo esc_html__('Total', 'foodfarm'); ?>:</span> <span class="price"><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>

            <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
        </div>
        <div class="cart-btn">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn button btn-default wc-forward"><?php echo esc_html__('View Cart', 'foodfarm'); ?></a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn button btn-default checkout wc-forward"><?php echo esc_html__( 'Checkout', 'foodfarm' ); ?></a>
        </div>
    <?php endif; ?>
</div>
<?php do_action('woocommerce_after_mini_cart'); ?>

