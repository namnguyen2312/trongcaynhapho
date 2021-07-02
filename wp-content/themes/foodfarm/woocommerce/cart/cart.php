<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="container">
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
		<?php wc_print_notices(); ?>
			<?php do_action( 'woocommerce_before_cart' ); ?>

			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<table class="shop_table shop_table_responsive cart" cellspacing="0">
				<thead>
					<tr>					
						<th class="product-name"><?php echo esc_html__( 'Product', 'foodfarm' ); ?></th>
						<th class="product-price"><?php echo esc_html__( 'Price', 'foodfarm' ); ?></th>
						<th class="product-quantity"><?php echo esc_html__( 'Quantity', 'foodfarm' ); ?></th>
						<th class="product-subtotal"><?php echo esc_html__( 'Total', 'foodfarm' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">



								<td class="product-thumbnail" data-title="<?php echo esc_attr__( 'Product', 'foodfarm' ); ?>">
								   	<div class="mobile-show">
	                                    <span>
	                                        <?php echo esc_html__( 'Product', 'foodfarm' ); ?>
	                                    </span>
	                                </div>
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $_product->is_visible() ) {
											echo $thumbnail;
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
										}
									?>
									<?php
										if ( ! $_product->is_visible() ) {
											echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
										} else {
											echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
										}

										// Meta data
										echo wc_get_formatted_cart_item_data( $cart_item );
										
										// Backorder notification
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'foodfarm' ) . '</p>';
										}
									?>
								</td>

								<td class="product-price" data-title="<?php echo esc_attr__( 'Price', 'foodfarm' ); ?>">
								   	<div class="mobile-show">
	                                    <span>
	                                        <?php echo esc_html__( 'Price', 'foodfarm' ); ?>
	                                    </span>
	                                </div>									
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									?>
								</td>

								<td class="product-quantity" data-title="<?php echo esc_attr__( 'Quantity', 'foodfarm' ); ?>">
								   	<div class="mobile-show">
	                                    <span>
	                                        <?php echo esc_html__( 'Quantity', 'foodfarm' ); ?>
	                                    </span>
	                                </div>									
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input( array(
												'input_name'  => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
												'min_value'   => '0'
											), $_product, false );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
									?>
								</td>

								<td class="product-subtotal" data-title="<?php echo esc_attr__( 'Total', 'foodfarm' ); ?>">
								   	<div class="mobile-show">
	                                    <span>
	                                        <?php echo esc_html__( 'Total', 'foodfarm' ); ?>
	                                    </span>
	                                </div>									
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
								</td>
								<td class="product-remove">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-close"></i></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											__( 'Remove this item', 'foodfarm' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										), $cart_item_key );
									?>
								</td>
							</tr>
							<?php
						}
					}

					do_action( 'woocommerce_cart_contents' );
					?>
					<tr>
						<td colspan="6" class="actions">
							<div class="row">				
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">
									<?php if ( wc_coupons_enabled() ) { ?>
										<div class="coupon">

											<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'foodfarm' ); ?>" /> <input type="submit" class="button btn btn-default" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'foodfarm' ); ?>" />

											<?php do_action( 'woocommerce_cart_coupon' ); ?>
										</div>
									<?php } ?>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 btn-update-cart text-right">
									<input type="submit" class="button btn btn-default display-inline" name="update_cart" value="<?php esc_attr_e( 'Update', 'foodfarm' ); ?>" />
									<div class="wc-proceed-to-checkout display-inline">
										<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
									</div>
								</div>
							</div>
							
							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart' ); ?>
						</td>
					</tr>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>

			<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</form>
		</div>
	</div>

</div>
<div class="cart-collaterals">
	<div class="container">
		<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			 <?php do_action( 'woocommerce_cart_collaterals' ); ?> 
			 </div>
			<div class="col-md-6 col-sm-6 col-xs-12 shipping-total">
				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php elseif ( WC()->cart->needs_shipping() ) : ?>

					<tr class="shipping">
						<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

						<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

						<?php wc_cart_totals_shipping_html(); ?>

						<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

					<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

						<tr class="shipping">
							<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
						</tr>

					<?php endif; ?>

					<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
						<tr class="fee">
							<th><?php echo esc_html( $fee->name ); ?></th>
							<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
						</tr>
					<?php endforeach; ?>

					<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
						$taxable_address = WC()->customer->get_taxable_address();
						$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
								? sprintf( ' <small>' . __( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
								: '';

						if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
							<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
								<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
									<th><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
									<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr class="tax-total">
								<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
								<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
							</tr>
						<?php endif; ?>
					<?php endif; ?>
					</tr>
				<?php endif; ?>		
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<?php 
		?>
		<?php do_action( 'woocommerce_after_cart' ); ?>
	</div>
</div>
