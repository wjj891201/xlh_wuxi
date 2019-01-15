<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Url;

$this->title = '添加债权融资项目';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
$this->registerMetaTag(['name' => 'description', 'content' => ''], 'description');

$this->registerCssFile('@web/public/wx/css/grid.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/normalize.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/member.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/dai_member.css', ['depends' => 'app\assets\WxAsset']);

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
                            <select class="danbao w-select" name="guarantee_bid" id="guarantee_bid">
                                <option value="1">抵质押</option>
                                <option value="2">担保</option>
                                <option value="3">信用</option>
                                <option value="79">融资租赁</option>
                                <option value="82">其他</option>
                            </select>
                            <select class="danbao w-select" name="guarantee_mid" id="guarantee_mid">
                                <option>请选择</option> 
                            </select>
                            <select class="danbao w-select" name="guarantee_sid" id="guarantee_sid">
                                <option>请选择</option>
                            </select>
                            <p class="exclamation"></p>
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
                            <?= $form->field($model, 'company_created', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li>
                            <label><i>*</i>企业名称：</label>
                            <?= $form->field($model, 'company_name', ['template' => "{input}{error}", 'errorOptions' => ['class' => 'exclamation']])->textInput(['class' => 'w145'])->label(false); ?>
                        </li>
                        <li style="height:auto">
                            <label><i>*</i>公司地址：</label>
                            <select class="danbao" name="company_region_bid">
                                <option value="2">北京</option>
                                <option value="3">安徽</option>
                                <option value="4">福建</option>
                                <option value="5">甘肃</option>
                                <option value="6">广东</option>
                                <option value="7">广西</option>
                                <option value="8">贵州</option>
                                <option value="9">海南</option>
                                <option value="10">河北</option>
                                <option value="11">河南</option>
                                <option value="12">黑龙江</option>
                                <option value="13">湖北</option>
                                <option value="14">湖南</option>
                                <option value="15">吉林</option>
                                <option value="16">江苏</option>
                                <option value="17">江西</option>
                                <option value="18">辽宁</option>
                                <option value="19">内蒙古</option>
                                <option value="20">宁夏</option>
                                <option value="21">青海</option>
                                <option value="22">山东</option>
                                <option value="23">山西</option>
                                <option value="24">陕西</option>
                                <option value="25">上海</option>
                                <option value="26">四川</option>
                                <option value="27">天津</option>
                                <option value="28">西藏</option>
                                <option value="29">新疆</option>
                                <option value="30">云南</option>
                                <option value="31">浙江</option>
                                <option value="32">重庆</option>
                                <option value="33">香港</option>
                                <option value="34">澳门</option>
                                <option value="35">台湾</option>
                            </select>
                            <select class="danbao" name="company_region_mid">
                                <option>请选择</option>
                            </select>
                            <select class="danbao" name="company_region_sid">
                                <option>请选择</option>
                            </select>
                            <br>
                            <?= $form->field($model, 'company_address', ['template' => "{input}"])->textInput(['class' => 'w145', 'style' => 'margin-left:100px', 'id' => 'adress'])->label(false); ?>
                        </li>
                        <li style="height:auto">
                            <label><i>*</i>所属行业：</label>
                            <div class="wid">
                                <select name="company_industry">
                                    <option value="">请选择</option>

                                    <option value="210000">采掘</option>


                                    <option value="220000">化工</option>


                                    <option value="230000">钢铁</option>


                                    <option value="240000">有色金属</option>


                                    <option value="610000">建筑材料</option>


                                    <option value="620000">建筑装饰</option>


                                    <option value="630000">电气设备</option>


                                    <option value="640000">机械设备</option>


                                    <option value="650000">国防军工</option>


                                    <option value="280000">汽车</option>


                                    <option value="330000">家用电器</option>


                                    <option value="360000">轻工制造</option>


                                    <option value="110000">农林牧渔</option>


                                    <option value="340000">食品饮料</option>


                                    <option value="350000">纺织服装</option>


                                    <option value="370000">医药生物</option>


                                    <option value="450000">商业贸易</option>


                                    <option value="460000">休闲服务</option>


                                    <option value="270000">电子</option>


                                    <option value="710000">计算机</option>


                                    <option value="720000">传媒</option>


                                    <option value="730000">通信</option>


                                    <option value="410000">公用事业</option>


                                    <option value="420000">交通运输</option>


                                    <option value="430000">房地产</option>


                                    <option value="480000">银行</option>


                                    <option value="490000">非银金融</option>


                                    <option value="510000">综合</option>


                                    <option value="740000">互联网</option>


                                    <option value="750000">新能源</option>


                                    <option value="760000">TMT</option>


                                    <option value="770000">新媒体</option>


                                    <option value="780000">节能环保</option>


                                    <option value="790000">新兴信息产业</option>


                                    <option value="800000">生物产业</option>


                                    <option value="810000">新能源汽车</option>


                                    <option value="820000">高端装备制造业</option>


                                    <option value="830000">新材料</option>

                                </select>
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
                            <input name="sell_income_1" type="text" class="w200 Income">
                            <p>万元（2015年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label></label>
                            <input name="sell_income_2" type="text" class="w200 Income">
                            <p>万元（2014年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label></label>
                            <input name="sell_income_3" type="text" class="w200 Income">
                            <p>万元（2013年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label><i>*</i>近三年净利润：</label>
                            <input name="net_profit_1" type="text" class="w200 Income">
                            <p>万元（2015年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label></label>
                            <input name="net_profit_2" type="text" class="w200 Income">
                            <p>万元（2014年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label></label>
                            <input name="net_profit_3" type="text" class="w200 Income">
                            <p>万元（2013年）</p>
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写企业收入</p>
                        </li>
                        <li>
                            <label>企业近一年资产负债率：</label>
                            <input name="incur_debts" type="text" class="w200">%
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
                            <input name="manager_name" type="text" class="w200" id="name" value="">
                            <p class="exclamation"></p>
                            <p class="input_tip">请填写真实姓名</p>
                        </li>
                        <li>
                            <label><i>*</i>户籍：</label>
                            <select class="huji" name="manager_province">
                                <option value="2">北京</option>
                                <option value="3">安徽</option>
                                <option value="4">福建</option>
                                <option value="5">甘肃</option>
                                <option value="6">广东</option>
                                <option value="7">广西</option>
                                <option value="8">贵州</option>
                                <option value="9">海南</option>
                                <option value="10">河北</option>
                                <option value="11">河南</option>
                                <option value="12">黑龙江</option>
                                <option value="13">湖北</option>
                                <option value="14">湖南</option>
                                <option value="15">吉林</option>
                                <option value="16">江苏</option>
                                <option value="17">江西</option>
                                <option value="18">辽宁</option>
                                <option value="19">内蒙古</option>
                                <option value="20">宁夏</option>
                                <option value="21">青海</option>
                                <option value="22">山东</option>
                                <option value="23">山西</option>
                                <option value="24">陕西</option>
                                <option value="25">上海</option>
                                <option value="26">四川</option>
                                <option value="27">天津</option>
                                <option value="28">西藏</option>
                                <option value="29">新疆</option>
                                <option value="30">云南</option>
                                <option value="31">浙江</option>
                                <option value="32">重庆</option>
                                <option value="33">香港</option>
                                <option value="34">澳门</option>
                                <option value="35">台湾</option>
                            </select>
                            <select class="huji" name="manager_city">
                                <option>请选择</option>
                            </select>
                            <p class="exclamation"></p>
                        </li>
                    </ul>
                </div>

                <!--联系人信息-->
                <div class="message_label" data-floor="5">
                    <div class="daikuan_title five_title">联系人信息</div>
                    <ul class="message_label_list clearfix dai_tou_list">
                        <li>
                            <label><i>*</i>联系人：</label>
                            <input name="user_name" type="text" class="w145" id="contact_people" value="">
                            <p class="exclamation">请填写联系人姓名</p>
                            <p class="input_tip">请填写联系人姓名</p>
                        </li>
                        <li>
                            <label><i>*</i>手机号码：</label>
                            <input name="user_mobile" type="text" class="w145" id="mobile" value="">
                            <p class="exclamation">11位数字，以1开头</p>
                            <p class="input_tip">请填写手机号码</p>
                        </li>
                        <li>
                            <label><i>*</i>职务名称：</label>
                            <input name="user_title" type="text" class="w145" id="position" value="">
                            <p class="exclamation">请填写所在公司的职位名称</p>
                            <p class="input_tip">请填写所在公司的职位名称</p>
                        </li>
                        <li>
                            <label><i>*</i>邮箱信息：</label>
                            <input name="user_mail" type="text" class="w145" id="email" value="">
                            <p class="exclamation">请填写邮箱地址</p>
                            <p class="input_tip">请填写邮箱地址</p>
                        </li>
                    </ul>
                </div>

                <!--附件上传-->
                <div class="message_label" style="border-bottom:0;" data-floor="6">
                    <div class="daikuan_title six_title">
                        <p>附件上传</p>
                        <span>单次上传请不要超过30M，上传类型为压缩包文件。为了尽快审核和处理您的贷款申请，请您尽快上传如下清单中的所需文件。</span>
                    </div>
                    <div class="update_raea">
                        <ul class="clearfix">
                            <li>
                                <div class="upload upload2" style="display:block">
                                    <!--
    <label for="upload"></label>
                                    <input type="file" name="upload" id="upload">
                                    -->
                                    <label for="fileupload" id="update_btn"></label>
                                    <input name="mypic" id="fileupload" type="file">
                                </div>


                                <!--<a href="javascript:void(0)" class="update_project"></a>-->
                                <div class="update_show" style="display:none">
                                    <a>
                                        <img src="http://wxjrfw.yirongbang.net/theme/red_theme/member/images/member/update_example.jpg" alt="">
                                        <i class="close_update" style="cursor:pointer"></i>
                                    </a>
                                    <input name="document_value" id="document_value" type="hidden" value="">
                                    <input name="document_name" id="document_name" type="hidden" value="">
                                    <input name="document_created" id="document_created" type="hidden" value="">
                                    <span class="mt20" id="text_document_name"></span>
                                    <span id="text_document_created"></span>
                                    <span id="upload_type" style="display:none">1</span>
                                </div>
                            </li>
                        </ul>
                        <em>注：文件内容 &lt; 3M</em>
                        <p>如：营业执照或者名片(请打包成zip／rar格式一次上传)</p>
                    </div>
                </div>

                <!--按钮区域-->
                <div class="btn_area">
                    <input name="gq_id" type="hidden" id="gq_id" value="0">
                    <input name="is_gq" type="hidden" id="is_gq" value="0">
                    <input name="project_type" id="project_type" type="hidden" value="1">
                    <input type="button" name="" value="保 存" class="cancel_button" onclick="submit_form('save', 'add')">
                    <input type="button" name="" value="提 交" class="submit_button" onclick="submit_form('submit', 'add')">
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>