<?php
$args = array(
    'posts_per_page' => 3,
    'post_type'        => 'post',
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
            <div class="knowledgeZone__list">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php include get_template_directory() . '/template-parts/_include_postTile.php'; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>