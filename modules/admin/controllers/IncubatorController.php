<?php

namespace app\modules\admin\controllers;

use app\modules\admin\controllers\CommonController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use app\models\IncubatorBase;

class IncubatorController extends CommonController
{

    public function actionList()
    {
        $model = IncubatorBase::find()->orderBy(['create_time' => SORT_DESC]);
        $count = $model->count();
        $pageSize = 10;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pages->offset)->limit($pages->limit)->all();
        # 载体资质
        $incubator_type = Yii::$app->params['incubator_type'];
        $incubator_type = ArrayHelper::map($incubator_type, 'id', 'name');
        # 载体类型
        $incubator_vector = Yii::$app->params['incubator_vector'];
        $incubator_vector = ArrayHelper::map($incubator_vector, 'id', 'name');
        return $this->render('list', ['data' => $data, 'pages' => $pages, 'incubator_type' => $incubator_type, 'incubator_vector' => $incubator_vector]);
    }

    public function actionAdd()
    {
        $incubator_id = Yii::$app->request->get('incubator_id');
        if ($incubator_id)
        {
            //编辑
            $model = IncubatorBase::find()->where(['incubator_id' => $incubator_id])->one();
            $message = '编辑成功';
            $model->facility_ops = explode(',', $model->facility_ops);
            $model->service_ops = explode(',', $model->service_ops);
        }
        else
        {
            //添加
            $model = new IncubatorBase;
            $message = '添加成功';
        }
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                Yii::$app->session->setFlash("success", $message);
                return $this->redirect(['incubator/list']);
            }
        }
        # 载体资质
        $incubator_type = Yii::$app->params['incubator_type'];
        $incubator_type = ArrayHelper::map($incubator_type, 'id', 'name');
        # 载体类型
        $incubator_vector = Yii::$app->params['incubator_vector'];
        $incubator_vector = ArrayHelper::map($incubator_vector, 'id', 'name');
        # 基础设施
        $facility_ops = Yii::$app->params['facility_ops'];
        $facility_ops = ArrayHelper::map($facility_ops, 'id', 'name');
        # 特色服务
        $service_ops = Yii::$app->params['service_ops'];
        $service_ops = ArrayHelper::map($service_ops, 'id', 'name');
        # 载体性质
        $incubator_property = Yii::$app->params['incubator_property'];
        $incubator_property = ArrayHelper::map($incubator_property, 'id', 'name');
        return $this->render('add', ['model' => $model, 'incubator_type' => $incubator_type, 'incubator_vector' => $incubator_vector, 'facility_ops' => $facility_ops, 'service_ops' => $service_ops, 'incubator_property' => $incubator_property]);
    }

    /**
     * 处理广告的批量删除和排序
     */
    public function actionDeal()
    {
        $post = Yii::$app->request->post();
        if ($post['action'] == 'del')
        {
            foreach ($post['id'] as $vo)
            {
                IncubatorBase::deleteAll('id = :id', [":id" => $vo]);
            }
            Yii::$app->session->setFlash("success", "删除成功");
        }
        if ($post['action'] == 'sort')
        {
            foreach ($post['pid'] as $key => $vo)
            {
                if (is_numeric($vo))
                {
                    IncubatorBase::updateAll(['pid' => $vo], ['id' => $key]);
                }
                else
                {
                    break;
                }
            }
            Yii::$app->session->setFlash("success", "排序成功");
        }
        return $this->redirect(['incubator/list']);
    }

}
