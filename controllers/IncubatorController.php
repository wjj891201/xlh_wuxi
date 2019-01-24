<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use yii\helpers\ArrayHelper;
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
        $incubator_id = Yii::$app->request->get("incubator_id");
        $info = IncubatorBase::find()->where(['incubator_id' => $incubator_id])->asArray()->one();
        # 基础设施
        $facility_ops = Yii::$app->params['facility_ops'];
        $facility_ops = ArrayHelper::index($facility_ops, 'id');
        # 特色服务
        $service_ops = Yii::$app->params['service_ops'];
        $service_ops = ArrayHelper::index($service_ops, 'id');
        return $this->render('info', ['info' => $info, 'facility_ops' => $facility_ops, 'service_ops' => $service_ops]);
    }

}
