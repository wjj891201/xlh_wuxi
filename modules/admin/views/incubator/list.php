<?php

use yii\web\View;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->registerCssFile('@web/public/backend/js/kindeditor/themes/default/default.css', ['depends' => ['app\assets\AdminAsset']]);

$this->registerJsFile('@web/public/backend/js/kindeditor/kindeditor.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/backend/js/kindeditor/lang/zh_CN.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/backend/js/layer/layer.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
?>
<script>
    KindEditor.ready(function (K) {
        var editor = K.editor();
        $(document).on('click', '#upload-office_pic', function () {
            editor.loadPlugin("image", function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    clickFn: function (url) {
                        $(".office_pic").val(url);
                        $(".fileupload-preview").html('<img src="' + url + '" style="width:200px;height:150px;"/>');
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>
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
                                <a class="setedit2 house_type" data-incubator_id="<?= $vo['incubator_id'] ?>" href="javascript:void(0);">户型管理</a>
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
<!--户型列表-->
<div class="house_list" style="display: none;">
    <div style="margin-top: 15px;">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" id="navigation" class="tableBasic"></table>
    </div>
</div>
<!--户型添加-->
<div class="house_add" style="display: none;">
    <div style="margin-top: 15px;">
        <form id="this_house_add" action="<?= Url::to(['incubator/add-incubator-office']) ?>" method="post" onsubmit="return validate(this)">
            <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                <tr>
                    <td width="80" align="right">户型名称</td>
                    <td colspan="3">
                        <input type="text" name="office_style" size="25" class="inpMain office_style" />
                    </td>
                </tr>
                <tr>
                    <td align="right">户型规格</td>
                    <td colspan="3">
                        <input type="text" name="office_size" size="25" class="inpMain office_size" />
                    </td>
                </tr>
                <tr>
                    <td align="right">户型图片</td>
                    <td>
                        <div class="fileupload-preview thumbnail" style="margin: 0;">
                            <img src="/public/backend/images/upload.png"/>
                        </div>
                    </td>
                    <td colspan="2">
                        <button id="upload-office_pic" type="button" class="btn">选择图片</button>
                        <input type="hidden" id="office_pic" value="" name="office_pic" class="office_pic"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">户型价格</td>
                    <td>
                        <input type="text" name="office_price" size="5" class="inpMain office_price" />
                    </td>
                    <td width="80" align="right">价格单位</td>
                    <td>
                        <input type="text" name="office_unit" size="5" class="inpMain office_unit" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <input type="hidden" name="incubator_id" id="incubator_id"/>
                        <button type="submit" class="btn">提交</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script>
    $(function () {
        $('.house_type').click(function () {
            var incubator_id = $(this).data('incubator_id');
            $("#incubator_id").attr("value", incubator_id);
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['incubator/ajax-get-office']) ?>',
                dataType: "json",
                async: false,
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', incubator_id: incubator_id},
                success: function (result) {
                    var html = '';
                    html += '<tr>';
                    html += '<th align="center">户型名称</th>';
                    html += '<th align="center">户型规格</th>';
                    html += '<th align="center">户型图片</th>';
                    html += '<th align="center">户型价格</th>';
                    html += '<th align="center">价格单位</th>';
                    html += '<th align="center">操作</th>';
                    html += '</tr>';
                    $.each(result, function (index, item) {
                        html += '<tr>';
                        html += '<td align="center">' + item.office_style + '</td>';
                        html += '<td align="center">' + item.office_size + '</td>';
                        html += '<td align="center"><img width="50" height="50" src="' + item.office_pic + '"></td>';
                        html += '<td align="center">' + item.office_price + '</td>';
                        html += '<td align="center">' + item.office_unit + '</td>';
                        html += '<td align="center">';
                        html += '<a href="">删除</a>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $("#navigation").append(html);
                }
            });
            layer.tab({
                zIndex: 0,
                area: ['600px', '460px'],
                tab: [{
                        title: '户型列表',
                        content: $('.house_list').html()
                    }, {
                        title: '新增户型',
                        content: $('.house_add').html()
                    }],
                end: function () {
                    $("#navigation").empty();
                }
            });
        });
    });

    function validate(form) {
        if (form.office_style.value == '') {
            layer.msg('请填写户型名称', {icon: 2, time: 1000});
            return false;
        }
        if (form.office_size.value == '') {
            layer.msg('请填写户型规格', {icon: 2, time: 1000});
            return false;
        }
        if (form.office_pic.value == '') {
            layer.msg('请上传户型图片', {icon: 2, time: 1000});
            return false;
        }
        if (form.office_price.value == '') {
            layer.msg('请填写户型价格', {icon: 2, time: 1000});
            return false;
        }
        if (form.office_unit.value == '') {
            layer.msg('请填写价格单位', {icon: 2, time: 1000});
            return false;
        }
    }
</script>