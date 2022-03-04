<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>



<form class="woocommerce-form woocommerce-form-login login checkoutLogin checkoutLogin--ready checkoutLogin--visible" method="post">
	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
    <h2 class="checkoutLogin__title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
    <?php do_action( 'woocommerce_login_form_start' ); ?>
	<div class="notices">
		<div class="wc-notices"></div>
	</div>
    <div class="checkoutLogin__input">
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" placeholder="<?php _e('Wpisz adres e-mail', 'lolobaby'); ?>" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </div>
    <div class="checkoutLogin__input">
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="<?php _e('Wpisz swoje hasło', 'lolobaby'); ?>" autocomplete="current-password" />
    </div>
    <?php do_action( 'woocommerce_login_form' ); ?>
    <div class="checkoutLogin__actions">
        <div class="top">
            <div class="remember">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox engineCheckbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            </div>
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
        </div>
        <div class="bottom">
            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn btn--button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
        </div>
    </div>
    <?php do_action( 'woocommerce_login_form_end' ); ?>
</form>
<div class="checkoutRegister">
	<h2><?php _e('Zarejestruj się', 'lolobaby'); ?></h2>
	<form class="checkoutRegister__form" id="checkoutRegisterForm" name="checkoutRegisterForm">
		<div class="notices"></div>
		<input type="hidden" name="register-formid" value="20"/>
		<div class="checkoutRegister__input">
			<input type="text" name="registerUsername" placeholder="<?php _e('Wpisz imię i nazwisko', 'lolobaby'); ?>"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="email" name="registerUseremail" placeholder="<?php _e('Wpisz adres e-mail', 'lolobaby'); ?>"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="password" name="registerUserpassword" placeholder="<?php _e('Ustal hasło', 'lolobaby'); ?>"/>	
		</div>
		<div class="checkoutRegister__checkbox top">
			<input type="checkbox" class="engineCheckbox" name="registerConsent"/>
			<label for="registerConsent"><?php _e('Zapoznałam/em się z <a href="/regulamin" target="_blank">regulaminem sklepu internetowego</a> i akceptuję jego treść.', 'lolobaby'); ?></label>
		</div>
		<div class="checkoutRegister__checkbox bottom">
			<input type="checkbox" class="engineCheckbox" name="mc4wp-subscribe" value="1" />
			<label for="mc4wp-subscribe"><?php _e('Chcę otrzymywać newsletter z aktualnościami oraz miec dostęp do ofert specjalnych i kuponów rabatowych (możesz zrezygnować z newslettera w kązdej chwili)', 'lolobaby'); ?></label>
		</div>
		<div class="checkoutRegister__input">
			<button type="submit" class="btn btn--button" value="<?php _e('Zarejestruj się', 'lolobaby'); ?>"><?php _e('Zarejestruj się', 'lolobaby'); ?></button>
		</div>
	</form>
	<div class="checkoutLogin__gotoOtherForm checkoutUser__change">
		<div class="wave">
			<img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
		</div>
		<h3><?php _e('Jeśli masz już konto', 'lolobaby'); ?>:</h3>
		<p class="btn openLogin"><span><?php _e('Zaloguj się', 'lolobaby'); ?></span></p>
	</div>
</div>
<div class="checkoutLogin__gotoOtherForm checkoutUser__change gotoRegister gotoRegister--ready gotoRegister--visible">
	<div class="wave">
		<img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
	</div>
	<h3><?php _e('Nie masz jeszcze konta?', 'lolobaby'); ?></h3>
	<p class="btn openRegister"><span><?php _e('Zarejestruj się', 'lolobaby'); ?></span></p>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
