$.fn.extend({
    tabBlock: function (info) {
        var init = {after: function () {}, before: function () {}};
        var obj = info;
        obj.after = obj.after || init.after;
        obj.before = obj.before || init.before;

        var cur_index = obj.hd.find('li.cur').index();
        if (cur_index < 0) {
            cur_index = 0;
        }
        obj.bd.find('div.item').eq(cur_index).show().siblings('div.item').hide();
        obj.hd.find('li').eq(cur_index).addClass("cur icon").siblings().removeClass("cur icon");
        obj.hd.find('li').on('click', function () {
            $(this).addClass('cur icon').siblings().removeClass('cur icon');
            var curNum = $(this).parent().find('li').index(this);
            obj.bd.find('div.item').eq(curNum).show().siblings('div.item').hide();
            obj.after($(this), $(this).index());
            $('#user_type').val($(this).val());
            return false;
        });
    }
});

$('.tabArea').each(function () {
    $(this).tabBlock({
        hd: $(this).find('.tabhd'),
        bd: $(this).find('.tabbd')
    });
});