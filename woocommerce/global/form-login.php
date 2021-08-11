<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login loloCheckout__loginForm checkoutLogin checkoutLogin--ready checkoutLogin--visible login" method="post">
	<?php do_action( 'woocommerce_login_form_start' ); ?>
    <h1 class="checkoutLogin__title"><?php _e('Zaloguj się', 'lolobaby'); ?></h1>
	<div class="checkoutLogin__input">
		<input type="text" class="input-text" name="username" id="username" placeholder="<?php _e('Wpisz adres e-mail', 'lolobaby'); ?>" autocomplete="username" />
    </div>
	<div class="checkoutLogin__input">
		<input class="input-text" type="password" name="password" id="password" placeholder="<?php _e('Wpisz swoje hasło', 'lolobaby'); ?>" autocomplete="current-password" />
    </div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="checkoutLogin__actions">
        <div class="top">
            <div class="remember">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox engineCheckbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
            </div>
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
        </div>
        <div class="bottom">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		    <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
		    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn--button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
        </div>
    </div>
	<?php do_action( 'woocommerce_login_form_end' ); ?>
</form>
