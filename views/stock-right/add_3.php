<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '添加股权融资-第三步';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/release.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/add_projects.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/laydate/laydate.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
?>

<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <b>股权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <div class="member_right grid_20 omega product_box">
            <div class="member_right grid_20 omega product_box">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="container">
                    <div class="top-title">
                        <h2>股权项目发布</h2>
                    </div> 
                    <div class="vessel">
                        <div class="vessel-title">
                            <p><i class="v-id">3</i>融资信息</p>
                        </div>
                        <div class="vcase">
                            <div class="case-title-two ht3 lht3"><p>融资历史</p></div>
                            <a href="javascript:;" id="history-add"><b class="add-icon">+</b>新增您的融资历史</a>
                            <div class="history-panel">
                                <?php if ($model->history): ?>
                                    <?php foreach ($model->history as $key => $vo): ?>
                                        <div class="history-box" data-id="<?= $key ?>">
                                            <i class="lefting"></i>
                                            <div class="h-inner">
                                                <div class="hs">
                                                    <label>融资时间：</label>
                                                    <p class="h-time"><?= $vo['financing_time'] ?></p>
                                                </div>
                                                <div class="hs">
                                                    <label>融资轮次：</label>
                                                    <?php
                                                    switch ($vo['financing_stage'])
                                                    {
                                                        case 1:
                                                            $str = '天使轮';
                                                            break;
                                                        case 2:
                                                            $str = 'A轮';
                                                            break;
                                                        case 3:
                                                            $str = 'B轮';
                                                            break;
                                                        case 4:
                                                            $str = 'C轮';
                                                            break;
                                                        case 5:
                                                            $str = 'PE轮';
                                                            break;
                                                    }
                                                    ?>
                                                    <p class="h-round"><?= $str ?></p>
                                                </div>
                                                <div class="hs">
                                                    <label>融资金额：</label>
                                                    <p class="h-money"><?= $vo['financing_money'] ?>万 <?= $vo['financing_currency'] == 1 ? '人民币' : '美元'; ?></p>
                                                </div>
                                                <div class="hs">
                                                    <label>估值：</label>
                                                    <p class="h-value"><?= $vo['financing_valuation'] ?>万 <?= $vo['financing_valuation_currency'] == 1 ? '人民币' : '美元'; ?></p>
                                                </div>
                                                <div class="hs">
                                                    <label>投资方：</label>
                                                    <p class="h-invest"><?= $vo['financing_investors'] ?></p>
                                                </div>
                                            </div>
                                            <div class="h-edit">
                                                <span><a href="javascript:;" data-financing_id="<?= $vo['financing_id'] ?>" class="editing"><i class="h-edit-icon"></i>编辑</a></span>
                                                <span><a href="javascript:;" data-financing_id="<?= $vo['financing_id'] ?>" class="delete"><i class="h-delete-icon"></i>删除</a></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>融资金额</p>
                            <?= $form->field($model, 't_finance_amount', ['template' => "{input}<span class=\"ml-40\">万元</span>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd20 pr30'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>融资用途</p>
                            <?= $form->field($model, 't_finance_purpose', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd29'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <div class="case-title-three"><i>*</i><p>股份出让比例</p></div>
                            <?= $form->field($model, 't_sell_ratio', ['template' => "{input}<span class=\"ml-25\">%</span>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd20 pr30'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i></i>挂牌需求</p>
                            <?= $form->field($model, 't_listing_requirements', ['template' => "{input}<span class=\"ml10\">例：主板、创业板、新三板、区域股交中心等</span>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['placeholder' => '20字以内', 'class' => 'cpt wd29'])->label(false); ?>
                        </div>
                    </div>
                    <div class="vessel topline">
                        <div class="vessel-title">
                            <p>
                                <span style="float: left;"><i class="v-id">4</i>资料上传</span>
                            </p>
                        </div>
                        <div class="svcase">
                            <div class="case-title-six"><i>*</i><p>商业计划书≤30M</p></div>
                            <div class="plan-upload-box">
                                <i id="success-icon" class="success-icon"></i><span id="plan-text">未上传</span>
                                <label for="plan-upload" class="plan-btn">
                                    <i class="upload-icon"></i>
                                    <p>上传</p>
                                </label>
                                <input type="file" id="plan-upload" name="mypic" onchange="fileChange(this);">
                            </div>
                            <span class="ml16 span_tip">注：上传格式只支持PDF、PPT/PPTX</span>
                            <?= $form->field($model, 'business_plan', ['errorOptions' => ['class' => 'exclamation']])->hiddenInput(['id' => 'business_plan'])->label(false); ?>
                        </div>
                        <div class="btn-group2">
                            <?= Html::submitButton('提交项目', ['class' => 'submit_button']); ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<div class="rz_history" style="display: none;">
    <div class="history-add">
        <div class="info-collect">
            <label class="wd9">融资时间：</label>
            <input type="text" class="wd16" id="financing_time" readonly="readonly">
        </div>
        <div class="info-collect">
            <label class="wd9">融资轮次：</label>
            <select id="financing_stage" class="wd16">
                <option value="">请选择</option>
                <?php foreach ($financing_stage as $key => $vo): ?>
                    <option value="<?= $vo['id'] ?>"><?= $vo['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="info-collect">
            <label class="wd9">融资金额：</label>
            <input type="text" class="wd6 pr40" id="financing_money">
            <span class="ml-25">万</span>
            <select id="financing_currency" class="wd6 ml10 ht2_8">
                <option value="1">人民币</option>
                <option value="2">美元</option>
            </select>
        </div>
        <div class="info-collect">
            <label class="wd9">估值：</label>
            <input type="text" class="wd6 pr40" id="financing_valuation">
            <span class="ml-25">万</span>
            <select id="financing_valuation_currency" class="wd6 ml10 ht2_8">
                <option value="1">人民币</option>
                <option value="2">美元</option>
            </select>
        </div>
        <div class="info-collect">
            <label class="wd9">投资方：</label>
            <input type="text" class="wd16" maxlength="20" id="financing_investors">
        </div>
        <div class="popup-btn-group">
            <a href="javascript:void(0);" class="popup-keep">保存</a>
        </div>
    </div>
</div>

<script>
    $(function () {
        //时间插件
        laydate.render({
            elem: '#financing_time',
            theme: '#FF6666'
        });
        //融资历史相关的js~~~start
        $('#history-add').click(function () {
            bbb = layer.open({
                type: 1,
                title: '添加融资信息',
                skin: 'layui-layer-rim',
                area: ['350px', '430px'],
                content: $('.rz_history'),
                end: function () {
                    //初始化数据
                    $('.popup-keep').attr({'data-financing_id': '', 'data-id': ''});
                    $('#financing_time,#financing_stage,#financing_money,#financing_valuation,#financing_investors').val("");
                    $('#financing_currency,#financing_valuation_currency').val("1");
                }
            });
        });
        $(document).on('click', '.popup-keep', function () {
            var data_financing_id = $(this).attr('data-financing_id');
            var data_id = $(this).attr('data-id');
            var financing_time = $('#financing_time').val();
            if (financing_time == '') {
                layer.tips('请选择融资时间', '#financing_time');
                return false;
            }
            var financing_stage = $('#financing_stage').val();
            if (financing_stage == '') {
                layer.tips('请选择融资轮次', '#financing_stage');
                return false;
            } else {
                var stage = $("#financing_stage").find("option:selected").text();
            }
            var financing_money = $('#financing_money').val();
            if (financing_money == '') {
                layer.tips('请填写融资金额', '#financing_money');
                return false;
            }
            var mt_1 = $("#financing_currency").find("option:selected").text();
            var financing_valuation = $('#financing_valuation').val();
            if (financing_valuation == '') {
                layer.tips('请填写估值', '#financing_valuation');
                return false;
            }
            var mt_2 = $("#financing_valuation_currency").find("option:selected").text();
            var financing_investors = $('#financing_investors').val();
            if (financing_investors == '') {
                layer.tips('请填写投资方', '#financing_investors');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['stock-right/ajax-add-history']) ?>",
                data: {'_csrf': "<?= Yii::$app->request->csrfToken ?>", 'data_financing_id': data_financing_id, 'financing_time': financing_time, 'financing_stage': financing_stage, 'financing_money': financing_money, 'financing_currency': $('#financing_currency').val(), 'financing_valuation': financing_valuation, 'financing_valuation_currency': $('#financing_valuation_currency').val(), 'financing_investors': financing_investors},
                dataType: "json",
                success: function (financing_id) {
                    if (data_financing_id) {
                        //编辑
                        var editnode = $('.history-panel div[data-id=' + data_id + ']').find('div[class="h-inner"]');
                        editnode.find('.hs:eq(0)').html('<label>融资时间：</label><p class="h-time">' + financing_time + '</p>');
                        editnode.find('.hs:eq(1)').html('<label>融资轮次：</label><p class="h-round">' + stage + '</p>');
                        editnode.find('.hs:eq(2)').html('<label>融资金额：</label><p class="h-money">' + financing_money + '万 ' + mt_1 + '</p>');
                        editnode.find('.hs:eq(3)').html('<label>估值：</label><p class="h-value">' + financing_valuation + '万 ' + mt_2 + '</p>');
                        editnode.find('.hs:eq(4)').html('<label>投资方：</label><p class="h-invest">' + financing_investors + '</p>');
                        layer.close(ccc);
                    } else {
                        //添加
                        var html = '<div class="history-box">';
                        html += '<i class="lefting"></i>';
                        html += '<div class="h-inner">';
                        html += '<div class="hs">';
                        html += '<label>融资时间：</label>';
                        html += '<p class="h-time">' + financing_time + '</p>';
                        html += '</div>';
                        html += '<div class="hs">';
                        html += '<label>融资轮次：</label>';
                        html += '<p class="h-round">' + stage + '</p>';
                        html += '</div>';
                        html += '<div class="hs">';
                        html += '<label>融资金额：</label>';
                        html += '<p class="h-money">' + financing_money + '万 ' + mt_1 + '</p>';
                        html += '</div>';
                        html += '<div class="hs">';
                        html += '<label>估值：</label>';
                        html += '<p class="h-value">' + financing_valuation + '万 ' + mt_2 + '</p>';
                        html += '</div>';
                        html += '<div class="hs">';
                        html += '<label>投资方：</label>';
                        html += '<p class="h-invest">' + financing_investors + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="h-edit">';
                        html += '<span><a href="javascript:;" data-financing_id="' + financing_id + '" class="editing"><i class="h-edit-icon"></i>编辑</a></span>';
                        html += '<span><a href="javascript:;" data-financing_id="' + financing_id + '" class="delete"><i class="h-delete-icon"></i>删除</a></span>';
                        html += '</div>';
                        html += '</div>';
                        $(".history-panel").append(html);
                        id_value();
                        layer.close(bbb);
                    }
                }
            });
        });
        $(document).on('click', '.delete', function () {
            var financing_id = $(this).data('financing_id');
            var that = $(this);//解决作用域问题
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['stock-right/ajax-del-history']) ?>",
                data: {'_csrf': "<?= Yii::$app->request->csrfToken ?>", 'financing_id': financing_id},
                dataType: "json",
                success: function (data) {
                    if (data == '1') {
                        that.parents(".history-box").remove();
                        id_value();
                    }
                }
            });
        });
        $(document).on('click', '.editing', function () {
            var data_id = $(this).parents(".history-box").attr('data-id');
            $('.popup-keep').attr('data-id', data_id);
            var financing_id = $(this).data('financing_id');
            $('.popup-keep').attr('data-financing_id', financing_id);
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['stock-right/ajax-get-history']) ?>",
                data: {'_csrf': "<?= Yii::$app->request->csrfToken ?>", 'financing_id': financing_id},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#financing_time').val(data.financing_time);
                        $("#financing_stage").val(data.financing_stage);
                        $("#financing_money").val(data.financing_money);
                        $("#financing_currency").val(data.financing_currency);
                        $("#financing_valuation").val(data.financing_valuation);
                        $("#financing_valuation_currency").val(data.financing_valuation_currency);
                        $("#financing_investors").val(data.financing_investors);
                        //弹出层
                        ccc = layer.open({
                            type: 1,
                            title: '编辑融资信息',
                            skin: 'layui-layer-rim',
                            area: ['350px', '430px'],
                            content: $('.rz_history'),
                            end: function () {
                                //初始化数据
                                $('.popup-keep').attr({'data-financing_id': '', 'data-id': ''});
                                $('#financing_time,#financing_stage,#financing_money,#financing_valuation,#financing_investors').val("");
                                $('#financing_currency,#financing_valuation_currency').val("1");
                            }
                        });
                    }
                }
            });
        });
        var id_value = function () {
            var liNode = $('.history-panel .history-box');
            liNode.each(function () {
                $(this).attr('data-id', $(this).index());
            });
        };
        //融资历史相关的js~~~end
    });

    //上传商业计划书
    function fileChange(target) {
        var thisId = target.id;
        var formData = new FormData();
        formData.append("_csrf", "<?= Yii::$app->request->csrfToken ?>");
        formData.append("type", 'project');
        formData.append("file", $('#' + thisId)[0].files[0]);
        $.ajax({
            url: "<?= Url::to(['claims-right/ajax-upload-files']) ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                //可以做一些正在上传的效果
            },
            success: function (data) {
                //data，我们这里是异步上传到后端程序所返回的图片地址
                var obj = JSON.parse(data);
                if (obj.code == 20000) {
                    $('#project_img').attr('src', '/' + obj.success.url);
                    $("#bp_big_img").val(obj.success.url);
                    //为了让yii2的验证生效
                    $("#bp_big_img").focus();
                    $("#bp_big_img").blur();
                }
                if (obj.code == 20001) {
                    layer.msg(obj.error, {icon: 2, time: 2000});
                }
            },
            error: function (responseStr) {
                console.log(responseStr);
            }
        });
    }
</script>




