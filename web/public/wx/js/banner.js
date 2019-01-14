$(function(){
    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true
    });
    
    $('.click_banner').click(function(){
        if($('#click_banner_img').attr('alt') == '嘉兴市首届创新创业大赛'){
            _czc.push(['_trackEvent','嘉兴市首届创新创业大赛','嘉兴子平台banner','','','click_banner_img']);
        }
    });

    var hideCategory;
    $(".banner-up .add-category li").hover(function() {
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".category-list").eq($(this).index()).show().siblings(".category-list").hide();
        $(this).children().css("color","#222");
        if( !$(".category-list").eq($(this).index()).children().html() ){
            $(".category-list").eq($(this).index()).css({"min-height":"0","border":"none"});
        }
    })
    $(".banner-up .add-category li").on("mouseleave",function() {
        var index = $(this).index();
        var that = $(this);
        that .children().css("color","#fff");
        hideCategory=setTimeout(function(){
            that.removeClass("active");
            $(".category-list").eq(index).hide();
        },50);
    })
    $(".banner-up .category-list").hover(function() {
        clearTimeout(hideCategory);
        $(this).show();
        $(".banner-up .add-category li").eq($(this).index()-1).children().css("color","#222");
    })
    $(".banner-up .category-list").on("mouseleave",function() {
        $(this).hide();
        $(".banner-up .add-category li").eq($(this).index()-1).removeClass("active");
        $(".banner-up .add-category li").eq($(this).index()-1).children().css("color","#fff");
    })

})

