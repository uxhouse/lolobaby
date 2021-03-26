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

/**
 * Enqueue scripts and styles.
 */
function lolobaby_scripts() {
	wp_enqueue_style( 'lolobaby-style', get_stylesheet_uri(), array(), _S_VERSION );
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

	/* Slick */
	wp_enqueue_script( 'lolobaby-zoom', get_template_directory_uri() . '/plugins/zoom/jquery.zoom.min.js', array(), _S_VERSION, true );

	/* Custom CSS */
	wp_enqueue_style( 'lolobaby-custom', get_template_directory_uri() . '/css/custom.css', array(), _S_VERSION );

	/* Custom js */
	wp_enqueue_script( 'lolobaby-custom-js', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'lolobaby-sliders-js', get_template_directory_uri() . '/js/sliders.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'lolobaby-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

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

add_action('init','create_account');
function create_account(){
    //You may need some data validation here
	$formID = ( isset($_POST['register-formid']) ? $_POST['register-formid'] : '' );
    $user = ( isset($_POST['registerUsername']) ? $_POST['registerUsername'] : '' );
    $pass = ( isset($_POST['registerUserpassword']) ? $_POST['registerUserpassword'] : '' );
    $email = ( isset($_POST['registerUseremail']) ? $_POST['registerUseremail'] : '' );

	if (!email_exists($email)){
		$user_id = wp_create_user($user, $pass, $email);
		if(!is_wp_error($user_id)){
			//user has been created
			$user = new WP_User($user_id);
			$user->set_role('customer');

			if($formID == 21){
				wp_redirect(home_url('/zamowienie'));
			}else{
				wp_redirect(home_url('/moje-konto'));
			}
			exit;
		}else{
			
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