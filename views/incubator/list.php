<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = '产业招商';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
//$this->registerCssFile('@web/public/wx/css/project.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/list.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/jquery.jcarousellite.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
?>
<!--面包屑导航+搜索栏-->
<!--<div class="bc-group">
    <div class="breadcrumb">
        <a href="../wxjrfw.yirongbang.html">
            首页            </a>
        <span>></span>
        <a href="yrfh.html">
            产业招商            </a>
        <span>></span>
        <a href="incubator.html">
            载体列表            </a>
    </div>
    <div class="bc-search">
        <input type="text" id="search_key_words" class="bc-search-ip" onkeydown="on_search_enter_key_down()" onkeypress="on_search_enter_key_down()"
               onclick="on_search_input_click()" value=请输入关键字>
        <a class="bc-search-btn" onclick="on_search_button_click()">搜索</a>
    </div>
</div>-->

<div class="lsit-box">
    <!--推荐孵化器-->
    <div class="carrier-box">
        <!--头部-->
        <div class="carrier-title-box">
            <div class="carrier-title">
                <h2>推荐孵化器</h2>
            </div>
        </div>
        <!--推荐列表-->
        <div class="v_show">
            <span class="prev"></span>
            <span class="next"></span>
            <div class="v_content">
                <div class="v_content_list carousel">
                    <ul>
                        <?php foreach ($recommend as $key => $vo): ?>
                            <li>
                                <a href="<?= Url::to(['incubator/info', 'incubator_id' => $vo['incubator_id']]) ?>" target="_blank">
                                    <img src="<?= $vo['incubator_logo'] ?>" alt="<?= $vo['incubator_name'] ?>">
                                    <p><?= $vo['incubator_name'] ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--孵化载体筛选条件-->
    <div id="turn_search">
        <div class="carrier-box" id="search_selector">
            <dl class="screening-list">
                <dt>载体资质</dt>
                <dd>
                    <a href="javascript:void(0)" data-id="0" data-name="incubator_type" class="cur">全部</a>
                    <?php foreach ($incubator_type as $key => $vo): ?>
                        <a href="javascript:void(0)" data-id="<?= $vo['id'] ?>" data-name="incubator_type"><?= $vo['name'] ?></a>
                    <?php endforeach; ?>
                </dd>
            </dl>
            <dl class="screening-list">
                <dt>载体类型</dt>
                <dd>
                    <a href="javascript:void(0)" data-id="0" data-name="incubator_vector" class="cur">全部</a>
                    <?php foreach ($incubator_vector as $key => $vo): ?>
                        <a href="javascript:void(0)" data-id="<?= $vo['id'] ?>" data-name="incubator_vector"><?= $vo['name'] ?></a>
                    <?php endforeach; ?>
                </dd>
            </dl>
        </div>   
    </div>

    <div class="carrier-box-new">
        <ul class="tab-select">
            <li class="first"><a data-id="1" data-name="sort"  href="javascript:void(0)" class="cur">最热</a></li>
            <li class="last"><a data-id="2" data-name="sort" href="javascript:void(0)">最新</a></li>
        </ul>
        <form id="search_form" method="get" action="">
            <div class="carrier-search">
                <div class="search-area">
                    <i></i>
                    <input name="incubator_name" type="text" value="" />
                </div>
            </div>
        </form>
        <div class="carrier-list-new">
            <?php $incubator_type_h = ArrayHelper::map($incubator_type, 'id', 'name'); ?>
            <?php $incubator_vector_h = ArrayHelper::map($incubator_vector, 'id', 'name'); ?>
            <?php foreach ($data as $key => $vo): ?>
                <a href="<?= Url::to(['incubator/info', 'incubator_id' => $vo['incubator_id']]) ?>" target="_blank">
                    <div class="inner-box">
                        <img src="<?= $vo['incubator_logo'] ?>" alt="<?= $vo['incubator_name'] ?>">
                        <div class="carrier-info">
                            <div class="carrier-a"><h3><?= $vo['incubator_name'] ?></h3></div>
                            <span class="carrier-rank"><?= $incubator_type_h[$vo['incubator_type']] ?></span>
                            <p class="carrier-field"><?= $incubator_vector_h[$vo['incubator_vector']] ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <!-- 这里是分页 -->
        <div class="new_page">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(".carousel").jCarouselLite({
            btnNext: "span.next",
            btnPrev: "span.prev",
            visible: 4
        });
    });
</script>