<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="sbox" style="padding: 30px 0px 0px 30px;height: 70px;">
    <form class="form" id="search_form" method="get">
        <ul>
            <li class="odd">
                <label>企业名称：</label>
                <input type="text" name="enterprise_name" value="<?= Yii::$app->request->get('enterprise_name', ''); ?>" placeholder="请输入">
            </li>
            <li>
                <div class="dateSelect">
                    <label>创建时间：</label>
                    <input type="text" class="datepicker" id="start_time" name="start_time" value="<?= Yii::$app->request->get('start_time', ''); ?>" placeholder="请选择">
                    <span>至</span>
                    <input type="text" class="datepicker" id="end_time" name="end_time" value="<?= Yii::$app->request->get('end_time', ''); ?>" placeholder="请选择">
                </div>
            </li>
            <li>
                <div id="search_form_btn">查询</div>
            </li>
        </ul>
    </form>
</div>
<div class="main-bar">
    <div class="library-box">
        <div class="article2">
            <div class="tablebox">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table4 dataTable no-footer" width="100%" border="0" cellspacing="0" cellpadding="0" id="DataTables_Table_0" role="grid" style="width: 100%;text-align: center;">
                        <thead>
                            <tr class="title table_thread" role="row">
                                <td>序号</td>
                                <td>企业名称</td>
                                <td>区域名称</td>
                                <td>科技企业类型</td>
                                <td>销售收入</td>
                                <td>金融支持需求</td>
                                <td>支持方式</td>
                                <td>联系人</td>
                                <td>联系电话</td>
                                <td>申请资料</td>
                                <td>申请时间</td>
                                <td>历史审核记录</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $vo): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $vo['enterprise_name'] ?></td>
                                    <td><?= $vo['town_name'] ?></td>
                                    <td style="text-align:left;">
                                        <?php $qualification = json_decode($vo['qualification_certificate'], true); ?>
                                        <?php foreach ($qualification as $k => $v): ?>
                                            【<?= $v['name'] ?>】
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?= $vo['annual_sales'] ?>（万元）</td>
                                    <td><?= ($vo['want_financing'] == 1 ? '有' : '无') ?> </td>
                                    <td style="text-align:left;"><?= $vo['fund_support_cn'] ?></td>
                                    <td><?= $vo['contact_person_man'] ?></td>
                                    <td><?= $vo['contact_person_phone'] ?></td>
                                    <td><a href="<?= Url::to(['unite/get-info', 'base_id' => $vo['base_id'], 'type' => 'base']) ?>">详情</a></td>
                                    <td><?= $vo['base_create_time'] ?></td>
                                    <td class="table_btn">
                                        <a class="stream" data-app_id="<?= $vo['app_id'] ?>" data-group_id="<?= $vo['group_id'] ?>" href="javascript:void(0);">查看</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page">
                <?=
                LinkPager::widget([
                    'pagination' => $pages,
                    'prevPageLabel' => '上一页',
                    'nextPageLabel' => '下一页'
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('/contract/stream'); ?>