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

get_header( 'shop' );
$lang = get_bloginfo('language');

// get category ID
$current_category_object = get_queried_object();
$category_terms = get_fields('term_' . $current_category_object->term_id);
?>
<div class="archiveShop">
    <!-- <div class="archiveShop__breadcrumb container">
        <?php
            /**
             * Hook: woocommerce_before_main_content.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             * @hooked WC_Structured_Data::generate_website_data() - 30
             */
            // do_action( 'woocommerce_before_main_content' );
        ?>
    </div> -->
    <?php include get_template_directory() . '/template-parts/_include_archiveBreadcrumbs.php'; ?>
    <header class="archiveShop__header container">
        <?php if(is_shop()): ?>
            <h1 class="sectionHeading"><span><?php _e('Produkty', 'lolobaby'); ?></span></h1>
        <?php else: ?>
            <?php if($category_terms['categoryName']): ?>
                <h1 class="sectionHeading"><span><?php echo $category_terms['categoryName']; ?></span></h1>
            <?php else: ?>
                <h1 class="sectionHeading"><span><?php woocommerce_page_title(); ?></span></h1>
            <?php endif; ?>
        <?php endif; ?>
        <div class="catDesc">
            <?php if(is_shop()): ?>
                <?php if($lang == 'pl-PL'): ?>
                    <p>Bezpieczeństwo i komfort Maluchów to nasz priorytet, dlatego też wszystkie ubranka naszej marki szyjemy w Polsce z najwyższej jakości materiałów posiadających certyfikat Oeko-Tex Standard 100 i spełniających normy Unii Europejskiej. Nasze produkty są zaprojektowane z dbałością o każdy szczegół. Są wygodne i praktyczne, uszyte z delikatnych, miłych w dotyku materiałów, dzięki czemu mogą towarzyszyć Waszemu maleństwu od pierwszych dni jego życia.</p>
                <?php else: ?>
                    <p>The safety and comfort of children is our priority, which is why all our brand clothes are sewn in Poland from the highest quality materials with the Oeko-Tex Standard 100 certificate and meeting the standards of the European Union. Our products are designed with attention to every detail. They are comfortable and practical, made of delicate, pleasant to the touch materials, thanks to which they can accompany your baby from the first days of his life.</p>
                <?php endif; ?>
            <?php else: ?>
                <?php do_action( 'woocommerce_archive_description' ); ?>
            <?php endif; ?>
        </div>
        <div class="categoryWrapper">
            <?php
                // since wordpress 4.5.0
                $args = array(
                    'taxonomy'   => 'product_cat',
                    'orderby'    => 'name',
                    'meta_query' => array(
                        array(
                            'key'       => 'categoryVisibility',
                            'value'     => '1',
                        )
                    )
                );
                $product_categories = get_terms($args);
            foreach( $product_categories as $cat ) : 
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
                $image = wp_get_attachment_url( $thumbnail_id );
                $term_fields = get_fields( 'term_' . $cat->term_id );
            ?>
                <?php if($cat->count >= 1): ?>
                    <a href="<?php echo get_category_link($cat->term_id); ?>" class="categoryWrapper__cat" term="term-<?php echo $cat->slug; ?>">
                        <div class="thumb">
                            <img class="thumb__image" src="<?php echo $image; ?>"/>
                            <img class="thumb__icon" src="<?php echo $term_fields['categoryIcon']; ?>"/>
                        </div>
                        <div class="content">
                            <?php if($term_fields['categoryName']): ?>
                                <p class="name"><?php echo $term_fields['categoryName']; ?></p>
                            <?php else: ?>
                                <p class="name"><?php echo $cat->name; ?></p>
                            <?php endif; ?>
                            <span><?php _e('Wybierz', 'lolobaby'); ?></span>
                        </div>
                    </a>
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
                    <p><?php _e('Filtruj wg', 'lolobaby'); ?>:</p>
                </div>
                <div class="filterEngine__engine">
                    <?php echo do_shortcode('[woof]'); ?>
                </div>
                <div class="filterEngine__checkboxes">
                    <div class="checkbox">
                        <label for="newestProducts"><?php _e('Nowości', 'lolobaby'); ?></label>
                        <input type="checkbox" name="newestProducts" class="engineCheckbox" />
                    </div>
                    <div class="checkbox">
                        <label for="priceDrop"><?php _e('Przecena', 'lolobaby'); ?></label>
                        <input type="checkbox" name="priceDrop" class="engineCheckbox" />
                    </div>
                </div>
            </div>
            <div class="filterOpen">
                <div class="filterOpen__btn">
                    <p><?php _e('Filtruj', 'lolobaby'); ?></p>
                </div>
            </div>
            <div class="sortEngine" itemscount="<?php $totalproducts = wc_get_loop_prop( 'total' ); echo $totalproducts; ?>">
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
                <div class="sortEngine__wrap">
                    <div class="sortEngine__block">
                        <p><?php _e('Sortuj wg', 'lolobaby'); ?></p>
                    </div>
                    <div class="sortEngine__dropdown">
                        <p class="sortEngine__select" sortname="popularity"><?php _e('Popularność', 'lolobaby'); ?></p>
                        <p class="sortEngine__select" sortname="date"><?php _e('Od najnowszych', 'lolobaby'); ?></p>
                        <p class="sortEngine__select" sortname="price"><?php _e('Cena: od najniższej', 'lolobaby'); ?></p>
                        <p class="sortEngine__select" sortname="price-desc"><?php _e('Cena: od najwyższej', 'lolobaby'); ?></p>
                    </div>
                </div>
            </div>
            <div id="filterMobile" class="filterMobile">
                <div class="filterMobile__heading">
                    <h2><?php _e('Filtruj wg', 'lolobaby'); ?>:</h2>
                </div>
                <div class="filterMobile__options">
                    <?php echo do_shortcode('[woof]'); ?>
                </div>
                <div class="filterMobile__checkboxes">
                    <div class="checkbox">
                        <label for="newestProducts"><?php _e('Nowości', 'lolobaby'); ?></label>
                        <input type="checkbox" name="newestProducts" class="engineCheckbox" />
                    </div>
                    <div class="checkbox">
                        <label for="priceDrop"><?php _e('Przecena', 'lolobaby'); ?></label>
                        <input type="checkbox" name="priceDrop" class="engineCheckbox" />
                    </div>
                </div>
                <div class="filterMobile__summary">
                    <p class="delete"><?php _e('Wyczyść wszystkie filtry', 'lolobaby'); ?></p>
                    <p class="btn woof_submit_search_form"><span><?php _e('Zapisz', 'lolobaby'); ?></span></p>
                </div>
            </div>
        </div>
        <?php
        if ( woocommerce_product_loop() ): ?>

            <?php
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
            ?>
        <?php if($category_terms['categorySEODesc']): ?>
            <section class="categoryContent">
                <div class="categoryContent__wrap">
                    <p><?php echo $category_terms['categorySEODesc']; ?></p>
                </div>
            </section>
        <?php endif; ?>
        <?php else: ?>
        <section class="archiveNotfound">
            <svg xmlns="http://www.w3.org/2000/svg" class="wave wave--top" width="5469" height="34" viewBox="0 0 5469 34" fill="none">
                <path d="M0 12C22.78 12 22.78 22 45.57 22C68.35 22 68.35 12 91.14 12C113.92 12 113.92 22 136.71 22C159.49 22 159.49 12 182.27 12C205.05 12 205.05 22 227.83 22C250.61 22 250.61 12 273.39 12C296.17 12 296.17 22 318.96 22C341.74 22 341.74 12 364.52 12C387.3 12 387.3 22 410.09 22C432.87 22 432.87 12 455.66 12C478.44 12 478.44 22 501.23 22C524.01 22 524.01 12 546.79 12C569.57 12 569.57 22 592.35 22C615.13 22 615.13 12 637.91 12C660.69 12 660.69 22 683.48 22C706.26 22 706.26 12 729.04 12C751.82 12 751.82 22 774.61 22C797.39 22 797.39 12 820.17 12C842.95 12 842.95 22 865.74 22C888.52 22 888.52 12 911.31 12C934.09 12 934.09 22 956.88 22C979.66 22 979.66 12 1002.45 12C1025.23 12 1025.23 22 1048.02 22C1070.81 22 1070.81 12 1093.59 12C1116.37 12 1116.37 22 1139.16 22C1161.94 22 1161.94 12 1184.73 12C1207.52 12 1207.52 22 1230.3 22C1253.08 22 1253.08 12 1275.87 12C1298.66 12 1298.66 22 1321.45 22C1344.24 22 1344.24 12 1367.02 12M1367 12C1389.78 12 1389.78 22 1412.57 22C1435.35 22 1435.35 12 1458.14 12C1480.92 12 1480.92 22 1503.71 22C1526.49 22 1526.49 12 1549.27 12C1572.05 12 1572.05 22 1594.83 22C1617.61 22 1617.61 12 1640.39 12C1663.17 12 1663.17 22 1685.96 22C1708.74 22 1708.74 12 1731.52 12C1754.3 12 1754.3 22 1777.09 22C1799.87 22 1799.87 12 1822.66 12C1845.44 12 1845.44 22 1868.23 22C1891.01 22 1891.01 12 1913.79 12C1936.57 12 1936.57 22 1959.35 22C1982.13 22 1982.13 12 2004.91 12C2027.69 12 2027.69 22 2050.48 22C2073.26 22 2073.26 12 2096.04 12C2118.82 12 2118.82 22 2141.61 22C2164.39 22 2164.39 12 2187.17 12C2209.95 12 2209.95 22 2232.74 22C2255.52 22 2255.52 12 2278.31 12C2301.09 12 2301.09 22 2323.88 22C2346.66 22 2346.66 12 2369.45 12C2392.23 12 2392.23 22 2415.02 22C2437.81 22 2437.81 12 2460.59 12C2483.37 12 2483.37 22 2506.16 22C2528.94 22 2528.94 12 2551.73 12C2574.52 12 2574.52 22 2597.3 22C2620.08 22 2620.08 12 2642.87 12C2665.66 12 2665.66 22 2688.45 22C2711.24 22 2711.24 12 2734.02 12M2734 12C2756.78 12 2756.78 22 2779.57 22C2802.35 22 2802.35 12 2825.14 12C2847.92 12 2847.92 22 2870.71 22C2893.49 22 2893.49 12 2916.27 12C2939.05 12 2939.05 22 2961.83 22C2984.61 22 2984.61 12 3007.39 12C3030.17 12 3030.17 22 3052.96 22C3075.74 22 3075.74 12 3098.52 12C3121.3 12 3121.3 22 3144.09 22C3166.87 22 3166.87 12 3189.66 12C3212.44 12 3212.44 22 3235.23 22C3258.01 22 3258.01 12 3280.79 12C3303.57 12 3303.57 22 3326.35 22C3349.13 22 3349.13 12 3371.91 12C3394.69 12 3394.69 22 3417.48 22C3440.26 22 3440.26 12 3463.04 12C3485.82 12 3485.82 22 3508.61 22C3531.39 22 3531.39 12 3554.17 12C3576.95 12 3576.95 22 3599.74 22C3622.52 22 3622.52 12 3645.31 12C3668.09 12 3668.09 22 3690.88 22C3713.66 22 3713.66 12 3736.45 12C3759.23 12 3759.23 22 3782.02 22C3804.81 22 3804.81 12 3827.59 12C3850.37 12 3850.37 22 3873.16 22C3895.94 22 3895.94 12 3918.73 12C3941.52 12 3941.52 22 3964.3 22C3987.08 22 3987.08 12 4009.87 12C4032.66 12 4032.66 22 4055.45 22C4078.24 22 4078.24 12 4101.02 12M4101 12C4123.78 12 4123.78 22 4146.57 22C4169.35 22 4169.35 12 4192.14 12C4214.92 12 4214.92 22 4237.71 22C4260.49 22 4260.49 12 4283.27 12C4306.05 12 4306.05 22 4328.83 22C4351.61 22 4351.61 12 4374.39 12C4397.17 12 4397.17 22 4419.96 22C4442.74 22 4442.74 12 4465.52 12C4488.3 12 4488.3 22 4511.09 22C4533.87 22 4533.87 12 4556.66 12C4579.44 12 4579.44 22 4602.23 22C4625.01 22 4625.01 12 4647.79 12C4670.57 12 4670.57 22 4693.35 22C4716.13 22 4716.13 12 4738.91 12C4761.69 12 4761.69 22 4784.48 22C4807.26 22 4807.26 12 4830.04 12C4852.82 12 4852.82 22 4875.61 22C4898.39 22 4898.39 12 4921.17 12C4943.95 12 4943.95 22 4966.74 22C4989.52 22 4989.52 12 5012.31 12C5035.09 12 5035.09 22 5057.88 22C5080.66 22 5080.66 12 5103.45 12C5126.23 12 5126.23 22 5149.02 22C5171.81 22 5171.81 12 5194.59 12C5217.37 12 5217.37 22 5240.16 22C5262.94 22 5262.94 12 5285.73 12C5308.52 12 5308.52 22 5331.3 22C5354.08 22 5354.08 12 5376.87 12C5399.66 12 5399.66 22 5422.45 22C5445.24 22 5445.24 12 5468.02 12" stroke="#FFCAD4" stroke-width="23" stroke-miterlimit="10"/>
            </svg>
            <div class="archiveNotfound__wrap">
                <h3 class="sectionHeading"><span><?php _e('Niestety nie znaleziono produktów', 'lolobaby'); ?></span></h3>
                <a href="<?php echo home_url('/produkty'); ?>" class="btn btn--blue"><span><?php _e('Powrót do sklepu', 'lolobaby'); ?></span></a>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="wave wave--bottom" width="5469" height="34" viewBox="0 0 5469 34" fill="none">
                <path d="M0 12C22.78 12 22.78 22 45.57 22C68.35 22 68.35 12 91.14 12C113.92 12 113.92 22 136.71 22C159.49 22 159.49 12 182.27 12C205.05 12 205.05 22 227.83 22C250.61 22 250.61 12 273.39 12C296.17 12 296.17 22 318.96 22C341.74 22 341.74 12 364.52 12C387.3 12 387.3 22 410.09 22C432.87 22 432.87 12 455.66 12C478.44 12 478.44 22 501.23 22C524.01 22 524.01 12 546.79 12C569.57 12 569.57 22 592.35 22C615.13 22 615.13 12 637.91 12C660.69 12 660.69 22 683.48 22C706.26 22 706.26 12 729.04 12C751.82 12 751.82 22 774.61 22C797.39 22 797.39 12 820.17 12C842.95 12 842.95 22 865.74 22C888.52 22 888.52 12 911.31 12C934.09 12 934.09 22 956.88 22C979.66 22 979.66 12 1002.45 12C1025.23 12 1025.23 22 1048.02 22C1070.81 22 1070.81 12 1093.59 12C1116.37 12 1116.37 22 1139.16 22C1161.94 22 1161.94 12 1184.73 12C1207.52 12 1207.52 22 1230.3 22C1253.08 22 1253.08 12 1275.87 12C1298.66 12 1298.66 22 1321.45 22C1344.24 22 1344.24 12 1367.02 12M1367 12C1389.78 12 1389.78 22 1412.57 22C1435.35 22 1435.35 12 1458.14 12C1480.92 12 1480.92 22 1503.71 22C1526.49 22 1526.49 12 1549.27 12C1572.05 12 1572.05 22 1594.83 22C1617.61 22 1617.61 12 1640.39 12C1663.17 12 1663.17 22 1685.96 22C1708.74 22 1708.74 12 1731.52 12C1754.3 12 1754.3 22 1777.09 22C1799.87 22 1799.87 12 1822.66 12C1845.44 12 1845.44 22 1868.23 22C1891.01 22 1891.01 12 1913.79 12C1936.57 12 1936.57 22 1959.35 22C1982.13 22 1982.13 12 2004.91 12C2027.69 12 2027.69 22 2050.48 22C2073.26 22 2073.26 12 2096.04 12C2118.82 12 2118.82 22 2141.61 22C2164.39 22 2164.39 12 2187.17 12C2209.95 12 2209.95 22 2232.74 22C2255.52 22 2255.52 12 2278.31 12C2301.09 12 2301.09 22 2323.88 22C2346.66 22 2346.66 12 2369.45 12C2392.23 12 2392.23 22 2415.02 22C2437.81 22 2437.81 12 2460.59 12C2483.37 12 2483.37 22 2506.16 22C2528.94 22 2528.94 12 2551.73 12C2574.52 12 2574.52 22 2597.3 22C2620.08 22 2620.08 12 2642.87 12C2665.66 12 2665.66 22 2688.45 22C2711.24 22 2711.24 12 2734.02 12M2734 12C2756.78 12 2756.78 22 2779.57 22C2802.35 22 2802.35 12 2825.14 12C2847.92 12 2847.92 22 2870.71 22C2893.49 22 2893.49 12 2916.27 12C2939.05 12 2939.05 22 2961.83 22C2984.61 22 2984.61 12 3007.39 12C3030.17 12 3030.17 22 3052.96 22C3075.74 22 3075.74 12 3098.52 12C3121.3 12 3121.3 22 3144.09 22C3166.87 22 3166.87 12 3189.66 12C3212.44 12 3212.44 22 3235.23 22C3258.01 22 3258.01 12 3280.79 12C3303.57 12 3303.57 22 3326.35 22C3349.13 22 3349.13 12 3371.91 12C3394.69 12 3394.69 22 3417.48 22C3440.26 22 3440.26 12 3463.04 12C3485.82 12 3485.82 22 3508.61 22C3531.39 22 3531.39 12 3554.17 12C3576.95 12 3576.95 22 3599.74 22C3622.52 22 3622.52 12 3645.31 12C3668.09 12 3668.09 22 3690.88 22C3713.66 22 3713.66 12 3736.45 12C3759.23 12 3759.23 22 3782.02 22C3804.81 22 3804.81 12 3827.59 12C3850.37 12 3850.37 22 3873.16 22C3895.94 22 3895.94 12 3918.73 12C3941.52 12 3941.52 22 3964.3 22C3987.08 22 3987.08 12 4009.87 12C4032.66 12 4032.66 22 4055.45 22C4078.24 22 4078.24 12 4101.02 12M4101 12C4123.78 12 4123.78 22 4146.57 22C4169.35 22 4169.35 12 4192.14 12C4214.92 12 4214.92 22 4237.71 22C4260.49 22 4260.49 12 4283.27 12C4306.05 12 4306.05 22 4328.83 22C4351.61 22 4351.61 12 4374.39 12C4397.17 12 4397.17 22 4419.96 22C4442.74 22 4442.74 12 4465.52 12C4488.3 12 4488.3 22 4511.09 22C4533.87 22 4533.87 12 4556.66 12C4579.44 12 4579.44 22 4602.23 22C4625.01 22 4625.01 12 4647.79 12C4670.57 12 4670.57 22 4693.35 22C4716.13 22 4716.13 12 4738.91 12C4761.69 12 4761.69 22 4784.48 22C4807.26 22 4807.26 12 4830.04 12C4852.82 12 4852.82 22 4875.61 22C4898.39 22 4898.39 12 4921.17 12C4943.95 12 4943.95 22 4966.74 22C4989.52 22 4989.52 12 5012.31 12C5035.09 12 5035.09 22 5057.88 22C5080.66 22 5080.66 12 5103.45 12C5126.23 12 5126.23 22 5149.02 22C5171.81 22 5171.81 12 5194.59 12C5217.37 12 5217.37 22 5240.16 22C5262.94 22 5262.94 12 5285.73 12C5308.52 12 5308.52 22 5331.3 22C5354.08 22 5354.08 12 5376.87 12C5399.66 12 5399.66 22 5422.45 22C5445.24 22 5445.24 12 5468.02 12" stroke="#FFCAD4" stroke-width="23" stroke-miterlimit="10"/>
            </svg>
        </section>        
        <?php endif; ?>
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
