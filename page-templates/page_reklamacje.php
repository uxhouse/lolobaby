<?php
/*
*   Template name: Reklamacje
*/
get_header(); ?>

<main class="lolosite lolosite--reklamacje pageReklamacje">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>   
    <section class="pageReklamacje__content">
        <div class="wrap">
            <h1 class="sectionHeading"><span><?php the_title(); ?></span></h1>
            <div class="content">
                <?php the_field('page_content'); ?>
            </div>
            <a href="<?php the_field('formularz_reklamacyjny'); ?>" target="_blank" class="btn btn--blue"><span>Pobierz formularz</span></a>
        </div>
    </section>
</main>

<?php get_footer(); ?>