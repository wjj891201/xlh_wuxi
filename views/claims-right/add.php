<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '添加债权融资项目';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/layer/layer.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/laydate/laydate.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/minFloor.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_END]);
?>
<div style="border-bottom:2px solid #f4c11e;"></div>
<div class="wrapper member">
    <div class="member_crumb container_25">
        <a href="">会员中心</a> &gt;
        <b>债权融资项目</b>
    </div>
    <div class="container_25 clearfix member_box">
        <?= $this->render('../layouts/member_left.php'); ?>		
        <div class="member_right grid_20 omega product_box">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'wk_project_add', 'enctype' => 'multipart/form-data']]); ?>
            <div class="member_right_content">
                <h3 class="zhai_title">债权融资项目发布</h3>
                <p class="dai_tou_recommend"></p>
                <div class="fenlei_nav clearfix">
                    <ul>
                        <li class="cur"><a href="">贷款项目</a></li>
                    </ul>
                    <p>通过银行、小贷、P2P等机构获得资金的融资</p>
                </div>
                <ul class="scroll_nav min-floor">
                    <li class="cur"><a href="javascript:void(0)">融资信息</a></li>
                    <li><a href="javascript:void(0)">企业基本信息</a></li>
                    <li><a href="javascript:void(0)">经营信息</a></li>
                    <li><a href="javascript:void(0)">实际控制人信息</a></li>
                    <li><a href="javascript:void(0)">联系人信息</a></li>
                    <li><a href="javascript:void(0)">附件上传</a></li>
                </ul>
                <!--贷款信息-->
                <div class="message_label" data-floor="1">
                    <div class="daikuan_title one_title">融资信息</div>
                    <ul class="message_label_list clearfix dai_tou_list">
                        <li>
                            <label><i>*</i>融资金额：</label>
                            <?= $form->field($model, 'loans_num', ['template' => "{input}<p>万元</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>货款用途：</label>
                            <?= $form->field($model, 'loans_usage', ['errorOptions' => ['class' => 'exclamation']])->dropDownList($loans_usage)->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>担保方式：</label>
                            <?= $form->field($model, 'guarantee_bid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($guarantee_bid, ['class' => 'danbao w-select', 'id' => 'guarantee_bid'])->label(false); ?>
                            <?= $form->field($model, 'guarantee_mid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($guarantee_mid, ['class' => 'danbao w-select', 'id' => 'guarantee_mid'])->label(false); ?>
                            <?= $form->field($model, 'guarantee_sid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($guarantee_sid, ['class' => 'danbao w-select', 'id' => 'guarantee_sid'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>估值：</label>
                            <?= $form->field($model, 'other', ['template' => "{input}<p>万元</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>货款期限：</label>
                            <?= $form->field($model, 'loads_date', ['template' => "{input}<p>个月</p>{error}<em>贷款期限在1个月-24个月之间</em>", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>是否已贷款：</label>
                            <?= $form->field($model, 'is_loads', ['errorOptions' => ['class' => 'exclamation']])->dropDownList(['1' => '是', '0' => '否'])->label(false); ?>
                        </li>
                    </ul>
                </div>

                <!--企业基本信息-->
                <div class="message_label" data-floor="2">
                    <div class="daikuan_title two_title">企业基本信息</div>
                    <ul class="message_label_list clearfix dai_tou_list">
                        <li>
                            <label><i>*</i>成立时间：</label>
                            <?= $form->field($model, 'company_created', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['id' => 'company_created', 'class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>企业名称：</label>
                            <?= $form->field($model, 'company_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li style="height:auto">
                            <label><i>*</i>公司地址：</label>
                            <?= $form->field($model, 'company_region_bid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_bid, ['class' => 'danbao', 'id' => 'company_region_bid'])->label(false); ?>
                            <?= $form->field($model, 'company_region_mid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_mid, ['class' => 'danbao', 'id' => 'company_region_mid'])->label(false); ?>
                            <?= $form->field($model, 'company_region_sid', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_sid, ['class' => 'danbao', 'id' => 'company_region_sid'])->label(false); ?>
                            <br>
                            <?= $form->field($model, 'company_address', ['template' => "{input}"])->textInput(['class' => 'w145', 'style' => 'margin-left:100px', 'id' => 'adress'])->label(false); ?>
                        </li>
                        <li style="height:auto">
                            <label><i>*</i>所属行业：</label>
                            <div class="wid">
                                <?= $form->field($model, 'company_industry', ['errorOptions' => ['class' => 'exclamation']])->dropDownList($company_industry)->label(false); ?>
                            </div>
                        </li>
                        <li>
                            <label>主营业务：</label>
                            <?= $form->field($model, 'company_business', ['template' => "{input}"])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                    </ul>
                </div>

                <!--经营信息-->
                <div class="message_label" data-floor="3">
                    <div class="daikuan_title three_title">经营信息</div>
                    <ul class="message_label_list clearfix">
                        <li>
                            <label><i>*</i>近三年主营业务收入：</label>
                            <?= $form->field($model, 'sell_income_1', ['template' => "{input}<p>万元（" . ( date('Y') - 1) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label></label>
                            <?= $form->field($model, 'sell_income_2', ['template' => "{input}<p>万元（" . ( date('Y') - 2) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label></label>
                            <?= $form->field($model, 'sell_income_3', ['template' => "{input}<p>万元（" . ( date('Y') - 3) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>近三年净利润：</label>
                            <?= $form->field($model, 'net_profit_1', ['template' => "{input}<p>万元（" . ( date('Y') - 1) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label></label>
                            <?= $form->field($model, 'net_profit_2', ['template' => "{input}<p>万元（" . ( date('Y') - 2) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label></label>
                            <?= $form->field($model, 'net_profit_3', ['template' => "{input}<p>万元（" . ( date('Y') - 3) . "年）</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200 Income'])->label(false); ?>
                        </li>
                        <li>
                            <label>企业近一年资产负债率：</label>
                            <?= $form->field($model, 'incur_debts', ['template' => "{input}<p>%</p>{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200'])->label(false); ?>
                        </li>
                    </ul>
                    <input type="hidden" name="is_gq" value="0">
                </div>
                <!--实际控制人信息--> 
                <div class="message_label" data-floor="4">
                    <div class="daikuan_title four_title">实际控制人信息</div>
                    <ul class="message_label_list clearfix dai_tou_list">
                        <li>
                            <label><i>*</i>姓名：</label>
                            <?= $form->field($model, 'manager_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w200'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>户籍：</label>
                            <?= $form->field($model, 'manager_province', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_bid, ['class' => 'huji', 'id' => 'manager_province'])->label(false); ?>
                            <?= $form->field($model, 'manager_city', ['errorOptions' => ['class' => 'exclamation', 'style' => 'padding:0;margin:0;']])->dropDownList($region_mid, ['class' => 'huji', 'id' => 'manager_city'])->label(false); ?>
                        </li>
                    </ul>
                </div>

                <!--联系人信息-->
                <div class="message_label" data-floor="5">
                    <div class="daikuan_title five_title">联系人信息</div>
                    <ul class="message_label_list clearfix dai_tou_list">
                        <li>
                            <label><i>*</i>联系人：</label>
                            <?= $form->field($model, 'user_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>手机号码：</label>
                            <?= $form->field($model, 'user_mobile', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>职务名称：</label>
                            <?= $form->field($model, 'user_title', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>邮箱信息：</label>
                            <?= $form->field($model, 'user_mail', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                    </ul>
                </div>

                <!--附件上传-->
                <div class="message_label" style="border-bottom:0;" data-floor="6">
                    <div class="daikuan_title six_title">
                        <p>营业执照上传</p><span></span>
                    </div>
                    <div class="update_raea">
                        <ul class="clearfix">
                            <li>
                                <div class="upload upload2" style="display:block">
                                    <label for="fileupload" id="update_btn"></label>
                                    <input name="mypic" id="fileupload" type="file" onchange="fileChange(this);"/>
                                </div>
                                <?= $form->field($model, 'document_url', ['errorOptions' => ['class' => 'exclamation']])->hiddenInput(['id' => 'document_url'])->label(false); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--按钮区域-->
                <div class="btn_area">
                    <?= Html::submitButton('提 交', ['class' => 'submit_button']); ?>
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
            elem: '#company_created',
            theme: '#FF6666'
        });

        //担保联动~~~start
        $("#guarantee_bid").change(function () {
            ajax_get_guarantee('guarantee_bid', 'guarantee_mid', 2, $(this).val());
        });
        $("#guarantee_mid").change(function () {
            ajax_get_guarantee('guarantee_mid', 'guarantee_sid', 3, $(this).val());
        });
        function ajax_get_guarantee(get_name, set_name, level, id) {
            $.ajax({
                type: 'post',
                url: '<?= Url::to(['claims-right/ajax-get-guarantee']) ?>',
                dataType: "json",
                data: {_csrf: '<?= Yii::$app->request->csrfToken ?>', level: level, top_id: id},
                success: function (data) {
                    if (get_name == 'guarantee_bid') {
                        $('#guarantee_mid,#guarantee_sid').empty().append("<option value=''>请选择</option>");
                    }
                    if (get_name == 'guarantee_mid') {
                        $('#guarantee_sid').empty().append("<option value=''>请选择</option>");
                    }
                    $.each(data, function (idx, item) {
                        $('#' + set_name).append($("<option value=" + item.id + ">" + item.name + "</option>"));
                    });
                }
            });
        }
        //担保联动~~~end

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

        //户籍联动~~~start
        $('#manager_province').change(function () {
            ajax_get_region('manager_province', 'manager_city', 2, $(this).val());
        });
        //户籍联动~~~end
    });

    //上传图片
    function fileChange(target) {
        var thisId = target.id;
        var formData = new FormData();
        formData.append("_csrf", "<?= Yii::$app->request->csrfToken ?>");
        formData.append("type", 'license');
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
                    $("#document_url").val(obj.success.url);
//                        $('.upload_before img').attr('src', '/public/kjd/images/file_finsh.png');
//                        $('.upload_describe .title').html('上传成功');
//                        $('.upload_describe .subtitle').html('重新上传营业执照<i></i>');
                    //为了让yii2的验证生效
                    $("#document_url").focus();
                    $("#document_url").blur();
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