<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/common.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/register.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/login.css', ['depends' => 'app\assets\WxAsset']);

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');
?>

<div class="wrapper login_bg">
    <div class="container_25 clearfix login_content">
        <?php
        $form = ActiveForm::begin(['options' => ['id' => 'login-form']]);
        ?>
        <div class="login_box po">
            <h3>用户登录</h3>
            <span class="fuhuazt_style"><a href="<?= Url::to(['public/signup']) ?>">立即注册</a></span>
            <div class="login_label">
                <?= $form->field($model, 'username', ['template' => "<i class=\"people_icon\"></i>{input}{error}", 'errorOptions' => ['class' => 'notice']])->textInput(['maxlength' => '20', 'placeholder' => '用户名/已验证手机号'])->label(false); ?>
            </div>
            <div class="login_label">
                <?= $form->field($model, 'password', ['template' => "<i class=\"password_icon\"></i>{input}{error}", 'errorOptions' => ['class' => 'notice']])->passwordInput(['maxlength' => '20', 'placeholder' => '密码'])->label(false); ?>
            </div>
            <div class="remember">
                <?= $form->field($model, 'remember')->checkbox(['id' => 'ra', 'template' => "{input}<label for=\"ra\">自动登录</label>"])->label(false); ?>
            </div>
            <ul class="other">
                <li><a href="<?= Url::to(['public/seekpass']) ?>">忘记密码?</a ></li>
            </ul>
            <?= Html::submitButton('立即注册', ['class' => 'login_btn', 'id' => 'login_btn-btn']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script>
    $(function () {
        var h = $(window).height();
        $('.login_bg').css('height', (h - 156) + "px");
        $('.login_content').css('height', (h - 156) + "px");
    });
</script>
