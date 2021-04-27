<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword resetPassword lost_reset_password" autocomplete="off">
    <div class="resetPassword__wrap">
        <h1 class="sectionHeading"><span>Nowe hasło</span></h1>
        <p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?></p>
        
        <div class="resetPassword__input">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Nowe hasło" name="password_1" id="password_1" autocomplete="off" />
        </div>
        <div class="resetPassword__input">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Powtórz nowe hasło" name="password_2" id="password_2" autocomplete="off" />
        </div>

        <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
        <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

        <div class="clear"></div>

        <?php do_action( 'woocommerce_resetpassword_form' ); ?>

        <div class="woocommerce-form-row form-row">
            <input type="hidden" name="wc_reset_password" value="true" />
            <button type="submit" class="woocommerce-Button button btn btn--button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
        </div>

        <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
    </div>
</form>
<?php
do_action( 'woocommerce_after_reset_password_form' );

