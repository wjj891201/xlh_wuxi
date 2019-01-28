$(function () {

    // 股权项目id
    var id = $('#project_id').val();
    // 项目名称
    var bp_name = $('#bp_name').text();

    // 项目简介，超过三行折叠，出现“展开”按钮
    var instro = $("#introduction");
    var ph = instro.height();
    if (ph > 60) {
        instro.css('height', 60);
        $('.down').css('display', 'inline-block');
        $('#open').click(function () {
            if ($(this).hasClass('down')) {
                $(this).removeClass('down').addClass('up');
                instro.css('height', 'auto');
            } else {
                $(this).removeClass('up').addClass('down');
                instro.css('height', 60);
            }
        });
    }
    // 右侧tab状态
    var containers = $('.container');
    var item_jz = containers[0].offsetTop,
            item_xq = containers[1].offsetTop - 20,
            gs_group = containers[2].offsetTop - 20,
            rz_info = containers[3].offsetTop - 20;
    $(window).scroll(function () {
        if ($(window).scrollTop() > item_jz) {
            $('.nav-right').addClass('nav-right-scoll').removeClass('nav-right-scoll-fr');
        } else {
            $('.nav-right').removeClass('nav-right-scoll').addClass('nav-right-scoll-fr');
        }

        if ($(window).scrollTop() > item_xq && $(window).scrollTop() < gs_group) {
            $('.nav-right').find('li').removeClass('active').eq(1).addClass('active');
        } else if ($(window).scrollTop() > gs_group && $(window).scrollTop() < rz_info) {
            $('.nav-right').find('li').removeClass('active').eq(2).addClass('active');
        } else if ($(window).scrollTop() > rz_info) {
            $('.nav-right').find('li').removeClass('active').eq(3).addClass('active');
        } else if ($(window).scrollTop() < item_xq) {
            $('.nav-right').find('li').removeClass('active').eq(0).addClass('active');
        }

        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
            $('.nav-right').find('li').removeClass('active').eq(3).addClass('active');
        }
    });
    // 锚点跳转
    $('.nav-right li').click(function () {
        var _index = $(this).index();
        $('html, body').animate({scrollTop: containers[_index].offsetTop - 19});
    });
    // 弹窗关闭
    $('.close-ico').click(function () {
        $('.overlay').hide();
        $('.popup').hide();
    });

    // 工作履历超过三行显示展开按钮
    $('.resume p').each(function () {
        var rH = $(this).height();
        if (rH > 60) {
            $(this).css('height', 60);
            $(this).siblings('.rs-open').show();
        }
    });
    // 工作履历展开收起
    $('.rs-open').on('click', function () {
        if ($(this).hasClass('rs-open')) {
            $(this).addClass('rs-down').removeClass('rs-open').text('收起');
            $(this).siblings('p').css('height', 'auto').parents('.inbox').css({'height': 'auto', 'z-index': 99});
            $(this).parents('li').siblings().find('.resume').children('p').css('height', 60)
                    .siblings('#rs-open').addClass('rs-open').removeClass('rs-down').text('展开')
                    .parents('.inbox').css({'height': '210', 'z-index': 0});
        } else {
            $(this).addClass('rs-open').removeClass('rs-down').text('展开');
            $(this).siblings('p').css('height', 60).parents('.inbox').css({'height': 210});
        }

    });

    // 点击关注
    $('#follow').click(function () {
        _czc.push(['_trackEvent', '股权项目详情页', '关注', bp_name, '', 'follow']);
        if ($('#id').val() == '') {
            login_alert();
        } else if ($('#type').val() != 2) {
            other_alert('抱歉！该功能仅对投资人开放');
        } else {
            follow_ajax(id);
        }
    });

    // 点击分享
    $('#share').click(function () {
        _czc.push(['_trackEvent', '股权项目详情页', '分享', bp_name, '', 'share']);
        $.ajax({
            url: window.shareUrl,
            type: "POST",
            dataType: "json",
            async: false,
            data: {id: id},
            success: function (data) {

            }
        });
    });

    // 约谈弹窗
    $('#yuetan').click(function () {
        _czc.push(['_trackEvent', '股权项目详情页', '约谈项目', bp_name, '', 'yuetan']);
        if ($('#id').val() == '') {
            login_alert();
        } else if ($('#type').val() != 2) {
            other_alert('抱歉！该功能仅对认证投资人开放');
        } else if (!$('#read_priv').val()) {
            auth_alert();
        } else {
            yuetan_ajax(id);
        }
    });

    // 下载商业计划书
    $('#business').click(function () {
        _czc.push(['_trackEvent', '股权项目详情页', '商业计划书下载', bp_name, '', 'business']);
        if ($('#id').val() == '') {
            login_alert();
            return false;
        } else if ($('#type').val() != 2) {
            other_alert('抱歉！该功能仅对认证投资人开放');
            return false;
        } else if (!$('#read_priv').val()) {
            auth_alert();
            return false;
        } else {
            business_ajax();
            return true;
        }
    });

    // 融资详情
    $('.investor-btn').click(function () {

        if ($('#id').val() == '') {
            login_alert();
            return false;
        } else if ($('#type').val() != 2) {
            other_alert('抱歉！该功能仅对认证投资人开放');
            return false;
        } else if (!$('#read_priv').val()) {
            auth_alert();
            return false;
        }
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 150) {
            $('.backtotop').fadeIn(600);
        } else {
            $('.backtotop').fadeOut(600);
        }
    });

    $('.backtotop').click(function () {
        $('html, body').animate({scrollTop: 0});
    });

    $(".share").on("click", function (e) {
        $(".QR-code").show();
        $(document).one("click", function () {
            $(".QR-code").hide();
        });
        e.stopPropagation();
    });
});

// 约谈操作
function yuetan_ajax(id) {
    var yuetan_byn = $('#yuetan');
    $.ajax({
        url: window.yueTanUrl,
        type: "POST",
        dataType: "json",
        async: false,
        data: {id: id},
        success: function (data) {
            if (data.info == "success") {
                yuetan_byn.removeClass().addClass("interview-already").html('已发出约谈申请');
                yuetan_byn.unbind('click');
                success_alert(data.msg);
            } else {
                other_alert(data.msg);
            }
        }
    });
}

// 关注／取消关注
function follow_ajax(id) {
    var follow_btn = $('#follow');
    $.ajax({
        url: window.followUrl,
        type: "POST",
        dataType: "json",
        async: false,
        data: {id: id},
        success: function (data) {
            if (data.info == "success") {
                if (follow_btn.hasClass('follow')) {
                    follow_btn.removeClass('follow').addClass('cancel').text('取消关注').prepend('<i class="heart-ico"></i>');
                } else {
                    follow_btn.removeClass('cancel').addClass('follow').text('+ 关注');
                }
            } else if (data.info == "login_false") {
                login_alert();
            } else if (data.info == "other_false") {
                other_alert(data.msg);
            }
        }
    });
}

// 下载商业计划书权限
function business_ajax() {
    $.ajax({
        url: window.businesswUrl,
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            if (data.info == "login_false") {
                login_alert();
            } else if (data.info == "other_false") {
                other_alert(data.msg);
            }
        }
    });
}

// 登陆弹窗
function login_alert() {
    $('.overlay').show();
    $('#status1').show();
}

// 其他弹窗
function other_alert(msg) {
    $('.overlay').show();
    $('#error_msg').html(msg);
    $('#status2').show();
}

// 认证弹窗
function auth_alert() {
    $('.overlay').show();
    $('#status3').show();
}

// 约谈成功弹窗
function success_alert(msg) {
    $('.overlay').show();
    $('#success_msg').html(msg);
    $('#status4').show();
}