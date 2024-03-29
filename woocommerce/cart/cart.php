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
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

    global $woocommerce;
    // $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
    // $chosen_shipping = $chosen_methods[0];
    // $shipmentID = (int) filter_var($chosen_shipping, FILTER_SANITIZE_NUMBER_INT);
    $lang = get_bloginfo('language'); ?>
<?php 
$brand_terms = get_terms(array(
    'taxonomy'      => 'pa_kolor',
    'hide_empty'    => 'false',
));
if($brand_terms): ?>
    <div class="colorsData">
        <?php foreach ($brand_terms as $key => $object): ?>
            <span class="color" termname="<?php echo $object->slug; ?>" style="background-color: <?php echo get_term_meta($object->term_id)["product_attribute_color"][0];?>;"></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="loloCart">
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" checkout="<?php echo get_permalink(icl_object_id(9, 'page', false, ICL_LANGUAGE_CODE)); ?>">
        <div class="loloCart__wave container">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
        <div class="loloCart__items container">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>
            <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $productID = wc_get_product($product_id);

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <div class="cartItem <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>
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
                        <h3><?php echo $productID->name; ?></h3>
                    </div>
                    <div class="cartItem__remove">
                    <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="/wp-content/themes/lolobaby/images/icons/cartItem_trash.svg"/></a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                    ?>
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
                            $data = $cart_item['data'];
                            $attributeSize = $cart_item['variation']['attribute_pa_rozmiar'];
                            if($lang == 'pl-PL'){
                                $attributeSizeFormat = $attributeSize;
                            }else{
                                $attributeSizeFormat = str_replace('-en', '', $attributeSize);
                            }
                            $size_term = wc_get_product_terms( $product_id, 'pa_rozmiar', array( 'fields' => 'all' ) );
                            if($size_term):
                        ?>
                        <p class="cartItem__title"><?php _e('Rozmiar', 'lolobaby'); ?>:</p>
                        <div class="dropdownInput">
                            <?php 
                                if($lang == 'pl-PL'){
                                    $inputName = 'cart[' . $cart_item_key . '][pa_rozmiar]';
                                }else{
                                    $inputName = 'cart[' . $cart_item_key . '][pa_rozmiar]';
                                }
                            ?>
                            <input style="display: none !important;" type="text" name="<?php echo $inputName; ?>" id="select_size" class="select_size" value="<?php echo $attributeSizeFormat; ?>"/>
                            <div class="dropdownInput__select selectTrigger">
                                <p class="dropdownInput__current"><?php echo $attributeSizeFormat; ?></p>
                            </div>
                            <div class="dropdownInput__dropdown selectDropdown">
                                <?php foreach ($size_term as $size){
                                    echo '<span>' . $size->name . '</span>';
                                } ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="cartItem__quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                    <p class="cartItem__title"><?php _e('Ilość', 'lolobaby'); ?>:</p>
                    <div class="dropdownInput">
                        <div class="dropdownInput__select selectTrigger">
                            <p class="dropdownInput__current"><?php echo $cart_item['quantity']; ?></p>
                        </div>
                        <div class="dropdownInput__dropdown selectDropdown">
                            <span>1</span>
                            <span>2</span>
                            <span>3</span>
                            <span>4</span>
                            <span>5</span>
                            <span>6</span>
                            <span>7</span>
                            <span>8</span>
                            <span>9</span>
                            <span>10</span>
                        </div>
                    </div>
                    <div class="quantityInputHidden" style="display: none !important;">
                        <?php
                            if ( $_product->is_sold_individually() ) {
                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                            } else {
                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                        'min_value'    => '0',
                                        'product_name' => $_product->get_name(),
                                    ),
                                    $_product,
                                    false
                                );
                            }
                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                        ?>
                    </div>
                    </div>
                    <div class="cartItem__subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                    <?php
                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                    ?>
                    </div>
                    <div class="cartItem__remove">
                    <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><img src="/wp-content/themes/lolobaby/images/icons/cartItem_trash.svg"/></a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                    ?>
                    </div>
                </div>
            </div>
            <?php do_action( 'woocommerce_cart_contents' ); ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="updateCart" style="display: none !important;">
                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
            </div>
        </div>
        <div class="loloCart__wave container">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
        <div class="couponWrap" style="display: none !important;">
        <?php if ( wc_coupons_enabled() ) { ?>
            <div class="coupon">
                <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_coupon' ); ?>
            </div>
        <?php } ?>
    
        </div>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </div>
        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>
    <div class="loloCart__bottom container">
        <div class="loloCart__delivery">
            <h2><?php _e('Wybierz sposób dostawy', 'lolobaby'); ?></h2>
            <div class="deliveryList">
            <?php
                $zone_ids = array_keys( array('') + WC_Shipping_Zones::get_zones() );
                foreach ( $zone_ids as $zone_id ):
                    global $freeshippingamount;
                    $cart = WC()->cart->subtotal;
                    $remaining = $freeshippingamount - $cart;

                    $shipping_zone = new WC_Shipping_Zone($zone_id);
                    $shipping_methods = $shipping_zone->get_shipping_methods( true, 'values' );
                ?>
                    <?php foreach ( $shipping_methods as $instance_id => $shipping_method ): 
                        if($lang == 'pl-PL'){
                            $price = $shipping_method->instance_settings['cost'];
                            if($shipping_method->instance_id == 8){
                                $deliveryTime = '1-2 dni';
                            }else{
                                $deliveryTime = '2-3 dni';
                            }
                        }else{
                            $price = $shipping_method->instance_settings['cost_EUR'];
                            if($shipping_method->instance_id == 8){
                                $deliveryTime = '1-2 days';
                            }else{
                                $deliveryTime = '2-3 days';
                            }
                        }
                        ?>
                        <?php if($shipping_method->instance_id !== 10 && $shipping_method->instance_id !== 11): ?>
                        <div class="deliveryList__option" methodid="id_<?php echo $shipping_method->instance_id; ?>" methodamount="<?php
                                if( $freeshippingamount > $cart ){
                                    echo $price;
                                }else if($freeshippingamount <= $cart){
                                    echo '0';
                                }
                            ?>">
                            <div class="name">
                                <input type="radio" id="method_<?php echo $shipping_method->instance_id; ?>" methodid="<?php echo $shipping_method->instance_id; ?>" name="delivery_option" value="method_<?php echo $shipping_method->instance_id; ?>"/>
                                <label for="method_<?php echo $shipping_method->instance_id; ?>" delivery-time="<?php echo $deliveryTime; ?>">
                                    <?php _e($shipping_method->title, 'lolobaby'); ?>
                                </label>
                            </div>
                            <div class="amount">
                                <?php                    
                                    if( $freeshippingamount > $cart ){
                                        echo '<span>' . wc_price($price) . '</span>';
                                    }else if($freeshippingamount <= $cart){
                                        echo '<span>' . __('Za darmo!', 'lolobaby') . '</span>';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php // Wysyłka międzynarodowa
                        foreach($shipping_methods as $instance_id => $shipping_method):
                            if($lang == 'pl-PL'){
                                $price = $shipping_method->instance_settings['cost'];
                            }else{
                                $price = $shipping_method->instance_settings['cost_EUR'];
                            }
                        ?>
                        <?php if($shipping_method->instance_id == 11): ?>
                        <h3><?php _e('Wysyłka międzynarodowa', 'lolobaby'); ?></h3>
                        <div class="deliveryList__option" methodid="id_<?php echo $shipping_method->instance_id; ?>" methodamount="<?php echo $price; ?>">
                            <div class="name">
                                <input type="radio" id="method_<?php echo $shipping_method->instance_id; ?>" methodid="<?php echo $shipping_method->instance_id; ?>" name="delivery_option" value="method_<?php echo $shipping_method->instance_id; ?>"/>
                                <label for="method_<?php echo $shipping_method->instance_id; ?>">
                                    <?php _e($shipping_method->title, 'lolobaby'); ?>
                                </label>
                            </div>
                            <div class="amount">
                                <?php echo '<span>' . wc_price($price) . '</span>'; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endforeach; ?>
            </div>
        </div>
        <div class="loloCart__summary">
        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
        <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action( 'woocommerce_cart_collaterals' );
        ?>
        </div>
    </div>
    <div class="loloCart__afterCart container <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'shippingSelected' : 'notSelected'; ?>" data-error="<?php _e('Wybierz sposób dostawy aby przejść dalej', 'lolobaby'); ?>">
        <a href="<?php echo get_permalink(icl_object_id(2567, 'page', false, ICL_LANGUAGE_CODE)); ?>" class="continue"><?php _e('Kontynuuj zakupy', 'lolobaby'); ?></a>
        <a href="<?php echo get_permalink(icl_object_id(9, 'page', false, ICL_LANGUAGE_CODE)); ?>" class="tocheckout btn"><span><?php _e('Przejdź dalej', 'lolobaby'); ?></span></a>
        <?php // do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
