$(document).ready(function(){
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    /* ---- Header actions tooltip ---- */
    $('.sortEngine__block').on('click', function(){
        $('.sortEngine__dropdown').addClass('sortEngine__dropdown--active');
    });
    $(document).mouseup(function(e){
        var container = $('.sortEngine__dropdown');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass('sortEngine__dropdown--active');
        }
    });
    $('.sortEngine__select').on('click', function(){
        var date = $(this).attr('sortname');
        console.log(date);
        $('.orderby').val(date).trigger('change');
        $('.')
    });
    $(document).ready(function(){
        var sortdata = getUrlParameter('orderby');
        var itemscount = $('.sortEngine').attr('itemscount');
        
        if(sortdata){
            $('.sortEngine__select[sortname="' + sortdata + '"]').addClass('selected');
        }
        if(itemscount == 0){
            $('.sortEngine__wrap').css('display', 'none');
        }
        $('.sortEngine__select').each(function(){
            if($(this).hasClass('selected')){
                var nameofselected = $(this).text();
                $('.sortEngine__block').find('p').text(nameofselected);
            }
        });
    });

    /* ---- Shop archive category select ---- */
    $('.categoryWrapper__cat').each(function(){
        var termName = $(this).attr('term');

        if($('body').hasClass(termName)){
            $(this).addClass('categoryWrapper__cat--current');
        }
    });

    /* ---- Filter engine ---- */
    setTimeout(function(){
        $('.woof_container').each(function(){
            var attributeName = $(this).find('.woof_checkboxBlock').attr('attrname').replace('Atrybut produktu: ', '');
            $(this).find('.woof_checkboxBlock').find('p').text(attributeName);
        });
    }, 10);

    $('.woof_checkboxBlock').on('click', function(){
        $('.woof_container_inner').removeClass('open');
        $(this).parent().find('.woof_container_inner').toggleClass('open');
    });
    $(document).mouseup(function(e){
        var container = $('.woof_container_inner');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass('open');
        }
    });

    $('input[name="acceptance-21"]').on('click', function(){
        if($(this).is(":checked")){
            $(this).parent().parent().parent().parent().addClass('checked');
        }
        else if($(this).is(":not(:checked)")){
            $(this).parent().parent().parent().parent().removeClass('checked');
        }
    });

    if($(window).width() > 991){
        $('.woof_checkbox_label').on('click', function(){
            setTimeout(function(){
                $('.woof_submit_search_form').trigger('click');
            }, 200);
        });
    }

    /* ---- Filter engine MOBILE ---- */
    if($(window).width() < 767){
        $('.filterOpen').on('click', function(){
            $('.filterMobile').addClass('active');
        });
    
        $('.woof_checkboxBlock').on('click', function(){
            $('.woof_container_inner').slideUp();
    
            if($(this).hasClass('opened')){
                $(this).parent().find('.woof_container_inner').slideUp();
                $(this).removeClass('opened');
            }else{
                $(this).parent().find('.woof_container_inner').slideDown();
                $(this).addClass('opened');
            }
        });
        var removefiltermobile = $('.filterMobile__summary').find('p.delete');
        $(removefiltermobile).on('click', function(){
            $('.woof_reset_search_form').trigger('click');
        });
        $('.woof_checkbox_term').on('click', function(){
            if($(this).is(":checked")){
                $(this).parent().addClass('checked');
            }
            else if($(this).is(":not(:checked)")){
                $(this).parent().removeClass('checked');
            }
        });
        $(document).ready(function(){
            var mobileFilterWrap = $('.filterMobile__options').find('.woof_container')
            setTimeout(function(){
                $('.woof_checkbox_label_selected').parent().addClass('checked');
                
                $(mobileFilterWrap).each(function(){
                    var numItems = $(this).find('li.checked').length;
                    if(numItems > 0){
                        $(this).find('.woof_checkboxBlock').addClass('hasCheckedItems');
                        $(this).find('.woof_checkboxBlock').find('p').attr('itemschecked', numItems);
                    }
                });
            }, 200);
        });
    }

    /* ---- Blog dropdown ---- */

    var blogButton = $('.blog__dropdownButton');

    blogButton.on('click', function(){
        var blogDescription = $('.blog__description');
        if (blogDescription.hasClass('open')) {
            blogDescription.removeClass('open');
            blogButton.text('Rozwiń');
        } else {
            blogDescription.addClass('open');
            blogButton.text('Zwiń');
        }
    });
  
    /* ---- Newsletter ---- */

    $('.engineCheckbox').on('click', function(){
        if($(this).is(":checked")){
            $(this).parent().addClass('checkbox--checked');
        }
        else if($(this).is(":not(:checked)")){
            $(this).parent().removeClass('checkbox--checked');
        }
    });

    /* ---- Product image zoom ---- */
    $(document).ready(function(){
        $('.woocommerce-product-gallery__image').each(function(){
            var wooImage = $(this).find('a');
            var wooImageSource = wooImage.attr('href');
            $(wooImage).zoom({
                url: wooImageSource,
                magnify: 2,
            });
        });
    });

    /* ---- Cart actions ---- */

    $(document).ready(function(){
        $('.selectTrigger').on('click', function(){
            var dropdown = $(this).parent().find('.selectDropdown');
            dropdown.addClass('selectDropdown--active');

            $(document).mouseup(function(e){
                if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
                    dropdown.removeClass('selectDropdown--active');
                }
            });
        });

        setTimeout(function(){
            $("[name='update_cart']").attr('aria-disabled', 'false').removeAttr("disabled");
        }, 500);
        var quantitySelect = $('.dropdownInput__dropdown').find('span');

        $(quantitySelect).on('click', function(){
            var value = $(this).text();
            $(this).parent().removeClass('selectDropdown--active');
            $(this).parent().parent().find('.dropdownInput__current').text(value);
    
            var qtyInput = $(this).parent().parent().parent().find('input.qty');
            var sizeInput = $(this).parent().parent().find('input.select_size');
            qtyInput.val(value).trigger('change');
            sizeInput.val(value).trigger('change');
            setTimeout(function(){
                $("[name='update_cart']").trigger('click').trigger('click');
                console.log('clicked');
            }, 1000);
        });

        /* Coupon actions */

        $('input[name="couponInput"]').on('keyup', function() {
            $('#coupon_code').val($(this).val());
        });
        $('.couponInput__submit').on('click', function(){
            $("[name='apply_coupon']").trigger('click');
        });

        /* Delivery select */

        var deliverySelector = $('input[name="delivery_option"]');
        var deliveryAmount = $('.cartTotals__value[valuename="deliverycost"]');
        var totalValue = $('.cartTotals__total').find('span.amount').find('bdi');
        var currency = $('body').attr('currency');
        if($('body').hasClass('woocommerce-cart')){
            var currentTotal = totalValue[0].childNodes[0]['data'].replace(',', '.');
        }

        var selectedShipment = $('.loloCart').attr('selectedshipment');
        if(typeof selectedShipment !== typeof undefined && selectedShipment !== false){
            $('.deliveryList').css('opacity', '.5');
            $('.deliveryList').css('pointer-events', 'none');
            $('.deliveryList__option[methodid="' + selectedShipment + '"]').addClass('deliveryList__option--checked');
            var selectedOptionAmount = $('.deliveryList__option').attr('methodamount');
            deliveryAmount.find('p').text(selectedOptionAmount + ' ' + currency);
        }else{
            $(deliverySelector).on('click', function(){
                var selectedAmount = $(this).parent().parent().attr('methodamount');
                
                $('.deliveryList__option').removeClass('deliveryList__option--checked');
                var updateTotal = parseFloat(currentTotal) + parseFloat(selectedAmount);
                var totalAmount = updateTotal;
                
                if($(this).is(":checked")){
                    $(this).parent().parent().addClass('deliveryList__option--checked');
                }
                else if($(this).is(":not(:checked)")){
                    $(this).parent().parent().removeClass('deliveryList__option--checked');
                }
    
                var totalAmountFormated = totalAmount.toFixed(2).toString().replace(".", ",");
                deliveryAmount.find('p').text(selectedAmount + ' ' + currency);
                totalValue.html(totalAmountFormated + ' ' + currency);
            });
        }

        /* Product page - variation update price */

        setTimeout(function(){
            $('.variations_form').each( function() {
                $(this).on('found_variation', function( event, variation ) {
                    var currency = $('body').attr('currency');
                    var price = parseFloat(variation.display_price);
                    var priceFormated = price.toFixed(2).toString().replace(".", ",");
                    $('.price--variation').html(priceFormated + ' ' + currency);
                });
            });
        }, 200);
    });

    /* ---- FAQ accordeon ---- */
    
    // set first item of list to opened
    function openFirstItem(list) {
        $('.faq__answer').css("height", "auto");
        var initialHeight = $(list).find('.faq__item .faq__answer p').eq(0).outerHeight();
        $('.faq__answer').css("height", "0");
        $(list).find('.faq__item .faq__answer').eq(0).css("height", initialHeight + 30);
        $(list).find('.faq__item').eq(0).addClass('open');
    }

    openFirstItem($('.faq__list').eq(0));

    $('.faq__item').each(function() {
        $(this).on('click', function() {
            var height = $(this).find('.faq__answer p').outerHeight();
            $(this).parent().find('.faq__answer').css("height", "0");

            if ($(this).hasClass('open')) {
                $('.faq__item').removeClass('open');
            } else {
                $('.faq__item').removeClass('open');
                $(this).addClass('open');
                $(this).find('.faq__answer').css("height", height + 30);
            };
        });
    });

    /* ---- FAQ filters engine ---- */

    $('.faq__filter').each(function() {
        $(this).on('click', function() {
            $('.faq__list').removeClass('active');
            $('.faq__filter').removeClass('active');
            $(this).addClass('active');
            var category = $(this).attr('data-category');
            var list = $(".faq__list[data-category='" + category + "']");
            list.addClass('active');
            openFirstItem(list);
        });
    });
});
