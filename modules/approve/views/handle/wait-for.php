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
                                    <td><?= $vo['annual_sales'] ?>（万元）</td>
                                    <td><?= ($vo['want_financing'] == 1 ? '有' : '无') ?> </td>
                                    <td style="text-align:left;"><?= $vo['fund_support_cn'] ?></td>
                                    <td><?= $vo['contact_person_man'] ?></td>
                                    <td><?= $vo['contact_person_phone'] ?></td>
                                    <td><a href="<?= Url::to(['unite/get-info', 'base_id' => $vo['base_id'], 'type' => 'base']) ?>">详情</a></td>
                                    <td><?= $vo['base_create_time'] ?></td>
                                    <td><a class="stream" data-app_id="<?= $vo['app_id'] ?>" data-group_id="<?= $vo['group_id'] ?>" href="javascript:void(0);">查看</a></td>
                                    <td class="table_btn">
                                        <?php if ($vo['is_read'] != 1): ?>
                                            <?php foreach ($vo['actionList'] as $k => $v): ?>
                                                <a href="javascript:void(0);" data-workflow_log_id="<?= $vo['workflow_log_id'] ?>" data-action_key="<?= $v['action_key'] ?>" data-next_node_id="<?= $v['next_node_id'] ?>" class="<?= $v['action_key'] ?>"><?= $v['action_name'] ?></a>
                                            <?php endforeach; ?>
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

<div class="dialog dialog_retract">
    <div class="dcontent">
        <form action="<?= Url::to(['unite/result']) ?>" method="post" class="form form_reason" onsubmit="return validate(this)">
            <ul>
                <li>
                    <label id="warn"></label>
                </li>
                <li>
                    <textarea name="comment" id="comment" class="retract_con" placeholder="请输入5~50字以内的原因"></textarea>
                </li>
            </ul>
            <div class="dbtn" style="padding-top: 10px;">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <input type="hidden" name="workflow_log_id" value=""/>
                <input type="hidden" name="action_key" value=""/>
                <input type="hidden" name="next_node_id" value=""/>
                <button type="submit" class="dokay">确定</button> 
            </div>
        </form>
    </div>
</div>
<?= $this->render('/contract/stream'); ?>
<script>
    $(function () {
        $('.pass,.end,.back,.defer,.finish').click(function () {
            var attribute = $(this).attr('class');
            var workflow_log_id = $(this).data('workflow_log_id');
            var action_key = $(this).data('action_key');
            var next_node_id = $(this).data('next_node_id');
            var operate = $(this).html();
            if (attribute == 'pass' || attribute == 'finish') {
                aaa = layer.confirm('确认要通过吗？', {icon: 3, title: '提示', offset: '200px'}, function (index) {
                    if (next_node_id) {
                        location.href = "/approve/unite/result?workflow_log_id=" + workflow_log_id + "&action_key=" + action_key + "&next_node_id=" + next_node_id;
                    } else {
                        location.href = "/approve/unite/result?workflow_log_id=" + workflow_log_id + "&action_key=" + action_key;
                    }
                    layer.close(aaa);
                });
            } else {
                var warn = '请填写' + operate + '原因';
                $('#warn').append(warn);
                $('input[name=workflow_log_id]').attr('value', workflow_log_id);
                $('input[name=action_key]').attr('value', action_key);
                $('input[name=next_node_id]').attr('value', next_node_id);
                layer.open({
                    type: 1,
                    title: operate,
                    skin: 'layui-layer-rim',
                    area: ['500px', '280px'], //宽高
                    content: $('.dialog_retract').html(),
                    cancel: function (index, layero) {
                        $('#warn').empty();
                        layer.close(index);
                        return false;
                    }
                });
            }
        });
    });
    function validate(form) {
        if (form.comment.value == '') {
            layer.msg('请填写内容', {icon: 2, time: 1000});
            return false;
        }
    }
</script>