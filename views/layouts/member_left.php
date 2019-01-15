<?php

use yii\helpers\Url;
?>
<div class="grid_5 member_Nav alpha">
    <h3>会员中心</h3>
    <dl>
        <dt class="message_icon">信息管理</dt>
        <dd>
            <a href="">账号信息</a>
            <a href="<?= Url::to(['member/psw']) ?>">修改密码</a>
        </dd>
    </dl>    
    <dl>
        <dt class="money_icon">我的融资</dt>
        <dd>
            <a href="<?= Url::to(['claims-right/list']) ?>">债权融资项目</a>
            <a href="<?= Url::to(['stock-right/list']) ?>">股权融资项目</a>
        </dd>
    </dl>    
</div>