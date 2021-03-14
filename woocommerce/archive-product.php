<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>
<div class="archiveShop">
    <div class="archiveShop__breadcrumb container">
        <?php
            /**
             * Hook: woocommerce_before_main_content.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             * @hooked WC_Structured_Data::generate_website_data() - 30
             */
            do_action( 'woocommerce_before_main_content' );
        ?>
    </div>
    <header class="archiveShop__header container">
        <h1 class="sectionHeading"><span><?php woocommerce_page_title(); ?></span></h1>
        <div class="catDesc">
            <?php if(is_shop()): ?>
                <p><?php the_field('archiveShop_description', 7); ?></p>
            <?php else: ?>
                <?php do_action( 'woocommerce_archive_description' ); ?>
            <?php endif; ?>
        </div>
        <div class="categoryWrapper">
            <?php
                // since wordpress 4.5.0
                $args = array(
                    'taxonomy'   => "product_cat",
                    'orderby'      => 'name',
                );
                $product_categories = get_terms($args);
            foreach( $product_categories as $cat ) : 
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
                $image = wp_get_attachment_url( $thumbnail_id );
                $term_fields = get_fields( 'term_' . $cat->term_id );
            ?>
                <?php if($cat->count >= 1): ?>
                    <div class="categoryWrapper__cat" term="term-<?php echo $cat->slug; ?>">
                        <div class="thumb">
                            <img class="thumb__image" src="<?php echo $image; ?>"/>
                            <img class="thumb__icon" src="<?php echo $term_fields['categoryIcon']; ?>"/>
                        </div>
                        <p class="name"><?php echo $cat->name; ?></p>
                        <a href="<?php echo get_category_link($cat->term_id); ?>">Wybierz</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="headerWave">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>"/>
        </div>
    </header>
    <section class="archiveShop__content">
        <div class="archiveTop container">
            <div class="filterEngine">
                <div class="filterEngine__title">
                    <p>Filtruj wg:</p>
                </div>
                <div class="filterEngine__engine">
                    <?php echo do_shortcode('[woof]'); ?>
                </div>
                <div class="filterEngine__checkboxes">
                    <div class="checkbox">
                        <label for="onlyAvailable">Tylko dostępne</label>
                        <input type="checkbox" name="onlyAvailable" class="engineCheckbox" id="onlyAvailable" />
                    </div>
                    <div class="checkbox">
                        <label for="priceDrop">Przecena</label>
                        <input type="checkbox" name="priceDrop" class="engineCheckbox" id="priceDrop" />
                    </div>
                </div>
            </div>
            <div class="filterOpen">
                <div class="filterOpen__btn">
                    <p>Filtruj</p>
                </div>
            </div>
            <div class="sortEngine">
                <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>
        </div>
        <?php
        if ( woocommerce_product_loop() ) {

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
        }
        ?>
    </section>
</div>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
