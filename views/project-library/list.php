<?php

use yii\helpers\Url;

$this->title = '股权融资';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/yirongfu_common.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/project_2.css', ['depends' => 'app\assets\WxAsset']);
?>
<div class="wrapper project_list_bg">
    <div class="container_25 clearfix">
        <!--左侧-->
        <div class="project_list_left">
            <!--筛选-->
            <div class="project_screening clearfix">
                <div class="project_screening_left">
                    <dl class="clearfix">
                        <dt>所属领域：</dt>
                        <dd class="oflow">
                            <a class="cur" href="">全部</a>
                            <?php foreach ($field as $key => $vo): ?>
                                <a href=""><?= $vo ?></a>
                            <?php endforeach; ?>
                        </dd>
                        <a href="javascript:;" class="field-more" id="togmore">更多</a>
                    </dl>
                    <dl class="clearfix">
                        <dt>所属阶段：</dt>
                        <dd>
                            <a class="cur" href="">全部</a>
                            <?php foreach ($financing_stage as $key => $vo): ?>
                                <a href=""><?= $vo ?></a>
                            <?php endforeach; ?>
                        </dd>
                    </dl>
                    <dl class="clearfix">
                        <dt>融资金额：</dt>
                        <dd>
                            <a class="cur" href="">全部</a>
                            <a href="">500万以下</a>
                            <a href="">500-2000万</a>
                            <a href="">2000-5000万</a>
                            <a href="">5000万以上</a>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="tabArea">
                <div class="tabbd">
                    <div class="item">
                        <ul>
                            <?php foreach ($data as $key => $vo): ?>
                                <li class="clearfix">
                                    <div class="list_left">
                                        <div class="img_message">
                                            <a href="<?= Url::to(['project-library/detail', 'id' => $vo['id']]) ?>">
                                                <img src="/<?= $vo['bp_big_img'] ?>">
                                            </a>
                                        </div>
                                        <div class="info-panel">
                                            <p class="p_title_new"><?= $vo['bp_name'] ?></p>
                                            <p class="p_field_new">所属领域：<span><?= $field[$vo['bp_industry_id']] ?></span></p>
                                        </div>
                                        <p class="briefing">
                                            <a style="cursor:pointer;" title="<?= $vo['bp_instroduction'] ?>"><?= $vo['bp_instroduction'] ?>		                    </a>
                                        </p>
                                    </div>
                                    <!--评论-->
                                    <div class="list_comment_new">
                                        <p class="financing">
                                            融资金额：<span><?= $vo['t_finance_amount'] ?>万</span>
                                        </p>
                                        <a href="<?= Url::to(['project-library/detail', 'id' => $vo['id']]) ?>" class="view_details">查看详情</a>
                                        <span class="comment_number_new">
                                            <i class="viewnum"></i>
                                            227											
                                        </span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!--新的分页-->
            <div class="new_page">
                <a href="" class="cur">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a href="">6</a>
                <a href="" class="next">下一页</a>
                <a href="" class="next">尾页</a>
            </div>
        </div>

        <!--右侧-->
        <div class="yirongfu_right">
            <!--赋有排行-->
            <div class="right_list">
                <div class="right_list_title">“赋”有排行</div>
                <table cellpadding="0" cellspacing="0" class="ranking_table">
                    <col width="70"></col>
                    <col width="183"></col>
                    <col width="70"></col>
                    <thead>
                    <th>排名</th>
                    <th align="left">项目名称</th>
                    <th>查看数</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/1.png"></td>
                            <td align="left"><a href="" target="_blank">一条龙生产流水线纺织专业制 </a></td>
                            <td align="center" class="orange">5465</td>
                        </tr>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/2.png"></td>
                            <td align="left"><a href="" target="_blank">跨境电商保税O2O体验店（约 </a></td>
                            <td align="center" class="orange">4633</td>
                        </tr>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/3.png"></td>
                            <td align="left"><a href="" target="_blank">超级智能无屏电视投影仪（约 </a></td>
                            <td align="center" class="orange">3636</td>
                        </tr>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/4.png"></td>
                            <td align="left"><a href="" target="_blank">某鞋机机器人机械设备制造商 </a></td>
                            <td align="center" class="orange">3561</td>
                        </tr>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/5.png"></td>
                            <td align="left"><a href="" target="_blank">中医行业垂直o2o平台</a></td>
                            <td align="center" class="orange">3539</td>
                        </tr>
                        <tr>
                            <td align="center"><img src="/public/wx/images/sort_num/6.png"></td>
                            <td align="left"><a href="" target="_blank">人工智能机器人专家</a></td>
                            <td align="center" class="orange">3267</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#togmore').click(function () {
            if ($(this).hasClass('field-more')) {
                $(this).removeClass('field-more').addClass('field-less').text('收起');
                $('.oflow').css('height', 'auto');
            } else {
                $(this).removeClass('field-less').addClass('field-more').text('更多');
                $('.oflow').css('height', '66px');
            }
        });
    });
</script>
