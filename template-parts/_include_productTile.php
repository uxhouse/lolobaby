<article class="productTile">
    <div class="productTile__wrap">
        <div class="productTile__thumb">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
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
        <div class="productTile__cover">
            <h3><?php the_title(); ?></h3>
            <p class="price"><?php $price = get_post_meta( get_the_ID(), '_regular_price', true); echo woocommerce_price($price); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn"><span>Sprawdź</span></a>
        </div>
        <?php endif; ?>
    </div>
</article>