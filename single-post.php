<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lolobaby
 */

get_header();
?>

<main id="primary" class="lolosite lolosite--singlePostPage">

    <?php
        while ( have_posts() ) :
            the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
        <header class="singlePost__header" style="background-image: url('<?php echo $url ?>');">
            <div class="singlePost__headerContent">
                <p class="singlePost__date"><?php echo get_the_date( 'd.m.Y' ); ?></p>
                <?php the_title( '<h1 class="singlePost__title">', '</h1>' ); ?>
            </div>
            <div class="singlePost__headerWave">
                <img src="<?php echo get_template_directory_uri() . '/images/wave-white.svg' ?>" alt="" />
            </div>
        </header>

        <?php include get_template_directory() . '/template-parts/_include_singlePostBreadcrumbs.php'; ?>

        <div class="container">
            <div class="singlePost__content">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lolobaby' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post( get_the_title() )
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lolobaby' ),
                        'after'  => '</div>',
                    )
                );
                ?>
                <img class="drawing drawing--singlePost" src="<?php echo get_template_directory_uri() . '/images/moon-stars.svg' ?>" alt="" />
            </div>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->

    <div class="divider divider--singlePost">
        <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
    </div>
    
    <!-- Strefa wiedzy -->
    <?php include get_template_directory() . '/template-parts/_include_strefaWiedzy.php'; ?>
            
    <?php
        endwhile; // End of the loop.
    ?>

</main>

<?php
get_footer();
