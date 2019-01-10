<?php

use yii\helpers\Url;
use app\models\Type;

$this->registerCssFile('@web/public/kjd/css/common.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/apply.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/apply_base.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/apply_style.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/easy.css', ['depends' => ['app\assets\KjdAsset']]);
$this->registerCssFile('@web/public/kjd/css/loan_land.css', ['depends' => ['app\assets\KjdAsset']]);

$this->title = $info['headtitle'];
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $info['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $info['description']], 'description');
?>
<div class="wrapper">
    <div class="top_back">
        <img src="<?= $info['typepic'] ?>">
    </div>
    <div class="wrapper3">
        <div class="main1200">
            <div class="tab banklist">
                <div class="nav">
                    <?php $bank = Type::getData(['IN', 'tid', [113, 114]]); ?>
                    <ul>
                        <?php foreach ($bank as $key => $vo): ?>
                            <li data-tid="<?= $vo['tid'] ?>" <?php if ($info['tid'] == $vo['tid']): ?>class="current"<?php endif; ?>>
                                <i><img style="margin-top: 11px;" src="<?= $vo['orther_typepic'] ?>"></i>
                                <span><?= $vo['typename'] ?></span>
                                <div class="downarrow"></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="content" style="width:100%">
                    <ul> 
                        <li>
                            <?php foreach ($data as $key => $vo): ?>
                                <div class="tab_cont_wrapper">
                                    <div class="tab_conttitle"><i><?= $key + 1 ?></i><span><?= $vo['title'] ?></span></div>
                                    <div class="tab_contsubtitle" style="height: 20px;"></div>
                                    <div class="tab_conts">
                                        <div class="label_title"><label>产品特点</label> <label>额度期限</label></div>
                                        <div class="p_back">
                                            <div style="width: 463px;float: left;"><?= $vo['attr']['special'] ?></div>
                                            <div></div>
                                            <div style="width: 463px;" class="right_conts"><?= $vo['attr']['quota'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </li>                   
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper2">
        <div class="main1200">
            <img src="/public/kjd/images/m_14.jpg">
            <div class="introBox introBox2">
                <h3>基本资料</h3>
                <div class="introContent introContent_m">
                    <p>1、有效的营业执照、机构代码证、税务登记证正(副)复印件（或统一社会代码证复印件）</p>
                    <p>2、开户许可证、机构信用代码证正反面复印件。</p>
                    <p>3、法定代表人、股东身份证（或单位工商代码证复印件）复印。</p>
                    <p>4、企业章程及修正案。</p>
                    <p>5、注册资金验资报告（新注册注册资金认缴的，无需提供）。</p>
                    <p>6、企业近三年度财务报表和即期报表，并加盖企业公章（含资产负债表、损益表、增值税纳税申报表）。</p>
                    <p>7、经营情况介绍（产品情况，经营模式，技术优势）、经营者个人简介。</p>
                    <p>8、企业现有合作客户情况，含信贷资金投向计划</p>
                    <p>9、专利证书、企业证书、获奖证书等复印件</p>
                </div>
            </div>
            <div class="introBox introBox2" style="border-bottom: 1px solid #ddd">
                <h3>贷款材料</h3>
                <div class="introContent introContent_m">
                    <p>1、贷款申请书/借款合同。</p>
                    <p>2、同意借款或者担保的股东会决议等。</p>
                    <p>3、根据不同产品提供相关资料、担保证明文件。</p>
                    <p>4、法定代表人和主要股东个人、董事会成员名单及签字样本。</p>
                    <p>5、贷款用途证明文件及需要提供的其他资料。</p>
                </div>
            </div>
            <img src="/public/kjd/images/m_16.jpg">
            <div class="btn-group">
                <a href="<?= Url::to(['apply/land']) ?>" class="applyBtn show">立即申请</a>
            </div>
            <div class="showTip"></div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.nav ul li').click(function () {
            var tid = $(this).data('tid');
            window.location.href = "/article/list?tid=" + tid;
        });
        var liNode = $('.tab_conts');
        liNode.each(function () {
            var this_height = $(this).children('.p_back').height();
            $(this).children('.p_back').children(("div:eq(1)")).css({'border-left': '1px solid #abbfe7', 'float': 'left', 'margin-left': '32px', 'height': this_height});
        });
    });
</script>