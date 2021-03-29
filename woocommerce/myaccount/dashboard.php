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
$name = explode(' ',trim($currentuserName));
?>
<div class="accountPage">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>
    <div class="accountPage__heading">
        <div class="wrap">
            <h2 class="sectionHeading"><span>Witaj <?php echo $name[0]; ?>!</span></h2>
            <p>W tym miejscu możesz zarządzać informacjami osobistymi oraz zamówieniami.</p>
        </div>
    </div>
    <div class="accountPage__orders container">
        <div class="heading">
            <h3 class="accountPage__title">Historia zamówień</h3>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Nr zamówienia</td>
                    <td>Data</td>
                    <td>Wartość</td>
                    <td>Status</td>
                    <td>Faktura</td>
                </tr>
            </thead>
            <tbody>
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
                        <p>Numer zamówienia</p>
                        <span><?php echo $order->get_id(); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p>Data</p>
                        <span><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p>Wartość</p>
                        <span><?php echo wc_price($order->get_subtotal()); ?></span>
                    </div>
                    <div class="tableMobile__pos">
                        <p>Status</p>
                        <span><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span>
                    </div>
                    <?php
                    $actions = wc_get_account_orders_actions( $order );
                    if ( ! empty( $actions ) ) : ?>
                        <?php foreach ( $actions as $key => $action ) :
                            if($action['name'] == 'Faktura'):?>
                            <div class="tableMobile__pos invoice">
                                <p>Faktura</p>
                                <a href="<?php echo $action['url']; ?>" target="_blank">Pobierz fakturę</a>
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
        <?php $username = get_user_meta( $customer_user_id, 'billing_username', true ); ?>
        <?php $email = get_user_meta( $customer_user_id, 'billing_email', true ); ?>
        <?php $phone = get_user_meta( $customer_user_id, 'billing_phone', true ); ?>
        <?php $address = get_user_meta( $customer_user_id, 'billing_address_1', true ); ?>
        <?php $postcode = get_user_meta( $customer_user_id, 'billing_postcode', true ); ?>
        <?php $city = get_user_meta( $customer_user_id, 'billing_city', true ); ?>
        <?php $company = get_user_meta( $customer_user_id, 'billing_company', true ); ?>
        <?php $nip = get_user_meta( $customer_user_id, 'billing_company_nip', true ); ?>

        <div class="userData__data" type="">
            <h2 class="accountPage__title">Dane osobowe</h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <p>Imię i nazwisko: <?php echo $username; ?></p>
                <p>E-mail: <?php echo $email; ?></p>
                <p>Telefon: <?php echo $phone; ?></p>
                <p class="btn btn--noarrow openForm"><span>Edytuj</span></p>
            </div>
            <div class="form">
                <form id="person" method="POST">
                    <input type="text" name="person_name" placeholder="Wpisz imię i nazwisko"/>
                    <input type="text" name="person_email" placeholder="Wpisz adres e-mail"/>
                    <input type="text" name="person_phone" placeholder="Wpisz numer telefonu"/>
                    <button type="submit" class="btn btn--button" value="send">Zapisz</button>
                </form>
            </div>
        </div>
        <div class="userData__data">
            <h2 class="accountPage__title">Adres dostawy</h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <p><?php echo $username; ?></p>
                <p><?php echo $address; ?></p>
                <p><?php echo $postcode . ' ' . $city; ?></p>
                <p class="btn btn--noarrow openForm"><span>Zmień adres</span></p>
            </div>
            <div class="form">
                <form id="delivery" method="POST">
                    <input type="text" name="delivery_name" placeholder="Wpisz imię i nazwisko"/>
                    <input type="text" name="delivery_address" placeholder="Wpisz adres"/>
                    <div class="flex">
                        <input type="text" name="delivery_postcode" placeholder="Kod pocztowy"/>
                        <input type="text" name="delivery_city" placeholder="Miasto"/>
                    </div>
                    <button type="submit" class="btn btn--button" value="send">Zapisz</button>
                </form>
            </div>
        </div>
        <?php if($nip): ?>
        <div class="userData__data">
            <h2 class="accountPage__title">Dane do faktury</h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <p>Nazwa firmy: <?php echo $company; ?></p>
                <p>NIP: <?php echo $nip; ?></p>
            </div>
            <p class="btn btn--noarrow"><span>Zmień adres</span></p>
        </div>
        <?php endif; ?>
        <div class="userData__data">
            <h2 class="accountPage__title">Moje hasło</h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <p>Obecne hasło: ********</p>
                <p class="btn btn--noarrow openForm"><span>Zmień hasło</span></p>
            </div>
            <div class="form">
                <form id="password" method="POST">
                    <input type="password" name="user_password_change" placeholder="Wpisz nowe hasło"/>
                    <button type="submit" class="btn btn--button" value="send">Zapisz</button>
                </form>
            </div>
        </div>
        <div class="userData__data">
            <h2 class="accountPage__title">Newsletter</h2>
            <div class="wave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <div class="content">
                <p>Status subskrypcji: włączona</p>
                <p class="btn btn--noarrow"><span>Wypisz się</span></p>
            </div>
        </div>
        <div class="userData__data" type="logout">
            <a href="<?php echo wc_logout_url(); ?>" class="btn btn--blue btn--noarrow"><span>Wyloguj się</span></a>
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
