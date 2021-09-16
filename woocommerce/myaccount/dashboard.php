<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
$customer_user_id = get_current_user_id();
$currentuserName = get_user_meta( $customer_user_id, 'billing_username', true );
$currentuserNickname = get_user_meta( $customer_user_id, 'nickname', true );
if($currentuserName){
    $name = explode(' ', trim($currentuserName));
}else{
    $name = explode(' ', trim($currentuserNickname));
}
?>
<div class="accountPage">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>
    <div class="accountPage__heading">
        <div class="wrap">
            <h2 class="sectionHeading"><span><?php _e('Witaj', 'lolobaby'); ?> <?php echo $name[0]; ?>!</span></h2>
            <p><?php _e('W tym miejscu możesz zarządzać informacjami osobistymi oraz zamówieniami.', 'lolobaby'); ?></p>
        </div>
    </div>
    <div class="accountPage__orders container">
        <div class="heading">
            <h3 class="accountPage__title"><?php _e('Historia zamówień', 'lolobaby'); ?></h3>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <td><?php _e('Nr zamówienia', 'lolobaby'); ?></td>
                    <td><?php _e('Data', 'lolobaby'); ?></td>
                    <td><?php _e('Wartość', 'lolobaby'); ?></td>
                    <td><?php _e('Status', 'lolobaby'); ?></td>
                    <td><?php _e('Faktura', 'lolobaby'); ?></td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $order_statuses = array('wc-on-hold', 'wc-processing', 'wc-completed', 'processing-p24');
            $customer_orders = wc_get_orders( array(
                'meta_key' => '_customer_user',
                'meta_value' => $customer_user_id,
                'post_status' => $order_statuses,
                'numberposts' => -1
            ) );

            foreach($customer_orders as $order ):
                $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

                foreach($order->get_items() as $item_id => $item):
                    $product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                ?>
                <tr>
                    <td class="orderid"><?php echo $order->get_id(); ?></td>
                    <td><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
                    <td><?php echo wc_price($order->get_subtotal()); ?></td>
                    <td><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></td>
                    <td>
                        <?php
                        $actions = wc_get_account_orders_actions( $order );
                        if ( ! empty( $actions ) ) :
                            foreach ( $actions as $key => $action ) :
                                if($action['name'] == 'Faktura'):?>
                                    <a href="<?php echo $action['url']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/icons/get_pdf_file_ico.svg'; ?>"/></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                    
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="tableMobile">
        <?php 
            $order_statuses = array('wc-on-hold', 'wc-processing', 'wc-completed');
            $customer_orders = wc_get_orders( array(
                'meta_key' => '_customer_user',
                'meta_value' => $customer_user_id,
                'post_status' => $order_statuses,
                'numberposts' => -1
            ) );

            foreach($customer_orders as $order ):
                $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

                foreach($order->get_items() as $item_id => $item):
                    $product_id = method_exists( $item, 'get_product_id' ) ? $item->get_product_id() : $item['product_id'];
                ?>
                <div class="tableMobile__row">
                    <div class="tableMobile__pos orderid">
                        <p><?php _e('Numer zamówienia', 'lolobaby'); ?></p>
                        <span><?php echo $order->get_id(); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p><?php _e('Data', 'lolobaby'); ?></p>
                        <span><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p><?php _e('Wartość', 'lolobaby'); ?></p>
                        <span><?php echo wc_price($order->get_subtotal()); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p><?php _e('Status', 'lolobaby'); ?></p>
                        <span><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span>
                    </div>
                    <?php
                    $actions = wc_get_account_orders_actions( $order );
                    if ( ! empty( $actions ) ) : ?>
                        <?php foreach ( $actions as $key => $action ) :
                            if($action['name'] == 'Faktura'):?>
                            <div class="tableMobile__pos invoice">
                                <p><?php _e('Faktura', 'lolobaby'); ?></p>
                                <a href="<?php echo $action['url']; ?>" target="_blank"><?php _e('Pobierz fakturę', 'lolobaby'); ?></a>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <section class="userData container">
        <?php 
            $userData = wp_get_current_user($customer_user_id);
            $username = get_user_meta( $customer_user_id, 'billing_username', true );
            $nickname = get_user_meta( $customer_user_id, 'nickname', true );
            $email = get_user_meta( $customer_user_id, 'email', true );
            $phone = get_user_meta( $customer_user_id, 'billing_phone', true );
            $address = get_user_meta( $customer_user_id, 'billing_address_1', true );
            $postcode = get_user_meta( $customer_user_id, 'billing_postcode', true );
            $city = get_user_meta( $customer_user_id, 'billing_city', true );
            $company = get_user_meta( $customer_user_id, 'billing_company', true );
            $nip = get_user_meta( $customer_user_id, 'billing_company_nip', true );
            $newsletter = get_user_meta( $customer_user_id, 'newsletterSubscribe', true );
        ?>
        <div class="userData__data" type="">
            <h2 class="accountPage__title"><?php _e('Dane osobowe', 'lolobaby'); ?></h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <div class="wrap">
                    <p><?php _e('Imię i nazwisko', 'lolobaby'); ?>: <?php if($username){echo $username;}else{echo $nickname;}; ?></p>
                    <p><?php _e('E-mail', 'lolobaby'); ?>: <?php if ($email){echo $email;}else{echo $userData->user_email;}; ?></p>
                    <p><?php _e('Telefon', 'lolobaby'); ?>: <?php echo $phone; ?></p>
                </div>
                <p class="btn btn--noarrow openForm"><span><?php _e('Edytuj', 'lolobaby'); ?></span></p>
            </div>
            <div class="form">
                <form id="person" method="POST">
                    <input type="text" name="person_name" placeholder="<?php _e('Wpisz imię i nazwisko', 'lolobaby'); ?>"/>
                    <input type="text" name="person_email" placeholder="<?php _e('Wpisz adres e-mail', 'lolobaby'); ?>"/>
                    <input type="text" name="person_phone" placeholder="<?php _e('Wpisz numer telefonu', 'lolobaby'); ?>"/>
                    <button type="submit" class="btn btn--button" value="send"><?php _e('Zapisz', 'lolobaby'); ?></button>
                </form>
            </div>
        </div>
        <div class="userData__data">
            <h2 class="accountPage__title"><?php _e('Adres dostawy', 'lolobaby'); ?></h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <div class="wrap">
                    <p><?php echo $username; ?></p>
                    <p><?php echo $address; ?></p>
                    <p><?php echo $postcode . ' ' . $city; ?></p>
                </div>
                <p class="btn btn--noarrow openForm"><span><?php _e('Zmień adres', 'lolobaby'); ?></span></p>
            </div>
            <div class="form">
                <form id="delivery" method="POST">
                    <input type="text" name="delivery_name" placeholder="<?php _e('Wpisz imię i nazwisko', 'lolobaby'); ?>"/>
                    <input type="text" name="delivery_address" placeholder="<?php _e('Wpisz adres', 'lolobaby'); ?>"/>
                    <div class="flex">
                        <input type="text" name="delivery_postcode" placeholder="<?php _e('Kod pocztowy', 'lolobaby'); ?>"/>
                        <input type="text" name="delivery_city" placeholder="<?php _e('Miasto', 'lolobaby'); ?>"/>
                    </div>
                    <button type="submit" class="btn btn--button" value="send"><?php _e('Zapisz', 'lolobaby'); ?></button>
                </form>
            </div>
        </div>
        <?php if($nip): ?>
        <div class="userData__data">
            <h2 class="accountPage__title"><?php _e('Dane do faktury', 'lolobaby'); ?></h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <div class="wrap">
                    <p><?php _e('Nazwa firmy', 'lolobaby'); ?>: <?php echo $company; ?></p>
                    <p><?php _e('NIP', 'lolobaby'); ?>: <?php echo $nip; ?></p>
                </div>
                <p class="btn btn--noarrow"><span><?php _e('Zmień adres', 'lolobaby'); ?></span></p>
            </div>
        </div>
        <?php endif; ?>
        <div class="userData__data">
            <h2 class="accountPage__title"><?php _e('Moje hasło', 'lolobaby'); ?></h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <div class="wrap">
                    <p><?php _e('Obecne hasło', 'lolobaby'); ?>: ********</p>
                </div>
                <p class="btn btn--noarrow openForm"><span><?php _e('Zmień hasło', 'lolobaby'); ?></span></p>
            </div>
            <div class="form">
                <form id="password" method="POST">
                    <input type="password" name="user_password_change" placeholder="<?php _e('Wpisz nowe hasło', 'lolobaby'); ?>"/>
                    <button type="submit" class="btn btn--button" value="send"><?php _e('Zapisz', 'lolobaby'); ?></button>
                </form>
            </div>
        </div>
        <div class="userData__data">
            <h2 class="accountPage__title"><?php _e('Newsletter', 'lolobaby'); ?></h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <div class="wrap">
                    <p><?php _e('Status subskrypcji', 'lolobaby'); ?>: 
                        <?php if($newsletter){
                            echo __('włączona', 'lolobaby');
                        }else{
                            echo __('wyłączona', 'lolobaby');
                        }
                        ?>
                    </p>
                </div>
                <form id="newsletter" method="POST">
                    <input style="display: none !important" type="email" name="newsletterEmail" value="<?php if ($email){echo $email;}else{echo $userData->user_email;}; ?>"/>
                    <?php if($newsletter): ?>
                        <input style="display: none !important" type="checkbox" name="_mc4wp_action" value="unsubscribe" checked/>
                        <input style="display: none !important" type="checkbox" name="newsletterSignout" value="1" checked/>
                        <button type="submit" class="btn btn-button btn--noarrow"><span><?php _e('Wypisz się', 'lolobaby'); ?></span></button>
                    <?php else: ?>
                        <input style="display: none !important" type="checkbox" name="mc4wp-subscribe" value="1" checked/>
                        <input style="display: none !important" type="checkbox" name="newsletterSignin" value="1" checked/>
                        <button type="submit" class="btn btn--button btn--noarrow"><span><?php _e('Zapisz się', 'lolobaby'); ?></span></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="userData__data" type="logout">
            <a href="<?php echo wc_logout_url(); ?>" class="btn btn--blue btn--noarrow"><span><?php _e('Wyloguj się', 'lolobaby'); ?></span></a>
        </div>
    </section>
</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	// do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
