<?php
/*
*   Template name: Regulamin
*/
get_header(); ?>

<main class="lolosite lolosite--regulamin">
    <?php include get_template_directory() . '/template-parts/_include_pageBreadcrumbs.php'; ?>
    <section class="section section--regulamin">
        <div class="container">
            <h2 class="sectionHeading">
                <span>Regulamin</span>
            </h2>
            <div class="regulamin__content">
                <?php the_field('regulamin_content'); ?>
            </div>
            <ul id="forms" class="forms">
                <li>
                    <a href="<?php the_field('formularz_konsument'); ?>" target="_blank">Formularz odstąpienia od umowy przez konsumenta</a>
                </li>
                <li>
                    <a href="<?php the_field('formularz_firma'); ?>" target="_blank">Formularz odstąpienia od umowy przez przedsiębiorce na prawach konsumenta</a>
                </li>
                <li>
                    <a href="<?php the_field('formularz_reklamacja'); ?>" target="_blank">Formularz reklamacji produktu</a>
                </li>
            </ul>
        </div>
        <img class="drawing planeDrawing planeDrawing--right" src="<?php echo get_template_directory_uri() . '/images/plane-red1.svg' ?>" alt="" />
    </section>
</main>

<?php get_footer(); ?>