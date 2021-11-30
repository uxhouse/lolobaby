<div class="loloBreadcrumbs container">
    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/breadcrumb_home_ico.svg'; ?>"/></a>
    <a href="<?php echo home_url('/produkty') ?>"><?php _e('Produkty', 'lolobaby'); ?></a>
    <?php if(is_product_category()): ?>
        <?php if($category_terms['categoryName']): ?>
            <span>/</span><a><?php echo $category_terms['categoryName']; ?></a>
        <?php else: ?>
            <?php echo '<span>/</span><a>' . single_cat_title( '', false ) . '</a>';?>
        <?php endif; ?>
    <?php endif; ?>
</div>