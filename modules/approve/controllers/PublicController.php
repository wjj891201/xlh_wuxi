<?php

namespace app\modules\approve\controllers;

use app\modules\approve\controllers\CommonController;
use yii\web\Controller;
use Yii;


class PublicController extends CommonController
{

    public function actionIndex()
    {
        $belong = Yii::$app->approvr_user->identity->belong;
        if(in_array($belong, [1,2])){
            $this->redirect("/approve/handle/wait-for");
        }elseif(in_array($belong, [23,24])){
            $this->redirect("/approve/loan-handle/loan-wait-for");
        } 
    }

}
