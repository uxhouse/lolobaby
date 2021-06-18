<article class="productTile" productID="<?php the_ID(); ?>">
    <div class="productTile__wrap">
        <div class="productTile__thumb">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
        </div>
        <?php if(get_field('product_bestseller')): ?>
        <div class="productTile__bestseller">
            <p>Bestseller</p>
        </div>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" class="productTile__cover">
            <h3><?php the_title(); ?></h3>
            <?php if ( $price_html = $post->get_price_html() ) : ?>
                <p class="price"><?php echo $price_html; ?></p>
            <?php endif; ?>
            <p href="<?php the_permalink(); ?>" class="btn"><span>Sprawdź</span></p>
        </a>
        <a href="<?php the_permalink(); ?>" class="productTile__content">
            <h3><?php the_title(); ?></h3>
            <?php if ( $price_html = $post->get_price_html() ) : ?>
                <p class="price"><?php echo $price_html; ?></p>
            <?php endif; ?>
            <p href="<?php the_permalink(); ?>" class="btn"><span>Zobacz</span></p>
        </a>
    </div>
</article>