<?php

use yii\web\View;
use yii\helpers\Url;
use app\libs\Image;
use app\models\Advert;
use app\models\News;

$this->registerCssFile('@web/public/wx/css/new_company_credit.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/new_index.css', ['depends' => 'app\assets\WxAsset']);
$this->registerCssFile('@web/public/wx/css/banner.css', ['depends' => 'app\assets\WxAsset']);

$this->registerJsFile('@web/public/wx/js/jquery.flexslider.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/searchChild.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/js.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/banner.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);
$this->registerJsFile('@web/public/wx/js/yrd_service.js', ['depends' => ['app\assets\WxAsset'], 'position' => View::POS_HEAD]);

$this->title = $this->params['config']['sitename'];
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['config']['keyword']]);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['config']['description']], 'description');
?>

<!--轮播区域-->
<div class="banner">
    <div class="flexslider">
        <ul class="slides">
            <?php $ads = Advert::get_ad(['atid' => 1, 'isclass' => 1]); ?>
            <?php foreach ($ads as $key => $vo): ?>
                <li><a class="click_banner" href=""><img src="<?= $vo['filename'] ?>"></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="banner-up">
        <div class="add-category">
            <ul></ul>
        </div>
    </div>
</div>
<!--数字区域-->
<div class="account_number">
    <div class="m1200">
        <ul class="clearfix">
            <li><p>注册企业数</p><b>21903</b></li>
            <li><p>认证投资人数</p><b>1927</b></li>
            <li><p>企业服务产品数</p><b>207</b></li>
            <li class="last"><p>贷款产品数</p><b><a href="">35</a></b></li>
        </ul>
    </div>
</div>
<!--中间内容-->
<div class="grayBg pb50">
    <!--一精选服务-->
    <div class="m1200 floor" id="yirongfu">
        <!--楼层标题-->
        <div class="title">
            <img src="/public/wx/images/yirongfu.png" height="24" width="367">
        </div>
        <!--楼层内容-->
        <div class="floorContent clearfix">
            <div class="floorLeft">
                <div class="bottom_table b0">
                    <a href="http://wuxi.dev.easyrong.cn/" class="a0"></a>
                    <a href="" class="a1"></a>
                    <a href="" class="a2"></a>
                    <img src="/public/wx/images/file_1547087462.jpg"/>
                </div>
            </div>
            <div class="floorRight">
                <ul class="fuList">
                    <li><a href=""><img src="/public/wx/images/file_1547084904.jpg"></a></li>
                    <li><a href=""><img src="/public/wx/images/file_15468293952.jpg"></a></li>
                    <li class="last"><a href=""><img src="/public/wx/images/file_15470849041.jpg"></a></li>
                </ul>
                <div class="fuReport">
                    <a href=""><img src="/public/wx/images/file_15468293954.jpg"></a>
                    <a href=""><img src="/public/wx/images/file_15468293955.jpg"></a>
                </div>
            </div>
        </div>
    </div>
    <!--一融赋-->
    <div class="m1200 floor" id="touziren">
        <!--楼层标题-->
        <div class="title">
            <img src="/public/wx/images/guquan.png" height="24" width="320">
        </div>
        <!--楼层内容-->
        <div class="floorContent clearfix">
            <div class="floorLeft">
                <a href=""><img src="/public/wx/images/file_1546831197.jpg" width="330"></a>
            </div>
            <div class="floorRight">
                <div class="neiTitle">
                    <h3>我们的投资人<span>他们会看到你的项目</span></h3>
                    <a href="" class="more">更多 ></a>
                </div>
                <ul class="touList">
                    <a href="">
                        <li>
                            <img src="/public/wx/images/20190107165242.png" width="70"/>
                            <div class="touRight">
                                <h3>刘恒</h3>
                                <em>上海日臻资产管理有限公司 | 合伙人(上海)</em>
                                <p>投资领域：电子 | 计算机 | 传媒 </p>
                                <p>投资区域：</p>
                                <span>A轮</span>
                                <span>B轮</span>
                            </div>
                        </li>
                    </a>
                    <a href="">
                        <li class="last" class="bottom">
                            <img src="/public/wx/images/20190107165242.png" width="70">
                            <div class="touRight">
                                <h3>郭建</h3>
                                <em>上海国际创投 | 总经理(上海)</em>
                                <p>投资领域：综合 </p>
                                <p>投资区域：</p>
                                <span>A轮</span>
                                <span>B轮</span>
                            </div>
                        </li>
                    </a>
                    <a href="">
                        <li>
                            <img src="/public/wx/images/20190107165242.png" width="70">
                            <div class="touRight">
                                <h3>曾强</h3>
                                <em>复星集团互联网投资部 | 投资总监(上海)</em>
                                <p>投资领域：电子 | 计算机 | 综合 </p>
                                <p>投资区域：</p>
                                <span>A轮</span>
                                <span>B轮</span>
                                <span>C轮</span>
                            </div>
                        </li>
                    </a>
                    <a href="">
                        <li class="bottom last">
                            <img src="/public/wx/images/20190107165242.png" width="70">
                            <div class="touRight">
                                <h3>李群</h3>
                                <em>汉都鼎坤投资管理有限公司 | 总经理(江苏)</em>
                                <p>投资领域：综合 </p>
                                <p>投资区域：</p>
                                <span>天使轮</span>
                                <span>A轮</span>
                                <span>B轮</span>
                                <span>C轮</span>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <!--一融贷楼层-->
    <div class="m1200 floor" id="dai">
        <!--楼层标题-->
        <div class="title">
            <img src="/public/wx/images/dai.png" height="24" width="280">
        </div>
        <!--楼层内容-->
        <div class="floorContent clearfix">
            <div class="floorLeft">
                <div class="f-wrap">
                    <div class="f-field">
                        <p>贷款金额</p>
                        <div class="f-item">
                            <span id="J_quota2" data-value="">500万</span>
                            <b></b>
                            <ul style="display: none;">
                                <li data-value="0">不限</li>
                                <li data-value="100">100万</li>
                                <li data-value="300">300万</li>
                                <li data-value="500">500万</li>
                                <li data-value="800">800万</li>
                                <li data-value="1000">1000万</li>
                            </ul>
                        </div>
                        <p>贷款期限</p>
                        <div class="f-item">
                            <span id="J_life2" data-value="">3年</span>
                            <b></b>
                            <ul style="display: none;">
                                <li data-value="0">不限</li>
                                <li data-value="1">1年</li>
                                <li data-value="2">2年</li>
                                <li data-value="3">3年</li>
                                <li data-value="4">4年</li>
                                <li data-value="5">5年</li>
                            </ul>
                        </div>

                    </div>
                    <div class="f-btn">
                        <input type="submit" id="daikuan_submit" value="立即匹配">
                    </div>
                    <input type="hidden" name="loans_num2">
                    <input type="hidden" name="loans_date2">
                </div>
            </div>
            <!--右侧-->
            <div class="floorRight">
                <div class="neiTitle">
                    <h3>我们推荐的贷款产品<span>更容易获得的贷款</span></h3>
                    <a href="" class="more">更多 ></a>
                </div>
                <div style="overflow: hidden">
                    <div class="daiKuan fl ml25 mt30">
                        <a href="">
                            <img src="/public/wx/images/file_15468306121.jpg" height="180" width="400">
                            <div class="daiTitle">应收账款质押贷款</div>
                        </a>
                    </div>
                    <div class="daiKuan fl ml25 mt30">
                        <a href="">
                            <img src="/public/wx/images/file_15468413851.jpg" height="180" width="400">
                            <div class="daiTitle">新三板快易租</div>
                        </a>
                    </div>
                </div>
                <div style="overflow: hidden; border-top:1px solid #eee;" class="mt30">
                    <div class="daiKuan fl">
                        <div class="m15">
                            <h3><a href="">税融通（合肥）</a> </h3>
                            <h4>贷款额度：<b>1 万元 - 1000 万元</b></h4>
                            <span>无抵押</span>
                            <span>无担保</span>
                            <span>放款快</span>
                            <ul class="clearfix">
                                <li>贷款期限：1个月 - 12个月</li>
                                <li class="tr"><label>担保方式：</label>信用</li>
                                <li>还款方式：到期本金付息</li>
                                <li class="tr"><label>审批时间：</label>10日以内</li>
                            </ul>
                            <a href="" class="look">查看详情</a>
                        </div>
                    </div>
                    <div class="daiKuan fl">
                        <div class="m15">
                            <h3><a href="">平安 生意贷</a> </h3>
                            <h4>贷款额度：<b>60 万元以下</b></h4>
                            <ul class="clearfix">
                                <li>贷款期限：24个月以下</li>
                                <li class="tr"><label>担保方式：</label>信用</li>
                                <li>还款方式：等额本息</li>
                                <li class="tr"><label>审批时间：</label>5日以内</li>
                            </ul>
                            <a href="" class="look">查看详情</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 找孵化器 -->
    <div class="m1200 floor">
        <!--楼层标题-->
        <div class="title">
            <img src="/public/wx/images/fuhua.png" height="24" width="321">
        </div>
        <!--楼层内容-->
        <div class="floorContent clearfix">
            <div class="floorLeft">
                <a href="">
                    <img src="/public/wx/images/file_1546850620.jpg" width="330">
                </a>
            </div>
            <div class="floorRight">
                <div class="neiTitle">
                    <h3>推荐孵化器<span>一站式在线孵化服务</span></h3>
                    <a href="" class="more">更多 ></a>
                </div>
                <ul class="fuhuaList">
                    <li>
                        <a href="">
                            <img src="/public/wx/images/file_1546843106.jpg">
                            <div class="fuhuaInfo">
                                <p class="fiTitle">无锡智慧体育产业园</p>
                                <p class="fiArea">
                                    <i class="mapIco"></i>
                                    江苏 无锡 滨湖区
                                </p>
                                <p class="fiField">
                                    <span>省级</span>
                                    智慧体育                                                            
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/public/wx/images/file_1546843106.jpg">
                            <div class="fuhuaInfo">
                                <p class="fiTitle">创星咖啡</p>
                                <p class="fiArea">
                                    <i class="mapIco"></i>
                                    江苏 无锡 崇安区                            
                                </p>
                                <p class="fiField">
                                    <span>其它</span>
                                    新一代信息技术                                                            
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/public/wx/images/file_1546843106.jpg">
                            <div class="fuhuaInfo">
                                <p class="fiTitle">希沃创咖</p>
                                <p class="fiArea">
                                    <i class="mapIco"></i>
                                    江苏 无锡 新区                            
                                </p>
                                <p class="fiField">
                                    <span>其它</span>
                                    新兴信息产业                
                                    高端装备制造业                                                            
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/public/wx/images/file_1546843106.jpg">
                            <div class="fuhuaInfo">
                                <p class="fiTitle">无锡国际科技合作园</p>
                                <p class="fiArea">
                                    <i class="mapIco"></i>
                                    江苏 无锡 新区                            
                                </p>
                                <p class="fiField">
                                    <span>其它</span>
                                    新兴信息产业                                                            
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--热点政策-->
    <div class="m1200 hotPoint clearfix floor">
        <img src="/public/wx/images/file_1546419032.png" height="60" width="242">
        <ul>
            <li><a href="">关于做好2016年度无锡市&ldquo;正版正货&rdquo;承诺推...</a></li>
            <li><a href="">无锡市科技发展（技术研发）资金管理实施细则</a></li>
            <li><a href="">关于做好取消价格鉴证师注册核准等行政许可...</a></li>
            <li><a href="">2016年苏南国家自主创新示范区建设工作要点</a></li>
            <li><a href=""> 促进科技成果转移转化行动方案</a></li>
            <li><a href="">中国银监会 科技部 中国人民银行关于支持...</a></li>
        </ul>
    </div>
</div>