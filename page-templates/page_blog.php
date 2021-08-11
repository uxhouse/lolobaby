<?php
/*
*   Template name: Blog
*/
get_header(); ?>


<?php
    $args = array(
        'posts_per_page' => -1,
        'post_type'        => 'post',
    );
    $the_query = new WP_Query($args); ?>
    <?php if ($the_query->have_posts()) : ?>
    <?php include get_template_directory() . '/template-parts/_include_blogBreadcrumbs.php'; ?>
    <section class="section section--blog">
        <div class="container container--min">
            <h2 class="sectionHeading">
                <span><?php _e('Blog', 'lolobaby'); ?></span>
            </h2>
            <div class="blog__description">
                <p><?php the_field('blogpage_desc'); ?></p>
                <div class="blog__descriptionLayer">
                    <div class="blog__dropdownButton"><?php _e('Rozwiń', 'lolobaby'); ?></div>
                </div>
            </div>
        </div>
        <div class="blog__dividerWrapper">
            <img class="blog__divider" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
        </div>
        <div class="container container--min">
            <div class="blog__wrapper">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php include get_template_directory() . '/template-parts/_include_postTile.php'; ?>
                <?php endwhile; ?>
            </div>
        </div>
        <img class="drawing pen" src="<?php echo get_template_directory_uri() . '/images/pen.svg' ?>" alt="" />
    </section>
    <?php endif; ?>


<?php get_footer(); ?>