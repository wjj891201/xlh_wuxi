<?php

use yii\helpers\Url;
?>
<style type="text/css">
    ul, li, ol {list-style:none;list-style-type:none;zoom:1;}
    .dialog_box {width:100%;margin:0 auto;font-size:13px;}
    .dialog_box ul {border-top:2px solid #EEEEEE;margin-bottom:20px;margin-top:10px;}
    .dialog_box li {margin-bottom:10px;}
    .dialog_box li label {width:181px;text-align:right;display:inline-block;color:#666;vertical-align:top;}
    .dialog_box li p {display:inline-block;vertical-align:top;width:250px;color:#666;}
    .dialog_box li a {cursor:pointer;color:#4479cf;}

    .form input[type='text'], 
    .form input[type='number'], 
    .form select, 
    .form file{border:none;background:none;border:1px solid #ccc;height:30px;line-height:30px;width:200px;text-indent:10px;margin-right:6px;}
    .btn {padding-top:15px;text-align:center;}
    .btn a {background:#419be9;font-size: 16px;width: 120px;height:40px;line-height:40px;margin-right:15px;border-radius:3px;color:#fff;border:none;cursor:pointer;display:inline-block;bottom:0;margin:10px auto;}
    .zzsc{ width:100%;margin:0px auto;}
    .zzsc .tab{ overflow:hidden; background:#ccc;}
    .zzsc .tab a{ display:block; padding:10px 20px; float:left; text-decoration:none; color:#333;}
    .zzsc .tab a.on{ background:#E64E3F; color:#fff; text-decoration:none;}
    .zzsc .content{ overflow:hidden; padding:10px;}
</style>

<div class="zzsc" id="loan_info_block" style="display:none;">
    <div class="tab">
        <a href="javascript:;" class="on">历史放款信息</a>
        <a href="javascript:;">填写放款信息</a>
    </div>
    <div class="content">
        <ul>
            <li class="show" style="display:block;">
                <div class="dialog_box loan_add_list"></div>
            </li>
            <li class="show" style="display:none;">
                <div class="dialog_box">
                    <form class="form loan_add_from">
                        <ul style="border:0px;" class="loan_add_from_head"></ul>
                        <ul style="border:0px;">
                            <li>
                                <label>贷款合同号：</label>
                                <input type="text" name="contract_num" class="contract_num" placeholder="请输入合同编号">
                            </li>
                            <li>
                                <label>实际放贷金额：</label>
                                <input type="number" name="loan_amount_money" class="loan_amount_money" placeholder="请输入金额">万
                            </li>
                            <li>
                                <label>贷款开始时间：</label>
                                <input type="text" name="contract_loan_start_time" class="datepicker contract_loan_start_time" readonly="readonly">
                            </li>
                            <li>
                                <label>贷款结束时间：</label>
                                <input type="text" name="contract_loan_end_time" class="datepicker contract_loan_end_time" readonly="readonly">
                            </li>
                            <li>
                                <label>贷款周期：</label>
                                <input type="number" name="loan_day" class="loan_day" readonly="readonly"> 天
                            </li>
                            <li>
                                <label>贷款利率：</label>
                                <input type="number" name="loan_rate" class="loan_rate">  %
                            </li>
                            <li>
                                <label>基准利率：</label>
                                <input type="number" name="loan_benchmark_rate" class="loan_benchmark_rate"> %
                            </li>
                            <li>
                                <label>还款方式：</label>
                                <?php $repayment_mode = Yii::$app->params['repayment_mode']; ?>
                                <select name="repayment_mode" class="repayment_mode">
                                    <option value="0">请选择</option>
                                    <?php foreach ($repayment_mode as $key => $vo): ?>
                                        <option value="<?= $vo['id'] ?>"><?= $vo['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li>
                                <label>请上传放款凭证：</label>
                                <input class="loan_voucher" type="file" style="width: 184px;" onchange="set_loan_uploads();">
                                <input id="hidden_loan_voucher" name="loan_voucher" type="hidden">
                            </li>
                        </ul>
                        <input type="hidden" name="loan_id" id="loan_id">
                    </form>
                    <div class="btn"> <a class="loan_add" onclick="loan_add()">确认提交</a> </div>
                </div>

            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    // 添加放款信息
    function loan_add() {
        $.post('/approve/contract/add-loan-info', $(".loan_add_from").serialize(), function (data) {
            var code = data.code;
            var msg = data.msg;
            if (code == 200) {
                layer.msg(msg, {icon: 1, time: 1500}, function () {
                    window.location.reload();
                });
            } else if (code == 201) {
                layer.msg(msg, {icon: 2, time: 1500});
                return false;
            } else if (code == 202) {
                var key = data.msg.key;
                var val = data.msg.val;
                layer.tips(val, '.loan_add_from .' + key, {tips: [1, 'red'], time: 2000});
                return false;
            }
        }, 'json');
        return false;
    }

    $(function () {
        // tab切换 mouseover
        $("#loan_info_block .tab a").click(function () {
            var index = $(this).index();
            number    = index;
            if(number == 1){
                var datas;
                $.ajaxSettings.async = false;
                $.get('/approve/ajax/get-credit-balance?loan_id='+ $(".loan_add_from #loan_id").val(), function(data){datas=data;}, 'text');
                if(datas <= 0){
                    layer.msg('当前放贷信息已满，不能再添加放贷信息！', {icon:2, time:1500});
                    return false;
                }
            }
            $(this).addClass('on').siblings().removeClass('on');
            $('#loan_info_block .content .show').hide();
            $('#loan_info_block .content .show:eq(' + index + ')').show();
        });

        var loan_id = 0;
        $(".loan_info").click(function () {
            $("#loan_info_block").css('display', 'block');

            loan_id = $(this).data('loan_id');

            $(".loan_add_from")[0].reset();

            $.get('/approve/ajax/get-loan-info?loan_id=' + loan_id + '&type_id=1', function (data) {
                $(".loan_add_from_head").empty().html(data);
            }, 'html');

            $.get('/approve/ajax/get-loan-list?loan_id=' + loan_id + '&type_id=1', function (data) {
                $(".loan_add_list").empty().html(data);
            }, 'html');

            $(".loan_add_from #loan_id").val(loan_id);

            layer.open({
                type: 1,
                title: '放款信息',
                area: ['550px', '700px'],
                content: $("#loan_info_block"),
                success: function () {
                    laydate.render({
                        elem: ".contract_loan_start_time",
                        done: function (value, date, endDate) {
                            $('.contract_loan_start_time').change();
                        }
                    });
                    laydate.render({
                        "elem": ".contract_loan_end_time",
                        done: function (value, date, endDate) {
                            $('.contract_loan_end_time').change();
                        }
                    });
                }
            });

        });
        // 监控时间日期选择
        $('.contract_loan_start_time,.contract_loan_end_time').change(function () {
            set_loan_days();
        });
    });

    // 设置天数
    function set_loan_days() {
        var start_time = $(".contract_loan_start_time").val();
        var end_time = $(".contract_loan_end_time").val();
        if (start_time !== '' && end_time !== '') {
            if (start_time > end_time) {
                $(".contract_loan_start_time").val('');
                $(".loan_day").val('');
                layer.tips('贷款结束时间不能大于开始时间', '.contract_loan_start_time', {tips: [3, 'red'], time: 2000});
                return false;
            }
            $(".loan_day").val(DateDiff(start_time, end_time));
            return true;
        }
        return false;
    }

    // 计算两个时间的天数
    function DateDiff(sDate1, sDate2) {
        var iDays;
        iDays = parseInt(Math.abs((new Date(sDate1)) - (new Date(sDate2))) / 1000 / 60 / 60 / 24);
        return iDays;
    }

    // 上传附件
    function set_loan_uploads() {
        var formData = new FormData();
        formData.append("file", $(".loan_voucher")[0].files[0]);
        $.ajax({
            url: '<?= Url::to(['ajax/uploads']) ?>',
            type: "POST",
            data: formData,
            dataType: "text",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data !== '') {
                    $("#hidden_loan_voucher").val(data);
                }
            }
        });
    }
</script>