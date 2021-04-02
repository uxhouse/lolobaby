<?php
/*
*   Template name: O nas
*/
get_header(); ?>

<main class="lolosite lolosite--aboutPage">
    <?php include get_template_directory() . '/template-parts/_include_aboutBreadcrumbs.php'; ?>
    <section class="section section--about">
        <div class="container container--min">
            <h2 class="sectionHeading">
                <span><?php the_field('aboutHeading_title'); ?></span>
            </h2>
            <div class="aboutDescription">
                <p><?php the_field('aboutHeading_content'); ?></p>
            </div>
        </div>
        <img class="drawing planeDrawing planeDrawing--right" src="<?php echo get_template_directory_uri() . '/images/plane-red1.svg' ?>" alt="" />
    </section>
    <div class="container container--min">
        <section class="section section--highQuality">
            <img class="highQuality__image" src="<?php the_field('aboutImagesec_image'); ?>" alt="lolobaby" />
            <div class="highQuality__description">
                <h2 class="secondaryHeading"><?php the_field('aboutImagesec_title'); ?></h2>
                <p><?php the_field('aboutImagesec_content'); ?></p>
            </div>
            <img class="drawing planeDrawing planeDrawing--left" src="<?php echo get_template_directory_uri() . '/images/plane-red2.svg' ?>" alt="" />
        </section>
    </div>
    <section class="section section--environmentCare">
        <div class="environmentCare__image"></div>
        <div class="container container--min">
            <div class="environmentCare__description">
                <h2 class="secondaryHeading"><?php the_field('aboutFullwidth_title'); ?></h2>
                <p><?php the_field('aboutFullwidth_content'); ?></p>
            </div>
        </div>
    </section>
    <div class="divider">
        <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
    </div>
    
    <!-- Strefa wiedzy -->
    <?php include get_template_directory() . '/template-parts/_include_strefaWiedzy.php'; ?>
    
    <div class="container container--min blogLink">
        <a href="/blog" class="btn"><span>Zobacz wszystkie artykuły</span></a>
    </div>
</main>

<?php get_footer(); ?>