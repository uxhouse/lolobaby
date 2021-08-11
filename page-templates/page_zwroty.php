<?php
/*
*   Template name: Zwroty
*/
get_header(); ?>

<main class="lolosite lolosite--zwroty pageZwroty">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>   
    <section class="pageZwroty__content">
        <div class="wrap">
            <h1 class="sectionHeading"><span><?php the_title(); ?></span></h1>
            <div class="content">
                <?php the_field('page_content'); ?>
            </div>
            <h3><?php _e('Pobierz i wypełnij odpowiedni dla siebie formularz', 'lolobaby'); ?></h3>
            <div class="forms">
                <a href="<?php the_field('zwrot_firma'); ?>" target="_blank" class="btn btn--blue"><span><?php _e('dla firmy', 'lolobaby'); ?></span></a>
                <a href="<?php the_field('zwrot_prywatna'); ?>" target="_blank" class="btn btn--blue"><span><?php _e('dla osoby prywatnej', 'lolobaby'); ?></span></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>