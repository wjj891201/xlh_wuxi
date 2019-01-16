<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\ProjectInfo;
use app\models\Guarantee;
use app\models\Region;
use app\models\Industry;

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
        $choice = ['' => '请选择'];
        # 贷款用途
        $loans_usage = Yii::$app->params['loans_usage'];
        $loans_usage = ArrayHelper::map($loans_usage, 'id', 'name');
        # 担保方式
        // 1.0一级担保
        $guarantee_bid = Guarantee::getList(['top_id' => 0]);
        $guarantee_bid = ArrayHelper::map($guarantee_bid, 'id', 'name');
        $guarantee_bid = $choice + $guarantee_bid;
        // 2.0二级担保
        $guarantee_mid = $choice;
        // 3.0三级担保
        $guarantee_sid = $choice;
        # 地区
        // 1.0一级地区
        $region_bid = Region::getList(['type' => 1]);
        $region_bid = ArrayHelper::map($region_bid, 'id', 'name');
        $region_bid = $choice + $region_bid;
        // 2.0二级地区
        $region_mid = $choice;
        // 3.0三级地区
        $region_sid = $choice;
        # 所属行业
        $company_industry = Industry::getList(['level' => 1]);
        $company_industry = ArrayHelper::map($company_industry, 'id', 'name');
        $company_industry = $choice + $company_industry;
        return $this->render('add', [
                    'model' => $model, 'loans_usage' => $loans_usage,
                    'guarantee_bid' => $guarantee_bid, 'guarantee_mid' => $guarantee_mid, 'guarantee_sid' => $guarantee_sid,
                    'region_bid' => $region_bid, 'region_mid' => $region_mid, 'region_sid' => $region_sid,
                    'company_industry' => $company_industry
        ]);
    }

}
