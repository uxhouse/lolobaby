<?php
$args = array(
    'numberposts'    => 3,
    'post_type'        => 'post',
    'posts_per_page' => 3,
);
$the_query = new WP_Query($args); ?>
<?php if ($the_query->have_posts()) : ?>
    <section class="knowledgeZone">
        <div class="container container--min">
            <div class="knowledgeZone__heading">
                <h2 class="sectionHeading sectionHeading--withImage">
                    <span>
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/book.svg' ?>" alt="" />
                        <span>Strefa wiedzy </span>  
                    </span>
                </h2>
            </div>
            <div class="knowledgeZone__wrap">
                <div class="knowledgeZone__list">
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php include get_template_directory() . '/template-parts/_include_postTile.php'; ?>
                    <?php endwhile; ?>
                </div>
                <div class="knowledgeZone__nav">
                    <div class="knowledgeZone__arrow knowledgeZone__arrow--left">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_left_white.svg'; ?>"/>
                    </div>
                    <div class="knowledgeZone__dots">
                        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <span postid="<?php the_ID(); ?>"></span>
                        <?php endwhile; ?>
                    </div>
                    <div class="knowledgeZone__arrow knowledgeZone__arrow--right">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/arrow_right_white.svg'; ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>