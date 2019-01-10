<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>南昌科技金融支持企业管理服务系统</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href="/public/approve/css/base.css" rel="stylesheet">
        <link href="/public/approve/css/login.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="login-box">
                <img src="/public/approve/images/yuanqu-logo2.png" class="login-logo" alt="" />
                <?php $form = ActiveForm::begin();?>
                <div class="login">
                    <div class="title">
                        <h3>登录</h3>
                    </div>
                    <?= $form->field($model, 'username', ['template' => "<div class=\"login-content\"><div class=\"login-input\"><label>账号</label>{input}</div>{error}", 'errorOptions' => ['class' => 'error']])->textInput(); ?>
                    <?= $form->field($model, 'password', ['template' => "<div class=\"login-content\"><div class=\"login-input\"><label>密码</label>{input}</div>{error}", 'errorOptions' => ['class' => 'error']])->passwordInput(); ?>
                    <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"login-auto\"><div>{input}自动登录</div>", 'checked' => 'checked']); ?>  
                    <?= Html::submitButton('立即登录', ['class' => 'login-btn']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <!--底部-->
            <div class="login-footer">
                <div class="login-footer-content">
                    <div class="footer-left">
                        <p>主办单位：南昌市科学技术局</p>
                    </div>
                    <div class="footer-right">
                        <p>技术支持：上海信隆行信息科技股份有限公司（一融网）</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>