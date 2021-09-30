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
?>

<div class="checkoutUser checkoutUser--ready checkoutUser--visible container">
	<div class="checkoutUser__login">
		<?php
			woocommerce_login_form(
				array(
					'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woocommerce' ),
					'redirect' => wc_get_checkout_url(),
					'hidden'   => true,
				)
			);
		?>
		<div class="checkoutRegister">
			<h2><?php _e('Zarejestruj się', 'lolobaby'); ?></h2>
			<form class="checkoutRegister__form" id="checkoutRegisterForm" name="checkoutRegisterForm" method="post" action="/">
				<input type="hidden" name="register-formid" value="21"/>
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
					<label for="register-consent"><?php _e('Zapoznałam/em się z <a href="/regulamin" target="_blank">regulaminem sklepu internetowego</a> i akceptuję jego treść.', 'lolobaby'); ?></label>
				</div>
				<div class="checkoutRegister__checkbox bottom">
					<input type="checkbox" class="engineCheckbox" name="register-newsletter"/>
					<label for="register-newsletter"><?php _e('Chcę otrzymywać newsletter z aktualnościami oraz miec dostęp do ofert specjalnych i kuponów rabatowych (możesz zrezygnować z newslettera w kązdej chwili)', 'lolobaby'); ?></label>
				</div>
				<div class="checkoutRegister__input">
					<button type="submit" class="btn btn--button" value="Zarejestruj się"><?php _e('Zarejestruj się', 'lolobaby'); ?></button>
				</div>
			</form>
		</div>
	</div>
	<div class="checkoutUser__options">
		<div class="checkoutUser__change">
			<div class="toRegister changeBox changeBox--ready">
				<h2>Nowy klient</h2>
				<p>Załóż konto i korzystaj z dodatkowych funkcji.</p>
				<p class="btn btn--noarrow openRegister"><span>Zarejestruj się</span></p>
			</div>
			<div class="toLogin changeBox">
				<h2>Masz konto?</h2>
				<p>Jeśli posiadasz konto użytkownika, zaloguj się!</p>
				<p class="btn btn--noarrow openLogin"><span>Zaloguj się</span></p>
			</div>
		</div>
		<div class="wave">
			<img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>"/>
		</div>
		<div class="checkoutUser__guest">
			<h2>Kup jako gość</h2>
			<p class="btn btn--blue btn--noarrow continueGuest"><span>Przejdź do finalizacji zamówienia</span></p>
		</div>
	</div>
</div>