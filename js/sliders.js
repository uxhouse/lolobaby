
/* ---- Home page top slider ---- */ 

$(document).ready(function(){
    $('.homeSlider__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.homeSlider__arrow--left'),
        nextArrow: $('.homeSlider__arrow--right'),
    });
    $('.homeSlider__dots span').first().addClass('active');

    $('.homeSlider__dots span').on('click', function(){
        $('.homeSlider__dots span').removeClass('active');
        $(this).addClass('active');

        var dotNum = $(this).attr('num');
        var getSlide = $('.homeSlider__slide[num="' + dotNum + '"]');
        var slideIndex = getSlide.data("slick-index");
        $('.homeSlider__slider').slick('slickGoTo', slideIndex);
    });
    $('.homeSlider__arrow').on('click', function(){
        var currentSlide = $('.homeSlider__slide.slick-current').attr('num');

        $('.homeSlider__dots span').removeClass('active');
        $('.homeSlider__dots span[num="' + currentSlide + '"]').addClass('active');
    });
});

/* ---- Bestsellers slider ---- */ 

$(document).ready(function(){
    $('.homeBestsellers__list').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.homeBestsellers__arrow--left'),
        nextArrow: $('.homeBestsellers__arrow--right'),
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
                variableWidth: true,
                infinite: true,
              }
            }
          ]
    });
    $('.homeBestsellers__dots span').first().addClass('active');
    $('.homeBestsellers__dots span').on('click', function(){
        $('.homeBestsellers__dots span').removeClass('active');
        $(this).addClass('active');

        var dotNum = $(this).attr('productid');
        var getSlide = $('.slick-slide[productid="' + dotNum + '"]');
        var slideIndex = getSlide.data("slick-index");
        $('.homeBestsellers__list').slick('slickGoTo', slideIndex);
    });
    $('.homeBestsellers__arrow').on('click', function(){
        var currentSlide = $('.productTile.slick-current').attr('productid');

        $('.homeBestsellers__dots span').removeClass('active');
        $('.homeBestsellers__dots span[productid="' + currentSlide + '"]').addClass('active');
    });
});

/* ---- Knowledge zone slider ---- */ 

$(document).ready(function(){
    if ($(window).width() < 992) {
        $('.knowledgeZone__list').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: $('.knowledgeZone__arrow--left'),
            nextArrow: $('.knowledgeZone__arrow--right'),
            centerMode: true,
            variableWidth: true,
            infinite: true,
        });
        $('.knowledgeZone__dots span').first().addClass('active');
        $('.knowledgeZone__dots span').on('click', function(){
            $('.knowledgeZone__dots span').removeClass('active');
            $(this).addClass('active');

            var dotNum = $(this).attr('postid');
            var getSlide = $('.slick-slide[postid="' + dotNum + '"]');
            var slideIndex = getSlide.data("slick-index");
            $('.knowledgeZone__list').slick('slickGoTo', slideIndex);
        });
        $('.knowledgeZone__arrow').on('click', function(){
            var currentSlide = $('.postTile.slick-current').attr('postid');

            $('.knowledgeZone__dots span').removeClass('active');
            $('.knowledgeZone__dots span[postid="' + currentSlide + '"]').addClass('active');
        });
    }
});

/* ---- Product page ---- */

$(document).ready(function(){
    var galleryMain = $('.productContent__gallery').find('.galleryMain');
    var galleryNav = $('.productContent__gallery').find('.galleryNav');

    $(galleryMain).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        adaptiveHeight: true,
        asNavFor: galleryNav,
    });
    $(galleryNav).slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: false,
        variableWidth: true,
        arrows: true,
        focusOnSelect: true,
        asNavFor: galleryMain,
    });
});

/* ---- Related products slider ---- */ 

$(document).ready(function(){
    if ($(window).width() < 767){
        $('.relatedList').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            arrows: true,
            infinite: true,
            variableWidth: true,
            prevArrow: $('.relatedList__arrow--left'),
            nextArrow: $('.relatedList__arrow--right'),
        });
    }
    $('.relatedList__dots span').first().addClass('active');
    $('.relatedList__dots span').on('click', function(){
        $('.relatedList__dots span').removeClass('active');
        $(this).addClass('active');

        var dotNum = $(this).attr('productid');
        var getSlide = $('.slick-slide[productid="' + dotNum + '"]');
        var slideIndex = getSlide.data("slick-index");
        $('.homeBestsellers__list').slick('slickGoTo', slideIndex);
    });
    $('.relatedList__arrow').on('click', function(){
        var currentSlide = $('.productTile.slick-current').attr('productid');

        $('.relatedList__dots span').removeClass('active');
        $('.relatedList__dots span[productid="' + currentSlide + '"]').addClass('active');
    });
});