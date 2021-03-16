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

});
