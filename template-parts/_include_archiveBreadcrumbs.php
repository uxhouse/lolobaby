<div class="loloBreadcrumbs container">
    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/breadcrumb_home_ico.svg'; ?>"/></a>
    <a href="<?php echo home_url('/produkty') ?>">Produkty</a>
    <?php if(is_product_category()): ?>
    <?php echo '<span>/</span><a>' . single_cat_title( '', false ) . '</a>';?>
    <?php endif; ?>
</div>