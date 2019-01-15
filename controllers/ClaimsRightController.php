<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;

class ClaimsRightController extends CheckController
{

    /**
     * 债权融资项目
     */
    public function actionList()
    {

        return $this->render('list');
    }

}
