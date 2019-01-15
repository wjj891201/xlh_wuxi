<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');


$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/common.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/register.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/register_v3.css', ['depends' => 'app\assets\WxAsset']);

# layer~~~start
$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
# layer~~~end
$this->registerJsFile('@web/public/wx/js/tabChange.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_END]);
?>

<div class="wrapper content_h">
    <div class="con_select">
        <p class="con_title sel_big">请选择您的角色后注册</p>
        <div class="tabArea">
            <div class="tabhd">
                <ul id="user_select" class="ul_select ">
                    <li value="1" class="cur icon"><p>企业用户</p></li>
                    <li value="2"><p>投资人用户</p></li>
                    <li value="3"><p>债权机构用户</p></li>
                    <li value="4"><p>园区用户</p></li>
                </ul>
            </div>
            <div class="tabbd">
                <div class="item"><p class="con_title sel_small">主要是创业型或成长型企业，需要获得融资服务或者是企业基础级服务的用户</p></div>
                <div class="item"><p class="con_title sel_small">主要包括投资机构、FA、券商、会所、律所、评估机构等能为企业服务的用户</p></div>
                <div class="item"><p class="con_title sel_small">主要是能为企业提供贷款服务的用户，如银行、基金、小贷等</p></div>
                <div class="item"><p class="con_title sel_small">主要是孵化园区、孵化器或成长型众创空间</p></div>
            </div>
        </div>
    </div>
    <div class="con_input">
        <?php
        $form = ActiveForm::begin([
                    'options' => ['id' => 'register_form'],
        ]);
        ?>
        <div class="register_box">
            <ul>
                <?= $form->field($model, 'username')->textInput(['class' => 'reg_input reg_input_w forget_input', 'placeholder' => '请填写中国大陆手机号']); ?>
                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '{input}{image}',
                    'captchaAction' => '/public/captcha',
                    'options' => ['id' => 'captcha_hash', 'class' => 'reg_input reg_input_w2 forget_input', 'placeholder' => '请输入验证码'],
                    'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'width:101px;height:36px;float:right;margin-right:35px;border-radius:3px;', 'class' => 'code_img']
                ]);
                ?>
                <?= $form->field($model, 'short', ['template' => "<li>{label}{input}<input type=\"button\" class=\"getVerification_code\" value=\"获取验证码\" id=\"btnSend\">{error}</li>", 'errorOptions' => ['class' => 'warn']])->textInput(['id' => 'short', 'class' => 'reg_input reg_input_w2 forget_input', 'placeholder' => '请输入短信验证码']); ?>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'reg_input reg_input_w forget_input', 'placeholder' => '6-20位字母数字组合']); ?>
                <?= $form->field($model, 'repass')->passwordInput(['class' => 'reg_input reg_input_w forget_input', 'placeholder' => '6-20位字母数字组合']); ?>
            </ul>
            <div class="reg_agree">
                <?= $form->field($model, 'agreement')->checkbox(['id' => 'agreement', 'template' => "<p>{input}<label for=\"agreement\">我已阅读并同意一融网</label><a href=\"" . Url::to(['single/detail', 'tid' => 112]) . "\" target=\"_blank\">《一融网用户使用协议》</a></p>{error}"]) ?>
            </div>
            <?= Html::activeHiddenInput($model, 'user_type', ['id' => 'user_type', 'value' => 1]) ?>
            <?= Html::submitButton('立即注册', ['class' => 'reg_button', 'id' => 'submit_button-btn']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script>
    //发送验证码
    $('#btnSend').on('click', function () {
        var phone = $("#member-username").val();
        if (phone == null || phone == "") {
            layer.tips('请输入手机号码', '#member-username', {tips: [2, '#EA2000']});
            return false;
        }
        if (!(/^1(3|4|5|7|8)\d{9}$/.test(phone))) {
            layer.tips('手机号码有误', '#member-username', {tips: [2, '#EA2000']});
            return false;
        }
        if (!$(this).hasClass('not')) {
            sendphonecode(phone);
        }
    });
    //验证手机号，发送验证码
    function sendphonecode(phoneNo) {
        $.get("<?= Url::to(['public/sms']) ?>", {"phone": phoneNo}, function (data) {
            if (data.code == '20000') {
                var time = setInterval(function () {
                    settime(time);
                }, 1000);
            } else if (data.code == '20001') {
                layer.tips(data.message, '#member-username', {tips: [1, '#EA2000']});
                return false;
            } else {
                layer.tips(data.message, '#short', {tips: [1, '#EA2000']});
                return false;
            }
        }, "json");
    }
    //验证码间隔时间
    var countdown = 60;
    //60秒后可重新发送
    function settime(time) {
        if (countdown <= 0) {
            clearInterval(time);
            $('#btnSend').removeClass("not");
            $('#btnSend').val("获取验证码");
            countdown = 60;
        } else {
            $('#btnSend').addClass("not");
            $('#btnSend').val("已发送(" + countdown + ")");
            countdown--;
        }
    }
</script>

