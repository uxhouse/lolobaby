<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cartTotals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="cartTotals__sum">
        <div class="cartTotals__title">
            <p>Suma:</p>
        </div>
        <div class="cartTotals__value">
            <?php wc_cart_totals_subtotal_html(); ?>
        </div>
    </div>
    <div class="cartTotals__coupon">
        <div class="couponInput">
            <input type="text" name="couponInput" id="couponInput" class="couponInput__input" placeholder="Masz kod rabatowy? Wpisz i zatwierdź..."/>
            <p class="couponInput__submit">Zatwierdź</p>
        </div>
        <div class="couponList">

        </div>
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="couponList__coupon coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="name">
                    <p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
                </div>
                <div class="amount">
                    <p><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
    <div class="cartTotals__delivery">
        <div class="cartTotals__title">
            <p>Koszt przesyłki:</p>
        </div>
        <div class="cartTotals__value" valuename="deliverycost">
            <p>Nie wybrano</p>
        </div>
    </div>
    <div class="cartTotals__free">
        <?php
            $min_amount = 200;
            $cart = WC()->cart->subtotal;
            $remaining = $min_amount - $cart;
 
            if( $min_amount > $cart ): ?>
                <p>Do darmowej przesyłki brakuje Ci jeszcze <span><?php echo wc_price($remaining); ?></span></p>
            <?php endif; ?>
    </div>
    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
    <div class="cartTotals__total">
        <div class="cartTotals__title">
            <p>Cena razem:</p>
        </div>
        <div class="cartTotals__value">
            <p><?php wc_cart_totals_order_total_html(); ?></p>
        </div>
    </div>
    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
