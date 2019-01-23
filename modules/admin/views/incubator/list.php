<?php

use yii\web\View;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerJsFile('@web/public/backend/js/layer/layer.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
?>
<div id="dcMain">
    <!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>孵化管理</strong></div>   
    <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <?= $this->render('../set/prompt.php'); ?>
        <h3><a href="<?= Url::to(['incubator/add']) ?>" class="actionBtn add">添加孵化</a>孵化列表</h3>
        <div id="list">
            <form name="action" id="thisform" method="post" action="">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th align="center">#</th>
                        <th align="center">品牌名称</th>
                        <th align="center">载体资质</th>
                        <th align="center">载体类型</th>
                        <th align="center">成立时间</th>
                        <th align="center">更新时间</th>
                        <th align="center">操作</th>
                    </tr>
                    <?php foreach ($data as $key => $vo): ?>
                        <tr>
                            <td align="center"><?= $vo['incubator_id'] ?></td>
                            <td align="center"><?= $vo['incubator_name'] ?></td>
                            <td align="center"><?= $incubator_type[$vo['incubator_type']] ?></td>
                            <td align="center"><?= $incubator_vector[$vo['incubator_vector']] ?></td>
                            <td align="center"><?= $vo['incubator_created'] ?></td>
                            <td align="center"><?= date('Y-m-d', $vo['create_time']) ?></td>
                            <td align="center">
                                <a class="setedit" href="<?= Url::to(['incubator/add', 'incubator_id' => $vo['incubator_id']]) ?>">修改</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </form>
            <div class="pager">
                <?=
                LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
        <div class="clear"></div>           
    </div>
</div>