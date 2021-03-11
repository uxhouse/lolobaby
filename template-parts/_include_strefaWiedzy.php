<?php
$args = array(
    'numberposts'    => 3,
    'post_type'        => 'post',
);
$the_query = new WP_Query($args); ?>
<?php if ($the_query->have_posts()) : ?>
    <section class="aboutStrefaWiedzy">
        <div class="aboutStrefaWiedzy__heading">
            <h2>Strefa wiedzy</h2>
        </div>
        <div class="aboutStrefaWiedzy__list">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="aboutStrefaWiedzy__post">
                    <div class="thumb">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                    </div>
                    <div class="content">
                        <p class="date"><?php echo get_the_date('j.m.Y'); ?></p>
                        <p class="title"><?php the_title(); ?></p>
                        <p class="excerpt">
                            <?php
                            $excerpt = get_the_excerpt();

                            $excerpt = substr($excerpt, 0, 135);
                            $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                            echo $result;
                            ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>