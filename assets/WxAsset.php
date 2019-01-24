<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WxAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/public/wx';
    public $css = [
        'css/new_base.css',
        'css/new_header.css',
        'css/menu.css',
        'css/zi-footer.css'
    ];
    public $js = [
        'js/jquery-1.10.2.min.js',
        'js/menu.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}
