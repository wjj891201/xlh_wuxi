<?php

use yii\helpers\Url;

$this->title = '个人中心-账号管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/ui-desktop.css', ['depends' => 'app\assets\WxAsset']);
?>

<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <a href="">账户信息</a> &gt; 
        <b>修改密码</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <!--右侧-->
        <div class="member_right grid_20 omega product_box">
            <div class="grid-container" style="padding: 20px;">
                <div class="grid-70">
                    <div class="grid-100">
                        <div class="grid-20">
                            <img src="/public/wx/images/memberhead.jpg">
                        </div>
                        <div class="grid-80">
                            <div style="padding-bottom: 10px;"><span class="ulev1"><b>欢迎，<a href=""><?= Yii::$app->session['member']['username'] ?></a></b></span>&nbsp;&nbsp;</div>
                            <div style="padding-bottom: 10px;">我的资料：<a href="" class="blue_new">去修改</a></div>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
                <div style="padding-top: 20px; padding-bottom: 20px">
                    <div style="border-bottom: dashed 1px #474E5D; height: 3px;">&nbsp;</div>
                    <div style="border-bottom: dashed 1px #474E5D; height: 3px;">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>

