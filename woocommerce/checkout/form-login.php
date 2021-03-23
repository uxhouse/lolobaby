<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

woocommerce_login_form(
	array(
		'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woocommerce' ),
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
?>
<div class="checkoutRegister">
	<h2>Zarejestruj się</h2>
	<form class="checkoutRegister__form" id="checkoutRegisterForm" method="post" action="/">
		<div class="checkoutRegister__input">
			<input type="text" name="register-user-name" placeholder="Wpisz imię i nazwisko"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="email" name="register-user-email" placeholder="Wpisz adres e-mail"/>
		</div>
		<div class="checkoutRegister__input">
			<input type="password" name="register-user-password" placeholder="Ustal hasło"/>	
		</div>
		<div class="checkoutRegister__checkbox top">
			<input type="checkbox" class="engineCheckbox" name="register-consent"/>
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