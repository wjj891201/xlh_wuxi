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
                            <div class="history-panel"></div>
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
                                <input type="file" id="plan-upload" name="mypic">
                            </div>
                            <span class="ml16 span_tip">注：上传格式只支持PDF、PPT/PPTX</span>
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
                <option value="0">请选择</option>
                <option value="1">天使轮</option>
                <option value="2">A轮</option>
                <option value="3">B轮</option>
                <option value="4">C轮</option>
                <option value="5">PE</option>
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
//                    //初始化数据
//                    $('.popup-keep').attr('data-id', '');
//                    $('.pname,.pjob,.pexperience').val("");
//                    //没有内容
//                    var team_float = $('.team-float');
//                    if (team_float.length != 0) {
//                        $("#code").val(1);
//                    } else {
//                        $("#code").val('');
//                    }
//                    //为了让yii2框架的验证生效
//                    $("#code").focus();
//                    $("#code").blur();
                }
            });
        });
        $(document).on('click', '.popup-keep', function () {
            var data_id = $(this).attr('data-id');
            var financing_time = $('#financing_time').val();
            if (financing_time == '') {
                layer.tips('请选择融资时间', '#financing_time');
                return false;
            }
            var financing_stage = $('#financing_stage').val();
            if (financing_stage == '0') {
                layer.tips('请选择融资轮次', '#financing_stage');
                return false;
            }
            var financing_money = $('#financing_money').val();
            if (financing_money == '') {
                layer.tips('请填写融资金额', '#financing_money');
                return false;
            }
            var financing_valuation = $('#financing_valuation').val();
            if (financing_valuation == '') {
                layer.tips('请填写估值', '#financing_valuation');
                return false;
            }
            var financing_investors = $('#financing_investors').val();
            if (financing_investors == '') {
                layer.tips('请填写投资方', '#financing_investors');
                return false;
            }
        });
        //融资历史相关的js~~~end
    });
</script>




