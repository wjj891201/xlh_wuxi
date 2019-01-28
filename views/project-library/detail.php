<?php

use yii\web\View;
use yii\helpers\Url;

$this->title = '股权融资';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/project_detail_new.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/project_detail.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
?>
<div class="wrapper">
    <div class="details-top">
        <div class="details-bar">
            <span><i class="browse-ico"></i>浏览：xxx</span>
            <span><i class="interview-ico"></i>约谈：xxx</span>
        </div>
        <div class="details-group">
            <img class="portrait" src="/<?= $info['bp_big_img'] ?>">
            <div class="item">
                <div class="item-name">
                    <h3 id="bp_name">
                        <?= $info['bp_name'] ?>
                        <span class="item-field">
                            <?= $info['industry']['name'] ?>                    
                        </span>
                    </h3>
                </div>
                <p class="sketch"><?= $info['bp_instroduction'] ?></p>
                <p class="money">￥<?= $info['t_finance_amount'] ?>万<span><i class="money-ico"></i>融资金额</span></p>
                <p class="stage"><?= $financing_stage[$f_s] ?><span><i class="stage-ico"></i>所属阶段</span></p>
                <p class="percent"><?= $info['t_sell_ratio'] ?>%<span><i class="percent-ico"></i>出让比例</span></p>
                <div class="btn-group">
                    <a class="interview-btn" id="yuetan" href="javascript:" ><i class="coffee-ico"></i>约谈项目</a>
                    <a class="download-btn" href="" id="business"><i class="download-ico"></i>商业计划书下载</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="content clearfix">
            <div class="container">
                <h3 class="container-title">项目简介</h3>
                <p class="para" id="introduction"><?= $info['bp_project_content'] ?></p>
            </div>
            <div class="container">
                <h3 class="container-title">项目详情</h3>
                <h4 class="inner-title">商业模式</h4>
                <p class="para"><?= $info['bp_gain_model'] ?></p>
                <h4 class="inner-title">竞争优势</h4>
                <p class="para"><?= $info['bp_analysis'] ?></p>
                <h4 class="inner-title">竞争对手</h4>
                <p class="para"><?= $info['bp_tactic_plan'] ?></p>
            </div>
            <div class="container">
                <h3 class="container-title">公司团队</h3>
                <ul class="company clearfix">
                    <?php $bp_profession_arr = json_decode($info['bp_profession'], true); ?>
                    <?php foreach ($bp_profession_arr as $key => $vo): ?>
                        <li>
                            <div class="inbox">
                                <img class="thumbnail" src="/public/wx/images/thumbnail.png">
                                <h3 class="rank"><?= $vo['name'] ?> | <?= $vo['position'] ?></h3>
                                <div class="resume">
                                    <h4>工作履历</h4>
                                    <p><?= $vo['experience'] ?></p>
                                    <span class="rs-open" id="rs-open">展开</span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="container">
                <h3 class="container-title">融资信息</h3>
                <h4 class="inner-title">融资用途</h4>
                <p class="para"><?= $info['t_finance_purpose'] ?></p>
                <h4 class="inner-title">融资历史</h4>
                <div class="history-line"></div>
            </div>
        </div>
        <!-- 右侧tab -->
        <ul class="nav-right nav-right-scoll-fr">
            <li class="active"><a href="javascript:" id="tab_base" onclick="_czc.push(['_trackEvent', '股权项目详情页', '点击项目简介', 'sdfsdf', '', 'tab_base']);">项目简介</a></li>
            <li><a href="javascript:" id="tab_detail" onclick="_czc.push(['_trackEvent', '股权项目详情页', '点击项目详情', 'sdfsdf', '', 'tab_detail']);">项目详情</a></li>
            <li><a href="javascript:" id="tab_team" onclick="_czc.push(['_trackEvent', '股权项目详情页', '点击公司团队', 'sdfsdf', '', 'tab_team']);" >公司团队</a></li>
            <li><a href="javascript:" id="tab_history" onclick="_czc.push(['_trackEvent', '股权项目详情页', '点击融资信息', 'sdfsdf', '', 'tab_history']);" >融资信息</a></li>
        </ul>
    </div>
    <i class="backtotop" id="backtotop" onclick="_czc.push(['_trackEvent', '股权项目详情页', '回到顶部', 'sdfsdf', '', 'backtotop']);" ></i>
</div>