<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use app\controllers\CommonController;
use app\models\StockBase;
use app\models\StockEnterpriseIndustry;

class ProjectLibraryController extends CommonController
{

    public function actionList()
    {
        # 股权融资列表
        $model = StockBase::find()->orderBy(['create_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 20;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        # 所属领域
        $field = StockEnterpriseIndustry::getList(['parent_id' => 1]);
        $field = ArrayHelper::map($field, 'id', 'name');
        # 融资轮次
        $financing_stage = Yii::$app->params['financing_stage'];
        $financing_stage = ArrayHelper::map($financing_stage, 'id', 'name');
        return $this->render('list', ['data' => $data, 'pages' => $pages, 'field' => $field, 'financing_stage' => $financing_stage]);
    }

}
