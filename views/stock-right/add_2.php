<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '添加股权融资-第二步';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/release.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
?>

<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <b>股权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <div class="member_right grid_20 omega product_box">
            <div class="member_right grid_20 omega product_box">
                <?php $form = ActiveForm::begin(); ?>
                <div class="container">
                    <div class="top-title">
                        <h2>股权项目发布</h2>
                    </div>
                    <div class="vessel">
                        <div class="vessel-title">
                            <p><i class="v-id">2</i>项目信息</p>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>项目名称</p>
                            <?= $form->field($model, 'bp_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd29'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>项目概述</p>
                            <?= $form->field($model, 'bp_instroduction', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd29'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <p class="case-title-one ht13 lht13"><i>*</i>项目简介</p>
                            <?= $form->field($model, 'bp_project_content', ['errorOptions' => ['class' => 'exclamation']])->textArea(['class' => 'cpt wd44', 'placeholder' => '100~1000字以内'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <div class="case-title-three"><i>*</i><p>项目所在地区</p></div>
                            <?= $form->field($model, 'bp_region_bid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_bid, ['id' => 'bp_region_bid'])->label(false); ?>
                            <?= $form->field($model, 'bp_region_mid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_mid, ['id' => 'bp_region_mid'])->label(false); ?>
                            <?= $form->field($model, 'bp_region_sid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_sid, ['id' => 'bp_region_sid'])->label(false); ?>
                        </div>
                        <div class="vcase">
                            <div class="case-title-two"><i>*</i><p>所属领域</p></div>
                            <div class="select-panel">
                                <?=
                                $form->field($model, 'bp_industry_id', ['errorOptions' => ['class' => 'exclamation']])->inline()->radioList($field, [
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $return = '<div class="checking"><input type="radio" name="' . $name . '" id="_' . $index . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '><label for="_' . $index . '">' . $label . '</label></div>';
                                        return $return;
                                    }
                                ])->label(false);
                                ?>
                            </div>
                        </div>
                        <div class="vcase">
                            <p class="case-title-one ht8 lht8"><i></i>项目图片</p>
                            <div class="case-upload">
                                <span>
                                    <?php if ($model->bp_big_img): ?>
                                        <img id="project_img" src="/<?= $model->bp_big_img ?>">
                                    <?php else: ?>
                                        <img id="project_img" src="/public/wx/images/img_example.jpg">
                                    <?php endif; ?>
                                </span>
                                <div class="upload-right" style="width:400px">
                                    <label for="upload_account" id="change_avatar" class="project-pic-upload">
                                        <i class="upload-icon"></i>
                                        上传项目图片
                                    </label>
                                    <input id="upload_account" type="file" name="userfile" onchange="fileChange(this);" style="display: none;">
                                    <label style="font-size:12px ; line-height:5.5;margin-left:9px">
                                        注：请上传企业logo或者项目logo图片
                                    </label>
                                    <p style="margin-top: -10px">仅支持jpg、jpeg，png、gif（2M以下）</p>
                                </div>
                                <?= $form->field($model, 'bp_big_img', ['errorOptions' => ['class' => 'exclamation', 'style' => 'color:#EE5121;margin-left:0px;']])->hiddenInput(['id' => 'bp_big_img'])->label(false); ?>
                            </div>
                        </div>
                        <div class="vcase">
                            <div class="case-title-two ht3 lht3"><i>*</i><p>公司团队</p></div>
                            <a href="javascript:;" id="team-add"><b class="add-icon">+</b>添加团队成员</a>
                            <div class="team-panel">
                                <?php $bp_profession_arr = json_decode($model->bp_profession, true); ?>
                                <?php if ($bp_profession_arr): ?>
                                    <?php foreach ($bp_profession_arr as $key => $vo): ?>
                                        <div class="team-float" data-id="<?= $key ?>">
                                            <div class="team-box">
                                                <div class="team-per" style="border: 1px solid #ee6f15;">
                                                    <div class="inner-per">
                                                        <label>姓名：</label>
                                                        <p class="per_name"><?= $vo['name'] ?></p>
                                                        <input name="pro_name[]" type="hidden" value="<?= $vo['name'] ?>">
                                                    </div>
                                                    <div class="inner-per">
                                                        <label>职位：</label>
                                                        <p class="per_position"><?= $vo['position'] ?></p>
                                                        <input name="pro_job[]" type="hidden" value="<?= $vo['position'] ?>">
                                                    </div>
                                                    <div class="inner-per">
                                                        <label>工作履历：</label>
                                                        <p class="wexp"><?= $vo['experience'] ?></p>
                                                        <input name="pro_exp[]" type="hidden" value="<?= $vo['experience'] ?>">
                                                    </div>
                                                </div>
                                                <div class="edit-box">
                                                    <span><a href="javascript:;" class="editing"><i class="editing-icon"></i>编辑</a></span>
                                                    <span><a href="javascript:;" class="delete"><i class="delete-icon"></i>删除</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?= $form->field($model, 'code', ['errorOptions' => ['class' => 'exclamation']])->hiddenInput(['id' => 'code'])->label(false); ?>
                        </div>
                        <div class="vcase" style="margin-bottom: 0px;">
                            <div class="case-title-five"><p class="model-case-title"><i>*</i>商业模式</p></div>
                            <?= $form->field($model, 'bp_gain_model', ['errorOptions' => ['class' => 'exclamation']])->textArea(['class' => 'cpt business-model', 'placeholder' => '500字以内'])->label(false); ?>
                        </div>
                        <div class="vcase" style="margin-bottom: 0px;">
                            <div class="case-title-five"><p class="model-case-title"><i>*</i>竞争优势</p></div>
                            <?= $form->field($model, 'bp_analysis', ['errorOptions' => ['class' => 'exclamation']])->textArea(['class' => 'cpt business-model', 'placeholder' => '500字以内'])->label(false); ?>
                        </div>
                        <div class="vcase" style="margin-bottom: 0px;">
                            <div class="case-title-five"><p class="model-case-title"><i></i>主要竞争对手</p></div>
                            <?= $form->field($model, 'bp_tactic_plan', ['errorOptions' => ['class' => 'exclamation']])->textArea(['class' => 'cpt business-model', 'placeholder' => '500字以内'])->label(false); ?>
                        </div>
                    </div>
                    <div class="btn-group2">
                        <a type="button" class="cancel_button" id="cancel">上一步</a>
                        <?= Html::submitButton('下一步', ['class' => 'submit_button']); ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<div class="company_team" style="display: none;">
    <div class="member-add">
        <div class="info-collect">
            <label class="wd9">姓名：</label>
            <input type="text" class="wd9 pname">
        </div>
        <div class="info-collect">
            <label class="wd9">职位：</label>
            <input type="text" class="wd9 pjob">
        </div>
        <div class="info-collect">
            <label class="wd9">工作履历：</label>
            <textarea class="pexperience" placeholder="10~200个字以内"></textarea>
        </div>
        <div class="popup-btn-group">
            <a href="javascript:;" class="popup-keep">保存</a>
        </div>
    </div>
</div>

<script>
    $(function () {
        //公司地址联动~~~start	
        $('#bp_region_bid').change(function () {
            ajax_get_region('bp_region_bid', 'bp_region_mid', 2, $(this).val());
        });
        $('#bp_region_mid').change(function () {
            ajax_get_region('bp_region_mid', 'bp_region_sid', 3, $(this).val());
        });
        function ajax_get_region(get_name, set_name, type, id) {
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['claims-right/ajax-get-region']) ?>',
                dataType: "json",
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', type: type, parent_id: id},
                success: function (data) {
                    if (get_name == 'bp_region_bid') {
                        $('#bp_region_mid,#bp_region_sid').empty().append("<option value=''>请选择</option>");
                    }
                    if (get_name == 'bp_region_mid') {
                        $('#bp_region_sid').empty().append("<option value=''>请选择</option>");
                    }
                    if (get_name == 'manager_province') {
                        $('#manager_city').empty().append("<option value=''>请选择</option>");
                    }
                    $.each(data, function (idx, item) {
                        $('#' + set_name).append($("<option value=" + item.id + ">" + item.name + "</option>"));
                    });
                }
            });
        }
        //公司地址联动~~~end

        //核心管理人员相关的js~~~start
        $('#team-add').click(function () {
            bbb = layer.open({
                type: 1,
                title: '添加团队成员',
                skin: 'layui-layer-rim',
                area: ['300px', '390px'], //宽高
                content: $('.company_team'),
                end: function () {
                    //初始化数据
                    $('.popup-keep').attr('data-id', '');
                    $('.pname,.pjob,.pexperience').val("");
                    //没有内容
                    var team_float = $('.team-float');
                    if (team_float.length != 0) {
                        $("#code").val(1);
                    } else {
                        $("#code").val('');
                    }
                    //为了让yii2框架的验证生效
                    $("#code").focus();
                    $("#code").blur();
                }
            });
        });
        $(document).on('click', '.popup-keep', function () {
            var data_id = $(this).attr('data-id');
            var pname = $('.pname').val();
            if (pname == '') {
                layer.tips('请填写姓名', '.pname');
                return false;
            }
            var pjob = $('.pjob').val();
            if (pjob == '') {
                layer.tips('请填写职位', '.pjob');
                return false;
            }
            var pexperience = $('.pexperience').val();
            if (pexperience == '') {
                layer.tips('请填写经历', '.pexperience');
                return false;
            }
            if (data_id) {
                //编辑
                var editnode = $('.team-panel .team-float[data-id=' + data_id + ']');
                editnode.find('.inner-per:eq(0)').html('<label>姓名：</label><p class="per_name">' + pname + '</p><input name="pro_name[]" type="hidden" value="' + pname + '"/>');
                editnode.find('.inner-per:eq(1)').html('<label>职位：</label><p class="per_position">' + pjob + '</p><input name="pro_job[]" type="hidden" value="' + pjob + '"/>');
                editnode.find('.inner-per:eq(2)').html('<label>工作履历：</label><p class="wexp">' + pexperience + '</p><input name="pro_exp[]" type="hidden" value="' + pexperience + '"/>');
                layer.close(ccc);
            } else {
                //添加
                var html = '<div class="team-float">';
                html += '<div class="team-box">';
                html += '<div class="team-per" style="border: 1px solid #ee6f15;">';
                html += '<div class="inner-per">';
                html += '<label>姓名：</label>';
                html += '<p class="per_name">' + pname + '</p>';
                html += '<input name="pro_name[]" type="hidden" value="' + pname + '">';
                html += '</div>';
                html += '<div class="inner-per">';
                html += '<label>职位：</label>';
                html += '<p class="per_position">' + pjob + '</p>';
                html += '<input name="pro_job[]" class="per_position_v" type="hidden" value="' + pjob + '">';
                html += '</div>';
                html += '<div class="inner-per">';
                html += '<label>工作履历：</label>';
                html += '<p class="wexp">' + pexperience + '</p>';
                html += '<input name="pro_exp[]" class="wexp_v" type="hidden" value="' + pexperience + '">';
                html += '</div>';
                html += '</div>';
                html += '<div class="edit-box">';
                html += '<span><a href="javascript:;" class="editing"><i class="editing-icon"></i>编辑</a></span>';
                html += '<span><a href="javascript:;" class="delete"><i class="delete-icon"></i>删除</a></span>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $(".team-panel").append(html);
                id_value();
                layer.close(bbb);
            }
        });
        $(document).on('click', '.delete', function () {
            $(this).parents(".team-float").remove();
            id_value();
            //没有内容
            var team_float = $('.team-float');
            if (team_float.length != 0) {
                $("#code").val(1);
            } else {
                $("#code").val('');
            }
            //为了让yii2框架的验证生效
            $("#code").focus();
            $("#code").blur();
        });
        $(document).on('click', '.editing', function () {
            var edit_npde = $(this).parents(".team-float");
            var data_id = edit_npde.attr('data-id');
            $('.popup-keep').attr('data-id', data_id);
            //姓名
            var obj = edit_npde.find(".inner-per:eq(0)").find("p");
            var pname = obj.html().trim();
            //职务
            var obj = edit_npde.find(".inner-per:eq(1)").find("p");
            var pjob = obj.html().trim();
            //经历
            var obj = edit_npde.find(".inner-per:eq(2)").find("p");
            var pexperience = obj.html().trim();
            //赋值
            $('.pname').val(pname);
            $('.pjob').val(pjob);
            $('.pexperience').val(pexperience);
            //弹出层
            ccc = layer.open({
                type: 1,
                title: '编辑公司团队',
                skin: 'layui-layer-rim',
                area: ['300px', '390px'], //宽高
                content: $('.company_team'),
                end: function () {
                    $('.popup-keep').attr('data-id', '');
                    $('.pname,.pjob,.pexperience').val("");
                }
            });
        });
        var id_value = function () {
            var liNode = $('.team-panel .team-float');
            liNode.each(function () {
                $(this).attr('data-id', $(this).index());
            });
        };
        //核心管理人员相关的js~~~end
    });

    //上传项目图片
    function fileChange(target) {
        var thisId = target.id;
        var formData = new FormData();
        formData.append("_csrf", "<?= Yii::$app->request->csrfToken ?>");
        formData.append("type", 'project');
        formData.append("file", $('#' + thisId)[0].files[0]);
        $.ajax({
            url: "<?= Url::to(['claims-right/ajax-upload-files']) ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                //可以做一些正在上传的效果
            },
            success: function (data) {
                //data，我们这里是异步上传到后端程序所返回的图片地址
                var obj = JSON.parse(data);
                if (obj.code == 20000) {
                    $('#project_img').attr('src', '/' + obj.success.url);
                    $("#bp_big_img").val(obj.success.url);
                    //为了让yii2的验证生效
                    $("#bp_big_img").focus();
                    $("#bp_big_img").blur();
                }
                if (obj.code == 20001) {
                    layer.msg(obj.error, {icon: 2, time: 2000});
                }
            },
            error: function (responseStr) {
                console.log(responseStr);
            }
        });
    }
</script>




