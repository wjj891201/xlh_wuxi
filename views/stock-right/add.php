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
        <form onsubmit="return check_form();" action="http://wxjrfw.yirongbang.net/member/yrf_projects/add_projects_do" method="post">
            <div class="member_right grid_20 omega product_box">
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
                            <input type="text" name="company" id="company" class="cpt wd29" value="">
                            <p id="company_notice" style="display:none;"></p>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>所在地区</p>
                            <select name="province" id="province" onchange="loadRegion('province', 2, 'city', 'http://wxjrfw.yirongbang.net/yr_global_class/ajax_city');">
                                <option value="">请选择</option>
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
                                <option value="25" selected="">上海</option>
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
                            <select name="city" id="city" onchange="loadRegion('city', 3, 'district', 'http://wxjrfw.yirongbang.net/yr_global_class/ajax_city');">

                                <option value="0">请选择</option><option value="321" selected="selected">上海</option></select>
                            <select name="district" id="district">

                                <option value="0">请选择</option><option value="2703">长宁区</option><option value="2705">闵行区</option><option value="2706">徐汇区</option><option value="2707">浦东新区</option><option value="2708">杨浦区</option><option value="2709">普陀区</option><option value="2710">静安区</option><option value="2711">卢湾区</option><option value="2712">虹口区</option><option value="2713">黄浦区</option><option value="2714">南汇区</option><option value="2715">松江区</option><option value="2716">嘉定区</option><option value="2717">宝山区</option><option value="2718">青浦区</option><option value="2719">金山区</option><option value="2720">奉贤区</option><option value="2721">崇明县</option></select>
                            <p id="region_notice" style="display:none;"></p>
                            <script type="text/javascript">
                                $(function () {
                                    $("#province").val('25');
                                    loadRegionAlready('25', 2, 'city', 'http://wxjrfw.yirongbang.net/yr_global_class/ajax_city', '321');
                                    loadRegionAlready('321', 3, 'district', 'http://wxjrfw.yirongbang.net/yr_global_class/ajax_city', '0');
                                });
                            </script>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>办公地址</p>
                            <input name="address" id="address" type="text" class="cpt wd29" value="">
                            <p id="address_notice" style="display:none;"></p>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>公司人数</p>
                            <input name="staff_num" id="staff_num" type="text" class="cpt wd12 pr30" value="0">
                            <span class="ml-20" style="">人</span>
                            <p id="staff_num_notice" style="display:none;"></p>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>注册资本</p>
                            <input name="capital" id="capital" type="text" class="cpt wd12 pr30" value="0.00">
                            <span class="ml-35">万元</span>
                            <p id="capital_notice" style="display:none;"></p>
                        </div>
                        <div class="vcase">
                            <p class="case-title"><i>*</i>成立时间</p>
                            <input name="create_date" id="create_date" class="cpt wd12 pr30" readonly="readonly" value="">
                            <p class="calc"><span id="month_num">0</span>个月</p>
                            <p id="create_date_notice" style="display:none;"></p>
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
                            <input id="list_url" type="hidden" value="http://wxjrfw.yirongbang.net/member/yrf_projects_track/project_list">
                            <input type="button" name="" value="取 消" class="cancel_button" id="cancel">
                            <input type="submit" name="submit" id="submit_btn" value="下一步" class="submit_button">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>