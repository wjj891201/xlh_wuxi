<?php

namespace app\controllers;

use Yii;
use app\controllers\CommonController;

class IndexController extends CommonController
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
