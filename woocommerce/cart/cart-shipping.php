<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
$lang = get_bloginfo('language');
?>
<div class="woocommerce-shipping-totals shipping">
	<div data-title="<?php echo esc_attr( $package_name ); ?>">
		<ul id="shipping_method" class="woocommerce-shipping-methods">
		<?php
			// Loop through shipping packages from WC_Session (They can be multiple in some cases)
			foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
				// Check if a shipping for the current package exist
				if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
					// Loop through shipping rates for the current package
					foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
						$rate_id     = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID)
						$method_id   = $shipping_rate->get_method_id(); // The shipping method slug
						$instance_id = $shipping_rate->get_instance_id(); // The instance ID
						$label_name  = $shipping_rate->get_label(); // The label name of the method
						$cost        = $shipping_rate->get_cost(); // The cost without tax
						$tax_cost    = $shipping_rate->get_shipping_tax(); // The tax cost
						$taxes       = $shipping_rate->get_taxes(); // The taxes details (array)
						if($instance_id == 8 && $instance_id !== 11){
							if($lang == 'pl-PL'){
								$deliveryTime = '1-2 dni';
							}else{
								$deliveryTime = '1-2 days';
							}
						}else{
							if($lang == 'pl-PL'){
								$deliveryTime = '2-3 dni';
							}else{
								$deliveryTime = '2-3 days';
							}
						}
						if($instance_id == 11){
							$deliveryTime = '';
						}
						echo '<li methodid="' . $instance_id . '">';
						echo '<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_' . $method_id . $instance_id . '" value="' . $rate_id . '" class="shipping_method engineRadio" />';
						echo '<label for="shipping_method_0_' . $method_id . $instance_id . '" delivery-time="' . $deliveryTime . '" delivery-name="' .  __($label_name, 'lolobaby') . '">' . __($label_name, 'lolobaby') . '</label>';
						echo '</li>';
					}
				}
			}
		?>
		</ul>
	</div>
	<?php if($temporaryDeactivate): ?>
	<div data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( $available_methods ) : ?>
			<ul id="shipping_method" class="woocommerce-shipping-methods">
				<?php foreach ( $available_methods as $method ):

                        $getMethodID = $method->id;
                        $methodID = (int) filter_var($getMethodID, FILTER_SANITIZE_NUMBER_INT);
                        $methodPrice = $method->cost;
                        $rate_table = array();

                        if($mehtodPrice == '0.00'){
                            $methodPrice = __('Za darmo!', 'lolobaby');
                        }else{
                            $methodPrice = wc_price($methodPrice);
                        }

                        $zone_ids = array_keys( array('') + WC_Shipping_Zones::get_zones() );
                        foreach ( $zone_ids as $zone_id ){
                            $shipping_zone = new WC_Shipping_Zone($zone_id);
                            $shipping_methods = $shipping_zone->get_shipping_methods( true, 'values' );

                            foreach ( $shipping_methods as $instance_id => $shipping_method ){
                                if($methodID == $shipping_method->instance_id){
                                    $methodName = $shipping_method->title;
                                }
                            }
                        }
                    ?>
					<li methodid="<?php echo $methodID; ?>">
						<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method engineRadio" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}?>
						<label><?php _e($methodName, 'lolobaby'); ?></label>
						<?php
						// printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                        do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'woocommerce' ) ) );
					}
					?>
				</p>
			<?php endif; ?>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
			}
		elseif ( ! is_cart() ) :
			echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( $show_shipping_calculator ) : ?>
			<?php woocommerce_shipping_calculator( $calculator_text ); ?>
		<?php endif; ?>
    </div>
	<?php endif; ?>
</div>
