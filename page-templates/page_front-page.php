<?php
/*
*   Template name: Strona główna
*/
get_header(); ?>

<main class="lolosite lolosite--frontPage">
    <?php if (get_field('homepage_slider')): ?>
    <section class="homeSlider">
        <div class="homeSlider__slider">
            <?php while(have_rows('homepage_slider')): the_row();
                $bg = get_sub_field('homepage_slider_image');
                $text = get_sub_field('homepage_slider_text');
                $btn = get_sub_field('homepage_slider_btn');
            ?>
            <div class="homeSlider__slide" num="num_<?php the_row_index(); ?>" style="background-image: url('<?php echo $bg; ?>');">
                <div class="homeSlider__wrap">
                    <h2><span><?php echo $text; ?></span></h2>
                    <a href="<?php echo $btn['url']; ?>" class="btn"><span><?php echo $btn['title']; ?></span></a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="homeSlider__nav">
            <div class="homeSlider__arrow homeSlider__arrow--left">
                <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_left_white.svg'; ?>"/>
            </div>
            <div class="homeSlider__dots">
                <?php while(have_rows('homepage_slider')): the_row(); ?>
                    <span num="num_<?php the_row_index(); ?>"></span>
                <?php endwhile; ?>
            </div>
            <div class="homeSlider__arrow homeSlider__arrow--right">
                <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_right_white.svg'; ?>"/>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>