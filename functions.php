<?php
/**
 * Lolobaby functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lolobaby
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'lolobaby_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lolobaby_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Lolobaby, use a find and replace
		 * to change 'lolobaby' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lolobaby', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'lolobaby' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'lolobaby_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'lolobaby_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lolobaby_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lolobaby_content_width', 640 );
}
add_action( 'after_setup_theme', 'lolobaby_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lolobaby_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lolobaby' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lolobaby' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lolobaby_widgets_init' );

add_action('wp_head', 'custom_ajaxurl');
function custom_ajaxurl() {
   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

/*
 *	Versioning
 */
function wpmix_get_version() {
	$theme_data = wp_get_theme();
	return $theme_data->Version;
}
$theme_version = wpmix_get_version();
global $theme_version;

function wpmix_get_random() {
	$randomizr = '-' . rand(100,999);
	return $randomizr;
}
$random_number = wpmix_get_random();
global $random_number;

/**
 * Enqueue scripts and styles.
 */
function lolobaby_scripts() {
	global $theme_version, $random_number;
	wp_enqueue_style( 'lolobaby-style', get_stylesheet_uri(), array(), $theme_version . $random_number );
	wp_style_add_data( 'lolobaby-style', 'rtl', 'replace' );

	/* jQuery */
	wp_register_script( 'lolobaby-jQuery', 'https://code.jquery.com/jquery-3.6.0.min.js', null, null, true );
	wp_enqueue_script('lolobaby-jQuery');

	/* Bootstrap */
	wp_enqueue_style( 'lolobaby-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.css', array(), _S_VERSION );

	/* Slick */
	wp_enqueue_script( 'lolobaby-slick', get_template_directory_uri() . '/plugins/slick/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'lolobaby-slickCSS', get_template_directory_uri() . '/plugins/slick/slick.css', array(), _S_VERSION );
	wp_enqueue_style( 'lolobaby-slickThemeCSS', get_template_directory_uri() . '/plugins/slick/slick-theme.css', array(), _S_VERSION );

	/* Zoom */
	wp_enqueue_script( 'lolobaby-zoom', get_template_directory_uri() . '/plugins/zoom/jquery.zoom.min.js', array(), _S_VERSION, true );

	/* Masonry gallery */
	wp_enqueue_script( 'lolobaby-macy', get_template_directory_uri() . '/plugins/macy/dist/macy.js', array(), _S_VERSION, true );

	/* Custom CSS */
	wp_enqueue_style( 'lolobaby-custom', get_template_directory_uri() . '/css/custom.css', array(), $theme_version . $random_number);

	/* Custom js */
	wp_enqueue_script( 'lolobaby-custom-js', get_template_directory_uri() . '/js/custom.js', array(), $theme_version . $random_number, true );
	wp_enqueue_script( 'lolobaby-language-js', get_template_directory_uri() . '/js/_language.js', array(), $theme_version . $random_number, true );
	wp_enqueue_script( 'lolobaby-checkout-js', get_template_directory_uri() . '/js/_checkout.js', array(), $theme_version . $random_number, true );
	wp_enqueue_script( 'lolobaby-sliders-js', get_template_directory_uri() . '/js/sliders.js', array(), $theme_version . $random_number, true );
	wp_enqueue_script( 'lolobaby-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $theme_version . $random_number, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lolobaby_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/* ACF */

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

/* Woocommerce remove hooks - product page */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/* Remove default shipping method */
add_filter( 'pre_option_woocommerce_default_gateway' . '__return_false', 99 );
add_filter( 'woocommerce_shipping_chosen_method', '__return_false', 99);

/* Remove Poland if user select specific shipping method */
// add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
// function woocommerce_custom_surcharge() {
// 	global $woocommerce;
	
// 	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
// 	$chosen_shipping = $chosen_methods[0]; 

// 	$country = $woocommerce->countries;

// 	// $min_spend = 25;
// 	// $cart_total = $woocommerce->cart->cart_contents_total;
// 	// if (($cart_total < 25) AND ($chosen_shipping == 'local_delivery')) {   
// 	// 	$surcharge = $min_spend-$cart_total;    
// 	// 	$woocommerce->cart->add_fee( 'Delivery Surchage', $surcharge, true, 'standard' );
// 	// }
// }
// function wc_remove_specific_country( $country ) {
// 	if (is_admin()){
// 		return $country;
// 	}else{
// 		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
// 		$chosen_shipping = $chosen_methods[0]; 

// 		if($chosen_shipping == 'flat_rate:12'){
// 			unset($country['PL']);
// 		}
// 		echo $chosen_shipping;
// 		return $country; 
// 	}
// }
// add_filter( 'woocommerce_countries', 'wc_remove_specific_country', 10, 1 );

add_filter( 'default_checkout_billing_country', 'change_default_checkout_country' );
function change_default_checkout_country() {
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping = $chosen_methods[0]; 

	if($chosen_shipping !== 'flat_rate:12'){
		return 'PL';
	}
}

/* Woocommerce cart size attribute update */
function filter_woocommerce_update_cart_action_cart_updated( $cart_updated ) {
    $cart_updated = false;
	$cart = WC()->cart->cart_contents;
	
    if ( $cart_updated == false ) {
		foreach($_POST['cart'] as $cart_item_id => $cart_item ) {
			$cartItem = $cart[$cart_item_id];
			$updatedSize = $cart_item['pa_rozmiar'];
			$currentSize = $cartItem['variation']['attribute_pa_rozmiar'];
			$cartItemColor = $cartItem['variation']['attribute_pa_kolor'];

			$args = array(
				'post_type'     => 'product_variation',
				'post_status'   => array( 'private', 'publish' ),
				'numberposts'   => -1,
				'orderby'       => 'menu_order',
				'order'         => 'asc',
				'post_parent'   => $cart_item_id, 
			);
			$variations = get_posts( $args );
			
			foreach ( $variations as $variation ) {
				$variation_ID = $variation->ID;
				$product_variation = new WC_Product_Variation( $variation_ID );
				$variation_size = $product_variation->attributes['pa_rozmiar'];
				$variation_color = $product_variation->attributes['pa_kolor'];
			
				$availableVariants = array($variation_ID, $variation_color, $variation_size);

				if($updatedSize == $availableVariants[2] && $cartItemColor == $availableVariants[1] && $updatedSize !== $currentSize){
					$cartItem['variation_id'] = $availableVariants[0];
					$cartItem['variation']['attribute_pa_rozmiar'] = $updatedSize;
					WC()->cart->cart_contents[$cart_item_id] = $cartItem;

					$currentUpdatedSize = $cartItem['variation']['attribute_pa_rozmiar'];
					wc_add_notice( __( 'Produkt został zmieniony! ' . $cartItem->name . ' - Rozmiar: ' . $currentUpdatedSize, 'woocommerce' ), 'success' );
				}
			}
		}
		WC()->cart->set_session();
    }
    return $cart_updated;
}
add_filter( 'woocommerce_update_cart_action_cart_updated', 'filter_woocommerce_update_cart_action_cart_updated', 10, 1 );


/*** Custom register form ***/

function get_custom_email_html($heading = false, $mailer ) {
	$template = '/wp-content/themes/lolobaby/woocommerce/emails/customer-new-account.php';
	return wc_get_template_html( $template, array(
		'email_heading' => $heading,
		'sent_to_admin' => false,
		'plain_text'    => false,
		'email'         => $mailer
	));
}

add_action('init','create_account');
function create_account(){
    //You may need some data validation here
	$formID = ( isset($_POST['register-formid']) ? $_POST['register-formid'] : '' );
    $user = ( isset($_POST['registerUsername']) ? $_POST['registerUsername'] : '' );
    $pass = ( isset($_POST['registerUserpassword']) ? $_POST['registerUserpassword'] : '' );
    $email = ( isset($_POST['registerUseremail']) ? $_POST['registerUseremail'] : '' );
    $newsletter = ( isset($_POST['mc4wp-subscribe']) ? $_POST['mc4wp-subscribe'] : '' );

	if($formID == 21){
		if (!email_exists($email)){
			$user_id = wp_create_user($user, $pass, $email);
			if(!is_wp_error($user_id)){
				$user = new WP_User($user_id);
				$user->set_role('customer');

				$emails = WC()->mailer()->get_emails();
				$emails['WC_Email_Customer_New_Account']->trigger( $user_id, $pass, false);

				if($newsletter){
					update_user_meta($user_id, 'newsletterSubscribe', $newsletter);
				}

				wp_set_current_user($user_id);
				wp_set_auth_cookie($user_id);
				wp_redirect(home_url('/zamowienie'));
				exit;
			}
		}else{
			wp_redirect(home_url('/moje-konto?registerstatus=failed&reason=email'));
			exit;
		}
	}else{
		if (!email_exists($email)){
			$user_id = wp_create_user($user, $pass, $email);
			if(!is_wp_error($user_id)){
				$user = new WP_User($user_id);
				$user->set_role('customer');

				$emails = WC()->mailer()->get_emails();
				$emails['WC_Email_Customer_New_Account']->trigger( $user_id, $pass, false);

				if($newsletter){
					update_user_meta($user_id, 'newsletterSubscribe', $newsletter);
				}

				wp_set_current_user($user_id);
				wp_set_auth_cookie($user_id);
				wp_redirect(home_url('/moje-konto'));
				exit;
			}
		}else{
			wp_redirect(home_url('/moje-konto?registerstatus=failed&reason=email'));
			exit;
		}
	}
}

// define the woocommerce_process_login_errors callback 
function filter_woocommerce_process_login_errors($validation_error, $post_username, $post_password)
{
    //if (strpos($post_username, '@') == FALSE)
    if (!filter_var($post_username, FILTER_VALIDATE_EMAIL)) //<--recommend option
    {
        throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Please Enter a Valid Email ID.', 'woocommerce' ) );
    }
    return $validation_error;
}

// add the filter 
add_filter('woocommerce_process_login_errors', 'filter_woocommerce_process_login_errors', 10, 3);

/* User extra newsletter field */
function wporg_usermeta_form_field_newsletter($user)
{
?>
	<h3>Subskrypcja newslettera</h3>
	<table class="form-table">
		<tr>
			<th>
				<label>Subskrypcja newslettera</label>
			</th>
			<td>
				<input type="checkbox" class="regular-text ltr" id="newsletterSubscribe" name="newsletterSubscribe" <?php if(get_user_meta($user->ID, 'newsletterSubscribe', true)){echo 'checked="checked"'; }; ?>>
				<label for="newsletterSubscribe">Zaznaczone jeśli klient subskrybuje newsletter</label>
			</td>
		</tr>
	</table>
<?php
}


/* Newsletter field user account */
function wporg_usermeta_form_field_newsletter_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'newsletterSubscribe', $_POST['newsletterSubscribe']);
}

// Add the field to user's own profile editing screen.
add_action('show_user_profile', 'wporg_usermeta_form_field_newsletter');

// Add the field to user profile editing screen.
add_action('edit_user_profile', 'wporg_usermeta_form_field_newsletter');

// Add the save action to user's own profile editing screen update.
add_action('personal_options_update', 'wporg_usermeta_form_field_newsletter_update');

// Add the save action to user profile editing screen update.
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_newsletter_update');

/*** Custom edit form ***/

add_action('init', 'user_edit_account_person');
function user_edit_account_person(){
	$user_id = get_current_user_id();
	$username = ( isset($_POST['person_name']) ? $_POST['person_name'] : '' );
    $email = ( isset($_POST['person_email']) ? $_POST['person_email'] : '' );
    $phone = ( isset($_POST['person_phone']) ? $_POST['person_phone'] : '' );

	if (!empty($username) && !empty($email) && !empty($phone)) {
		update_user_meta( $user_id, 'billing_username', $username );
		update_user_meta( $user_id, 'billing_email', $email );
		update_user_meta( $user_id, 'email', $email );
		update_user_meta( $user_id, 'billing_phone', $phone );
		wc_add_notice( 'Dane zostały pomyślnie zmienione', 'success' );
	}
}

add_action('init', 'user_edit_account_delivery');
function user_edit_account_delivery(){
	$user_id = get_current_user_id();
	$username = ( isset($_POST['delivery_name']) ? $_POST['delivery_name'] : '' );
    $address = ( isset($_POST['delivery_address']) ? $_POST['delivery_address'] : '' );
    $postcode = ( isset($_POST['delivery_postcode']) ? $_POST['delivery_postcode'] : '' );
    $city = ( isset($_POST['delivery_city']) ? $_POST['delivery_city'] : '' );

	if (!empty($username) && !empty($address) && !empty($postcode) && !empty($city)) {
		update_user_meta( $user_id, 'billing_username', $username );
		update_user_meta( $user_id, 'billing_address_1', $address );
		update_user_meta( $user_id, 'billing_postcode', $postcode );
		update_user_meta( $user_id, 'billing_city', $city );
		wc_add_notice( 'Dane zostały pomyślnie zmienione', 'success' );
	}
}

add_action('init', 'user_change_pass');
function user_change_pass(){
	$user_id = get_current_user_id();
    $password = ( isset($_POST['user_password_change']) ? $_POST['user_password_change'] : '' );

	if (!empty($password)) {
		wp_set_password( $password, $user_id );
		wc_add_notice( 'Hasło do Twojego konta zostało pomyślnie zmienione', 'success' );
	}
}
add_action('init', 'user_newsletter_subscription');
function user_newsletter_subscription(){
	$user_id = get_current_user_id();
	$signin = ( isset($_POST['newsletterSignin']) ? $_POST['newsletterSignin'] : '' );
	$signout = ( isset($_POST['newsletterSignout']) ? $_POST['newsletterSignout'] : '' );

	if($signin){
		update_user_meta($user_id, 'newsletterSubscribe', $signin);
	}
	if($signout){
		delete_user_meta($user_id, 'newsletterSubscribe', $signin);
	}
}


/* remove add to cart message */
add_filter( 'wc_add_to_cart_message_html', '__return_false' );


/* Global free shipping amount */
function freeshipping_amount() {
	global $freeshippingamount;
	$freeshippingamount = 250;
}
add_action( 'after_setup_theme', 'freeshipping_amount' );


/* Orphans */
function acf_orphans($value, $post_id, $field) {
	if ( class_exists( 'iworks_orphan' ) ) {
	  $orphan = new \iworks_orphan();
	  $value = $orphan->replace( $value );
	}
	return $value;
  }
add_filter('acf/format_value/type=textarea', 'acf_orphans', 10, 3);
add_filter('acf/format_value/type=wysiwyg', 'acf_orphans', 10, 3);

add_filter( 'woocommerce_add_to_cart_fragments', 'wc_mini_cart_ajax_refresh' );
function wc_mini_cart_ajax_refresh( $fragments ){

	if(WC()->cart->get_cart_contents_count() > 0){
		$fragments['div.openMiniCart__count'] = '<div class="openMiniCart__count"><p class="minicart-count">' . WC()->cart->get_cart_contents_count() . '</p></div>';
	}else{
		$fragments['div.openMiniCart__count'] = '<div class="openMiniCart__count"></div>';
	}

    ob_start();
    echo '<div id="miniCart" class="miniCart">';
    woocommerce_mini_cart();
    echo '</div>';
	
    $fragments['#miniCart'] = ob_get_clean();

    return $fragments;

}

add_action( 'wp_footer', 'ajax_add_tocart_event' );
function ajax_add_tocart_event() {
?>
	<script type="text/javascript">
		jQuery('body').on( 'added_to_cart', function( e, fragments, cart_hash, this_button ) {
			setTimeout(function(){
				$('.miniCart').css('opacity', '1').css('pointer-events', 'all');
				$('.closeMiniCart').on('click', function(){
					$('.miniCart').css('opacity', '0').css('pointer-events', 'none');
				});
			}, 500);
		});
	</script>
<?php
}

/* Session start */

add_action('wp_ajax_availableForm', 'availableForm');
add_action('wp_ajax_nopriv_availableForm', 'availableForm');

function availableForm(){
	$_SESSION['availableAlert'];
	$productName = $_POST['name'];
	$to = 'kontakt@lolobaby.pl';
	$subject = '[Lolobaby] Zainteresowanie produktem ' . $productName;
	$message = 'Witaj, jeden z uzytkowników zgłosił zainteresowanie produktem - ' . $productName;

	wp_mail( $to, $subject, $message );
}


/* don't cache wishlist page */
add_action('wp_ajax_wishlistDelete', 'wishlistDelete');
add_action('wp_ajax_nopriv_wishlistDelete', 'wishlistDelete');

function wishlistDelete(){
	global $wpdb, $table_prefix;
	$wishlistID = $_POST['id'];
	$productAttr = $wpdb->get_var('SELECT variation_id FROM '. $table_prefix .'tinvwl_items WHERE ID = '. $wishlistID);
	echo $wishlistID . ' ' . $productAttr;

	$wpdb->delete(
		$table_prefix . 'tinvwl_items',
		array(
			'ID' => $wishlistID,
		),
		array(
			'%d'
		)
	);

	die();
}

/* Check user newsletter subscription status */
function get_subscriber_mailchimp_status() {
	$user = wp_get_current_user();
	$api_key = '44790bf7d89d21841f3fdb902a309152-us1';
	$list_id = '474dd832c9';
	$us = 'us1';
	$args = array(
		'headers'     => array(
			'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key ),
			'Access-Control-Allow-Origin' => '*',
		),
	);

	$email_address = $user->user_email;
	$email_formatted = md5(strtolower($email_address));
	$response = wp_remote_get( 'https://'. $us  .'.api.mailchimp.com/3.0/lists/'. $list_id . '/members/' . $email_formatted, $args );
	$body = json_decode( wp_remote_retrieve_body( $response ) );
	$mailchimp_status = $body->status;
	if($mailchimp_status == 'subscribed'){
		update_user_meta($user->ID, 'newsletterSubscribe', 'on');
	}else{
		delete_user_meta($user->ID, 'newsletterSubscribe', 'on');
	}
}
add_action('wp_head', 'get_subscriber_mailchimp_status', 10, 2);

/* Newsletter popup */

// function delete_newsletter_cookies(){
// 	setcookie('newsletterPopup', 'false', strtotime('-1 day'));
// }
// add_action('init', 'delete_newsletter_cookies');

add_action('wp_ajax_newsletter_get_cookie', 'newsletter_get_cookie');
add_action('wp_ajax_nopriv_newsletter_get_cookie', 'newsletter_get_cookie');
function newsletter_get_cookie(){
	echo $_COOKIE['newsletterPopup'];
	wp_die();
}

add_action('wp_ajax_newsletter_set_cookie', 'newsletter_set_cookie');
add_action('wp_ajax_nopriv_newsletter_set_cookie', 'newsletter_set_cookie');
function newsletter_set_cookie(){
	$expiry = strtotime('+1 day');
	setcookie('newsletterPopup', 'true', $expiry);

	echo 'cookie set';

	wp_die();
}

// Insert name to fields

// add_action( 'woocommerce_checkout_order_processed', 'cloneName',  1, 1  );
// function cloneName($order_id){
// 	$order = new WC_Order($order_id);
// 	$userID = $order->get_user_id();

// 	$getname = get_user_meta($userID, 'billing_username', true);
// 	$username = explode(' ', $getname);

// 	update_user_meta($userID, 'billing_first_name', $username[0]);
// 	update_user_meta($userID, 'billing_last_name', $username[1]);
// }

add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 10, 2);
function before_checkout_create_order($order) {
	$getname = $order->get_meta('_billing_username');
	$username = explode(' ', $getname);

	$order->update_meta_data('_billing_first_name', $username[0]);
	$order->update_meta_data('_shipping_first_name', $username[0]);

	$order->update_meta_data('_billing_last_name', $username[1]);
	$order->update_meta_data('_shipping_last_name', $username[1]);
	
	$order->save();
}

// Remove archive pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
// Display all products
add_filter( 'loop_shop_per_page', function ( $cols ) {
    return - 1;
} );


/**
 *	Custom checkout validate - error
 */
function add_fake_error($posted) {
    if ($_POST['confirm-order-flag'] == "1") {
        wc_add_notice( __( "custom_notice", 'fake_error' ), 'error');
    } 
}
add_action('woocommerce_after_checkout_validation', 'add_fake_error');


// Enable customer WC_Session
add_action( 'init', 'wc_session_enabler' );
function wc_session_enabler() {
    if ( is_user_logged_in() || is_admin() )
        return;

    if ( isset(WC()->session) && ! WC()->session->has_session() ) {
        WC()->session->set_customer_session_cookie( true );
    }
}