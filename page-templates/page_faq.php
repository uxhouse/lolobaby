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
                <span>Pytania i odpowiedzi</span>
            </h2>
            <div class="faqDescription">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p>
                <img class="drawing drawing--faq" src="<?php echo get_template_directory_uri() . '/images/question-marks.svg' ?>" alt="" />
            </div> 
        </div>
        <div class="divider divider--faq">
            <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
        </div>
        <div class="container">
            <div class="faq">
                <div class="faq__filtersList">
                    <div class="faq__filter active" data-category="firstShopping"><p>Pierwsze zakupy</p></div>
                    <div class="faq__filter" data-category="aboutProduct"><p>O produkcie</p></div>
                    <div class="faq__filter" data-category="delivery"><p>Dostawa</p></div>
                    <div class="faq__filter" data-category="complaints"><p>Reklamacje i zwroty</p></div>
                </div>
                <div class="divider divider--filters">
                    <img class="divider__image" src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg' ?>" alt="" />
                </div>
                <div class="faq__list active" data-category="firstShopping">
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Nie dostałem/am maila z potwierdzeniem zamówienia/płatności. Jak mam sprawdzić, czy zamówienie zostało złożone?</p></div>
                            <div class="faq__answer"><p>Przetwarzanie płatności może trwać kilka minut. Jeżeli otrzymali Państwo potwierdzenie przelewu ze swojego banku, a mail z potwierdzeniem zamówienia wciąż nie dotarł, prosimy o kontakt: kontakt@lolobaby.pl</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Nie wiem, jaki rozmiar wybrać.</p></div>
                            <div class="faq__answer"><p>Przetwarzanie płatności może trwać kilka minut. Jeżeli otrzymali Państwo potwierdzenie przelewu ze swojego banku, a mail z potwierdzeniem zamówienia wciąż nie dotarł, prosimy o kontakt: kontakt@lolobaby.pl</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Rozmiar, który mnie interesuje jest niedostępny.</p></div>
                            <div class="faq__answer"><p>Przetwarzanie płatności może trwać kilka minut. Jeżeli otrzymali Państwo potwierdzenie przelewu ze swojego banku, a mail z potwierdzeniem zamówienia wciąż nie dotarł, prosimy o kontakt: kontakt@lolobaby.pl</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                </div>
                <div class="faq__list" data-category="aboutProduct">
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus</p></div>
                            <div class="faq__answer"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                            <div class="faq__answer"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Lorem ipsum dolor sit amet, consectetur sodales nec dui cursus</p></div>
                            <div class="faq__answer"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                </div>
                <div class="faq__list" data-category="delivery">
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus</p></div>
                            <div class="faq__answer"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                            <div class="faq__answer"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lectus magna, sodales nec dui cursus, dictum pretium odio.</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                </div>
                <div class="faq__list" data-category="complaints">
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Nie wiem, jaki rozmiar wybrać.</p></div>
                            <div class="faq__answer"><p>Przetwarzanie płatności może trwać kilka minut. Jeżeli otrzymali Państwo potwierdzenie przelewu ze swojego banku, a mail z potwierdzeniem zamówienia wciąż nie dotarł, prosimy o kontakt: kontakt@lolobaby.pl</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                    <div class="faq__item">
                        <div class="faq__itemContent">
                            <div class="faq__question"><p>Rozmiar, który mnie interesuje jest niedostępny.</p></div>
                            <div class="faq__answer"><p>Przetwarzanie płatności może trwać kilka minut. Jeżeli otrzymali Państwo potwierdzenie przelewu ze swojego banku, a mail z potwierdzeniem zamówienia wciąż nie dotarł, prosimy o kontakt: kontakt@lolobaby.pl</p></div>
                        </div>
                        <img class="faq__arrow" src="<?php echo get_template_directory_uri() . '/images/icons/dropdown_arrow_ico.svg' ?>" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>