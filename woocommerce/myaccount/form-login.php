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

do_action( 'woocommerce_before_customer_login_form' ); ?>



<form class="woocommerce-form woocommerce-form-login login checkoutLogin checkoutLogin--ready checkoutLogin--visible" method="post">
    <h2 class="checkoutLogin__title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
    <?php do_action( 'woocommerce_login_form_start' ); ?>
	<div class="notices"></div>
    <div class="checkoutLogin__input">
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" placeholder="Wpisz adres e-mail" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </div>
    <div class="checkoutLogin__input">
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="Wpisz swoje hasło" autocomplete="current-password" />
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
	<h2>Zarejestruj się</h2>
	<form class="checkoutRegister__form" id="checkoutRegisterForm" name="checkoutRegisterForm" method="post" action="/">
		<div class="notices"></div>
		<input type="hidden" name="register-formid" value="20"/>
		<div class="checkoutRegister__input">
			<input type="text" name="registerUsername" placeholder="Wpisz imię i nazwisko"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="email" name="registerUseremail" placeholder="Wpisz adres e-mail"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="password" name="registerUserpassword" placeholder="Ustal hasło"/>	
		</div>
		<div class="checkoutRegister__checkbox top">
			<input type="checkbox" class="engineCheckbox" name="register-consent" required/>
			<label for="register-consent">Zapoznałam/em się z <a href="/regulamin" target="_blank">regulaminem sklepu internetowego</a> i akceptuję jego treść.</label>
		</div>
		<div class="checkoutRegister__checkbox bottom">
			<input type="checkbox" class="engineCheckbox" name="register-newsletter"/>
			<label for="register-newsletter">Chcę otrzymywać newsletter z aktualnościami oraz miec dostęp do ofert specjalnych i kuponów rabatowych (możesz zrezygnować z newslettera w kązdej chwili)</label>
		</div>
		<div class="checkoutRegister__input">
			<button type="submit" class="btn btn--button" value="Zarejestruj się">Zarejestruj się</button>
		</div>
	</form>
	<div class="checkoutLogin__gotoOtherForm">
		<div class="wave">
			<img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
		</div>
		<h3>Jeśli masz już konto:</h3>
		<p class="btn openLogin"><span>Zaloguj się</span></p>
	</div>
</div>
<div class="checkoutLogin__gotoOtherForm gotoRegister gotoRegister--ready gotoRegister--visible">
	<div class="wave">
		<img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
	</div>
	<h3>Nie masz jeszcze konta?</h3>
	<p class="btn openRegister"><span>Zarejestruj się</span></p>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
