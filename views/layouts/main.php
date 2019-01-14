<?php

use app\assets\WxAsset;
use yii\helpers\Html;
use yii\helpers\Url;

WxAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <div class="top_header swxheight stopbg">
                <div class="m1200">
                    <div class="login_state">
                        <a href="" class="stop_login">您还未登录，登录</a>
                        <a href="" class="stop_register">|&nbsp;&nbsp;注册</a>
                    </div>
                </div>
            </div>
            <div class="menu-container">
                <div class="m1200 smenu-content">
                    <div class="menu-logo" style="margin-top:-8px">
                        <a href="../"><img src="<?= $this->params['config']['logo'] ?>"></a>
                    </div>
                    <ul class="spmenu-nav clearfix">
                        <li class="cs" class="menu-cur"><a href="">首页</a></li>
                        <li class="more gqrz smenu-cur"><a href="">股权融资</a></li>                        
                        <li class="more zqrz smenu-cur"><a href="">债权融资</a></li>   
                        <li><a class=menu-cur href="">金融路演</a></li>                        
                        <li><a href="">产业招商</a></li>
                        <li><a class=menu-cur href="">金融招商</a></li>                    
                    </ul>
                    <div class="wuxi">
                        <a href="" target="_blank">产业金融贷款系统</a>
                    </div>
                </div>
            </div>
            <div class="wxmenu-container wxmenu-nav-down cone">
                <div class="m1200 smenu-content">
                    <ul class="smenu-nav clearfix" style="height: 50%;">
                        <li><a href="" target="_blank">项目库</a></li>
                        <li><a href="" target="_blank">投资人</a></li>
                    </ul>
                </div>
            </div>
            <div class="wxmenu-container wxmenu-nav-down ctwo">
                <div class="m1200 smenu-content">
                    <ul class="smenu-nav clearfix" style="height: 50%;">
                        <li><a href="yrd/goods/search.html" target="_blank">找贷款</a></li>
                        <li><a href="yrd/projects/index.html" target="_blank">选项目</a></li>
                        <li><a href="yrd/tools/diagnostic.html" target="_blank">贷款工具</a></li>
                    </ul>
                </div>
            </div>
            <script>
                $(".spmenu-nav li.gqrz a,.cone").hover(function () {
                    $('.cone').show();
                }, function () {
                    $('.cone').hide();
                });
                $(".spmenu-nav li.zqrz a,.ctwo").hover(function () {
                    $('.ctwo').show();
                }, function () {
                    $('.ctwo').hide();
                });
            </script>
            <?= $content ?>
        </div>
        <div class="zi-footer po" style="height:160px">
            <div class="zi-footer-content" style="width:1200px;height:135px">
                <ul class="ft-about sft-about" >
                    <li><a class="spa" href="http://www.jsjrfw.com/" target="_blank">友情链接：江苏省金融服务平台</a></li>
                    <li><a class="spa" href="http://www.wxjrpt.com/" target="_blank">无锡市金融服务平台</a></li>
                    <li><a class="spa" href="http://www.jsxishan.gov.cn/" target="_blank">无锡市锡山区人民政府</a></li>
                </ul>
                <dl class="friend-link" >
                    <dd>
                        <a class="spa">版权所有: 无锡市锡山区人民政府</a>
                        <a class="spa">技术支持：上海信隆行科技股份有限公司</a>
                        <a class="spa">如有疑问，请联系我们（工作时间周一至周五9:00-18:00） 客服电话：4006-520-060</a>
                    </dd>
                </dl>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
