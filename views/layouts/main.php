<?php

use app\assets\WxAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Advert;

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
                    <a href="../" class="stop_index">首页</a>
                    <?php if (Yii::$app->session['member']['isLogin'] == 1): ?>
                        <div class="login_state slogo">
                            <div class="sname_member" style="position:relative">欢迎您，
                                <a href="<?= Url::to(['member/center']) ?>"><?= Yii::$app->session['member']['username'] ?></a>
                                <div class="slogin-down">
                                    <span class="membercenter"></span>
                                    <a href="" style="float:left;margin-left:-28px;margin-top:5px">会员中心</a><br/>
                                    <span style="margin-top:5px;display: block;border-top:solid 1px #dddddd;"></span>
                                    <span class="loginout"></span>
                                    <a href="<?= Url::to(['public/logout']) ?>" style="float:left;margin-left:40px;margin-top:-65px;">退出登录</a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="login_state">
                            <a href="<?= Url::to(['public/login']) ?>" class="stop_login">您还未登录，登录</a>
                            <a href="<?= Url::to(['public/signup']) ?>" class="stop_register">|&nbsp;&nbsp;注册</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="menu-container" style="border-bottom:2px solid #f4c11e;">
                <div class="m1200 smenu-content">
                    <div class="menu-logo" style="margin-top:-8px">
                        <a href="../"><img src="<?= $this->params['config']['logo'] ?>"></a>
                    </div>
                    <ul class="spmenu-nav clearfix">
                        <li><a href="../" <?php if ($this->context->id == 'index'): ?>class="smenu-cur"<?php endif; ?>>首页</a></li>
                        <li class="more gqrz smenu-cur"><a href="">股权融资</a></li>                        
                        <li><a href="">金融路演</a></li>                        
                        <li><a href="<?= Url::to(['incubator/list']) ?>" <?php if ($this->context->id == 'incubator'): ?>class="smenu-cur"<?php endif; ?>>产业招商</a></li>
                        <li><a href="">金融招商</a></li>                    
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
                        <li><a href="" target="_blank">找贷款</a></li>
                        <li><a href="" target="_blank">选项目</a></li>
                        <li><a href="" target="_blank">贷款工具</a></li>
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
            <div id="content_here">
                <?= $content ?>
            </div>
        </div>
        <div class="zi-footer po" style="height:160px">
            <div class="zi-footer-content" style="width:1200px;height:135px">
                <ul class="ft-about sft-about" >
                    <?php $links = Advert::get_ad(['atid' => 15, 'isclass' => 1]); ?>
                    <li><a class="spa" href="javascript:void(0);">友情链接：</li>
                    <?php foreach ($links as $key => $vo): ?>
                        <li><a class="spa" href="<?= $vo['url'] ?>" target="_blank"><?= $vo['title'] ?></a></li>
                    <?php endforeach; ?>
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
        <script>
            $(function () {
                var h = $(window).height();
                var H = $('.top_header').height() + $('.menu-container').height() + $('.zi-footer').height();
                $("#content_here").css({"min-height": h - H, "background": "#f8f8f8"});
            });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
