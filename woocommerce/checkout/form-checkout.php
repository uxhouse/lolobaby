<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	return;
}
global $woocommerce;
$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
$chosen_shipping = $chosen_methods[0];
$shipmentID = (int) filter_var($chosen_shipping, FILTER_SANITIZE_NUMBER_INT);

$currentUser = wp_get_current_user();
$currentUserID = get_current_user_id();
$username = get_user_meta( $currentUserID, 'billing_username', true );
$nickname = get_user_meta( $currentUserID, 'nickname', true );
?>
<div class="checkoutPage<?php if(is_user_logged_in() || !$checkout->is_registration_enabled()): ?> checkoutPage--ready checkoutPage--visible<?php endif; ?> container" selectedshipment="<?php echo $shipmentID; ?>" clientName="<?php if($username){echo $username;}else{echo $nickname;}; ?>">
    <form name="checkout" method="post" class="checkout checkoutForm woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <?php if ( $checkout->get_checkout_fields() ) : ?>
        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
        <div class="checkoutForm__userdata" id="customer_details">
            <div class="checkoutForm__shipping">
                <h2><?php _e('Dane adresowe', 'lolobaby'); ?>:</h2>
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>
            <div class="checkoutForm__billing">
                <h2><?php _e('Uzupełnij dane', 'lolobaby'); ?>:</h2>
                <div class="form">
                    <div class="radio">
                        <div class="radio__option radio-selected">
                            <input type="radio" name="checkoutPersonType" forfield="billing_persontype" id="selectTypePrivate" class="engineRadio" value="private" checked/>
                            <label for="selectTypePrivate"><?php _e('Osoba prywatna', 'lolobaby'); ?></label>
                        </div>
                        <div class="radio__option">
                            <input type="radio" name="checkoutPersonType" forfield="billing_persontype" id="selectTypeBusiness" class="engineRadio" value="business"/>
                            <label for="selectTypeBusiness"><?php _e('Firma', 'lolobaby'); ?></label>
                        </div>
                    </div>
                    <input type="text" class="comapnyField" name="billing_company" placeholder="Nazwa firmy" value="<?php echo get_user_meta( $currentUserID, 'billing_company', true ); ?>"/>
                    <input type="text" class="comapnyField" name="billing_company_nip" placeholder="NIP" value="<?php echo get_user_meta( $currentUserID, 'billing_company_nip', true ); ?>"/>
                    <input type="text" name="billing_phone" placeholder="Numer telefonu" value="<?php echo get_user_meta( $currentUserID, 'billing_phone', true ); ?>"/>
                    <input type="text" name="billing_email" placeholder="Adres e-mail" value="<?php echo $currentUser->user_email; ?>"/>
                    <div class="checkbox gift">
                        <input type="checkbox" class="customCheckbox" name="billing_gift"/>
                        <label for="billing_gift"><?php _e('Wyślij paragon na inny adres', 'lolobaby'); ?></label>
                    </div>

                    <?php if(!is_user_logged_in()): ?>
                    <div class="checkbox account">
                        <input type="checkbox" class="customCheckbox" name="checkout_create_account"/>
                        <label for="checkout_create_account"><?php _e('Chcę założyć konto', 'lolobaby'); ?></label>
                    </div>
                    <div class="accountCreator">
                        <div class="accountCreator__pass">
                            <input type="password" name="checkoutUserPass" placeholder="Ustal hasło"/>
                            <div class="changeVisibility"></div>
                        </div>
                        <div class="accountCreator__acceptance">
                            <div class="checkbox top">
                                <input type="checkbox" class="engineCheckbox" name="registerConsent" required/>
                                <label for="register-consent"><?php _e('Zapoznałam/em się z <a href="/regulamin" target="_blank">regulaminem sklepu internetowego</a> i akceptuję jego treść.', 'lolobaby'); ?></label>
                            </div>
                            <div class="checkbox bottom">
                                <input type="checkbox" class="engineCheckbox" name="register-newsletter"/>
                                <label for="register-newsletter"><?php _e('Chcę otrzymywać newsletter z aktualnościami oraz miec dostęp do ofert specjalnych i kuponów rabatowych (możesz zrezygnować z newslettera w kązdej chwili)', 'lolobaby'); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
    <?php endif; ?>

    <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
    <div class="checkoutPage__delivery">
        <div class="wave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
        <div class="heading">
            <h3><?php _e('Wczytywanie', 'lolobaby'); ?></h3>
        </div>
        <div class="checkoutDeliverySelected checkoutDeliverySelected--disable">
            <h3 class="name" methodid="0"><?php _e('Wczytywanie', 'lolobaby'); ?></h3>
            <p class="pointname"></p>
            <div class="buttons">
                <p class="btn btn--light changeShipmentMethod"><span><?php _e('Zmień sposób dostawy', 'lolobaby'); ?></span></p>
                <p class="btn btn--blue selectPoint"><span><?php _e('Wybierz Paczkomat', 'lolobaby'); ?></span></p>
            </div>
        </div>
        <div class="checkoutDeliverySelect">
        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
                <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
        <?php endif; ?>
        </div>
    </div>
    <div class="checkoutPage__nextstep">
        <a href="<?php echo home_url('/koszyk'); ?>" class="previousStep"><span><?php _e('Powrót', 'lolobaby'); ?></span></a>
        <p class="btn nextStep"><span><?php _e('Przejdź dalej', 'lolobaby'); ?></span></p>
    </div>
    <div class="checkoutPage__payment">
        <?php
            if ( ! is_ajax() ) {
                do_action( 'woocommerce_review_order_before_payment' );
            }
            ?>
            <div id="payment" class="woocommerce-checkout-payment">
            <?php if ( WC()->cart->needs_payment() ) : ?>
                <ul class="wc_payment_methods payment_methods methods">
                    <?php
                    if ( ! empty( $available_gateways ) ) {
                        foreach ( $available_gateways as $gateway ) {
                            wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                        }
                    } else {
                        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
                    }
                    ?>
                </ul>
            <?php endif; ?>
                <div class="form-row place-order">
                    <noscript>
                        <?php
                        /* translators: $1 and $2 opening and closing emphasis tags respectively */
                        printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                        ?>
                        <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
                    </noscript>
            
                    <?php wc_get_template( 'checkout/terms.php' ); ?>
            
                    <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
            
                    <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>
            
                    <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
            
                    <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                </div>
            </div>
            <?php
            if ( ! is_ajax() ) {
                do_action( 'woocommerce_review_order_after_payment' );
            }
        ?>
    </div>
    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
