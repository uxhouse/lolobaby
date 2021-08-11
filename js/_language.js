$(document).ready(function(){
    var langs = $('#lang_sel_list').find('li');
    
    $(langs).each(function(){
        var lang = $(this).attr('class').replace('icl-', '');
        var status = $(this).find('a').attr('class');

        if(status == 'lang_sel_sel'){
            $('.language__select').append('<div class="lang lang--active" data-lang="' + lang + '"><img src="/wp-content/themes/lolobaby/images/lang/' + lang + '.png"/></div>');
        }else{
            $('.language__select').append('<div class="lang" data-lang="' + lang + '"><img src="/wp-content/themes/lolobaby/images/lang/' + lang + '.png"/></div>');
        }
    });

    $('.lang').on('click', function(){
        var lang = $(this).attr('data-lang');
        var href = $('li.icl-' + lang).find('a').attr('href');
        window.location.replace(href);
    });
});