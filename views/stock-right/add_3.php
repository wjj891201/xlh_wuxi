<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '添加股权融资-第二步';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/release.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
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

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
    });
</script>




