<?php

use yii\helpers\Url;

$this->title = '股权融资项目';
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
        <b>股权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <!--右侧-->
        <div class="grid_18 omega member_right_new">
            <div class="member_right_title">
                <h3 class="clearfix">
                    股权融资项目
                    <a href="<?= Url::to(['stock-right/add']) ?>">发布股权项目</a>
                </h3>
            </div>
            <ul class="examine_title">
                <li class="w45per">项目名称</li>
                <li class="w15per">创建时间</li>
                <li class="w15per">项目阶段</li>
                <li class="w25per">操作</li>
            </ul>
            <ul class="examine_content" style="text-align: center;margin-top: 20px;">暂无信息</ul>
        </div>
    </div>
</div>