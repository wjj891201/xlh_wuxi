<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = '产业招商';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/flexslider.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/project.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/swiper-3.4.0.min.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/swiper-3.4.0.jquery.min.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
?>
<!--面包屑导航+搜索栏-->
<div class="bc-group">
    <div class="breadcrumb">
        <a href="">首页</a><span>></span><a href="">产业招商</a><span>></span><a href="">载体列表</a><span>></span><a href=""><?= $info['incubator_name'] ?></a>
    </div>
</div>
<div class="wrapper">
    <div class="top-bg">
        <div class="company">
            <div class="company-ico">
                <img src="<?= $info['incubator_logo'] ?>" alt="<?= $info['incubator_name'] ?>" />
            </div>
            <div class="company-name"><?= $info['incubator_name'] ?></div>
            <p class="company-address"><i class="address-ico"></i><?= $info['incubator_address'] ?></p>
            <a class="apply-now" href="javascript:" id="join1">立即申请</a>
        </div>
    </div>
    <div class="main">
        <ul class="details-tab">
            <li class="cur" name="fh-details">孵化详情</li>
            <li name="fh-rules">入驻规则</li>
            <li name="fh-map">周边地图</li>
            <a class="apply-now2" href="javascript:" id="join2"><i class="apply-ico"></i>立即申请</a>
        </ul>
        <div class="fh-col">
            <h3 class="fh-col-title">孵化户型</h3>
            <div class="lt-panel">
                <?php foreach ($info['office'] as $key => $vo): ?>
                    <a class="lt-house">
                        <img src="<?= $vo['office_pic'] ?>" alt="<?= $vo['office_style'] ?>">
                        <p class="house-type"><?= $vo['office_style'] ?></p>
                        <p class="house-price">￥<?= $vo['office_price'] ?>元/<?= $vo['office_unit'] ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="fh-col" id="fh-details">
            <h3 class="fh-col-title">孵化简介</h3>
            <div class="intro">
                <div class="brief-group">
                    <div class="brief" id="infrastructure">
                        <h3>基础设施</h3>
                        <?php $facility_ops_arr = explode(',', $info['facility_ops']); ?>
                        <?php foreach ($facility_ops_arr as $vo): ?>
                            <p class="spec"><i class="<?= $facility_ops[$vo]['img'] ?>"></i><br><?= $facility_ops[$vo]['name'] ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="brief" id="special-service">
                        <h3>特色服务</h3>
                        <?php $service_ops_arr = explode(',', $info['service_ops']); ?>
                        <?php foreach ($service_ops_arr as $vo): ?>
                            <p class="spec"><i class="<?= $service_ops[$vo]['img'] ?>"></i><br><?= $service_ops[$vo]['name'] ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="service-equipment"><?= $info['incubator_intro'] ?></div>
        </div>
        <div class="fh-col" id="fh-rules">
            <h3 class="fh-col-title">入驻规则</h3>
            <div class="fhq-rules"><?= $info['incubator_condition'] ?></div>
        </div>
        <div class="fh-col" id="fh-map">
            <h3 class="fh-col-title">周边地图</h3>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        // tab跳转
        $('.details-tab li').on('click', function () {
            $(this).addClass('cur').siblings().removeClass('cur');
            var name = $(this).attr('name');
            var th = $("#" + name).offset().top;
            $('html, body').animate({
                scrollTop: th - 79
            });
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100) {
                $('.scrollTop').fadeIn();
            } else {
                $('.scrollTop').fadeOut();
            }
        });
        $('.scrollTop').on('click', function () {
            $('html, body').animate({scrollTop: 0});
        });
        //户型轮播
        var mySwiper = new Swiper('#house', {
            direction: 'horizontal',
            loop: true,
            slidesPerView: 4,
            nextButton: '.nextBtn',
            prevButton: '.prevBtn'
        });
    });
</script>