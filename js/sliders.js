
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