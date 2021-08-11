<?php
/*
*   Template name: Kontakt
*/
get_header(); ?>

<main class="lolosite lolosite--contactPage">
    <?php include get_template_directory() . '/template-parts/_include_contactBreadcrumbs.php'; ?>
    <section class="section section--contact">
        <div class="container contactContent">
            <div class="contactContent__imageWrapper">
                <img class="contactContent__image" src="<?php echo get_template_directory_uri() . '/images/contact-image.jpg' ?>" alt="" />
                <div class="contactContent__headingWrapper">
                    <h2 class="sectionHeading sectionHeading--red contactContent__heading">
                        <span><?php _e('Kontakt', 'lolobaby'); ?></span>
                    </h2>
                </div>
            </div>
            <ul class="contactContent__detailsList">
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/home.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading"><?php _e('Adres', 'lolobaby'); ?>:</h3>
                    </div>
                    <p>Lolo Baby<br>ul. Rynek Kosciuszki 8/1<br>15-426 Białystok<br><?php _e('Polska', 'lolobaby'); ?></p>
                    <p><b><?php _e('Magazyn', 'lolobaby'); ?>:</b><br/>Fabryczna 101<br/>15-119 Białystok</p>
                </li>
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/phone.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading"><?php _e('Telefon', 'lolobaby'); ?>:</h3>
                    </div>
                    <p>+48 506 496 731</p>
                </li>
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/email.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading"><?php _e('E-mail', 'lolobaby'); ?>:</h3>
                    </div>
                    <p>kontakt@lolobaby.pl</p>
                </li>
            </ul>
        </div>
        <img class="drawing planeDrawing planeDrawing--contact" src="<?php echo get_template_directory_uri() . '/images/plane-red2.svg' ?>" alt="" />
    </section>
</main>

<?php get_footer(); ?>