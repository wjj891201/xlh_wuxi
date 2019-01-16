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
                        <select name="company_type" id="company_type" class="wd30">
                            <option value="1" selected="">无</option>
                            <option value="2">有限责任公司</option>
                            <option value="3">股份有限公司</option>
                            <option value="4">国有独资公司</option>
                            <option value="5">个人独资企业</option>
                            <option value="6">合伙企业</option>
                            <option value="7">个体工商户</option>
                            <option value="8">外商投资企业</option>
                            <option value="9">私营企业</option>
                        </select>
                    </div>
                    <div class="vcase">
                        <div class="case-title-two ht16" style="margin-left: 0px;"><i>*</i><p>企业注册信息</p></div>
                        <div class="case-box">
                            <h3 id="register_msg" class="register_title">请选择填写一项</h3>
                            <div class="inner-box">
                                <div class="inner-case">
                                    <label class="case-title" for="registered">工商注册号</label><input name="registered" id="registered" type="text" class="cpt wd22" value="">
                                </div>
                                <div class="inner-case">
                                    <label class="case-title" for="social_credit">企业统一社会信用代码</label><input name="social_credit" id="social_credit" type="text" class="cpt wd22" value="">
                                </div>
                            </div>
                            <p id="register_notice" style="display:none;"></p>
                        </div>
                    </div>
                </div>
                <div class="bottom-box">
                    <div class="gather">
                        <label class="case-title"><i>*</i>真实姓名</label><input name="name" id="name" type="text" class="wd16" value="">
                        <p id="name_notice" style="display:none;"></p>

                    </div>
                    <div class="gather">
                        <label class="case-title"><i>*</i>职位名称</label><input name="job" id="job" type="text" class="wd16" value="">
                        <p id="job_notice" style="display:none;"></p>
                    </div>
                    <div class="gather">
                        <label class="case-title"><i>*</i>联系手机</label><input name="phone" id="phone" type="text" class="wd16" value="13918249869">
                        <p id="phone_notice" style="display:none;"></p>
                    </div>
                    <div class="gather">
                        <label><i></i>邮箱</label><input name="email" id="email" type="text" class="wd16" value="">
                        <p id="email_notice" style="display:none;"></p>
                    </div>
                    <div class="gather">
                        <label><i></i>微信</label><input name="wechat" id="wechat" type="text" class="wd16" value="">
                        <p id="wechat_notice" style="display:none;"></p>
                    </div>
                    <div class="gather">
                        <label><i></i>网址</label><input name="website" id="website" type="text" class="wd16" value="">
                        <p id="website_notice" style="display:none;"></p>
                    </div>
                    <input name="session_key" type="hidden" value="1547630419">
                    <input name="pro_id" type="hidden" value="">
                    <div class="btn-group">
                        <input type="button" name="" value="取 消" class="cancel_button" id="cancel">
                        <input type="submit" name="submit" id="submit_btn" value="下一步" class="submit_button">
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
    });
</script>