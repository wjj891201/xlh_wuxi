<?php

use app\assets\ApproveAsset;
use yii\helpers\Url;

ApproveAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>南昌科技企业信息管理平台成果总结</title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <!--左侧-->
            <div class="left-nav" style="height: 100%;">
                <div class="head-img"> 
                    <img src="/public/approve/images/head-img.png" height="128" width="128" alt=""/>
                    <p>机构名：<?= $this->params['organizationName'] ?></p>
                    <p>账号名：<?= Yii::$app->approvr_user->identity->username ?></p>
                </div>
                <ul>
                    <?php $belong = Yii::$app->approvr_user->identity->belong; ?>
                    <dl class="accordion">
                        <?php if (in_array($belong, [1, 2])): ?>
                            <dt <?php if ($this->context->id == 'handle'): ?>class="on"<?php endif; ?>><i class="icon1"></i>资质</dt>
                            <dd <?php if ($this->context->id == 'handle'): ?>style="display: block"<?php endif; ?>>
                                <a <?php if ($this->context->action->id == 'wait-for'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['handle/wait-for']) ?>">待审批企业</a>
                                <a <?php if ($this->context->action->id == 'finish'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['handle/finish']) ?>">已通过企业</a>
                                <a <?php if ($this->context->action->id == 'back'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['handle/back']) ?>">被退回企业</a>
                                <a <?php if ($this->context->action->id == 'end'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['handle/end']) ?>">被终止企业</a>
                            </dd>
                        <?php endif; ?>
                        <?php if (in_array($belong, [1, 2, 23, 24])): ?>
                            <dt <?php if ($this->context->id == 'loan-handle'): ?>class="on"<?php endif; ?>><i class="icon3"></i>贷款</dt>
                            <dd <?php if ($this->context->id == 'loan-handle'): ?>style="display: block"<?php endif; ?>>
                                <a <?php if ($this->context->action->id == 'loan-wait-for'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['loan-handle/loan-wait-for']) ?>">待审批企业</a>
                                <a <?php if ($this->context->action->id == 'loan-finish'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['loan-handle/loan-finish']) ?>">已通过企业</a>
                                <a <?php if ($this->context->action->id == 'loan-end'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['loan-handle/loan-end']) ?>">被终止企业</a>
                            </dd>
                        <?php endif; ?>

                        <dt <?php if ($this->context->id == 'unite'): ?>class="on"<?php endif; ?>><i class="icon4"></i>数据统计</dt>
                        <dd <?php if ($this->context->id == 'unite'): ?>style="display: block"<?php endif; ?>>
                            <?php if (in_array($belong, [1, 2])): ?>
                                <a <?php if ($this->context->action->id == 'base-data-info'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['unite/base-data-info']) ?>">资质报表导出</a>
                            <?php endif; ?>
                            <?php if (in_array($belong, [1, 2, 23, 24])): ?>
                                <a <?php if ($this->context->action->id == 'loan-data-info'): ?>class='choose'<?php endif; ?> href="<?= Url::to(['unite/loan-data-info']) ?>">贷款报表导出</a>
                            <?php endif; ?>
                        </dd>

                    </dl>
                </ul>
            </div>
            <!--头部-->
            <div class="head-bar">
                <div class="yuanqu"> 南昌科技金融支持企业管理服务系统 </div>
                <div id="version-icon"></div>
                <a href="jsvascript:void(0);" class="quit">退出登录</a>
                <a href="<?= Url::to(['setting/psw']); ?>" class="setting">设置</a>
            </div>
            <!--中间内容-->
            <?= $content ?>
        </div>
        <script>
            $(function () {
                var h = $(this).height();
                var H = $('.head-bar').height() + $('.main-bar').height();
                if (h < H) {
                    $('.left-nav').height(H);
                } else {
                    $('.left-nav').height(h);
                }
                $('.quit').click(function () {
                    layer.confirm('确认要退出吗？', {icon: 3, title: '提示', offset: '200px'}, function (index) {
                        location.href = "<?= Url::to(['login/logout']) ?>";
                    });
                });
            });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
