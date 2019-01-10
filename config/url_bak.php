<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false, //隐藏index.php 
    'suffix' => '',
    'rules' => [
        'http://admin.kjd_nanchang.deve' => 'admin',
        'http://approve.kjd_nanchang.deve' => 'approve'
    ],
];
