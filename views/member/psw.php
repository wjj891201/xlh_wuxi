<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '个人中心-密码管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
?>
<div style="border-bottom:2px solid #f4c11e;"></div>
<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <a href="">账户信息</a> &gt; 
        <b>修改密码</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <!--右侧-->
        <div class="member_right grid_19 omega password_box">
            <div class="password_change">
                <h3>密码修改</h3>
                <?php
                $form = ActiveForm::begin([
                            'options' => ['id' => 'change_pwd_form'],
                            'fieldConfig' => [
                                'template' => "<li>{label}{input}{error}</li>",
                                'labelOptions' => ['class' => false, 'for' => false, 'style' => 'margin-right:10px;'],
                                'errorOptions' => ['class' => 'exclamation'],
                            ]
                ]);
                ?>
                <ul class="password_list">
                    <?= $form->field($model, 'orpass')->passwordInput(['class' => 'forget_input', 'maxlength' => '20']); ?>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'forget_input', 'maxlength' => '20']); ?>
                    <?= $form->field($model, 'repass')->passwordInput(['class' => 'forget_input', 'maxlength' => '20']); ?>
                </ul>
                <?= Html::submitButton('提交', ['class' => 'changePassword_btn']); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>