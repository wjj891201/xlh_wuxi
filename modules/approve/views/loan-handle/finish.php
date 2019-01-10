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
                                <td>授信状态</td>
                                <td>授信金额</td>
                                <td>已放贷金额</td>
                                <td>授信通过时间</td>
                                <td>授信有效期</td>
                                <td>放贷状态</td>
                                <td>联系人</td>
                                <td>联系电话</td>
                                <td>申请资料</td>
                                <td>申请时间</td>
                                <td>历史审核记录</td>
                                <td>操作</td>
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
                                            【<?= $v['name'] ?>】<br/>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>已批复</td>
                                    <td><?= $vo['credit_amount'] ?> （万元）</td>
                                    <td><?= $vo['already_loan_amount'] ?> （万元）</td>
                                    <td><?= $vo['credit_time'] ?></td>
                                    <td><?= $vo['credit_validity'] ?></td>
                                    <td>
                                    <?php 
                                        if($vo['already_loan_amount'] == 0){
                                            echo '未放款';
                                        }elseif($vo['already_loan_amount'] == $vo['credit_amount']){
                                            echo '已全额放款';
                                        }elseif($vo['already_loan_amount'] < $vo['credit_amount']){
                                            echo '未全额放款';
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </td>
                                    <td><?= $vo['contact_person_man'] ?></td>
                                    <td><?= $vo['contact_person_phone'] ?></td>
                                    <td><a href="<?= Url::to(['unite/get-info', 'base_id' => $vo['base_id'], 'type' => 'loan']) ?>">详情</a></td>
                                    <td><?= $vo['base_create_time'] ?></td>
                                    <td><a class="stream" data-app_id="<?= $vo['app_id'] ?>" data-group_id="<?= $vo['group_id'] ?>" href="javascript:void(0);">查看</a></td>
                                    <td class="table_btn">
                                    <?php if(in_array(Yii::$app->approvr_user->identity->belong, [1, 2])): ?>
                                        <a class="contract_info" data-loan_id="<?= $vo['loan_id']; ?>" href="javascript:void(0);">合同</a>
                                    <?php else: ?>
                                        <a class="loan_info" data-loan_id="<?= $vo['loan_id'] ?>" href="javascript:void(0);">放款信息</a>
                                        <a class="repayment_info" data-loan_id="<?= $vo['loan_id'] ?>" href="javascript:void(0);">还款信息</a> 
                                    <?php endif; ?>
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
<?php if(in_array(Yii::$app->approvr_user->identity->belong, [1, 2])): ?>
<?= $this->render('/contract/contract_info'); ?>
<?php else: ?>
<?= $this->render('/contract/loan_info'); ?>
<?= $this->render('/contract/repayment_info'); ?>
<?php endif; ?>
<?= $this->render('/contract/stream'); ?>

