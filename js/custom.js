/* ---- Page loader ---- */

$(document).ready(function(){
    var loader = $('.pageLoader');
    loader.addClass('ready');
    setTimeout(function(){
        loader.addClass('disable');
    }, 1000);
});

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

    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
    
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });

    /* ---- Header float class ---- */
    $(document).ready(function(){
        if ($(window).scrollTop() >= 50) {
            $('.siteHeader--frontPage').addClass('siteHeader--float');
        }
    })
    $(window).scroll(function(){
        if ($(this).scrollTop() >= 50) {
            $('.siteHeader--frontPage').addClass('siteHeader--float');
        }else{
            $('.siteHeader--frontPage').removeClass('siteHeader--float');
        }
    });

    /* ---- Header clone height ---- */
    $(document).ready(function(){
        var siteHeaderHeight = $('.siteHeader').height();
        $('.headerClone').css('height', siteHeaderHeight);

        $(window).resize(function(){
            siteHeaderHeight = $('.siteHeader').height();
            $('.headerClone').css('height', siteHeaderHeight);
        });
    });

    /* ---- Header dropdown ---- */
    $(document).ready(function(){
        $('.hasDropdown').find('a:not(.sub-menu a)').removeAttr('href');
    });

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

            // $('.categoryWrapper__cat:not(.categoryWrapper__cat--current)').find('.thumb__icon').css('opacity', '0');
        }
    });

    /* ---- Filter engine ---- */
    setTimeout(function(){
        $('.woof_container').each(function(){
            var attributeName = $(this).find('.woof_checkboxBlock').attr('attrname')
            if(attributeName){
                if($('html').attr('lang') == 'en-US'){
                    var nameformated = attributeName.replace('Product ', '');
                }else{
                    var nameformated = attributeName.replace('Atrybut produktu: ', '');
                }
                $(this).find('.woof_checkboxBlock').find('p').text(nameformated);
            }
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

    $('input[name="_mc4wp_subscribe_contact-form-7"]').on('click', function(){
        if($(this).is(":checked")){
            $(this).parent().parent().addClass('checked');
        }
        else if($(this).is(":not(:checked)")){
            $(this).parent().parent().removeClass('checked');
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

    /**
     *  Sort products by color
     */
    $(document).ready(function(){
        var param = getUrlParameter('orderby');
        var sort = {
            multikolor: 1,
            czerwony: 2,
            niebieski: 3,
            ocean: 4,
            kremowy: 5,
            rozowy: 6,
            lawendowy: 7,
            floral: 8,
            granatowy: 9,
            zolty: 10,
            mietowy: 11,
            brak: 12, 
        }
        if(param === false){
            var items = $('.productTile--archive');
            items.each(function(){
                var color = $(this).data('color');
                if(sort[color] !== undefined){
                    $(this).attr('data-sort', sort[color]);
                }
            });
            items.sort(function(a, b){
                return +$(a).data('sort') - +$(b).data('sort');
            });
            items.appendTo('.archiveShop__list');
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
  
    /* ---- Check engine ---- */

    $('.engineCheckbox').on('click', function(){
        if($(this).is(":checked")){
            $(this).parent().addClass('checkbox--checked checked');
        }
        else if($(this).is(":not(:checked)")){
            $(this).parent().removeClass('checkbox--checked checked');
        }
    });

    $('.engineRadio').on('click', function(){
        var radioGroupName = $(this).attr('name');
        if($(this).is(":checked")){
            $('input[name="' + radioGroupName + '"]').parent().removeClass('radio-selected');
            $(this).parent().addClass('radio-selected');
        }
    });

    /* ---- Products filter checkboxes ---- */
    $(document).ready(function(){
        var order = getUrlParameter('orderby');
        var onsales = getUrlParameter('onsales');

        if(order == 'date'){
            $('input[name="newestProducts"]').parent().addClass('checkbox--checked');
        }
        if(onsales == 'salesonly'){
            $('input[name="priceDrop"]').parent().addClass('checkbox--checked');
        }
    });
    $('input[name="newestProducts"]').on('click', function(){
        if($(this).is(":checked")){
            $('.sortEngine__select[sortname="date"]').trigger('click');
        }
    });
    $('input[name="priceDrop"]').on('click', function(){
        if($(this).is(":checked")){
            $('input#woof_checkbox_sales').trigger('click');
        }
    });

    /* ---- Product image zoom ---- */
    $(document).ready(function(){
        if($(window).width() > 767){
            var gallery = $('.galleryMain').find('.galleryImage');
            $(gallery).each(function(){
                var wooImage = $(this).find('.galleryImage__wrap');
                var wooImageSource = wooImage.attr('src');
                $(wooImage).zoom({
                    url: wooImageSource,
                    magnify: 1,
                });
            });
        }
    });

    /* ---- Product color variable ---- */
    $(document).ready(function(){
        var attr = $('.color-variable-wrapper').find('.rtwpvs-term');
        
        if($(window).width() < 767){
            $(attr).on('click', function(){
                var color = $(this).attr('data-term');
                var slideno = $('.galleryMain').find('.galleryImage[data-name="' + color + '"]').attr('data-slick-index');
                $('.galleryMain').slick('slickGoTo', slideno);
            });
        }else{
            $(attr).on('click', function(){
                var color = $(this).attr('data-term');
                var slideno = $('.galleryNav').find('.galleryImage[data-name="' + color + '"]').attr('data-slick-index');
                $('.galleryNav').slick('slickGoTo', slideno);
            });
        }
    });

    /* ---- Size modal ---- */
    $(document).ready(function(){
        var openBtn = $('.openSizeModal');
        var closeBtn = $('.closeModal');
        var modal = $('#sizeModal');

        $(openBtn).on('click', function(){
            modal.addClass('sizeModal--ready');
            $('body').addClass('noscroll')

            setTimeout(function(){
                modal.addClass('sizeModal--active');
            }, 350);
        });
        $(closeBtn).on('click', function(){
            modal.removeClass('sizeModal--active');
            $('body').removeClass('noscroll')

            setTimeout(function(){
                modal.removeClass('sizeModal--ready');
            }, 350);
        });
    });

    /* ---- Search bar show ---- */
    $(document).ready(function(){
        var searchModal = $('.searchModal');

        $('.openSearchBar').on('click', function(){
            var button = $(this);
            button.addClass('notallowed');
            setTimeout(function(){
                button.removeClass('notallowed');
            }, 1000);

            if(searchModal.hasClass('searchModal--active')){
                searchModal.find('form').removeClass('active');
                setTimeout(function(){
                    searchModal.removeClass('searchModal--active');
                }, 300);
            }else{
                searchModal.addClass('searchModal--active');
                setTimeout(function(){
                    searchModal.find('form').addClass('active');
                }, 1000);
            }
        });
        $(document).mouseup(function(e){
            var siteHeader = $('.lolosite__header');
            if (!siteHeader.is(e.target) && siteHeader.has(e.target).length === 0) {
                searchModal.find('form').removeClass('active');
                setTimeout(function(){
                    searchModal.removeClass('searchModal--active');
                }, 300);
            }
        });

        var formInput = searchModal.find('input[type="text"]');
        var formSubmit = searchModal.find('input[type="submit"]');
        $(formInput).on('keyup', function(){
            if(formInput.val() !== ''){
                formSubmit.removeClass('notallowed').attr('disabled', false);
            }else{
                formSubmit.addClass('notallowed').attr('disabled', true);;
            }
        });
    });

    /* ---- Header mobile menu ---- */
    var menutoggle = $('.siteHeader__actions').find('.menu-toggle');
    $(menutoggle).on('click', function(){
        $('.mobileMenu').addClass('mobileMenu--active');
        $('body').addClass('noscroll');
    });
    $('.mobileMenu__close').on('click', function(){
        $('.mobileMenu').removeClass('mobileMenu--active');
        $('body').removeClass('noscroll');
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

    /* ---- Login form errors ---- */
    $(document).ready(function(){
        if ($('.woocommerce-form-login ul.woocommerce-error').length) {
            $('ul.woocommerce-error').insertAfter('form.woocommerce-form-login .notices .wc-notices')//where you want to place it
        };
    });

    /* ---- Cart actions ---- */

    /**
     * Set container to cart page
     */
    $(document).ready(function(){
        if($('body').hasClass('woocommerce-cart')){
            $('.woocommerce-notices-wrapper').addClass('container');
        }
    });

    $(document).ready(function(){
        var cartheader = $('.cartHeader__wrap')
        var cartheaderValue = cartheader.find('span');
        var cartItems = $('.summaryPage').attr('itemscount');
        if(!cartheaderValue.text().trim().length){
            if(cartItems){
                cartheaderValue.text('(' + cartItems + ')');
            }
        }

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
        var quantitySelect = $('.cartItem__quantity').find('.dropdownInput__dropdown').find('span');
        var sizeSelect = $('.cartItem__size').find('.dropdownInput__dropdown').find('span');

        $(quantitySelect).on('click', function(){
            var value = $(this).text();
            $(this).parent().removeClass('selectDropdown--active');
            $(this).parent().parent().find('.dropdownInput__current').text(value);
    
            var qtyInput = $(this).parent().parent().parent().find('input.qty');
            qtyInput.attr('value', value).trigger('change');
            setTimeout(function(){
                $("[name='update_cart']").trigger('click').trigger('click');
            }, 500);
        });
        $(sizeSelect).on('click', function(){
            var value = $(this).text();
            $(this).parent().removeClass('selectDropdown--active');
            $(this).parent().parent().find('.dropdownInput__current').text(value);
    
            var sizeInput = $(this).parent().parent().find('input.select_size');
            sizeInput.attr('value', value).trigger('change');
            setTimeout(function(){
                $("[name='update_cart']").trigger('click');
            }, 500);
        });
        

        /* Coupon actions */

        $('input[name="couponInput"]').on('keyup', function() {
            $('#coupon_code').val($(this).val());
        });
        $('.couponInput__submit').on('click', function(){
            $("[name='apply_coupon']").trigger('click');
            $(this).parents('.couponInput').addClass('loading');
        });
        $('.couponInput__delete').on('click', function(){
            $(this).parents('.couponInput').addClass('loading');
        });
        $(document).ready(function(){
            var couponRemove = $('a.woocommerce-remove-coupon').attr('href');
            $('.couponInput__delete').attr('href', couponRemove);
        });

        /* Cart continue error */
        $(document).ready(function(){
            var wrap = $('.loloCart__afterCart');
            var continuebtn = $('.notSelected').find('.tocheckout');

            $(continuebtn).on('mouseenter', function(){
                wrap.addClass('showError');
            });
            $(continuebtn).on('mouseleave', function(){
                setTimeout(function(){
                    wrap.removeClass('showError');
                }, 1000);
            });

            if(wrap.hasClass('notSelected')){
                continuebtn.removeAttr('href');
            }
        });

        /* Delivery select */

        var lang = $('body').attr('lang');
        var deliverySelector = $('input[name="delivery_option"]');
        var deliveryAmount = $('.cartTotals__value[valuename="deliverycost"]');
        var totalValue = $('.cartTotals__sum').find('.cartTotals__value').attr('value');
        var carTotalValue = $('.cartTotals__total').find('span.amount');
        var currency = $('body').attr('currency');
        if($('body').hasClass('woocommerce-cart')){
            var currentTotal = totalValue;
            var couponAmount = $('.couponList__coupon').find('.cartTotals__value').attr('amount');
            var totalDiscount = $('.couponList').attr('totaldiscount');
        }

        /**
         * Get selected shippment ID
         */
        $(document).ready(function(){
            var data = {
                action: 'get_user_shipping_method',
            }
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function(){
                    $('.loloCart__delivery').css('opacity', '.5');
                    $('.loloCart__delivery').css('pointer-events', 'none');
                },
                success: function(response){
                    if($('body').hasClass('woocommerce-checkout')){
                        var lang = $('body').attr('lang');
                        var shipmentID = parseInt(response);
                        if(shipmentID == 11){
                            $('#billing_country_field').css('pointer-events', 'all');
                            $('#billing_country').find('option[value="PL"]').remove();
                        }else{
                            $('#billing_country_field').css('pointer-events', 'none');
                        }
                        $('#shipping_method').find('li[methodid="' + shipmentID + '"]').addClass('radio-selected');
                        $('#shipping_method').find('li[methodid="' + shipmentID + '"]').find('input').trigger('click');
                        setTimeout(function(){
                            $('li[methodid="' + shipmentID + '"]').each(function(){
                                var getname = $(this).find('label')[0].childNodes[0].nodeValue;
                                var name = getname.replace(':', '');
                                var methodid = $(this).attr('methodid');
            
                                $('.checkoutDeliverySelected').removeClass('checkoutDeliverySelected--disable');
                                $('.checkoutDeliverySelected').find('h3').text(name).attr('methodid', methodid);
                                $('.summaryPage__shipping').find('.name').text(name).attr('methodid', methodid);
            
                                if(methodid == 8 && methodid == 11){
                                    $('.checkoutDeliverySelected').find('.pointname').removeClass('visible');
                                    $('.checkoutDeliverySelected').find('.selectPoint').removeClass('visible');
                                }
                                if(methodid == 9){
                                    $('.checkoutDeliverySelected').find('.pointname').addClass('visible');
                                    $('.checkoutDeliverySelected').find('.pointname').text($('#selected-point').text());
                                    $('.btn.selectPoint').addClass('visible');
                                }
                            });
                        }, 100);
            
                        if(shipmentID > 0){
                            $('.checkoutDeliverySelect').slideUp();
                            if(lang == 'pl-PL'){
                                $('.checkoutPage__delivery').find('.heading').find('h3').text('Wybrany sposób dostawy');
                            }else{
                                $('.checkoutPage__delivery').find('.heading').find('h3').text('Selected delivery method');
                            }
                        }else{
                            if(lang == 'pl-PL'){
                                $('.checkoutPage__delivery').find('.heading').find('h3').text('Wybierz sposób dostawy');
                            }else{
                                $('.checkoutPage__delivery').find('.heading').find('h3').text('Select delivery method');
                            }
                        }
                    }else{
                        $('.loloCart__delivery').css('opacity', '1');
                        $('.loloCart__delivery').css('pointer-events', 'all');
                        if(response !== 'error'){
                            $('.deliveryList__option[methodid="id_' + response + '"]').addClass('deliveryList__option--checked');
                            $('#method_' + response).trigger('click');
                            var selectedOptionAmount = $('.deliveryList__option[methodid="id_' + response + '"]').attr('methodamount');
                            if(selectedOptionAmount == '0'){
                                if(lang == 'pl-PL'){
                                    deliveryAmount.find('p').text('ZA DARMO');
                                }else{
                                    deliveryAmount.find('p').text('FREE');
                                }
                            }else{
                                deliveryAmount.find('p').text(selectedOptionAmount + ' ' + currency);
                            }
                        }else{
                            console.error('Brak wybranego sposobu dostawy');
                        }
                    }
                },
            });
        });

        /**
         * System delivery click
         */
        var delieryOption = $('#shipping_method').find('.shipping_method');
        $(delieryOption).on('click', function(){
            var id = $(this).parent().attr('methodid');
            var data = {
                action: 'add_user_shipping_method',
                methodid: id,
            }
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                success: function(response){
                    console.log(response);
                },
            })
        });

        $(deliverySelector).on('click', function(){
            var buttonhref = $('.woocommerce-cart-form').attr('checkout');
            $('.loloCart__afterCart').removeClass('notSelected');
            $('.loloCart__afterCart').find('.tocheckout').attr('href', buttonhref);

            var methodID = $(this).attr('methodid');
            $('#shipping_method').find('li[methodid="' + methodID + '"]').find('input').trigger('click');

            var selectedAmount = $(this).parent().parent().attr('methodamount');
            $('.deliveryList__option').removeClass('deliveryList__option--checked');

            if(couponAmount){
                var updateTotal = parseFloat(totalDiscount) + parseFloat(selectedAmount);
            }else{
                console.log(totalValue);
                var updateTotal = parseFloat(currentTotal) + parseFloat(selectedAmount);
            }
            var totalAmount = updateTotal;
            
            if($(this).is(":checked")){
                $(this).parent().parent().addClass('deliveryList__option--checked');
            }
            else if($(this).is(":not(:checked)")){
                $(this).parent().parent().removeClass('deliveryList__option--checked');
            }

            if(selectedAmount !== '0'){
                var totalAmountFormated = totalAmount.toFixed(2).toString().replace(".", ",");
                deliveryAmount.find('p').text(selectedAmount + ' ' + currency);
                carTotalValue.html(totalAmountFormated + ' ' + currency);
            }else{
                var totalAmountFormated = totalAmount.toFixed(2).toString().replace(".", ",");
                if(lang == 'pl-PL'){
                    deliveryAmount.find('p').text('ZA DARMO');
                }else{
                    deliveryAmount.find('p').text('FREE');
                }
                carTotalValue.html(totalAmountFormated + ' ' + currency);
            }

            var data = {
                action: 'add_user_shipping_method',
                methodid: methodID,
            }
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                success: function(response){
                    console.log(response);
                },
            })
        });

        /* Product page - variation update price */

        $(document).on('found_variation.first', function(event, variation) {
            var currency = $('body').attr('currency');
            var price = parseFloat(variation.display_price);
            var priceFormated = price.toFixed(2).toString().replace(".", ",");
            $('.price--variation').html('<span>' + priceFormated + ' ' + currency + '</span>');
        });

        setTimeout(function(){
            if($('.variations_form').length){
                $('.variations_form').each(function() {
                    $(this).on('found_variation', function( event, variation ) {
                        var currency = $('body').attr('currency');
                        var price = parseFloat(variation.display_price);
                        var priceFormated = price.toFixed(2).toString().replace(".", ",");
                        $('.price--variation').html('<span>' + priceFormated + ' ' + currency + '</span>');
                    });
                });
            }
        }, 500);

        /* Product page - available alert */
        $(document).ready(function(){
            var form = $('form.availableForm');
            var submit = form.find('input[type="button"]');
            $(submit).on('click', function(){
                form.trigger('submit');
            });
            $('input[name="availableAlert"]').on('click', function(){
                if($(this).is(":checked")){
                    $(this).parent().addClass('checked');
                    submit.trigger('click');
                }
            });
            $(form).submit(function(e){
                var name = form.find('input[type="text"]').val();
                $.ajax({ 
                     data: {action: 'availableForm', name:name},
                     type: 'post',
                     url: ajaxurl,
                     success: function(data) {
                          console.log('done');
                    }
                });
                return false;
            });

            if(form.length){
                $('.productContent__summary').addClass('notavailable');
            }
        });

        /* Checkout login - register forms */

        function openRegisterForm(){
            /* Hide login form */
            $('.checkoutLogin').removeClass('checkoutLogin--visible');
            $('.checkoutUser__change').find('.toRegister').removeClass('changeBox--ready');
            $('.checkoutUser__change').find('.toLogin').addClass('changeBox--ready');
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
        }
        function openLoginForm(){
            /* Hide register form */
            $('.checkoutRegister').removeClass('checkoutRegister--visible');
            $('.checkoutUser__change').find('.toLogin').removeClass('changeBox--ready');
            $('.checkoutUser__change').find('.toRegister').addClass('changeBox--ready');
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
        }

        /* ---- Reset pass notices ---- */
        $(document).ready(function(){
            var resetStatus = getUrlParameter('password-reset');

            if(resetStatus == 'true'){
                $('.checkoutLogin').find('.notices').append('<p class="success">Twoje hasło zostało zmienione, zaloguj się za pomocą nowego hasła.</p>');
            }
        });

        /**
         * Register sent
         */
        $(document).ready(function(){
            jQuery.validator.setDefaults({
                debug: false,
                success: 'valid'
            });
            $('form[name="checkoutRegisterForm"]').validate({
                // Specify validation rules
                rules: {
                    registerUsername: "required",
                    registerUseremail: {
                        required: true,
                        email: true
                    },
                    registerUserpassword: {
                        required: true,
                        minlength: 8
                    },
                    registerConsent: {
                        required: true,
                    },
                },
                messages: {
                    registerUsername: "Wprowadź imię i nazwisko",
                    registerUserpassword: {
                        required: "Wprowadź hasło",
                        minlength: "Twoje hasło musi posiadać przynajmniej 8 znaków"
                    },
                    registerUseremail: "Wprowadź prawidłowy adres e-mail",
                    registerConsent: "<p>Potwierdź zapoznanie z regulaminem sklepu</p>",
                },
            });

            $('#checkoutRegisterForm').on('submit', function(e){
                e.preventDefault();
                var form = $(this),
                    id = form.find('input[name="register-formid"]').val(),
                    name = form.find('input[name="registerUsername"]').val(),
                    email = form.find('input[name="registerUseremail"]').val(),
                    pass = form.find('input[name="registerUserpassword"]').val(),
                    newsletter = false;

                if(form.find('input[name="mc4wp-subscribe"]').parent().hasClass('checked')){
                    newsletter = true;
                }
                
                var data = {
                    action: 'registerForm',
                    formID: id,
                    user: name,
                    email: email,
                    pass: pass,
                    newsletter: newsletter,
                }
                form.validate();

                if(form.valid() == true){
                    console.log(data);
                    $.ajax({ 
                        type: 'POST',
                        url: ajaxurl,
                        data: data,
                        success: function(response) {
                            console.log(response);
                            if(response == 'done'){
                                if($('body').attr('lang') == 'pl-PL'){
                                    window.location.href = '/moje-konto';
                                }else{
                                    window.location.href = '/en/my-account';
                                }
                            }else if(response == 'done - zamowienie'){
                                if($('body').attr('lang') == 'pl-PL'){
                                    window.location.href = '/zamowienie';
                                }else{
                                    window.location.href = '/en/checkout';
                                }
                            }else if(response == 'failed' || response == 'failed - zamowienie'){
                                form.find('.notices').append('<p class="error">Na podany adres e-mail jest już zarejestrowane konto użytkownika.</p>');
                            }
                        }
                    });
                }
            });
        });

        /* ---- Register notices ---- */

        $(document).ready(function(){
            var registerStatus = getUrlParameter('registerstatus');
            var reason = getUrlParameter('reason');

            if(registerStatus == 'failed'){
                console.log('failed');
                openRegisterForm();
                if(reason == 'email'){
                    $('#checkoutRegisterForm').find('.notices').append('<p class="error">Na podany adres e-mail jest już zarejestrowane konto użytkownika.</p>');
                }else{
                    $('#checkoutRegisterForm').find('.notices').append('<p class="error">Wystąpił błąd podczas rejestracji konta.</p>');
                }
            }else if(registerStatus == 'success'){
                $('.checkoutLogin').find('.notices').append('<p class="success">Twoje konto zostało pomyślnie założone.</p>');
            }
        });

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

        var openRegister = $('.checkoutUser__change').find('.openRegister');
        var openLogin = $('.checkoutUser__change').find('.openLogin');

        $(openRegister).on('click', function(){
            openRegisterForm();
        });
        $(openLogin).on('click', function(){
            openLoginForm();
        });
    });

    /**
     *  Guest checkout
     */
    $(document).ready(function(){
        var createAccount = true;

        function checkStatus(){
            if(createAccount == true){
                var acceptance = $('.accountCreator__acceptance').find('.checkbox.top');
                if(!acceptance.hasClass('checked')){
                    $('.checkoutPage__nextstep').find('.nextStep').css('filter', 'grayscale(1)');
                    $('.checkoutPage__nextstep').find('.nextStep').css('pointer-events', 'none');
                }else{
                    $('.checkoutPage__nextstep').find('.nextStep').css('filter', 'grayscale(0)');
                    $('.checkoutPage__nextstep').find('.nextStep').css('pointer-events', 'all');
                }
            }else{
                $('.checkoutPage__nextstep').find('.nextStep').css('filter', 'grayscale(0)');
                $('.checkoutPage__nextstep').find('.nextStep').css('pointer-events', 'all');
            }
        }
        // Open checkout guest
        $('.continueGuest').on('click', function(){
            // Close login
            $('.checkoutUser').removeClass('checkoutUser--visible');
            setTimeout(function(){
                $('.checkoutUser').removeClass('checkoutUser--ready');
            }, 300);

            // Change step
            $('body').removeClass('checkout-step2');
            $('body').addClass('checkout-step3');
            $('.cartProgress').find('.step-3').addClass('cartProgress__step--active').addClass('cartProgress__arrow--active');

            // Open checkout
            setTimeout(function(){
                $('.checkoutPage').addClass('checkoutPage--ready')
            }, 300);
            setTimeout(function(){
                $('.checkoutPage').addClass('checkoutPage--visible');
            }, 500);
        });

        // Create account guest
        $('input[name="checkout_create_account"]').on('click', function(){
            if($(this).is(":checked")){
                $(this).parent().addClass('checked');

                createAccount = true;
                $('#createaccount').trigger('click');
                $('.accountCreator').slideDown();

                checkStatus();
            }else if($(this).is(":not(:checked)")){
                $(this).parent().removeClass('checked');

                createAccount = false;
                $('#createaccount').trigger('click');
                $('.accountCreator').slideUp();

                checkStatus();
            }
        });
        $('input[name="checkoutUserPass"]').on('keyup paste', function(){
            var val = $(this).val();
            $('#account_password').val(val);
        });
        $('.changeVisibility').on('click', function(){
            $(this).toggleClass('enable');
            $('input[name="checkoutUserPass"]').attr('type', function(index, attr){
                return attr == 'text' ? 'password' : 'text';
            });
        });
        $('input[name="registerConsent"]').on('click', checkStatus);
    });

    /* Checkout form custom */

    $(document).ready(function(){
        var clientname = $('.checkoutPage').attr('clientname');
        $('input#billing_username').val(clientname);

        var formBillingInputs = $('.checkoutForm__billing').find('input[type="text"]');
        $(formBillingInputs).on('change keyup', function(){
            var value = $(this).val();
            var name = $(this).attr('name');
            $('input[name="' + name + '"]').val(value).trigger('submit');

            var inputPhone = $(this).parent().find('input[name="billing_phone"]');
            if(inputPhone.val() == '' || inputPhone.val().length <= 8){
                inputPhone.removeClass('inputSuccess').addClass('inputError');
            }else if (inputPhone.val() !== '' && inputPhone.val().length >= 9){
                inputPhone.removeClass('inputError').addClass('inputSuccess');
            }

            var inputMail = $(this).parent().find('input[name="billing_email"]');
            if(inputMail.val() == ''){
                inputMail.removeClass('inputSuccess').addClass('inputError');
            }else{
                inputMail.removeClass('inputError').addClass('inputSuccess');
            }
        });
        $('input[name="checkoutUserPass"]').on('change keyup', function(){
            if($(this).val() == ''){
                $(this).removeClass('inputSuccess').addClass('inputError');
            }else{
                $(this).removeClass('inputError').addClass('inputSuccess');
            }
        });
        var formBillingInputs = $('.checkoutForm__billing').find('input.engineRadio');
        $(formBillingInputs).on('click', function(){
            var value = $(this).attr('value');
            var name = $(this).attr('forfield');
            $('input[name="' + name + '"][value="' + value + '"]').attr('checked', true).trigger('click');
        });

        $('.customCheckbox[name="billing_paperinvoice"]').on('click', function(){
            if($(this).is(":checked")){
                $(this).parent().addClass('checked');
                if($('input#billing_paperinvoice_true').is(':not(:checked)')){
                    $('input#billing_paperinvoice_true').trigger('click');
                }
            }
            else if($(this).is(":not(:checked)")){
                $(this).parent().removeClass('checked');
                if($('input#billing_paperinvoice_false').is(':not(:checked)')){
                    $('input#billing_paperinvoice_false').trigger('click');
                }
            }
        });
        $('.customCheckbox[name="billing_gift"]').on('click', function(){
            if($(this).is(":checked")){
                $(this).parent().addClass('checked');
                if($('input#billing_gift_true').is(':not(:checked)')){
                    $('input#billing_gift_true').trigger('click');
                }
            }
            else if($(this).is(":not(:checked)")){
                $(this).parent().removeClass('checked');
                if($('input#billing_gift_false').is(':not(:checked)')){
                    $('input#billing_gift_false').trigger('click');
                }
            }
        });
    });

    $(document).ready(function(){
        var input = $('.radio__option').find('input');

        $(input).on('click', function(){
            if($(this).attr('value') == 'private'){
                $('.checkoutForm__billing').find('.comapnyField').removeClass('visible').removeClass('required');
                setTimeout(function(){
                    $('.checkoutForm__billing').find('.comapnyField').removeClass('ready');
                    $('.checkoutForm__billing').find('.comapnyField').val('');
                    $('.checkoutForm__billing').find('.comapnyField').removeClass('inputSuccess').removeClass('inputError');
                    $('.woocommerce-billing-fields__field-wrapper').find('input[name="billing_company"]').val('');
                    $('.woocommerce-billing-fields__field-wrapper').find('input[name="billing_company_nip"]').val('');
                }, 300);
            }
            if($(this).attr('value') == 'business'){
                $('.checkoutForm__billing').find('.comapnyField').addClass('ready').addClass('required');
                setTimeout(function(){
                    $('.checkoutForm__billing').find('.comapnyField').addClass('visible');
                }, 300);
                var companyName = $('.comapnyField.required[name="billing_company"]');
                $(companyName).on('change keyup', function(){
                    if($(this).val() == ''){
                        $(this).removeClass('inputSuccess').addClass('inputError');
                    }else{
                        $(this).removeClass('inputError').addClass('inputSuccess');
                    }
                });
                var NIPfield = $('.comapnyField.required[name="billing_company_nip"]');
                $(NIPfield).on('change keyup', function(){
                    if($(this).val() == '' || $(this).val().length <= 9){
                        $(this).removeClass('inputSuccess').addClass('inputError');
                    }else{
                        $(this).removeClass('inputError').addClass('inputSuccess');
                    }
                });
            }
        });
    });

    $('.checkoutForm').on('DOMNodeInserted', function(e) {
        setTimeout(function(){
            if($('#billing_phone_field').hasClass('woocommerce-invalid')){
                $('.checkoutForm__billing').find('input[name="billing_phone"]').removeClass('inputSuccess').addClass('inputError');
            }
            if($('#billing_email_field').hasClass('woocommerce-invalid')){
                $('.checkoutForm__billing').find('input[name="billing_email"]').removeClass('inputSuccess').addClass('inputError');
            }
            if($('#account_password_field').hasClass('woocommerce-invalid')){
                $('input[name="checkoutUserPass"]').removeClass('inputSuccess').addClass('inputError');
            }
        }, 500);
    });
    $(document.body).on('checkout_error', function(){
        setTimeout(function(){
            console.log('phone-error');
        }, 1000);
    });

    ///////////// Validate /////////////

    // Validate newsletter
    $(document).ready(function(){
        var form = $('.newsletter').find('form');
        var email = form.find('input[name="email-621"');
        var button = form.find('input[type="submit"');
        var acceptance = form.find('input[name="_mc4wp_subscribe_contact-form-7"]');
        var acceptanceError = form.find('.acceptanceError');
        var action = form.attr('action');
        form.attr('action', '');
        // button.prop('disabled' ,true);

        $(acceptance).on('click', function(){
            if(acceptance.is(":checked")){
                acceptanceError.css('display', 'none');
                button.prop('disabled', false);
            }else if(acceptance.is(':not(:checked)')){
                acceptanceError.css('display', 'block');
                button.prop('disabled', true);
            }
        });

        $(button).on('click', function(){
            if(acceptance.is(":checked")){
                form.removeAttr('action');
                button.prop('disabled', false);
            }else if(acceptance.is(":not(:checked)")){
                form.attr('action', action);
                button.prop('disabled', true);
                acceptanceError.css('display', 'block');
            }
        });
        $(email).on('keyup', function(){
            if($(this).hasClass('wpcf7-not-valid')){
                $(this).parent().find('.wpcf7-not-valid-tip').css('opacity', '0');
                $(this).removeClass('wpcf7-not-valid');
            }
        });
    });

    $('input[name="registerUsername"]').keyup(function(e) {
        var regex = /^[ a-zA-Zęóąśłźżćń-]+$/;
        if (regex.test(this.value) !== true){
            this.value = this.value.replace(/[^a-zA-Z ]+/, '');
        }
    });
    $('input[name="registerUseremail"]').keyup(function(e) {
        var regex = /^[a-zA-Z0-9@._-]+$/;
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

    // /////////////  Hide shipment options on select - and clone data //////////////
    // $(document).ready(function(){
    //     if($('body').hasClass('woocommerce-checkout')){
    //         var shipmentoption = $('#shipping_method').find('li');
    //         $(shipmentoption).on('click', function(){
    //             var getname = $(this).find('label')[0].childNodes[0].nodeValue;
    //             var name = getname.replace(':', '');
    //             var methodid = $(this).attr('methodid');

    //             $('.checkoutDeliverySelected').removeClass('checkoutDeliverySelected--disable');
    //             $('.checkoutDeliverySelected').find('h3').text(name).attr('methodid', methodid);
    //             $('.summaryPage__shipping').find('.name').text(name).attr('methodid', methodid);

    //             if(methodid == 8){
    //                 $('.checkoutDeliverySelected').find('.pointname').removeClass('visible');
    //                 $('.checkoutDeliverySelected').find('.selectPoint').removeClass('visible');
    //             }
    //             if(methodid == 9){
    //                 $('.checkoutDeliverySelected').find('.pointname').addClass('visible');
    //                 $('.btn.selectPoint').addClass('visible');
    //             }

    //             setTimeout(function(){
    //                 $('.checkoutDeliverySelect').slideUp();
    //             }, 200);
    //             setTimeout(function(){
    //                 location.reload();
    //             }, 300);
    //         });
    //     }
    // });

    /////////////  Open shipment methods on click  //////////////
    $(document).ready(function(){
        var selectedPoint = $('#furgonetkaPointName').val();
        if(selectedPoint){
            $('.checkoutDeliverySelected').find('.pointname').text(selectedPoint);
            $('.btn.selectPoint').addClass('visible');
        }
        $('#select-point').removeAttr('href');

        $('.changeShipmentMethod').on('click', function(){
            $('.checkoutDeliverySelect').slideDown();
        });

        $('.selectPoint').on('click', function(){
            if($('#furgonetkaPointName').length){
                console.log($('#furgonetkaPointName').attr('value'));
            }
            $('#select-point').trigger('click');
        });
        $('#furgonetkaPointName').on('change', function(){
            var val = $(this).attr('value');
            $('.checkoutDeliverySelected').find('.pointname').text(val);
        });
        
        var updatePointName;
        if($('.checkoutPage').hasClass('checkoutPage--ready')){
            updatePointName = setInterval(function(){
                var pointName;
                var currentPoint = $('.checkoutDeliverySelected').find('.pointname').text();
                if($('#furgonetkaPointName').length){
                    pointName = $('#furgonetkaPointName').attr('value');
                    if(pointName !== currentPoint){
                        $('.checkoutDeliverySelected').find('.pointname').text(pointName);
                    }
                }
            }, 100);
        }else{
            clearInterval(updatePointName);
        }
    });

    ///////////// Checkout form - nav ///////////////
    // $(document).ready(function(){
    //     var checkoutNext = $('.nextStep');

    //     $(checkoutNext).on('click', function(){
    //         $('#place_order').trigger('click');
    //     });
    // });

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

    /* ---- FAQ accordeon ---- */
    
    // set first item of list to opened
    function openFirstItem(list) {
        $('.faq__answer').css("height", "auto");
        var initialHeight = $(list).find('.faq__item .faq__answer p').eq(0).outerHeight();
        $('.faq__answer').css("height", "0");
        $(list).find('.faq__item .faq__answer').eq(0).css("height", initialHeight + 102);
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

    $(document).ready(function(){
        $('.faq__filtersList').find('.faq__filter:first').addClass('active');
        $('.faq__list:first').addClass('active');
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

    /* ---- Thank you page breadcrumbs ---- */
    $(document).ready(function(){
        var bread = $('.woocommerce-order-received').find('.loloBreadcrumbs').find('a:last');
        bread.text('Podziękowanie');
    });
    /* ---- Thank you page review form ---- */
    $(document).ready(function(){
        var star = $('.form__stars').find('.star');

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

    /* ---- MINI CART ---- */
    function closeButton(){
        $('.closeMiniCart').on('click', function(){
            closeMiniCart();
        });
    }
    function closeMiniCart(){
        $('.miniCart').css('opacity', '0').css('pointer-events', 'none');
        closeButton();
    }
    function openMiniCart(){
        $('.miniCart').css('opacity', '1').css('pointer-events', 'all');
        closeButton();
    }
    $('.openMiniCart').on('click', function(){
        openMiniCart();
    });
    $('.closeMiniCart').on('click', function(){
        closeMiniCart();
    });
    $(document).mouseup(function(e){
        var miniCart = $('.miniCart');
        if (!miniCart.is(e.target) && miniCart.has(e.target).length === 0) {
            closeMiniCart();
        }
    });
    $(document.body).on('updated_wc_div', closeButton);
    $(document.body).on('updated_cart_totals', closeButton);

    // if($(window).width() < 767){
    //     $('.openMiniCart').removeClass('openMiniCart').attr('href', '/koszyk');
    //     $('.miniCart').remove();
    // }

    /* Masonry gallery - collection */
    if($('.collectionGallery__images').length){
        var masonryGallery = Macy({
            container: '.collectionGallery__images',
            trueOrder: false,
            waitForImages: false,
            margin: 20,
            columns: 2,
            breakAt: {
                767: 1,
            }
        });
    }

    /* Wishlist remove items */
    $(document).ready(function(){

        $('.tinvwl-remove').on('click', function(){
            var form = $(this).parent().find('form.productTile__form');
            form.trigger('submit');
        });
        $('form.productTile__form').submit(function(e){
            var wishlistID = $(this).find('input').attr('value');
            $('.wishlistPage__form').css('opacity', '0.5');
            
            $.ajax({ 
                data: {
                    action: 'wishlistDelete',
                    id: wishlistID,
                },
                type: 'post',
                url: ajaxurl,
                success: function(data) {
                    setTimeout(function(){
                        location.reload();
                   }, 100); 
                }
            });
            return false;
        });
    });

    /* Newsletter popup */
    function openNewsletterPopup(){
        var popup = $('.newsletterPopup');
        popup.addClass('newsletterPopup--ready');
        setTimeout(function(){
            popup.addClass('newsletterPopup--active');
        }, 300);
    }
    function closeNewsletterPopup(){
        var popup = $('.newsletterPopup');
        popup.removeClass('newsletterPopup--active');
        setTimeout(function(){
            popup.removeClass('newsletterPopup--ready');
        }, 300);
    }

    $(document).ready(function(){
        if($('.newsletterPopup').length){
            setTimeout(function(){
                $.ajax({
                    type: 'POST', 
                    url: ajaxurl,
                    data: {
                        action: 'newsletter_get_cookie',
                    },
                    success: function(data) {
                        if(data !== 'true'){
                            console.log('Newsletter popup cookie is NOT active - popup showed');
                            openNewsletterPopup();
                        }else{
                            console.log('Newsletter popup cookie active');
                        }
                    }
                })
            }, 5000);
            $('.newsletterPopup__close').on('click', function(){
                closeNewsletterPopup();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'newsletter_set_cookie',
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        }else{
            console.log('Current user subscribe newsletter');
        }
    });

    /*
     *  Product page color variant select
     */
    $(document).ready(function(){
        $('.productColors__color').each(function(){
            var href = $(this).attr('href');
            var curr = window.location.href;
            if(href == curr){
                $(this).addClass('productColors__color--active');
            }
        });
        $('.productColors__color').on('click', function(){
            $('.productColors__color').removeClass('productColors__color--active');
            $(this).addClass('productColors__color--active');
        });
    });
});
