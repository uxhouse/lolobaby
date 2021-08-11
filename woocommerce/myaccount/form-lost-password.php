<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password lostPassword">
    <div class="lostPassword__wrap">
        <h2 class="lostPassword__title"><?php _e('Resetowanie hasła', 'lolobaby'); ?></h2>
        <p class="lostPassword__subtitle"><?php _e('Wpisz adres e-mail przypisany do Twojego konta. Na podany adres zostanie wysłany link do resetowania hasła.', 'lolobaby'); ?></p>
        <div class="lostPassword__input">
            <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" placeholder="<?php _e('Wpisz adres e-mail', 'lolobaby'); ?>" autocomplete="username" />
        </div>
        <?php do_action( 'woocommerce_lostpassword_form' ); ?>
        <input type="hidden" name="wc_reset_password" value="true" />
        <button type="submit" class="woocommerce-Button button btn btn--button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
        <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
    </div>
</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
