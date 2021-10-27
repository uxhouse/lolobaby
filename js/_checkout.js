$(document).ready(function(){
    var checkout_form = $('form.woocommerce-checkout');
    var checkoutNext = $('.checkoutPage__nextstep').find('.nextStep');
    var checkoutEnd = $('.summaryPage__nextstep').find('.nextStep');

    checkout_form.on('submit', function () {
        // console.log('submitted');
        if ($('#confirm-order-flag').length == 0) {
            checkout_form.append('<input type="hidden" id="confirm-order-flag" name="confirm-order-flag" value="1">');
        }
        return true;
    });

    $('.checkoutForm').on('DOMNodeInserted', function () {
        var error_count = $('.woocommerce-error li').length;
    
        if(error_count){
            // console.log('checkout_error');
            // console.log('error_count: ' + error_count);

            $('.woocommerce-error li').each(function(){
                var error_text = $(this).text().trim();
                if (error_text == 'custom_notice'){
                    $(this).css('display', 'none');
                }
            });
            if (error_count == 1) {
                var summary_selectedShipment = $('.checkoutDeliverySelected').find('h3').attr('methodid');
                $('.checkoutPage').removeClass('checkoutPage--visible');
                $('.cartProgress').find('.step-4').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');
                setTimeout(function(){
                    $('.checkoutPage').removeClass('checkoutPage--ready');
                    $('.summaryPage').addClass('summaryPage--ready');
                }, 300);
                setTimeout(function(){
                    $('.summaryPage').addClass('summaryPage--visible');
                }, 300);
                if(summary_selectedShipment !== '9'){
                    var name = $('input[name="billing_username"]').val();
                    var street = $('input[name="billing_address_1"]').val();
                    var postcode = $('input[name="billing_postcode"]').val();
                    var city = $('input[name="billing_city"]').val();
                    $('.summaryPage__shipping').find('.deliveryAddress div').text(name + ', ' + street + ', ' + postcode + ' ' + city);
                }else{
                    var inpostPoint = $('#furgonetkaPointName').attr('value');
                    $('.summaryPage__shipping').find('.deliveryAddress div').text(inpostPoint);
                }
                $('body').trigger('checkout_next_step');
            }
        }
    });

    $(checkoutNext).click(function () {
        $('#place_order').trigger('click');
    });
    $(checkoutEnd).click(function(){
        $('#confirm-order-flag').val('');
        $('#place_order').trigger('click');
    });
    var summaryPrev = $('.summaryPage__nextstep').find('.previousStep');
    $(summaryPrev).on('click', function(){
        $('#confirm-order-flag').val('1');
        $('.summaryPage').removeClass('summaryPage--visible');
        $('.cartProgress').find('.step-4').removeClass('cartProgress__step--active').removeClass('cartProgress__arrow--active');
        setTimeout(function(){
            $('.summaryPage').removeClass('summaryPage--ready');
            $('.checkoutPage').addClass('checkoutPage--ready');
        }, 300);
        setTimeout(function(){
            $('.checkoutPage').addClass('checkoutPage--visible');
        }, 300);
    });
});

/**
 *  Payment select
 */
$('body').on('checkout_next_step', function(){
    $('.optionList__option').on('click', function(){
        console.log('clicked');
        var radioGroupName = $(this).find('input').attr('name');
        if($(this).find('input').is(":checked")){
            $('input[name="' + radioGroupName + '"]').parent().removeClass('optionList__option--active');
            $(this).addClass('optionList__option--active');
        }
    });
});
