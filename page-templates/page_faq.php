<?php
/*
*   Template name: FAQ
*/
get_header(); ?>

<main class="lolosite lolosite--faqPage">
    <?php include get_template_directory() . '/template-parts/_include_faqBreadcrumbs.php'; ?>
    <section class="section section--faq">
        <div class="container">
            <h2 class="sectionHeading">
                <span><?php _e('Pytania i odpowiedzi', 'lolobaby'); ?></span>
            </h2>
            <div class="faqDescription">
                <p><?php _e('Poniżej przedstawiamy odpowiedzi na najczęściej zadawane pytania. Jeśli wciąż masz wątpliwości napisz do nas na', 'lolobaby'); ?>: <a href="mailto:kontakt@lolobaby.pl">kontakt@lolobaby.pl</a></p>
                <img class="drawing drawing--faq" src="<?php echo get_template_directory_uri() . '/images/question-marks.svg' ?>" alt="" />
            </div> 
        </div>
        <div class="divider divider--faq">
            <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
        </div>
        <div class="container">
            <div class="faq">
                <?php if(get_field('faq')): ?>
                <div class="faq__filtersList">
                    <?php while(have_rows('faq')): the_row();
                        $title = get_sub_field('faq_category_name');
                    ?>
                    <div class="faq__filter" data-category="cat_<?php echo get_row_index(); ?>"><p><?php echo $title; ?></p></div>
                    <?php endwhile; ?>
                </div>
                <div class="divider divider--filters">
                    <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
                </div>
                <?php while(have_rows('faq')): the_row();
                    $title = get_sub_field('faq_category_name');
                ?>
                <div class="faq__list" data-category="cat_<?php echo get_row_index(); ?>">
                    <?php while(have_rows('faq_category')): the_row();
                        $que = get_sub_field('faq_category_que');
                        $ans = get_sub_field('faq_category_ans');
                    ?>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p><?php echo $que; ?></p></div>
                            <div class="faq__answer">
                                <?php echo $ans; ?>
                            </div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>