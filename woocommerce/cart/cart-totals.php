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
$lang = get_bloginfo('language'); ?>
<div class="cartTotals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="cartTotals__deliverySelect" style="display: none !important">
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

        <tr class="shipping">
            <th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
            <td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
        </tr>

        <?php endif; ?>
    </div>
    <div class="cartTotals__sum">
        <div class="cartTotals__title">
            <p><?php _e('Suma', 'lolobaby'); ?>:</p>
        </div>
        <div class="cartTotals__value" value="<?php echo WC()->cart->get_subtotal(); ?>">
            <?php wc_cart_totals_subtotal_html(); ?>
        </div>
    </div>
    <div class="cartTotals__coupon">
        <?php foreach (WC()->cart->get_coupons() as $code => $coupon){
			$currentCoupon = $coupon->code;
		}
		?>
        <div class="couponInput">
            <input type="text" name="couponInput" id="couponInput" class="couponInput__input" value="<?php echo $currentCoupon; ?>" placeholder="<?php _e('Masz kod rabatowy? Wpisz i zatwierdź...', 'lolobaby'); ?>"/>
            <?php if($currentCoupon): ?>
                <a href="" class="couponInput__delete" data-coupon="<?php echo $currentCoupon; ?>"><?php _e('Usuń', 'lolobaby'); ?></a>
            <?php else: ?>
                <p class="couponInput__submit"><?php _e('Zatwierdź', 'lolobaby'); ?></p>
            <?php endif; ?>
        </div>
        <?php
            global $woocommerce;
            $discountTotal = $woocommerce->cart->get_totals();
            $totalDiscount = $discountTotal['cart_contents_total'];
        ?>
        <div class="couponList" totaldiscount="<?php echo $totalDiscount; ?>">
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="couponList__coupon coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="cartTotals__title name">
                    <p><?php _e('Zniżka', 'lolobaby'); ?>:</p>
                </div>
                <div class="cartTotals__value amount" amount="<?php echo $coupon->amount; ?>">
                    <p data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
                </div>
            </div>
		<?php endforeach; ?>
        </div>
    </div>
    <?php
        global $freeshippingamount;
        $cart = WC()->cart->subtotal;
        $remaining = $freeshippingamount - $cart;
    ?>
    <div class="cartTotals__delivery">
        <div class="cartTotals__title">
            <p><?php _e('Koszt przesyłki', 'lolobaby'); ?>:</p>
        </div>
        <div class="cartTotals__value<?php if( $freeshippingamount < $cart ){echo ' freeshipping';} ?>" valuename="deliverycost">
            <p><?php _e('Nie wybrano', 'lolobaby'); ?></p>
        </div>
    </div>
    <?php if($lang == 'pl-PL'): ?>
    <div class="cartTotals__free">
        <?php 
            if( $freeshippingamount > $cart ): ?>
                <p><?php _e('Do darmowej przesyłki brakuje Ci jeszcze', 'lolobaby'); ?> <span><?php echo wc_price($remaining); ?></span></p>
            <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
    <div class="cartTotals__total">
        <div class="cartTotals__title">
            <p><?php _e('Cena razem', 'lolobaby'); ?>:</p>
        </div>
        <div class="cartTotals__value">
            <p><?php wc_cart_totals_order_total_html(); ?></p>
        </div>
    </div>
    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
