<article class="productTile<?php if(!is_front_page()): ?> productTile--archive<?php endif; ?>" productID="<?php the_ID(); ?>">
    <div class="productTile__wrap">
        <div class="productTile__thumb">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
            <?php if(!is_front_page()):
                $thisProductID = get_the_ID();
                $brand_terms = get_the_terms($thisProductID, 'pa_kolor');
                if($brand_terms): ?>
                    <div class="productTile__colors">
                        <?php foreach ($brand_terms as $key => $object): ?>
                            <span class="color" style="background-color: <?php echo get_term_meta($object->term_id)["product_attribute_color"][0];?>;"></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if(!is_front_page()): ?>
        <div class="productTile__wishlist">
            <a href="#">
                <img src="<?php echo get_template_directory_uri() . '/images/icons/wishlist_ico_red.svg'; ?>"/>
            </a>
        </div>
        <?php endif; ?>
        <?php if(get_field('product_bestseller')): ?>
        <div class="productTile__bestseller">
            <p>Bestseller</p>
        </div>
        <?php endif; ?>
        <?php if(is_front_page()): ?>
        <a href="<?php the_permalink(); ?>" class="productTile__cover">
            <h3><?php the_title(); ?></h3>
            <p class="price"><?php $price = get_post_meta( get_the_ID(), '_regular_price', true); echo woocommerce_price($price); ?></p>
            <p href="<?php the_permalink(); ?>" class="btn"><span>Sprawdź</span></p>
        </a>
        <?php endif; ?>
        <?php if(!is_front_page()): ?>
            <div class="productTile__content">
                <h3><?php the_title(); ?></h3>
                <p class="price"><?php $price = get_post_meta( get_the_ID(), '_regular_price', true); echo woocommerce_price($price); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn--archive"><span>Zobacz</span></a>
            </div>
        <?php endif; ?>
    </div>
</article>