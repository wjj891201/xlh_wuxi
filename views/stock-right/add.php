<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '添加股权融资项目';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/release.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/laydate/laydate.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/minFloor.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_END]);
?>
<div style="border-bottom:2px solid #f4c11e;"></div>
<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <b>股权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <div class="member_right grid_20 omega product_box">
            <?php $form = ActiveForm::begin(); ?>
            <div class="container">
                <div class="top-title">
                    <h2>股权项目发布</h2>
                </div>
                <div class="vessel">
                    <div class="vessel-title">
                        <p><i class="v-id">1</i>企业信息</p>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>企业名称</p>
                        <?= $form->field($model, 'enterprise_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd29'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>所在地区</p>
                        <?= $form->field($model, 'company_region_bid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_bid, ['id' => 'company_region_bid'])->label(false); ?>
                        <?= $form->field($model, 'company_region_mid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_mid, ['id' => 'company_region_mid'])->label(false); ?>
                        <?= $form->field($model, 'company_region_sid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_sid, ['id' => 'company_region_sid'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>办公地址</p>
                        <?= $form->field($model, 'office_address', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd29'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>公司人数</p>
                        <?= $form->field($model, 'staff_num', ['template' => "{input}<span class=\"ml-20\">人</span>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd12 pr30'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>注册资本</p>
                        <?= $form->field($model, 'register_capital', ['template' => "{input}<span class=\"ml-35\">万元</span>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd12 pr30'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>*</i>成立时间</p>
                        <?= $form->field($model, 'establish_time', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['id' => 'establish_time', 'class' => 'cpt wd12 pr30'])->label(false); ?>
                    </div>
                    <div class="vcase">
                        <p class="case-title"><i>&nbsp;</i>企业性质</p>
                        <?= $form->field($model, 'company_type', ['errorOptions' => ['class' => 'exclamation']])->dropDownList($company_type, ['id' => 'company_type', 'class' => 'wd30'])->label(false); ?>
                    </div>
                    <div class="vcase" style="margin-bottom: 5px;">
                        <div class="case-title-two" style="margin-left: 0px;"><i>*</i><p>注册信息</p></div>
                        <div class="case-box">
                            <div class="inner-box">
                                <div class="inner-case">
                                    <label class="case-title" for="registered">工商注册号</label>
                                    <?= $form->field($model, 'tax_registration', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd22'])->label(false); ?>
                                </div>
                                <div class="inner-case">
                                    <label class="case-title" for="social_credit">企业统一社会信用代码</label>
                                    <?= $form->field($model, 'organization_code', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'cpt wd22'])->label(false); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-box">
                    <div class="gather">
                        <label class="case-title"><i>*</i>真实姓名</label>
                        <?= $form->field($model, 'contacts', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="gather">
                        <label class="case-title"><i>*</i>职位名称</label>
                        <?= $form->field($model, 'duties', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="gather">
                        <label class="case-title"><i>*</i>联系手机</label>
                        <?= $form->field($model, 'contact_number', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="gather">
                        <label><i></i>邮箱</label>
                        <?= $form->field($model, 'email', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="gather">
                        <label><i></i>微信</label>
                        <?= $form->field($model, 'wechat', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="gather">
                        <label><i></i>网址</label>
                        <?= $form->field($model, 'company_website', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'wd16'])->label(false); ?>
                    </div>
                    <div class="btn-group">
                        <?= Html::submitButton('提 交', ['class' => 'submit_button']); ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        //时间插件
        laydate.render({
            elem: '#establish_time',
            theme: '#FF6666'
        });
        
         //公司地址联动~~~start	
        $('#company_region_bid').change(function () {
            ajax_get_region('company_region_bid', 'company_region_mid', 2, $(this).val());
        });
        $('#company_region_mid').change(function () {
            ajax_get_region('company_region_mid', 'company_region_sid', 3, $(this).val());
        });
        function ajax_get_region(get_name, set_name, type, id) {
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['claims-right/ajax-get-region']) ?>',
                dataType: "json",
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', type: type, parent_id: id},
                success: function (data) {
                    if (get_name == 'company_region_bid') {
                        $('#company_region_mid,#company_region_sid').empty().append("<option value=''>请选择</option>");
                    }
                    if (get_name == 'company_region_mid') {
                        $('#company_region_sid').empty().append("<option value=''>请选择</option>");
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
    });
</script>