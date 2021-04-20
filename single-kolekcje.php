<?php
/**
 * The template for displaying all kolekcja
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lolobaby
 */

get_header();
?>

<main class="lolobaby lolobaby--subpage lolobaby--kolekcja">
    <?php include get_template_directory() . '/template-parts/_include_kolekcjaBreadcrumbs.php'; ?>
    <section class="collectionHeading container">
        <div class="collectionHeading__wrap">
            <h1 class="sectionHeading"><span><?php the_title(); ?></span></h1>
            <p><?php the_field('collection_desc'); ?></p>
        </div>
    </section>
    <section class="collectionGallery">
        <div class="collectionGallery__images">
        <?php 
            $images = get_field('collection_images');
            if( $images ): ?>
                <?php foreach( $images as $image ): ?>
                    <div class="collectionGallery__image">
                        <img src="<?php echo $image['url']; ?>" />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <section class="collectionLink">
        <a href="<?php the_field('collection_link'); ?>" class="btn btn--noarrow btn--big"><span>Zobacz produkty z kolekcji <?php echo the_title(); ?></span></a>
    </section>
</main>

<?php get_footer(); ?>