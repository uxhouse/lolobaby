<?php
/*
*   Template name: Dostawa i płatność
*/
get_header(); ?>

<main class="lolosite lolosite--dostawaiplatnosc pageDostawaiplatnosc">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>   
    <section class="pageDostawaiplatnosc__content container">
        <div class="wrap">
            <h1 class="sectionHeading"><span><?php the_title(); ?></span></h1>
            <div class="content">
                <?php the_field('dostawaiplatnosc_content'); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>