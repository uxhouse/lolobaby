<?php
/*
*   Template name: Polityka prywatności
*/
get_header(); ?>

<main class="lolosite lolosite--privacyPolicyPage">
    <?php include get_template_directory() . '/template-parts/_include_privacyPolicyBreadcrumbs.php'; ?>
    <section class="section section--privacyPolicy">
        <div class="container">
            <h2 class="sectionHeading">
                <span><?php _e('Polityka prywatności', 'lolobaby'); ?></span>
            </h2>
            <div class="privacyPolicy__content">
                <?php the_field('privacy_policy_content'); ?>
            </div>
        </div>
        <img class="drawing planeDrawing planeDrawing--right" src="<?php echo get_template_directory_uri() . '/images/plane-red1.svg' ?>" alt="" />
    </section>
</main>

<?php get_footer(); ?>