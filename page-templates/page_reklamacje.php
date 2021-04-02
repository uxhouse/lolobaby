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
            <p>Jeśli zakupiony artykuł posiada wadę lub jest uszkodzony, prosimy o zgłoszenie reklamacji.</p>
            <p>Aby rozpatrzyć reklamację, wypełnij  formularz, podając jak najwięcej szczegółów dotyczących wady, tak abyśmy mogli szybciej odpowiedzieć na Twoje zgłoszenie.</p>
            <a href="<?php the_field('formularz_reklamacyjny'); ?>" target="_blank" class="btn btn--blue"><span>Pobierz formularz</span></a>
        </div>
    </section>
</main>

<?php get_footer(); ?>