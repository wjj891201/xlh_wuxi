<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Organization;
?>
<style type="text/css">
    .back {margin-bottom: 33px;float: left;display: block;float: left;height: 38px;width: 140px;border-radius: 10px;background: #399bff;font-size: 20px;color: #fff;line-height: 38px;text-align: center;}
</style>>
<div class="main-bar main-bar2">
    <div class="library-box">
        <a href="javascript:history.back(-1)" class="back">返回</a>
        <div class="clear"></div>
        <div class="article2">
            <div class="box3">
                <h3>基本信息</h3>
            </div>
            <div class="box4">
                <ul>
                    <?php $industry_arr = Yii::$app->params['industry']; ?>
                    <?php $industry_arr = ArrayHelper::index($industry_arr, 'id'); ?>
                    <li><label>企业名称：</label><?= $base['enterprise_name'] ?></li>
                    <li><label>所属区域：</label><?= $base['district'] ?>-<?= $base['town']['name'] ?></li>
                    <li><label>注册时间：</label><?= substr($base['register_date'], 0, 10) ?></li>
                    <li><label>注册资本：</label><?= $base['register_capital'] ?>（万元）</li>
                    <li><label>法定代表人：</label><?= $base['legal_person'] ?></li>
                    <li><label>法人联系方式：</label><?= $base['legal_person_phone'] ?></li>
                    <li><label>组织机构代码：</label><?= $base['institution_code'] ?></li>
                    <li><label>统一社会信用代码：</label><?= $base['credit_code'] ?></li>
                    <li><label>通讯地址：</label><?= $base['contact_address'] ?></li>
                    <li><label>联系人：</label><?= $base['contact_person_man'] ?></li>
                    <li><label>联系电话：</label><?= $base['contact_person_phone'] ?></li>
                    <li><label>电子邮箱：</label><?= $base['contact_mail'] ?></li>
                    <li><label>行业：</label><?= $industry_arr[$base['industry_id']]['name'] ?></li>
                    <li><label>企业简介：</label><span style="width:81%;display:inline-block;float:right;padding:5px;margin-top:-50px;"><?= $base['enterprise_info'] ?></span></li>
                    <li><label class="boxlabel">营业执照：</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['business_licence']]) ?>">下载</a></li>
                </ul>
            </div>
        </div>

        <div class="article2">
            <div class="box3">
                <h3>财务信息</h3>
            </div>
            <div class="box4">
                <ul>
                    <?php
                    $system = Yii::$app->params['system'];
                    $system = ArrayHelper::index($system, 'id');
                    $finance_year = $base['finance']['finance_year'];
                    $previous_year = !empty($finance_year) ? $finance_year - 1 : date('Y') - 2; //前年
                    $before_last_year = !empty($finance_year) ? $finance_year : date('Y') - 1; //去年
                    $last_year = !empty($finance_year) ? $finance_year + 1 : date('Y'); //近一期
                    ?>
                    <li><label>企业使用会计制度：</label><?= $system[$base['finance']['accounting_system']]['name'] ?></li>
                    <li><label><?= $finance_year ?>年销售收入：</label><?= $base['finance']['annual_sales'] ?>（万元）</li>
                    <li><label><?= $finance_year ?>年高新技术产品销售收入：</label><?= $base['finance']['hightec_sales'] ?>（万元）</li>
                    <li><label><?= $finance_year ?>年利润总额：</label><?= $base['finance']['annual_profit'] ?>（万元）</li>
                    <li><label><?= $finance_year ?>年研发经费投入：</label><?= $base['finance']['research_input'] ?>（万元）</li>
                    <li><label><?= $finance_year ?>年净资产：</label><?= $base['finance']['net_asset'] ?>（万元）</li>
                    <li><label><?= $finance_year ?>年资产负债率：</label><?= $base['finance']['asset_debt_ratio'] ?>%</li>
                    <li><label>员工总数：</label><?= $base['finance']['total_employees_num'] ?>人</li>
                    <li><label>大专以上科技人员数：</label> <?= $base['finance']['above_college_num'] ?>人</li>
                    <li><label>直接从事研发人员数：</label> <?= $base['finance']['research_num'] ?>人 </li>
                </ul>
            </div>
        </div>

        <div class="article2">
            <div class="box3">
                <h3>企业概述</h3>
            </div>
            <div class="box4">
                <ul>
                    <li>
                        <label>主要产品及技术领域：</label>
                        <span style="width:81%;display:inline-block;float:right;"><?= $base['describe']['product_tech_desc'] ?></span>
                    </li>
                    <div style="clear: both;"></div>
                    <li><label>企业拥有自主知识产权数量：</label><?= $base['describe']['equity_num'] ?></li> 
                    <?php $profession = !empty($base['describe']['profession']) ? json_decode($base['describe']['profession'], true) : []; ?>
                    <li style="height:100%;">
                        <label style="float:left;">企业核心管理人员职业经历:</label>
                        <div style="float:left; width:50%;">
                            <?php if (!empty($profession)): ?>
                                <?php foreach ($profession as $v): ?>
                                    <ul style="border:1px solid #A6B6C0;margin-top: 5px;padding-bottom: 10px;">
                                        <li><label style="width:15%; float:left;">姓名：</label><?= $v['name']; ?></li>
                                        <li><label style="width:15%; float:left;">职位：</label><?= $v['position']; ?></li>
                                        <li>
                                            <label style="width:15%; float:left;">经历：</label>
                                            <p style="float: right; width:83%; line-height:30px; margin-top:8px;white-space:normal;word-break:break-all;word-wrap:break-word;">
                                                <?= $v['experience']; ?>
                                            </p>
                                        </li>
                                        <div style="clear: both;"></div>
                                    </ul>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <div style="clear: both;"></div>
                    <li>
                        <?php $qualification_certificate = json_decode($base['describe']['qualification_certificate'], true); ?>
                        <label class="boxlabel">企业资质：</label>
                        <?php foreach ($qualification_certificate as $key => $vo): ?>
                            <div>
                                <label><?= $vo['name'] ?></label>
                                <a href="<?= Url::to(['ajax/download', 'filename' => $vo['path']]) ?>" class="download">下载</a>
                            </div>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>

        <?php $type = Yii::$app->request->get('type', 'base'); ?>
        <?php if (!empty($type) && $type == 'loan'): ?>
            <div class="article2">
                <div class="box3">
                    <h3>融资信息</h3>
                </div>
                <div class="box4">
                    <ul>
                        <li>
                            <label>是否有金融需求：</label>
                            <?= $base['loan']['want_financing'] == 1 ? '有需求' : '无需求'; ?>
                        </li>
                        <?php if ($base['loan']['want_financing'] == 1): ?>
                            <li>
                                <label>金融支持方式：</label>
                                <?php if (!empty($base['loan']['fund_support'])): ?>
                                    <?php $fund_support_arr = explode(',', $base['loan']['fund_support']); ?>
                                    <?php foreach ($fund_support_arr as $key => $vo): ?>
                                        【<?= $all_supports[$vo] ?>】
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </li>
                            <li><label>贷款金额：</label><?= $base['loan']['apply_amount'] ?>万</li>
                            <li><label>贷款期限：</label><?= $base['loan']['period_month'] ?>个月</li>
                            <?php $bank_name = Organization::find()->select('name')->where(['id' => $base['loan']['bank_id']])->scalar(); ?>
                            <li><label>选择银行：</label><?= $bank_name ?></li>
                            <li>
                                <label>贷款用途：</label>
                                <span style="width:81%;display:inline-block;float:right;"><?= $base['loan']['loan_purpose'] ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="article2">
                <div class="box3">
                    <h3>银行批复信息</h3>
                </div>
                <div class="box4">
                    <ul>
                        <li><label>授信金额：</label> <?= $base['loan']['credit_amount'] . '万'; ?></li>
                        <li><label>授信开始时间：</label> <?= $base['loan']['credit_time']; ?></li>
                        <li><label>授信截止时间：</label> <?= $base['loan']['credit_validity']; ?></li>
                        <li><label>已放款金额：</label> <?= $base['loan']['already_loan_amount'] . '万'; ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="article2">
            <div class="box3">
                <h3>相关附件</h3>
            </div>
            <div class="box4">
                <?php $system = Yii::$app->params['system']; ?>
                <?php $system = ArrayHelper::index($system, 'id'); ?>
                <ul>
                    <?php if (substr($base['register_date'], 0, 4) <= $previous_year): ?>
                        <li><label><?= $previous_year ?>年度企业适用会计制度：</label><?= $system[$base['finance']['accounting_system_before']]['name'] ?></li>
                        <li>
                            <label class="boxlabel"><?= $previous_year ?>年度税务报表：</label>
                            <div><label>《资产负债表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['asset_debt_file_before']]) ?>" class="download">下载</a></div>
                            <div><label>《利润及利润分配表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['profit_distribution_file_before']]) ?>" class="download">下载</a></div>
                        </li>
                    <?php endif; ?>
                    <li><label><?= $before_last_year ?>年度企业适用会计制度：</label><?= $system[$base['finance']['accounting_system']]['name'] ?></li>
                    <li>
                        <label class="boxlabel"><?= $before_last_year ?>年度税务报表：</label>
                        <div><label>《资产负债表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['asset_debt_file']]) ?>" class="download">下载</a></div>
                        <div><label>《利润及利润分配表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['profit_distribution_file']]) ?>" class="download">下载</a></div>
                    </li>
                    <li><label>近一期企业适用会计制度：</label><?= $system[$base['finance']['accounting_system_lastest']]['name'] ?></li>
                    <li>
                        <label class="boxlabel">近一期税务报表：</label>
                        <div><label>《资产负债表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['asset_debt_file_lastest']]) ?>" class="download">下载</a></div>
                        <div><label>《利润及利润分配表》</label><a href="<?= Url::to(['ajax/download', 'filename' => $base['finance']['profit_distribution_file_lastest']]) ?>" class="download">下载</a></div>
                    </li>
                </ul>
            </div>
        </div>
        <a href="<?= Url::to(['unite/get-info', 'base_id' => $base['base_id'], 'type' => $type, 'export' => 'export']); ?>" target="_blank" style="cursor:pointer;"><div class="btn3" >导出为pdf</div></a>
    </div>
</div>