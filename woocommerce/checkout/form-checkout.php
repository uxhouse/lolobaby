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
?>
<div class="checkoutPage checkoutPage--ready checkoutPage--visible container" selectedshipment="<?php echo $shipmentID; ?>">
    <form name="checkout" method="post" class="checkout checkoutForm woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <?php if ( $checkout->get_checkout_fields() ) : ?>
        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
        <div class="checkoutForm__userdata" id="customer_details">
            <div class="checkoutForm__billing">
                <h2>Uzupełnij dane:</h2>
                <div class="form">
                    <div class="radio">
                        <div class="radio__option radio-selected">
                            <input type="radio" name="checkoutPersonType" forfield="billing_persontype" id="selectTypePrivate" class="engineRadio" value="private" checked/>
                            <label for="selectTypePrivate">Osoba prywatna</label>
                        </div>
                        <div class="radio__option">
                            <input type="radio" name="checkoutPersonType" forfield="billing_persontype" id="selectTypeBusiness" class="engineRadio" value="business"/>
                            <label for="selectTypeBusiness">Firma</label>
                        </div>
                    </div>
                    <input type="text" class="comapnyField" name="billing_company" placeholder="Nazwa firmy"/>
                    <input type="text" class="comapnyField" name="billing_company_nip" placeholder="NIP"/>
                    <input type="text" name="billing_phone" placeholder="Numer telefonu"/>
                    <input type="text" name="billing_email" placeholder="Adres e-mail" value="<?php echo $currentUser->user_email; ?>"/>
                </div>
            </div>
            <div class="checkoutForm__shipping">
                <h2>Dane adresowe:</h2>
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
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
            <h3>Wczytywanie</h3>
        </div>
        <div class="checkoutDeliverySelected checkoutDeliverySelected--disable">
            <h3 class="name" methodid="0">Wczytywanie</h3>
            <div class="buttons">
                <p class="btn btn--light changeShipmentMethod"><span>Zmień sposób dostawy</span></p>
            </div>
        </div>
        <div class="checkoutDeliverySelect">
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
                <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
        <?php endif; ?>
        </div>
    </div>
    <div class="checkoutPage__nextstep">
        <a href="<?php echo home_url('/koszyk'); ?>" class="previousStep"><span>Powrót</span></a>
        <p class="btn nextStep"><span>Przejdź dalej</span></p>
    </div><div class="checkoutPage__payment">
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
<div class="summaryPage container">
    <div class="summaryPage__cartItems">
        <?php $itemsCount = $woocommerce->cart->cart_contents_count; ?>
        <h2 class="summaryPage__secTitle">Twój koszyk (<?php echo $itemsCount; ?>)</h2>
    <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
    ?>
    <div class="cartItem <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
        <div class="cartItem__top">
            <div class="cartItem__thumb">
            <?php
                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                if ( ! $product_permalink ) {
                    echo $thumbnail; // PHPCS: XSS ok.
                } else {
                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                }
            ?>
            </div>
            <div class="cartItem__name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                <h3><?php echo $_product->get_title(); ?></h3>
            </div>
        </div>
        <div class="cartItem__bottom">
            <div class="cartItem__color">
                <p class="cartItem__title">Kolor:</p>
                <?php
                    $data = $cart_item['data'];
                    $attributes = $data->get_attribute('pa_kolor');
                    $productVariant = strtoupper($cart_item['data']->attributes['pa_kolor']);
                    $allVariants = wc_get_product_terms( $product_id, 'pa_kolor', array( 'fields' => 'all' ) );
                
                foreach($allVariants as $variant){
                    $variantName = strtoupper($variant->name);
                    if($variantName == $productVariant){
                        echo '<span style="background-color:' . get_term_meta($variant->term_id)["product_attribute_color"][0] . '"></span>';
                    }
                }
                ?>
            </div>
            <div class="cartItem__size">
                <?php
                    $data = $cart_item['data'];
                    $attributeSize = $cart_item['variation']['attribute_pa_rozmiar'];
                    $size_term = wc_get_product_terms( $product_id, 'pa_rozmiar', array( 'fields' => 'all' ) );
                    if($size_term):
                ?>
                <p class="cartItem__title">Rozmiar:</p>
                <p class="cartItem__selected"><?php echo $attributeSize; ?></p>
                <?php endif; ?>
            </div>
            <div class="cartItem__quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                <p class="cartItem__title">Ilość:</p>
                <p class="cartItem__selected"><?php echo $cart_item['quantity']; ?></p>
            </div>
            <div class="cartItem__price">
                <p><?php echo wc_price($cart_item['quantity'] * $cart_item['data']->price); ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <div class="summaryPage__shipping">
        <div class="wave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
        <h2 class="summaryPage__secTitle">Wybrany sposób dostawy:</h2>
        <p class="name" methodid="0">Wczytywanie</p>
        <div class="wave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
    </div>
    <div class="summaryPage__payment">
        <h2 class="summaryPage__secTitle">Wybierz sposób płatności:</h2>
        <div class="optionList">
        <?php
            $gateways = WC()->payment_gateways->get_available_payment_gateways();
            $enabled_gateways = [];
            if( $gateways ):
                foreach( $gateways as $gateway ): 
                if( $gateway->enabled == 'yes' ) {
                    $enabled_gateways[] = $gateway;
                }
            ?>
                <div class="optionList__option" paymentmethod="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
                    <p class="name"><?php echo $gateway->title; ?></p>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="summaryPage__secureInfo">
        <p>Gwarantujemy całkowite bezpieczeństwo Twoich danych. Wszystkie poufne informacje są wysyłane w zaszyfrowanej postaci, co zapewnia ich pełną ochronę. Więcej szczegółów znajdziesz w <a href="/polityka-prywatnosci">Polityce prywatności</a></p>
    </div>
    <div class="summaryPage__nextstep">
        <p class="previousStep"><span>Powrót</span></p>
        <p class="btn nextStep"><span>Złóż zamówienie</span></p>
    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
