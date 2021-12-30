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

$items = $woocommerce->cart->get_cart();
$itemsCount = $woocommerce->cart->cart_contents_count;
$cartTotal = $woocommerce->cart->get_cart_total();
$shippingTotal = $woocommerce->cart->get_cart_shipping_total();
// $order_data = $order->get_data();
// $orderID = $order_data['id'];
// $orderData = wc_get_order($orderID); 
// $orderItems = $orderData->get_items();
// $orderItemsQty = $orderItems['quantity'];
?>
<form name="checkout" method="post" class="checkout checkoutForm woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <div class="checkoutPage<?php if(is_user_logged_in() || !$checkout->is_registration_enabled()): ?> checkoutPage--ready checkoutPage--visible<?php endif; ?> container" selectedshipment="<?php echo $shipmentID; ?>" clientName="<?php if($username){echo $username;}else{echo $nickname;}; ?>">
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
                            <label for="billing_gift"><?php _e('Chcę otrzymać paragon tylko drogą mailową', 'lolobaby'); ?></label>
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
                    <?php 
                        // WC()->cart->calculate_totals();
                        wc_cart_totals_shipping_html();
                    ?>
                <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="checkoutPage__nextstep">
            <a href="<?php echo home_url('/koszyk'); ?>" class="previousStep"><span><?php _e('Powrót', 'lolobaby'); ?></span></a>
            <p class="btn nextStep"><span><?php _e('Przejdź dalej', 'lolobaby'); ?></span></p>
        </div>
    </div>

    <div class="summaryPage container">
        <div class="summaryPage__cartItems">
            <h2 class="summaryPage__secTitle"><?php _e('Twój koszyk', 'lolobaby'); ?> (<?php echo $itemsCount; ?>)</h2>
            <div class="wave wave--mobile">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <?php
                foreach ( $items as $cart_item_key => $cart_item ):
                $_product = wc_get_product($cart_item['data']);
                $product_id = wc_get_product($cart_item['data']->get_id());
                
                if ( $_product && $cart_item['quantity'] > 0 ):
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
                        <p class="cartItem__title"><?php _e('Kolor', 'lolobaby'); ?>:</p>
                        <?php
                            $attributeName = $_product->get_attribute('pa_kolor');
                            $allVariants = get_terms('pa_kolor');

                        foreach($allVariants as $variant){
                            $variantName = $variant->name;
                            if($variantName == $attributeName){
                                echo '<span termname="' . $variant->slug . '" style="background-color:' . get_term_meta($variant->term_id)["product_attribute_color"][0] . '"></span>';
                            }
                        }
                        ?>
                    </div>
                    <div class="cartItem__size">
                        <?php
                            $attributeSize = $_product->get_attribute('pa_rozmiar');
                            if($attributeSize):
                        ?>
                        <p class="cartItem__title"><?php _e('Rozmiar', 'lolobaby'); ?>:</p>
                        <p class="cartItem__selected"><?php echo $attributeSize; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="cartItem__quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                        <p class="cartItem__title"><?php _e('Ilość', 'lolobaby'); ?>:</p>
                        <p class="cartItem__selected"><?php echo $cart_item['quantity']; ?></p>
                    </div>
                    <div class="cartItem__price">
                        <p><?php echo wc_price(get_post_meta($cart_item['product_id'] , '_price', true)); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="cartSummary">
                <p><?php _e('Wysyłka', 'lolobaby'); ?>: 
                <?php if($shippingTotal !== ''): ?>
                    <span><?php echo $shippingTotal; ?></span>
                <?php else: ?>
                    <span><?php _e('Za darmo', 'lolobaby'); ?></span>
                <?php endif; ?>
                <p><?php _e('Suma', 'lolobaby'); ?>: <?php echo $cartTotal; ?></p>
            </div>
        </div>
        <div class="summaryPage__shipping">
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <h2 class="summaryPage__secTitle"><?php _e('Wybrany sposób dostawy', 'lolobaby'); ?>:</h2>
            <p class="name" methodid=""></p>
            <div class="deliveryAddress">
                <div></div>
            </div>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
        </div>
        <div class="summaryPage__payment">
            <h2 class="summaryPage__secTitle"><?php _e('Wybierz sposób płatności', 'lolobaby'); ?>:</h2>
            <div class="optionList">
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
                
                        <?php // wc_get_template( 'checkout/terms.php' ); ?>
                
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
            <div class="optionContent">
                <?php $gateways = WC()->payment_gateways->get_available_payment_gateways(); ?>
                <?php foreach ( $gateways as $gateway ): ?>
                    <?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
                        <div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
                            <?php $gateway->payment_fields(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
        <div class="summaryPage__secureInfo">
            <p><?php _e('Gwarantujemy całkowite bezpieczeństwo Twoich danych. Wszystkie poufne informacje są wysyłane w zaszyfrowanej postaci, co zapewnia ich pełną ochronę. Więcej szczegółów znajdziesz w <a href="/polityka-prywatnosci">Polityce prywatności</a>', 'lolobaby'); ?></p>
        </div>
        <div class="summaryPage__nextstep">
            <p class="previousStep" ><span><?php _e('Powrót', 'lolobaby'); ?></span></p>
            <p class="btn nextStep"><span><?php _e('Zamawiam z obowiązkiem zapłaty', 'lolobaby'); ?></span></p>
        </div>
    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
