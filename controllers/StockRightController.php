<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\EnterpriseBase;
use app\models\Region;

class StockRightController extends CheckController
{

    /**
     * 股权融资项目
     */
    public function actionList()
    {

        return $this->render('list');
    }

    /**
     * 发布股权融资项目
     */
    public function actionAdd()
    {
        $model = new EnterpriseBase;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                return $this->redirect(['call/mess', 'mess' => '股权融资项目发布成功']);
            }
        }
        $choice = ['' => '请选择'];
        # 地区
        // 1.0一级地区
        $region_bid = Region::getList(['type' => 1]);
        $region_bid = ArrayHelper::map($region_bid, 'id', 'name');
        $region_bid = $choice + $region_bid;
        // 2.0二级地区
        $region_mid = $choice;
        // 3.0三级地区
        $region_sid = $choice;
        # 企业性质
        $company_type = Yii::$app->params['company_type'];
        $company_type = ArrayHelper::map($company_type, 'id', 'name');
        return $this->render('add', ['model' => $model, 'region_bid' => $region_bid, 'region_mid' => $region_mid, 'region_sid' => $region_sid, 'company_type' => $company_type]);
    }

}
