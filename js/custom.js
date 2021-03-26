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
  
    /* ---- Check engine ---- */

    $('.engineCheckbox').on('click', function(){
        if($(this).is(":checked")){
            $(this).parent().addClass('checkbox--checked');
        }
        else if($(this).is(":not(:checked)")){
            $(this).parent().removeClass('checkbox--checked');
        }
    });

    $('.engineRadio').on('click', function(){
        var radioGroupName = $(this).attr('name');
        if($(this).is(":checked")){
            $('input[name="' + radioGroupName + '"]').parent().removeClass('radio-selected');
            $(this).parent().addClass('radio-selected');
        }
    });
  
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

    /* ---- Product image zoom ---- */
    $(document).ready(function(){
        if($(screen).width() > 767){
            $('.woocommerce-product-gallery__image').each(function(){
                var wooImage = $(this).find('a');
                var wooImageSource = wooImage.attr('href');
                $(wooImage).zoom({
                    url: wooImageSource,
                    magnify: 2,
                });
            });
        }
    });

    /* ---- Header mobile menu ---- */
    var menutoggle = $('.siteHeader__actions').find('.menu-toggle');
    $(menutoggle).on('click', function(){
        $('.mobileMenu').addClass('mobileMenu--active');
        $('body').addClass('noscroll');
    });
    $(document).mouseup(function(e){
        var menumobile = $('.mobileMenu');
        if (!menumobile.is(e.target) && menumobile.has(e.target).length === 0) {
            menumobile.removeClass('mobileMenu--active');
            $('body').removeClass('noscroll');
        }
    });

    var menumobileposition = $('.mobileMenu__position');
    $(menumobileposition).on('click', function(){
        $('.mobileMenu__position').find('ul').slideUp();
        if($(this).hasClass('mobileMenu__position--active')){
            $(this).removeClass('mobileMenu__position--active');
            $(this).find('ul').slideUp();
        }else{
            $('.mobileMenu__position').removeClass('mobileMenu__position--active');
            $(this).addClass('mobileMenu__position--active');
            $(this).find('ul').slideDown();
        }
        
    });
    var menumobilepositionhref = $('.mobileMenu__position').find('a');
    $(menumobilepositionhref).on('click', function(){
        $('.mobileMenu').removeClass('mobileMenu--active');
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

        /* Checkout login - register forms */
        $(document).ready(function(){
            var body = $('body');
            if(body.hasClass('woocommerce-checkout')){
                if(body.hasClass('logged-in')){
                    $('body').addClass('checkout-step3');
                }else{
                    $('body').addClass('checkout-step2');
                }
            }
            if(body.hasClass('checkout-step2')){
                $('.cartProgress').find('.step-2').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');
            }
            if(body.hasClass('checkout-step3')){
                $('.cartProgress').find('.step-2').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');
                $('.cartProgress').find('.step-3').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');
            }
        });

        var openRegister = $('.checkoutLogin__gotoOtherForm').find('.openRegister');
        var openLogin = $('.checkoutLogin__gotoOtherForm').find('.openLogin');

        $(openRegister).on('click', function(){
            /* Hide login form */
            $('.checkoutLogin').removeClass('checkoutLogin--visible');
            $('.gotoRegister').removeClass('gotoRegister--visible');
            setTimeout(function(){
                $('.checkoutLogin').removeClass('checkoutLogin--ready');
                $('.gotoRegister').removeClass('gotoRegister--ready');
            }, 200);

            /* Open register form */
            setTimeout(function(){
                $('.checkoutRegister').addClass('checkoutRegister--ready');
            }, 200);
            setTimeout(function(){
                $('.checkoutRegister').addClass('checkoutRegister--visible');
            }, 500);
        });
        $(openLogin).on('click', function(){
            /* Hide register form */
            $('.checkoutRegister').removeClass('checkoutRegister--visible');
            setTimeout(function(){
                $('.checkoutRegister').removeClass('checkoutRegister--ready');
            }, 200);

            /* Open login form */
            setTimeout(function(){
                $('.checkoutLogin').addClass('checkoutLogin--ready');
                $('.gotoRegister').addClass('gotoRegister--ready');
            }, 200);
            setTimeout(function(){
                $('.checkoutLogin').addClass('checkoutLogin--visible');
                $('.gotoRegister').addClass('gotoRegister--visible');
            }, 500);
        });
    });

    /* Checkout form custom */

    $(document).ready(function(){
        var formBillingInputs = $('.checkoutForm__billing').find('input[type="text"]');
        $(formBillingInputs).on('change keyup', function(){
            var value = $(this).val();
            var name = $(this).attr('name');
            $('input[name="' + name + '"]').val(value);
        });
        var formBillingInputs = $('.checkoutForm__billing').find('input.engineRadio');
        $(formBillingInputs).on('click', function(){
            var value = $(this).attr('value');
            var name = $(this).attr('forfield');
            $('input[name="' + name + '"][value="' + value + '"]').attr('checked', true).trigger('click');
        });
    });

    $(document).ready(function(){
        var input = $('.radio__option').find('input');

        $(input).on('click', function(){
            if($(this).attr('value') == 'private'){
                $('.checkoutForm__billing').find('.comapnyField').removeClass('visible');
                setTimeout(function(){
                    $('.checkoutForm__billing').find('.comapnyField').removeClass('ready');
                }, 300);
            }
            if($(this).attr('value') == 'business'){
                $('.checkoutForm__billing').find('.comapnyField').addClass('ready');
                setTimeout(function(){
                    $('.checkoutForm__billing').find('.comapnyField').addClass('visible');
                }, 300);
            }
        });
    });

    ///////////// Validate /////////////
    $(function() {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $('form[name="checkoutRegisterForm"]').validate({
          // Specify validation rules
          rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            registerUsername: "required",
            registerUseremail: {
              required: true,
              email: true
            },
            registerUserpassword: {
              required: true,
              minlength: 8
            }
          },
          // Specify validation error messages
          messages: {
            registerUsername: "Wprowadź imię i nazwisko",
            registerUserpassword: {
              required: "Wprowadź hasło",
              minlength: "Twoje hasło musi posiadać przynajmniej 8 znaków"
            },
            email: "Wprowadź prawidłowy adres e-mail"
          },
          // Make sure the form is submitted to the destination defined
          // in the "action" attribute of the form when valid
          submitHandler: function(form) {
            form.submit();
          }
        });
      });
      $('input[name="registerUsername"]').keyup(function(e) {
        var regex = /^[a-zA-Z ]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^a-zA-Z ]+/, '');
        }
      });
      $('input[name="registerUseremail"]').keyup(function(e) {
        var regex = /^[a-zA-Z@.]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^a-zA-Z@.]+/, '');
        }
      });
      $('input[name="registerUserpassword"]').keyup(function(e) {
        var regex = /^[a-zA-Z0-9!@#$%^&*()-_=+]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^a-zA-Z0-9!@#$%^&*()-_=+]+/, '');
        }
      });
      $('input[name="billing_username"]').keyup(function(e) {
        var regex = /^[a-zA-Z ]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^a-zA-Z ]+/, '');
        }
      });
      $('input[name="billing_phone"]').keyup(function(e) {
        var regex = /^[0-9]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^0-9]+/, '');
        }
      });


    /////////////  Select choosed shipment option //////////////
    $(document).ready(function(){
        var shipmentID = $('.checkoutPage').attr('selectedshipment');
        $('#shipping_method').find('li[methodid="' + shipmentID + '"]').addClass('radio-selected');
        setTimeout(function(){
            $('li[methodid="' + shipmentID + '"]').find('input').trigger('click');
        }, 100);

        if(shipmentID > 0){
            $('.checkoutDeliverySelect').slideUp();
            $('.checkoutPage__delivery').find('.heading').find('h3').text('Wybrany sposób płatności');
        }else{
            $('.checkoutPage__delivery').find('.heading').find('h3').text('Wybierz sposób płatności');
        }
    });

    /////////////  Hide shipment options on select - and clone data //////////////
    $(document).ready(function(){
        var shipmentoption = $('#shipping_method').find('li');
        $(shipmentoption).on('click', function(){
            var name = $(this).find('label')[0].childNodes[0].nodeValue;
            var methodid = $(this).attr('methodid');

            $('.checkoutDeliverySelected').removeClass('checkoutDeliverySelected--disable');
            $('.checkoutDeliverySelected').find('h3').text(name).attr('methodid', methodid);
            $('.summaryPage__shipping').find('.name').text(name).attr('methodid', methodid);

            setTimeout(function(){
                $('.checkoutDeliverySelect').slideUp();
            }, 200);
        });
    });

    /////////////  Open shipment methods on click  //////////////
    $(document).ready(function(){
        $('.changeShipmentMethod').on('click', function(){
            $('.checkoutDeliverySelect').slideDown();
        });
    });

    ///////////// Checkout form - nav ///////////////
    $(document).ready(function(){
        var checkoutNext = $('.checkoutPage__nextstep').find('.nextStep');

        $(checkoutNext).on('click', function(){
            $('.cartProgress').find('.step-4').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');
            $('.checkoutPage').removeClass('checkoutPage--visible');
            setTimeout(function(){
                $('.checkoutPage').removeClass('checkoutPage--ready');
                $('.summaryPage').addClass('summaryPage--ready');
            }, 300);
            setTimeout(function(){
                $('.summaryPage').addClass('summaryPage--visible');
            }, 350);
        });
    });

    ///////////// Summary page - nav ///////////////
    $(document).ready(function(){
        var checkoutPrev = $('.summaryPage__nextstep').find('.previousStep');
        var checkoutNext = $('.summaryPage__nextstep').find('.nextStep');

        $(checkoutPrev).on('click', function(){
            $('.summaryPage').removeClass('summaryPage--visible');
            $('.cartProgress').find('.step-4').removeClass('cartProgress__step--active').removeClass('cartProgress__arrow--active');
            setTimeout(function(){
                $('.summaryPage').removeClass('summaryPage--ready');
                $('.checkoutPage').addClass('checkoutPage--ready');
            }, 300);
            setTimeout(function(){
                $('.checkoutPage').addClass('checkoutPage--visible');
            }, 350);
        });
        $(checkoutNext).on('click', function(){
            $('button[name="woocommerce_checkout_place_order"]').trigger('click');
        });
    });

    $('.checkoutForm').on('DOMNodeInserted', function(e) {
        if ($(e.target).is('.woocommerce-NoticeGroup')) {
            $('.cartProgress').find('.step-4').removeClass('cartProgress__step--active').removeClass('cartProgress__arrow--active');
            $('.summaryPage').removeClass('summaryPage--visible');
            setTimeout(function(){
                $('.summaryPage').removeClass('summaryPage--ready');
                $('.checkoutPage').addClass('checkoutPage--ready');
            }, 300);
            setTimeout(function(){
                $('.checkoutPage').addClass('checkoutPage--visible');
            }, 350);
        }
    });

    //////// Payment method select ///////
    $(document).ready(function(){
        var option = $('.summaryPage__payment').find('.optionList__option');

        $(option).on('click', function(){
            var paymentmethod = $(this).attr('paymentmethod');
            $('.optionList__option').removeClass('optionList__option--active');
            $(this).addClass('optionList__option--active');

            $('.wc_payment_methods').find('#' + paymentmethod).attr('checked', true).trigger('click');
        });
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

    /* ---- Thank you page review form ---- */
    $(document).ready(function(){
        var star = $('.form__stars').find('.star');
        star.parent().attr('data-rating-value', '5');

        $(star).on('click', function(){
            var value = $(this).attr('value');
            $('.form__radio').find('input[value="' + value + '"]').trigger('click');
        });

        $('.form__stars > .star').click(function() {
            $(this).addClass('star--active').siblings().removeClass('star--active');
            $(this).parent().attr('data-rating-value', $(this).attr('value'));
        });
    });


    /* ---- User edit forms ---- */
    $(document).ready(function(){
        $('.openForm').on('click', function(){
            $(this).parent().parent().find('.form').addClass('form--active');
            $(this).parent().addClass('content--hidden');
        });
    });
});
