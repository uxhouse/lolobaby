<article class="productTile productTile--wishlist" productID="<?php the_ID(); ?>">
    <div class="productTile__wrap">
        <a class="productTile__thumb">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
            <?php if(!is_front_page()):
                $thisProductID = get_the_ID();
                $color_terms = get_the_terms($thisProductID, 'pa_kolor');
                if($color_terms): ?>
                    <div class="productTile__colors">
                        <?php foreach ($color_terms as $key => $object): ?>
                            <span class="color" style="background-color: <?php echo get_term_meta($object->term_id)["product_attribute_color"][0];?>;"></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="productTile__remove">
                <button type="submit" name="tinvwl-remove"
                        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
                        title="<?php _e( 'Remove', 'ti-woocommerce-wishlist' ) ?>">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/wishlist_remove_ico.svg'; ?>"/>
                </button>
            </div>
        </a>
        <?php if(!is_front_page()): ?>
        <div class="productTile__wishlist">
            <?php echo do_shortcode('[ti_wishlists_addtowishlist product_id="' . $thisProductID . '"]'); ?>
        </div>
        <?php endif; ?>
        <?php if(get_field('product_bestseller')): ?>
        <div class="productTile__bestseller">
            <p>Bestseller</p>
        </div>
        <?php endif; ?>
        <?php if(!is_front_page()): ?>
            <a class="productTile__content">
                <h3><?php the_title(); ?></h3>
                <p class="price"><?php
            echo apply_filters( 'tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product ); // WPCS: xss ok.
            ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn--archive"><span>Zobacz</span></a>
            </a>
        <?php endif; ?>
    </div>
</article>