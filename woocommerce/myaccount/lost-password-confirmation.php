<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

wc_print_notice( esc_html__( 'Password reset email has been sent.', 'woocommerce' ) );
?>

<?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>

<div class="lostConfirmation">
    <div class="lostConfirmation__wrap">
        <h2 class="sectionHeading"><span>Gotowe!</span></h2>
        <p>E-mail z linkiem do zresetowania hasła został wysłany na adres przypisany do Twojego konta, może minąć kilka minut zanim pojawi się on w Twojej skrzynce.</p>
    </div>
</div>

<?php do_action( 'woocommerce_after_lost_password_confirmation_message' ); ?>
