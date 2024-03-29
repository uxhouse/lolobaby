<a class="postTile" href="<?php echo get_permalink(); ?>" postid="<?php the_ID(); ?>">
    <div>
        <div class="postTile__thumb">
            <img class="postTile__image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" />
        </div>
    </div>
    <div class="postTile__content">
        <div>
            <p class="postTile__date"><?php echo get_the_date('j.m.Y'); ?></p>
            <p class="postTile__title"><?php the_title(); ?></p>
            <p class="postTile__excerpt">
                <?php
                $excerpt = get_the_excerpt();

                $excerpt = substr($excerpt, 0, 135);
                $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                echo $result;
                ?>
            </p>
        </div>
        <div class="postTile__readMore"><?php _e('Czytaj więcej', 'lolobaby'); ?></div>
    </div>
</a>