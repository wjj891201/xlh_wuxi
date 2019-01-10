<?php

use yii\helpers\Url;
?>
<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>南昌科技贷系统</title>
        <link href="/public/kjd/css/easy.css" rel="stylesheet" type="text/css">
        <link href="/public/kjd/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="bg"></div>
        <div class="tbg"></div>
        <div class="top">
            <div class="topTitle">
                <img src="<?= $logo ?>" width="1088" alt="" />
            </div>
            <div class="nav wrap">
                <ul>
                    <li class="n1 rotate">
                        <div class="circle"></div>
                        <div class="loading">
                            <div class="num"><?= $one_num ?></div>
                            <div class="text">企业申请总数</div>
                            <div class="show_01 show"></div>
                            <div class="show_02 show"></div>
                            <div class="img hide"><img src="/public/kjd/images/ie1.png" /></div>
                        </div>
                    </li>
                    <li class="n2 rotate">
                        <div class="circle"></div>
                        <div class="loading">
                            <div class="num"><?= $two_num ?></div>
                            <div class="text">企业入库总数</div>
                            <div class="show_01 show"></div>
                            <div class="show_02 show"></div>
                            <div class="img hide"><img src="/public/kjd/images/ie2.png" /></div>
                        </div>
                    </li>
                    <li class="n3 rotate">
                        <div class="circle"></div>
                        <div class="loading">
                            <div class="num"><?= $three_num ?></div>
                            <div class="text">金融需求总数</div>
                            <div class="show_01 show"></div>
                            <div class="show_02 show"></div>
                            <div class="img hide"><img src="/public/kjd/images/ie3.png" /></div>
                        </div>
                    </li>
                    <li class="n4 rotate">
                        <div class="circle"></div>
                        <div class="loading">
                            <div class="num"><?= $four_num ?></div>
                            <div class="text">金融受理总数</div>
                            <div class="show_01 show"></div>
                            <div class="show_02 show"></div>
                            <div class="img hide"><img src="/public/kjd/images/ie4.png" /></div>
                        </div>
                    </li>
                </ul>
                <div class="cbg"></div>
                <div class="tip" style="display: block;"><div class="close"></div></div>
            </div>
        </div>
        <div class="bottom">
            <div class="bbg"></div>
            <div class="wrap">
                <div class="detail">
                    <ul>
                        <!-- 11111111 -->
                        <li>
                            <div class="centerwrpper" style="height: 600px;">
                                <div class="tab">
                                    <div class="nav">
                                        <ul>
                                            <li class="current first">
                                                <div class="liwrap"><i class="linkicon linkicon1"></i><span>区域分布</span></div>
                                            </li>
                                            <li>
                                                <div class="liwrap"><i class="linkicon linkicon3"></i><span>科技企业类型</span></div>
                                            </li>
                                            <li>
                                                <div class="liwrap"><i class="linkicon linkicon2"></i><span>行业分布</span></div>
                                            </li>
                                            <li class="last">
                                                <div class="liwrap"><i class="linkicon linkicon4"></i><span>入库年度</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <!-- 区域分布 -->
                                            <li style="display:block" class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader">
                                                        <ul><li><a href="#">区域分布</a></li></ul>
                                                    </div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider">
                                                                <li class="areaul">
                                                                    <?php foreach ($one_town_list as $key => $vo): ?>
                                                                        <?php if ($key <= 7): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="s_area" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                                <li class="areaul">
                                                                    <?php foreach ($one_town_list as $key => $vo): ?>
                                                                        <?php if ($key > 7 && $key <= 15): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="s_area" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- 科技企业类型 -->
                                            <li class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader"><ul><li><a href="#">科技企业类型</a></li></ul></div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider">
                                                                <li class="areaul">   
                                                                    <?php foreach ($one_enterprise as $key => $vo): ?>
                                                                        <div>
                                                                            <span><?= $vo['name'] ?></span>
                                                                            <p><?= $vo['count'] ?></p>
                                                                            <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="s_enterprise" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                    <span class="areaulbor"></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- 行业分布 -->
                                            <li class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader">
                                                        <ul><li><a href="#">行业分布</a></li></ul>
                                                    </div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider" > 
                                                                <li class="areaul">
                                                                    <?php foreach ($one_industry as $key => $vo): ?>
                                                                        <?php if ($key <= 7): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="s_industry" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                                <li class="areaul">
                                                                    <?php foreach ($one_industry as $key => $vo): ?>
                                                                        <?php if ($key > 7 && $key < 15): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="s_industry" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>                                    
                                            <!-- 入库年度 -->
                                            <li>
                                                <div class="linkheader">
                                                    <ul><li><a href="#">入库年度</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="contwrap" style="width: 100%;">
                                                        <ul class='page_1_content'>
                                                            <?php foreach ($one_company as $key => $vo): ?>
                                                                <li style="width:50%;float:left;"><?= $key + 1 ?> <?= $vo['enterprise_name'] ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="page_1">
                                                        <?php if ($one_company_count > 1): ?>
                                                            <?php for ($i = 0; $i < $one_company_count; $i++): ?>
                                                                <?php if ($i == 0): ?>
                                                                    <a href="javascript:void(0);" class='cur' data-type='s_company' data-page='<?= $i ?>'><?= $i + 1 ?></a>
                                                                <?php else: ?>
                                                                    <a href="javascript:void(0);" data-type='s_company' data-page='<?= $i ?>'><?= $i + 1 ?></a>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- 22222222 -->
                        <li>
                            <div class="centerwrpper" style="height: 600px;">
                                <div class="tab">
                                    <div class="nav">
                                        <ul>
                                            <li class="current first">
                                                <div class="liwrap"><i class="linkicon linkicon1"></i><span>区域分布</span></div>
                                            </li>
                                            <li>
                                                <div class="liwrap"><i class="linkicon linkicon3"></i><span>科技企业类型</span></div>
                                            </li>
                                            <li>
                                                <div class="liwrap"><i class="linkicon linkicon2"></i><span>行业分布</span></div>
                                            </li>
                                            <li class="last">
                                                <div class="liwrap"><i class="linkicon linkicon4"></i><span>入库年度</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <!-- 区域分布 -->
                                            <li style="display:block" class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader">
                                                        <ul><li><a href="#">区域分布</a></li></ul>
                                                    </div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider">
                                                                <li class="areaul">
                                                                    <?php foreach ($two_town_list as $key => $vo): ?>
                                                                        <?php if ($key <= 7): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="i_area" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                                <li class="areaul">
                                                                    <?php foreach ($two_town_list as $key => $vo): ?>
                                                                        <?php if ($key > 7 && $key <= 15): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="i_area" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- 科技企业类型 -->
                                            <li class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader"><ul><li><a href="#">科技企业类型</a></li></ul></div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider">
                                                                <li class="areaul">   
                                                                    <?php foreach ($two_enterprise as $key => $vo): ?>
                                                                        <div>
                                                                            <span><?= $vo['name'] ?></span>
                                                                            <p><?= $vo['count'] ?></p>
                                                                            <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="i_enterprise" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                    <span class="areaulbor"></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- 行业分布 -->
                                            <li class="showContent">
                                                <div class="show1">
                                                    <div class="linkheader">
                                                        <ul><li><a href="#">行业分布</a></li></ul>
                                                    </div>
                                                    <div class="linkcontent">
                                                        <div class="slider" style="width:890px;">
                                                            <ul class="canslider" > 
                                                                <li class="areaul">
                                                                    <?php foreach ($two_industry as $key => $vo): ?>
                                                                        <?php if ($key <= 7): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="i_industry" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                                <li class="areaul">
                                                                    <?php foreach ($two_industry as $key => $vo): ?>
                                                                        <?php if ($key > 7 && $key < 15): ?>
                                                                            <div>
                                                                                <span><?= $vo['name'] ?></span><p><?= $vo['count'] ?></p>
                                                                                <?php if ($vo['count'] > 0): ?><a href="javascript:void(0);" data-type="i_industry" data-id="<?= $vo['id'] ?>">查看名单</a><?php endif; ?>
                                                                            </div>
                                                                            <?php if ($key % 4 == 3): ?>
                                                                                <span class="areaulbor"></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- 入库年度 -->
                                            <li>
                                                <div class="linkheader">
                                                    <ul><li><a href="#">入库年度</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="contwrap" style="width:100%;">
                                                        <ul class='page_2_content'>
                                                            <?php foreach ($two_company as $key => $vo): ?>
                                                                <li style="width:50%;float:left;"><?= $key + 1 ?> <?= $vo['enterprise_name'] ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="page_2">
                                                        <?php if ($two_company_count > 1): ?>
                                                            <?php for ($i = 0; $i < $two_company_count; $i++): ?>
                                                                <?php if ($i == 0): ?>
                                                                    <a href="javascript:void(0);" class='cur' data-type='i_company' data-page='<?= $i ?>'><?= $i + 1 ?></a>
                                                                <?php else: ?>
                                                                    <a href="javascript:void(0);" data-type='i_company' data-page='<?= $i ?>'><?= $i + 1 ?></a>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- 33333333 -->
                        <li>
                            <div class="centerwrpper">
                                <div class="tab">
                                    <div class="nav">
                                        <ul>
                                            <li class="current first">
                                                <div class="liwrap"><i class="linkicon n31"></i><span>金融需求</span></div>
                                            </li>
                                            <li class="last">
                                                <div class="liwrap"><i class="linkicon n32"></i><span>科技银行贷款</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li style="display:block">
                                                <div class="linkheader">
                                                    <ul><li><a href="#">金融需求</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="nbox">
                                                        <div class="t1">科技银行贷款
                                                            <div class="line"></div>
                                                        </div>
                                                        <ul>
                                                            <?php foreach ($jrxq as $key => $vo): ?>
                                                                <li>
                                                                    <div class="box">
                                                                        <div class="c nc<?= $key + 1 ?>"><?= $vo['title'] ?></div>
                                                                        <div class="text">
                                                                            <div class="text1"><?= $vo['count'] ?><span>家</span></div>
                                                                            <div class="text2">￥<?= $vo['totle'] ?><span>万</span></div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="nbox">
                                                        <div class="t1">
                                                            其他金融需求
                                                            <div class="line"></div>
                                                        </div>
                                                        <div class="mbox">
                                                            <ul>
                                                                <?php foreach ($all_supports as $key => $vo): ?>
                                                                    <li>
                                                                        <div class="t1">
                                                                            <?= $vo['name'] ?>
                                                                            <div class="line"></div>
                                                                        </div>
                                                                        <div class="text1"><?= $vo['count'] ?><span>家</span></div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="linkheader">
                                                    <ul><li><a href="#">科技贷</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="xbox">
                                                        <ul>
                                                            <?php foreach ($bank_tj as $key => $vo): ?>
                                                                <li>
                                                                    <div class="bank">
                                                                        <?php if ($vo['organization_name'] == '北京银行'): ?>
                                                                            <img src="/public/kjd/images/bjyh.png"/>
                                                                        <?php else: ?>
                                                                            <img src="/public/kjd/images/xyyh.png"/>
                                                                        <?php endif; ?>
                                                                        <?= $vo['organization_name'] ?>
                                                                    </div>
                                                                    <div class="bdata">
                                                                        <div class="text">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_1'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_1']) ? $vo['b_total_1'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_2'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_2']) ? $vo['b_total_2'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_3'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_3']) ? $vo['b_total_3'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_4'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_4']) ? $vo['b_total_4'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- 4444444 -->
                        <li>
                            <div class="centerwrpper">
                                <div class="tab">
                                    <div class="nav">
                                        <ul>
                                            <li class="current first">
                                                <div class="liwrap"><i class="linkicon n31"></i><span>金融需求</span></div>
                                            </li>
                                            <li class="last">
                                                <div class="liwrap"><i class="linkicon n32"></i><span>科技银行贷款</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li style="display:block">
                                                <div class="linkheader">
                                                    <ul><li><a href="#">金融需求</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="nbox">
                                                        <div class="t1">科技银行贷款
                                                            <div class="line"></div>
                                                        </div>
                                                        <ul>
                                                            <?php foreach ($jrxq as $key => $vo): ?>
                                                                <li>
                                                                    <div class="box">
                                                                        <div class="c nc<?= $key + 1 ?>"><?= $vo['title'] ?></div>
                                                                        <div class="text">
                                                                            <div class="text1"><?= $vo['count'] ?><span>家</span></div>
                                                                            <div class="text2">￥<?= $vo['totle'] ?><span>万</span></div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="nbox">
                                                        <div class="t1">
                                                            其他金融需求
                                                            <div class="line"></div>
                                                        </div>
                                                        <div class="mbox">
                                                            <ul>
                                                                <?php foreach ($all_supports as $key => $vo): ?>
                                                                    <li>
                                                                        <div class="t1">
                                                                            <?= $vo['name'] ?>
                                                                            <div class="line"></div>
                                                                        </div>
                                                                        <div class="text1"><?= $vo['count'] ?><span>家</span></div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="linkheader">
                                                    <ul><li><a href="#">科技贷</a></li></ul>
                                                </div>
                                                <div class="linkcontent">
                                                    <div class="xbox">
                                                        <ul>
                                                            <?php foreach ($bank_tj as $key => $vo): ?>
                                                                <li>
                                                                    <div class="bank">
                                                                        <?php if ($vo['organization_name'] == '北京银行'): ?>
                                                                            <img src="/public/kjd/images/bjyh.png"/>
                                                                        <?php else: ?>
                                                                            <img src="/public/kjd/images/xyyh.png"/>
                                                                        <?php endif; ?>
                                                                        <?= $vo['organization_name'] ?>
                                                                    </div>
                                                                    <div class="bdata">
                                                                        <div class="text">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_1'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_1']) ? $vo['b_total_1'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_2'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_2']) ? $vo['b_total_2'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_3'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_3']) ? $vo['b_total_3'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="text1"><?= $vo['b_count_4'] ?><span>家</span></div>
                                                                                    <div class="text2">￥<?= !empty($vo['b_total_4']) ? $vo['b_total_4'] : 0 ?><span>万</span></div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content" style="margin-top:-49px">
                    <div class="belowwrapper">
                        <div class="belowbox below1ul">
                            <div class="zi">
                                <div class="titleborder">
                                    <h3>企业入口</h3>
                                </div>
                                <ul>
                                    <li>
                                        <div class="bussback bussback1"><span class="wave"></span></div>
                                        <a class="buss buss1" href="<?= Url::to(['apply/land']) ?>"><i></i><span>科技贷款申请</span></a>
                                    </li>
                                    <li>
                                        <div class="bussback bussback2"><span class="wave"></span></div>
                                        <a class="buss buss2" href="<?= Url::to(['member/enterprise-list']) ?>"><i></i><span>申请进度查询</span></a>
                                    </li>
                                    <li>
                                        <div class="bussback bussback3"><span class="wave"></span></div>
                                        <a class="buss buss3" href="<?= Url::to(['article/list', 'tid' => 113]) ?>"><i></i><span>金融需求申请</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="be1"></div>
                        </div>
                        <div class="belowbox belowmain">
                            <div class="bcenter " style="margin-bottom: 19px;">
                                <div class="zi">
                                    <img src="/public/kjd/images/below3.png">
                                    <div class="cenbtnbox">
                                        <div class="cir cir1"><span class="circlet"></span></div>
                                        <div class="cbg2"></div>
                                        <div class="cbg1"></div>
                                        <a class="bcbtn bcbtn1" target="_blank" href="<?= $this->params['config']['approve_url'] ?>">管理员入口</a>
                                    </div>
                                </div>
                                <div class="c1"></div>
                            </div>
                            <div class="bcenter ">
                                <div class="zi">
                                    <img src="/public/kjd/images/below4.png">
                                    <div class="cenbtnbox">
                                        <div class="cir cir2"><span class="circlet"></span></div>
                                        <div class="cbg2"></div>
                                        <div class="cbg1"></div>
                                        <a class="bcbtn bcbtn2" target="_blank" href="<?= $this->params['config']['approve_url'] ?>">金融机构入口</a>
                                    </div>
                                </div>
                                <div class="c1"></div>
                            </div>
                        </div>
                        <div class="belowbox below2ul">
                            <div class="zi">
                                <div class="titleborder">
                                    <h3>公告</h3>
                                </div>
                                <ul>
                                    <?php foreach ($news as $key => $vo): ?>
                                        <li>
                                            <i class="wdot"></i>
                                            <a href="<?= Url::to(['article/detail', 'did' => $vo['did']]) ?>"><?= $vo['title'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="morebtnbox">
                                    <div class="morebtnback morebtnback1"><span class="morewave "></span></div>
                                    <a class="morebtn" href="#">更多</a>
                                </div>
                            </div>
                            <div class="be1"></div>
                        </div>
                    </div>
                    <div class="info">
                        <img src="/public/kjd/images/i1.png" width="32" height="28" alt="" />
                        如有问题，请联系南昌科技金融服务平台&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：15879188381
                    </div>
                </div>
            </div>
        </div>

        <div id="company_here" style="display:none;">
            <div class="linkcontent">
                <div class="list">
                    <div class="contwrap" style="width: 100%;">
                        <ul class="final_here" style=" height: 348px;"></ul>
                        <div class="page" style="width:100%;text-align: center;"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/public/kjd/js/jquery.js"></script>
        <script src="/public/kjd/js/easy.js"></script>
        <script src="/public/kjd/js/jquery.easing.1.3.js"></script>
        <script src="/public/kjd/js/jquery.fitvids.js"></script>
        <script src="/public/kjd/js/slider.js"></script>
        <script src="/public/kjd/js/js.js"></script>
        <script src="/public/kjd/js/layer/layer.js"></script>
        <script>
            $(function () {
                $('.areaul a').click(function () {
                    var type = $(this).data("type");
                    var id = $(this).data("id");
                    var page = $(this).data("page");
                    $.ajax({
                        url: "<?= Url::to(['index/ajax-get-company']) ?>",
                        async: false,
                        dataType: 'json',
                        data: {'_csrf': '<?= Yii::$app->request->csrfToken ?>', 'type': type, 'id': id, 'page': page},
                        type: 'post',
                        success: function (data) {
                            var html = '';
                            var html_2 = '';
                            $.each(data.list, function (index, item) {
                                html += '<li style="width: 45%; float: left; padding-left: 5%;">' + (index + 1) + ' ' + item.enterprise_name + '</li>';
                            });
                            $('.final_here').append(html);
                            if (data.num > 1) {
                                for (var i = 0; i < data.num; i++) {
                                    if (i == 0) {
                                        html_2 += '<a href="javascript:void(0);" class="cur" data-type="' + type + '" data-id="' + id + '" data-page="' + i + '">' + (i + 1) + '</a>';
                                    } else {
                                        html_2 += '<a href="javascript:void(0);" data-type="' + type + '" data-id="' + id + '" data-page="' + i + '">' + (i + 1) + '</a>';
                                    }
                                }
                                $('.page').append(html_2);
                            }
                        }
                    });
                    layer.open({
                        type: 1,
                        title: '企业列表',
                        skin: 'layui-layer-rim',
                        area: ['1000px', '500px'],
                        content: $('#company_here'),
                        end: function () {
                            $('.final_here,.page').empty();
                        }
                    });
                });
                //分页查询
                $(".page,.page_1,.page_2").on("click", "a", function () {
                    var par_class = $(this).parent().prop("className");
                    var type = $(this).data("type");
                    var id = $(this).data("id");
                    var page = $(this).data("page");
                    $.ajax({
                        url: "<?= Url::to(['index/ajax-get-company']) ?>",
                        async: false,
                        dataType: 'json',
                        data: {'_csrf': '<?= Yii::$app->request->csrfToken ?>', 'type': type, 'id': id, 'page': page},
                        type: 'post',
                        success: function (data) {
                            var html = '';
                            if (par_class == 'page') {
                                $.each(data.list, function (index, item) {
                                    html += '<li style="width: 45%; float: left; padding-left: 5%;">' + (index + 1) + ' ' + item.enterprise_name + '</li>';
                                });
                                $('.final_here').empty().append(html);
                            }
                            if (par_class == 'page_1') {
                                $.each(data.list, function (index, item) {
                                    html += '<li style="width:50%;float:left;">' + (index + 1) + ' ' + item.enterprise_name + '</li>';
                                });
                                $('.page_1_content').empty().append(html);
                            }
                            if (par_class == 'page_2') {
                                $.each(data.list, function (index, item) {
                                    html += '<li style="width:50%;float:left;">' + (index + 1) + ' ' + item.enterprise_name + '</li>';
                                });
                                $('.page_2_content').empty().append(html);
                            }
                        }
                    });
                    $(this).addClass('cur').siblings().removeClass('cur');
                });
            });
        </script>
    </body>
</html>