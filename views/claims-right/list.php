<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '债权融资项目';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/out_member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);
?>
<div style="border-bottom:2px solid #f4c11e;"></div>
<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <b>债权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <!--右侧-->
        <div class="grid_18 omega member_right_new">
            <div class="member_right_title">
                <h3 class="clearfix">
                    债权融资项目
                    <a href="<?= Url::to(['claims-right/add']) ?>">发布债权项目</a>
                </h3>
            </div>
            <ul class="dai_nav">
                <li><a href="?type=1" class="cur">待提交</a></li>
                <li><a href="?type=2">审核中</a></li>
                <li><a href="?type=3">融资中</a></li>
                <li><a href="?type=4">融资成功</a></li>
            </ul>
            <ul class="examine_title examine_title2">
                <li class="w60per">产品名称</li>
                <li class="w20per">创建时间</li>
                <li class="w20per">操作</li>
            </ul>
            <ul class="examine_content">
                暂无信息					
            </ul>
        </div>
    </div>
</div>