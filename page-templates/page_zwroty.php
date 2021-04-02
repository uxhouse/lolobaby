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
            <p>Zamówiony artykuł okazał się jednak nietrafiony? Oferujemy możliwość bezpłatnego zwrotu do 14 dni.</p>
            <h3>Pobierz i wypełnij odpowiedni dla siebie formularz</h3>
            <div class="forms">
                <a href="<?php the_field('zwrot_firma'); ?>" target="_blank" class="btn btn--blue"><span>dla firmy</span></a>
                <a href="<?php the_field('zwrot_prywatna'); ?>" target="_blank" class="btn btn--blue"><span>dla osoby prywatnej</span></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>