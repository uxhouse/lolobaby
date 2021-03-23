<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section class="productPage">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'productContent', $product ); ?>>
        <div class="productContent__top container">
            <div class="productContent__header" style="display: none;">
                <h1 class="product_title"><?php the_title(); ?></h1>
                <p class="product_collection">Bambusowe</p>
            </div>
            <div class="productContent__gallery">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>

            <div class="productContent__summary">
                <h1 class="product_title"><?php the_title(); ?></h1>
                <p class="product_collection">Bambusowe</p>
                <?php if ($product->is_type('variable')): ?>
                    <p class="price price--variation"><?php echo wc_price($product->get_price()); ?></p>
                <?php else: ?>
                    <p class="price"><?php echo wc_price($product->get_price()); ?></p>
                <?php endif; ?>
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
                <div class="summary__info">
                    <div class="summary__delivery">
                        <div class="info">
                            <img src="<?php echo get_template_directory_uri() . '/images/icons/delivery_product_ico.svg' ?>"/>
                            <p>Wysyłka w 48h</p>
                        </div>
                        <a href="/dostawa-i-platnosc" target="_blank">Dostawa i płatność</a>
                    </div>
                    <?php if(get_field('product_boxes')): ?>
                    <div class="summary__boxes">
                        <?php while(have_rows('product_boxes')): the_row();
                            $icon = get_sub_field('product_boxes_icon');
                            $title = get_sub_field('product_boxes_title');
                        ?>
                        <div class="box">
                            <div class="box__thumb">
                                <img src="<?php echo $icon; ?>"/>
                            </div>
                            <p><?php echo $title; ?></p>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="productContent__content">
            <div class="divider container">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
            <h2 class="content_title">Szczegółowy opis</h2>
            <p class="main_text"><?php the_field('product_desc'); ?></p>

            <?php if(get_field('product_desc_cechy')): ?>
            <div class="content_tab">
                <h4>Cechy:</h4>
                <p><?php the_field('product_desc_cechy'); ?></p>
            </div>
            <?php endif; ?>

            <?php if(get_field('product_desc_sklad')): ?>
            <div class="content_tab">
                <h4>Skład:</h4>
                <p><?php the_field('product_desc_sklad'); ?></p>
            </div>
            <?php endif; ?>

            <?php if(get_field('product_desc_gramatura')): ?>
            <div class="content_tab">
                <h4>Gramatura:</h4>
                <p><?php the_field('product_desc_gramatura'); ?></p>
            </div>
            <?php endif; ?>

            <?php if(get_field('product_desc_pielegnacja')): ?>
            <div class="content_tab">
                <h4>Pielęgnacja:</h4>
                <p><?php the_field('product_desc_pielegnacja'); ?></p>
            </div>
            <?php endif; ?>
            <div class="divider container">
                <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
            </div>
        </div>
    </div>
    <?php
    $related_posts = get_field('product_related');
    if( $related_posts ): ?>
    <div class="productPage__related">
        <h2>Pasujące produkty</h2>
        <div class="relatedList">
            <?php foreach( $related_posts as $post ): 
                setup_postdata($post); ?>
            <?php include get_template_directory() . '/template-parts/_include_productTile-related.php'; ?>
            <?php endforeach; ?>
        </div>
        <div class="relatedList__nav">
                <div class="relatedList__arrow relatedList__arrow--left">
                    <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_left_white.svg'; ?>"/>
                </div>
                <div class="relatedList__dots">
                    <?php foreach( $related_posts as $post ): 
                    setup_postdata($post); ?>
                        <span productID="<?php echo get_the_ID($post); ?>"></span>
                    <?php endforeach; ?>
                </div>
                <div class="relatedList__arrow relatedList__arrow--right">
                    <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_right_white.svg'; ?>"/>
                </div>
            </div>
    </div>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</section>


<?php do_action( 'woocommerce_after_single_product' ); ?>
