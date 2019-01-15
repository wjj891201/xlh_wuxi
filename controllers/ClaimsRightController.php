<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\ProjectInfo;

class ClaimsRightController extends CheckController
{

    /**
     * 债权融资项目
     */
    public function actionList()
    {

        return $this->render('list');
    }

    /**
     * 添加债权融资项目
     */
    public function actionAdd()
    {
        $model = new ProjectInfo;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['area/list']);
            }
        }
        $loans_usage = Yii::$app->params['loans_usage'];
        $loans_usage = ArrayHelper::map($loans_usage, 'id', 'name');
        return $this->render('add', ['model' => $model, 'loans_usage' => $loans_usage]);
    }

}
