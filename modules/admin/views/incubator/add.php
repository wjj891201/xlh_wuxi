<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile('@web/public/backend/js/kindeditor/themes/default/default.css', ['depends' => ['app\assets\AdminAsset']]);
$this->registerJsFile('@web/public/backend/js/kindeditor/kindeditor.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/backend/js/kindeditor/lang/zh_CN.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/backend/js/My97DatePicker/WdatePicker.js', ['depends' => ['app\assets\AdminAsset'], 'position' => View::POS_HEAD]);
?>
<script>
    KindEditor.ready(function (K) {
        K.create('textarea[id="incubator_intro"],textarea[id="incubator_condition"]', {afterBlur: function () {
                this.sync();
            }});
        var editor = K.editor();
        $("#upload-image-incubator_logo").click(function () {
            editor.loadPlugin("image", function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    clickFn: function (url) {
                        $("#incubator_logo").val(url);
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
    <div id="urHere">管理中心<b>></b><strong>添加孵化信息</strong> </div>   
    <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <?php
        $form = ActiveForm::begin();
        ?>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
                <td width="20%" align="right">品牌名称</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_name')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">机构全称</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'facilitating_agency_name')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">载体资质</td>
                <td colspan="2">
                    <?= $form->field($model, 'incubator_type')->radioList($incubator_type, ['style' => 'display:inline;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">载体类型</td>
                <td colspan="2">
                    <?= $form->field($model, 'incubator_vector')->radioList($incubator_vector, ['style' => 'display:inline;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">基础设施</td>
                <td colspan="2">
                    <?= $form->field($model, 'facility_ops')->checkboxList($facility_ops, ['style' => 'display:inline;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">特色服务</td>
                <td colspan="2">
                    <?= $form->field($model, 'service_ops')->checkboxList($service_ops, ['style' => 'display:inline;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">详细地址</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_address')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">联系人姓名</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_contact')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">联系人手机号</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_contact_phone')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">联系固话</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_tell')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">联系人职位</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'contact_user_position')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td width="20%" align="right">注册企业数</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'enterprise_count')->textInput(['class' => 'inpMain', 'size' => 40])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">载体性质</td>
                <td colspan="2">
                    <?= $form->field($model, 'incubator_property')->radioList($incubator_property, ['style' => 'display:inline;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">园区log</td>
                <td width="25%" align="center">
                    <div class="fileupload-preview thumbnail">
                        <?php if (!empty($model->incubator_logo)): ?>
                            <img src="<?= $model->incubator_logo ?>" width="200" height="150"/>
                        <?php else: ?>
                            <img src="/public/backend/images/upload.png"/>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <button id="upload-image-incubator_logo" type="button" class="btn">选择图片</button>
                    <?= $form->field($model, 'incubator_logo')->hiddenInput(['id' => 'incubator_logo'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right">成立时间</td>
                <td colspan="2">
                    <?php echo $form->field($model, 'incubator_created', ['template' => "{input}&nbsp;&nbsp;<a class=\"datetime\" onclick=\"WdatePicker({el: 'incubator_created', isShowClear: false, readOnly: true, dateFmt: 'yyyy-MM-dd'})\">选择日期</a>{error}"])->textInput(['id' => 'incubator_created', 'class' => 'inpMain', 'size' => 24, 'readonly' => 'readonly'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">孵化简介</td>
                <td colspan="2">
                    <?= $form->field($model, 'incubator_intro')->textarea(['id' => 'incubator_intro', 'class' => 'textArea', 'style' => 'width:80%;height:300px;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top">入驻规则</td>
                <td colspan="2">
                    <?= $form->field($model, 'incubator_condition')->textarea(['id' => 'incubator_condition', 'class' => 'textArea', 'style' => 'width:80%;height:300px;'])->label(false); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">
                    <?php echo Html::submitButton('提交', ['class' => 'btn']); ?>
                </td>
            </tr>
        </table>
        <?php ActiveForm::end(); ?>
    </div>
</div>