/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-07-28 21:44:23
 * @version $Id$
 */

/*
 titles  : 迷你楼层
 author  : 森森
 **/
var isOnPage = false;
var inputLenth = "";
var inputCounty = "";

(function ($) {

    'use strict';
    var minFloor = {
        init: function() {
            this.elements();
            this.events();
            
        },
        elements: function() {
            this.target = $('.scroll_nav');
            this.floors = $('div[data-floor]');
            this.arr = [];
        },
        events: function() {
            var
                self = this,
                top = 0,
                index = 0;

            $.each(this.floors, function() {
                self.arr.push($(this).offset().top);
            });


            $(window).on('scroll', function() {
                //noinspection JSValidateTypes
                top = $(this).scrollTop();
                var flag = parseInt($('.top_header').height(), 10) + parseInt($('.menu-container').height(), 10);

                if (top > flag) {
                    self.target.addClass('scroll_position');
                    //alert();
                } else {
                    self.target.removeClass('scroll_position');
                }
                if (!$('html,body').is(':animated')) {
                    self.changeFloor(self.getFloor(top));
                }
                //邮箱验证
                //$('#email').autoMail();
            });

            self.target.on('click', 'li', function() {
                index = $(this).index();
                $('html, body').stop().animate({
                    scrollTop: self.floors.eq(index).offset().top - 50
                });

                self.changeFloor(index);
            });
        },
        changeFloor: function(index) {
            this.target.find('li').removeClass('cur');
            this.target.find('li').eq(index).addClass('cur');
        },
        getFloor: function(val) {
            var
                i,
                len;

            for (i = 0, len = this.floors.length; i < len; i += 1) {
                if (val < this.arr[0]) {
                    return 0;
                }
                if (val > this.arr[i] && val < this.arr[i + 1]) {
                    return i + 1;
                }
            }
        }
    };

    minFloor.init();
}(jQuery));

$(function(){
    //邮箱验证
    //$('#email').autoMail();
});