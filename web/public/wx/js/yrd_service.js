$(function(){
    var life2 = $('input[name="loans_date2"]'),
        quota2 = $('input[name="loans_num2"]');
    $('#daikuan_submit').click(function() {
        life2.val($('#J_life2').attr('data-value'));
        quota2.val($('#J_quota2').attr('data-value'));
        var loans_date2 = $('#J_life2').attr('data-value')=='' ? 3 : $('#J_life2').attr('data-value');
        var loans_num2 = $('#J_quota2').attr('data-value')=='' ? 500 : $('#J_quota2').attr('data-value');
        console.log(loans_num2);
        console.log(loans_date2);
        window.location.href='/yrd/goods/search/'+loans_num2+'-'+loans_date2+'-0-0-0-0-0-0-0-0-0-0-0';
    });

    (function() {
        var item2 = $('.f-item'),
            wrap2 = $('.f-wrap');


        $.each(item2, function(index, elem) {
            $(elem).click(function() {
                var span = $(this).find('span'),
                    li = $(this).find('li');

                wrap2.find('ul').hide();
                $(this).find('ul').stop().slideDown(200);

                li.click(function() {
                    $(this).closest('ul').hide();
                    span.text($(this).text());
                    span.attr('data-value', $(this).attr('data-value'));
                    return false;
                });

                return false;
            });
        });

        $(document).click(function() {
            item2.find('ul').hide();
        });
    })();

});