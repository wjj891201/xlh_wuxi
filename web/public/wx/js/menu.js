$(function() {
    $(window).load(function() {
        newHeader();
    });

    $(window).scroll(function() {
        newHeader();
    });

    function newHeader() {
        if ($('.ad-top').is(':visible')) {
            if($(window).scrollTop() > 150) {
                $('.menu-container').addClass("pull-down");
                $('.top_header').css('margin-bottom', 64);
            } else {
                $('.menu-container').removeClass("pull-down");
                $('.top_header').css('margin-bottom', 0);
            }
        } else {
            if($(window).scrollTop() > 30) {
                $('.menu-container').addClass("pull-down");
                $('.top_header').css('margin-bottom', 64);
            } else {
                $('.menu-container').removeClass("pull-down");
                $('.top_header').css('margin-bottom', 0);
            }
        }
    }

});