<?php
    $terms = get_the_terms($post->ID, 'product_cat');
    foreach ($terms  as $term) {                    
        $product_cat_id = $term->term_id;              
        $product_cat_name = $term->name;                
        $product_cat_link = $term->slug;                
        break;
    }
?>
<div class="loloBreadcrumbs loloBreadcrumbs--product container">
    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/breadcrumb_home_ico.svg'; ?>"/></a>
    <a href="<?php echo home_url('/produkty') ?>">Produkty</a>
    <span>/</span>
    <a href="<?php echo home_url('/kategoria-produktu/' . $product_cat_link); ?>"><?php echo $product_cat_name; ?></a>
    <span>/</span>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>