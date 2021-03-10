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