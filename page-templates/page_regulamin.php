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
                <span><?php _e('Regulamin', 'lolobaby'); ?></span>
            </h2>
            <div class="regulamin__content">
                <?php the_field('regulamin_content'); ?>
            </div>
            <ul id="forms" class="forms">
                <li>
                    <a href="<?php the_field('formularz_konsument'); ?>" target="_blank"><?php _e('Formularz odstąpienia od umowy przez konsumenta', 'lolobaby'); ?></a>
                </li>
                <li>
                    <a href="<?php the_field('formularz_firma'); ?>" target="_blank"><?php _e('Formularz odstąpienia od umowy przez przedsiębiorce na prawach konsumenta', 'lolobaby'); ?></a>
                </li>
                <li>
                    <a href="<?php the_field('formularz_reklamacja'); ?>" target="_blank"><?php _e('Formularz reklamacji produktu', 'lolobaby'); ?></a>
                </li>
            </ul>
        </div>
        <img class="drawing planeDrawing planeDrawing--right" src="<?php echo get_template_directory_uri() . '/images/plane-red1.svg' ?>" alt="" />
    </section>
</main>

<?php get_footer(); ?>