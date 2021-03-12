<?php
/*
*   Template name: Kontakt
*/
get_header(); ?>

<main class="lolosite lolosite--contactPage">
    <section class="section section--contact">
        <div class="container contactContent">
            <div class="contactContent__imageWrapper">
                <img class="contactContent__image" src="<?php echo get_template_directory_uri() . '/images/contact-image.jpg' ?>" alt="" />
                <div class="contactContent__headingWrapper">
                    <h2 class="sectionHeading sectionHeading--red contactContent__heading">
                        <span>Kontakt</span>
                    </h2>
                </div>
            </div>
            <ul class="contactContent__detailsList">
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/home.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading">Adres:</h3>
                    </div>
                    <p>Lolo Baby<br>ul. Rynek Kosciuszki 8/1<br>15-426 Białystok<br>Polska</p>
                </li>
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/phone.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading">Telefon:</h3>
                    </div>
                    <p>TBC</p>
                </li>
                <li>
                    <div class="contactContent__subheadingWrapper">
                        <img src="<?php echo get_template_directory_uri() . '/images/icons/email.svg' ?>" alt="" />
                        <h3 class="contactContent__subheading">E-mail:</h3>
                    </div>
                    <p>kontakt@lolobaby.pl</p>
                </li>
            </ul>
        </div>
        <img class="drawing planeDrawing planeDrawing--contact" src="<?php echo get_template_directory_uri() . '/images/plane-red2.svg' ?>" alt="" />
    </section>
</main>

<?php get_footer(); ?>