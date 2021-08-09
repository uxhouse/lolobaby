<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$order_data = $order->get_data();
$orderID = $order_data['id'];
$orderData = wc_get_order($orderID); 
$orderItems = $orderData->get_items();
$orderItemsQty = $orderItems['quantity'];
$itemsCount = $order->get_item_count();
$shippingTotal = $order->get_shipping_total();
$cartTotal = $order->get_total();

?>

<div class="summaryPage container" itemscount="<?php echo $itemsCount; ?>">
    <div class="summaryPage__cartItems">
        <h2 class="summaryPage__secTitle"><?php _e('Twój koszyk', 'lolobaby'); ?> (<?php echo $itemsCount; ?>)</h2>
        <div class="wave wave--mobile">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
    <?php
        foreach ( $orderData->get_items() as $cart_item_key => $cart_item ):
        $_product   = $cart_item->get_product();
        $product_id = $cart_item->get_id();
        
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
                <p><?php echo wc_price($cart_item['total']); ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <div class="cartSummary">
        <p><?php _e('Wysyłka', 'lolobaby'); ?>: 
        <?php if($shippingTotal > 0): ?>
            <span><?php echo wc_price($shippingTotal); ?></span>
        <?php else: ?>
            <span><?php _e('Za darmo', 'lolobaby'); ?></span>
        <?php endif; ?>
        <p><?php _e('Suma', 'lolobaby'); ?>: <?php echo wc_price($cartTotal); ?></p>
    </div>
    </div>
    <div class="summaryPage__shipping">
        <div class="wave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
        <h2 class="summaryPage__secTitle"><?php _e('Wybrany sposób dostawy', 'lolobaby'); ?>:</h2>
        <?php
        foreach( $orderData->get_items( 'shipping' ) as $item_id => $item ):
            $shipping_method_title       = $item['name'];
            $shipping_method_id          = $item['instance_id'];
        ?>
        <p class="name" methodid="<?php echo $shipping_method_id; ?>"><?php echo $shipping_method_title; ?></p>
        <?php endforeach; ?>
        <div class="deliveryAddress">
            <?php echo $order->get_formatted_billing_address(); ?>
        </div>
        <div class="wave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
    </div>
    <div class="summaryPage__payment">
        <h2 class="summaryPage__secTitle"><?php _e('Wybierz sposób płatności', 'lolobaby'); ?>:</h2>
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
            <div class="optionList__option optionList__option--active" paymentmethod="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
                <p class="name"><?php echo $gateway->title; ?></p>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="optionContent">
            <?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>
        </div>
    </div>
    <div class="summaryPage__secureInfo">
        <p>Gwarantujemy całkowite bezpieczeństwo Twoich danych. Wszystkie poufne informacje są wysyłane w zaszyfrowanej postaci, co zapewnia ich pełną ochronę. Więcej szczegółów znajdziesz w <a href="/polityka-prywatnosci">Polityce prywatności</a></p>
    </div>
    <div class="summaryPage__nextstep">
        <a href="/moje-konto" class="previousStep" style="opacity: 0; pointer-events: none;"><span><?php _e('Powrót', 'lolobaby'); ?></span></a>
        <p class="btn nextStep"><span><?php _e('Zamawiam z obowiązkiem zapłaty', 'lolobaby'); ?></span></p>
    </div>
</div>