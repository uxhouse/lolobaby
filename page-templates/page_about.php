<?php
/*
*   Template name: O nas
*/
get_header(); ?>

<main class="lolosite lolosite--aboutPage">
    <section class="section section--about">
        <div class="container">
            <h2 class="sectionHeading">
                <span>O nas</span>
            </h2>
            <div class="aboutDescription">
                <p>Pomysł na Lolobaby narodził się w 2020r., w samym środku pandemii. Wkrótce, w sercu Podlasia, powstała malutka firma z wielkimi ambicjami i pozytywnie patrząca w przyszłość. 'Lolo' oznacza samolot i było to pierwsze słowo wypowiedziane przez moją córkę. Stąd też nazwa i logo marki, której misją jest zapewnić maksymalne bezpieczeństwo i komfort nowo narodzonym Maluszkom.</p>
            </div>
        </div>
        <img class="drawing planeDrawing planeDrawing--right" src="<?php echo get_template_directory_uri() . '/images/plane-red1.svg' ?>" alt="" />
    </section>
    <div class="container">
        <section class="section section--highQuality">
            <div class="imageWrapper"></div>
            <div class="highQualityDescription">
                <h2 class="secondaryHeading">Wysoka jakość<br>i funkcjonalność</h2>
                <p>Jako mama dwójki temperamentnych dzieci często miałam problem ze znalezieniem ubranek, odpowiadających na moje potrzeby. Przede wszystkim łatwych w zakładaniu i umożliwiających szybkie przewijanie. Zrodził się więc pomysł na markę, której produkty mają być nie tylko ładne ale przede wszystkim proste i luźne w kroju, bez zbędnych zdobień i zatrzasków. </p>
                <p>Gwarancja jakości i bezpieczeństwa to nasz priorytet. Szyjemy i projektujemy w Polsce z wyłącznie certyfikowanych materiałów. Dzianiny z naszej kolekcji są niezwykle miękkie i jedwabiste w dotyku, dzięki czemu idealnie otulają noworodki dając im ciepło i ochronę, których Maluszki tak bardzo potrzebują.</p>
            </div>
            <img class="drawing planeDrawing planeDrawing--left" src="<?php echo get_template_directory_uri() . '/images/plane-red2.svg' ?>" alt="" />
        </section>
    </div>
    <section class="section section--environmentCare">
        <div class="container">
            <div class="environmentCareDescription">
                <h2 class="secondaryHeading">Lolobaby to także dbałość o środowisko. </h2>
                <p>Nasze produkty pakujemy efektownie ale i ekologicznie. Pudełka, w których wysyłamy nasze ubranka, wykonane są w 90% z przetwarzalnych materiałów wtórnych, barwione farbami na bazie wody.</p>
                <p>Zapraszamy na nasz pokład. Wyruszmy razem w piękną i spokojną podróż!</p>
            </div>
        </div>
    </section>
    
    <!-- Strefa wiedzy -->
    <?php include get_template_directory() . '/template-parts/_include_strefaWiedzy.php'; ?>

    <a href="/blog" class="btn"><span>Zobacz wszystkie artykuły</span></a>
</main>

<?php get_footer(); ?>