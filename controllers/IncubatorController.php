<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use yii\data\Pagination;
use app\models\IncubatorBase;

class IncubatorController extends CommonController
{

    /**
     * 列表
     */
    public function actionList()
    {
        # 推荐孵化器
        $recommend = IncubatorBase::find()->select(['incubator_id', 'incubator_name', 'incubator_logo'])->where(['incubator_recommend_index' => 1])->orderBy(['incubator_id' => SORT_DESC])->asArray()->all();
        # 孵化器列表
        $model = IncubatorBase::find()->orderBy(['incubator_id' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 10;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        # 载体资质
        $incubator_type = Yii::$app->params['incubator_type'];
        # 载体类型
        $incubator_vector = Yii::$app->params['incubator_vector'];
        return $this->render('list', ['recommend' => $recommend, 'data' => $data, 'pages' => $pages, 'incubator_type' => $incubator_type, 'incubator_vector' => $incubator_vector]);
    }

    /**
     * 孵化详情
     */
    public function actionInfo()
    {
        
    }

}
