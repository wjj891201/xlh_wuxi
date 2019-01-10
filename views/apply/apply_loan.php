<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\News;

$this->registerCssFile('@web/public/kjd/css/apply.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/apply_base.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/apply_style.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/easy.css', ['depends' => ['app\assets\KjdAsset']]);

# layer~~~start
$this->registerJsFile('@web/public/kjd/js/layer/layer.js', ['depends' => ['app\assets\KjdAsset'], 'position' => View::POS_HEAD]);
# layer~~~end
$this->registerJsFile('@web/public/kjd/js/jquery.cookie.js', ['depends' => ['app\assets\KjdAsset'], 'position' => View::POS_HEAD]);
$this->title = '认定资料填写-第四步';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');
?>
<div class="wrapper">
    <div class="titleBar">
        <div class="main1200">
            <img src="/public/kjd/images/edit.jpg" height="80" width="217" alt="">
        </div>
    </div>
    <div class="main1200 steps">
        <img src="/public/kjd/images/s4.png" alt="">
        <ul>
            <li class="first">基本信息</li>
            <li class="second">财务信息</li>
            <li class="third">企业概述</li>
            <li class="last">贷款信息</li>
        </ul>
    </div>
    <div class="main1200 pb5">
        <div class="mainBar pt50 pl100 pr50 pb20 mb20">
            <h3 class="mb15">贷款信息</h3>
            <?php $form = ActiveForm::begin(['options' => ['id' => 'step4', 'enctype' => 'multipart/form-data']]); ?>
            <div class="content_form" style="padding-bottom: 10px">
                <ul class="step2box step3Box step4Box">
                    <li class="financing">
                        <label class="labelT">是否有金融需求：</label>
                        <div class="radio">
                            <?=
                            $form->field($model, 'want_financing', ['errorOptions' => ['class' => 'msg', 'style' => 'margin-left:0px;']])->inline()->radioList(['1' => '有', '2' => '无'], [
                                'item' => function($index, $label, $name, $checked, $value) {
                                    $return = '<input style="width:20px;height:auto;" type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>' . $label . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                    return $return;
                                },
                                'class' => 'radio',
                                'style' => 'line-height:40px;'
                            ])->label(false);
                            ?>
                        </div>
                    </li>

                    <li class="have_financing" style="height: 286px;<?php if ($model->want_financing != 1): ?>display: none;<?php endif; ?>">
                        <label class="labelT">金融支持方式：</label>
                        <div class="moreSelectContent3 bottom_bor">
                            <div class="finance_cont finance_cont1">
                                <label class="finance_l_title">资金支持方式</label>
                                <div class="clear"></div>
                                <?php foreach ($fund as $key => $vo): ?>
                                    <?php if ($vo['id'] != 7): ?>
                                        <label style="padding-left: 20px;width: 200px;">
                                            <?php if ($vo['id'] == 1): ?>
                                                <input style="width: auto; height: auto;" type="checkbox" onclick="return false;" checked="checked" value="<?= $vo['id'] ?>" name="fund_support[]"/>&nbsp;<?= $vo['name'] ?>
                                            <?php else: ?>
                                                <input style="width: auto; height: auto;" type="checkbox" <?php if (in_array($vo['id'], $fund_support_arr)): ?>checked="checked"<?php endif; ?> value="<?= $vo['id'] ?>" name="fund_support[]"/>&nbsp;<?= $vo['name'] ?>
                                            <?php endif; ?>
                                        </label>
                                    <?php else: ?>
                                        <label style="padding-left: 20px;width: 200px;">
                                            <div class="other" style="float:left">
                                                <input style="width: auto; height: auto;" type="checkbox" <?php if (in_array($vo['id'], $fund_support_arr)): ?>checked="checked"<?php endif; ?> value="<?= $vo['id'] ?>" name="fund_support[]"/>&nbsp;<?= $vo['name'] ?>
                                                <?= $form->field($model, 'fund_support_other', ['options' => ['tag' => false]])->textInput(['id' => 'fund_support_other', 'style' => 'margin-left: 10px;'])->label(false); ?>
                                            </div>
                                        </label>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="clear"></div><br/>
                            <div class="finance_cont finance_cont2">
                                <label class="finance_l_title">其他支持方式</label>
                                <div class="clear"></div>
                                <?php foreach ($orther as $key => $vo): ?>
                                    <?php if ($vo['id'] != 11): ?>
                                        <label style="padding-left: 20px;width: 200px;">
                                            <input style="width: auto; height: auto;" type="checkbox" <?php if (in_array($vo['id'], $fund_support_arr)): ?>checked="checked"<?php endif; ?> value="<?= $vo['id'] ?>" name="fund_support[]"/>&nbsp;<?= $vo['name'] ?>
                                        </label>
                                    <?php else: ?>
                                        <label style="padding-left: 20px;width: 200px;">
                                            <div class="other" style="float:left">
                                                <input style="width: auto; height: auto;" type="checkbox" <?php if (in_array($vo['id'], $fund_support_arr)): ?>checked="checked"<?php endif; ?> value="<?= $vo['id'] ?>" name="fund_support[]"/>&nbsp;<?= $vo['name'] ?>
                                                <?= $form->field($model, 'other_support_other', ['options' => ['tag' => false]])->textInput(['id' => 'other_support_other', 'style' => 'margin-left: 10px;'])->label(false); ?>
                                            </div>
                                        </label>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>

                    <li class="have_financing" <?php if ($model->want_financing != 1): ?>style="display: none;"<?php endif; ?>>
                        <label>申请金额：</label>
                        <?= $form->field($model, 'apply_amount', ['template' => "{input} 万元{error}", 'errorOptions' => ['class' => 'msg']])->textInput(['id' => 'apply_amount', 'placeholder' => '申请金额'])->label(false); ?>
                    </li>  
                    <li class="have_financing" <?php if ($model->want_financing != 1): ?>style="display: none;"<?php endif; ?>>
                        <label>申请期限：</label>
                        <?= $form->field($model, 'period_month', ['template' => "{input} 月{error}", 'errorOptions' => ['class' => 'msg']])->textInput(['id' => 'period_month', 'placeholder' => '请输入你要申请的贷款期限'])->label(false); ?>
                    </li>
                    <li class="have_financing" <?php if ($model->want_financing != 1): ?>style="display: none;"<?php endif; ?>>
                        <label>贷款用途：</label>
                        <?= $form->field($model, 'loan_purpose', ['errorOptions' => ['class' => 'msg']])->textArea(['class' => 'normal_text', 'placeholder' => '请输入贷款用途50字内'])->label(false); ?>
                    </li>
                    <li class="have_financing" <?php if ($model->want_financing != 1): ?>style="display: none;"<?php endif; ?>>
                        <label>选择银行：</label>
                        <?= $form->field($model, 'bank_id', ['errorOptions' => ['class' => 'msg', 'style' => 'display: inline-block;margin-left:10px;height:38px;line-height:38px;']])->dropDownList($bank_list, ['class' => 'gray_select', 'style' => 'width:312px;'])->label(false); ?>
                    </li>
                    <div style="clear:both"></div>
                </ul>
            </div>
            <div style="clear:both"></div>
            <div class="agreement">
                <?= $form->field($model, 'agreement', ['errorOptions' => ['class' => 'msg', 'style' => 'margin-left:0px;padding-left:298px;']])->checkbox(['id' => 'agreement', 'template' => "<p class=\"promise\"><span class=\"check\">{input}阅读并同意<a href=\"javascript:void(0);\" class=\"i_agree\">《南昌科技金融支持企业入库协议》</a></p>{error}"]) ?>
            </div>
            <div class="save_btn">
                <a href="<?= Url::to(['apply/apply-describe']) ?>" class="left_btn">上一步</a>
                <?= Html::submitButton('完成', ['class' => 'nextbtn right_btn grey']); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="agreement_content" style="display: none;">
    <div class="dialog dialog_deal dani" style="border: none;">
        <div class="dcontent">
            <?php $info = News::getOne(['tid' => 115]); ?>
            <div class="deal-txt">
                <?= $info['content']['content'] ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        //协议
        $('.i_agree').click(function () {
            layer.open({
                type: 1,
                title: '南昌科技金融服务平台融资协议',
                skin: 'layui-layer-rim',
                area: ['750px', '630px'], //宽高
                content: $('.agreement_content')
            });
        });
        //切换
        $("input[name='EnterpriseLoan[want_financing]']").on('change', function () {
            if ($(this).val() == 1) {
                $('.have_financing').show();
            } else {
                $('.have_financing').hide();
            }
        });
    });
</script>


