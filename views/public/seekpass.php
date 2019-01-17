<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/common.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/register.css', ['depends' => 'app\assets\WxAsset']);

# layer~~~start
$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
# layer~~~end
?>	
<div class="container_25 clearfix forget_content" style="margin-top: 20px;">
    <div class="forget_password">
        <?php
        $form = ActiveForm::begin([
                    'options' => ['id' => 'register_form'],
                    'fieldConfig' => [
                        'template' => "<li>{label}{input}{error}</li>",
                        'labelOptions' => ['class' => false, 'for' => false, 'style' => 'margin-right:10px;'],
                        'errorOptions' => ['class' => 'exclamation'],
                    ]
        ]);
        ?>
        <ul>
            <?= $form->field($model, 'username')->textInput(['class' => 'forget_input', 'maxlength' => '11']); ?>
            <?=
            $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '{input}{image}',
                'captchaAction' => '/public/captcha',
                'options' => ['id' => 'verify', 'class' => 'forget_input2 forget_input'],
                'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'class' => 'code_img', 'style' => 'width:95px;height:28px;margin-left:10px;']
            ]);
            ?>
            <?= $form->field($model, 'short', ['template' => "<li>{label}{input}<input type=\"button\" class=\"getVerification_code\" value=\"获取验证码\" id=\"btnSend\">{error}</li>", 'errorOptions' => ['class' => 'exclamation']])->textInput(['id' => 'short', 'class' => 'forget_input2 forget_input']); ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'forget_input']); ?>
            <?= $form->field($model, 'repass')->passwordInput(['class' => 'forget_input']); ?>
        </ul>
        <?= Html::submitButton('立即找回', ['class' => 'forget_btn', 'id' => 'forget_btn']); ?>
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
            if (data) {
                var time = setInterval(function () {
                    settime(time);
                }, 1000);
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