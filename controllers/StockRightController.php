<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\EnterpriseBase;
use app\models\Region;
use app\models\EnterpriseIndustry;
use app\models\FinancingHistory;

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
     * 发布股权融资项目-第一步
     */
    public function actionAdd()
    {
        $choice = ['' => '请选择'];
        // 1.0一级地区
        $region_bid = Region::getList(['type' => 1]);
        $region_bid = ArrayHelper::map($region_bid, 'id', 'name');
        $region_bid = $choice + $region_bid;
        $model = EnterpriseBase::find()->where(['user_id' => $this->userid])->one();
        if (!$model)
        {
            $model = new EnterpriseBase;
            // 2.0二级地区
            $region_mid = $choice;
            // 3.0三级地区
            $region_sid = $choice;
        }
        else
        {
            // 2.0二级地区
            $region_mid = Region::getList(['parent_id' => $model->company_region_bid, 'type' => 2]);
            $region_mid = ArrayHelper::map($region_mid, 'id', 'name');
            $region_mid = $choice + $region_mid;
            // 3.0三级地区
            $region_sid = Region::getList(['parent_id' => $model->company_region_mid, 'type' => 3]);
            $region_sid = ArrayHelper::map($region_sid, 'id', 'name');
            $region_sid = $choice + $region_sid;
        }
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post, 's_1'))
            {
                return $this->redirect(['stock-right/add_2']);
            }
        }
        # 企业性质
        $company_type = Yii::$app->params['company_type'];
        $company_type = ArrayHelper::map($company_type, 'id', 'name');
        return $this->render('add', ['model' => $model, 'region_bid' => $region_bid, 'region_mid' => $region_mid, 'region_sid' => $region_sid, 'company_type' => $company_type]);
    }

    /**
     * 发布股权融资项目-第二步
     */
    public function actionAdd_2()
    {
        $choice = ['' => '请选择'];
        // 1.0一级地区
        $region_bid = Region::getList(['type' => 1]);
        $region_bid = ArrayHelper::map($region_bid, 'id', 'name');
        $region_bid = $choice + $region_bid;
        $model = EnterpriseBase::find()->where(['user_id' => $this->userid])->one();
        if (!$model)
        {
            $model = new EnterpriseBase;
            // 2.0二级地区
            $region_mid = $choice;
            // 3.0三级地区
            $region_sid = $choice;
        }
        else
        {
            // 2.0二级地区
            $region_mid = Region::getList(['parent_id' => $model->bp_region_bid, 'type' => 2]);
            $region_mid = ArrayHelper::map($region_mid, 'id', 'name');
            $region_mid = $choice + $region_mid;
            // 3.0三级地区
            $region_sid = Region::getList(['parent_id' => $model->bp_region_mid, 'type' => 3]);
            $region_sid = ArrayHelper::map($region_sid, 'id', 'name');
            $region_sid = $choice + $region_sid;
            if ($model->bp_profession)
            {
                $model->code = 1;
            }
        }
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post, 's_2'))
            {
                return $this->redirect(['stock-right/add_3']);
            }
        }
        # 所属领域
        $field = EnterpriseIndustry::getList(['level' => 1]);
        $field = ArrayHelper::map($field, 'id', 'name');
        return $this->render('add_2', ['model' => $model, 'region_bid' => $region_bid, 'region_mid' => $region_mid, 'region_sid' => $region_sid, 'field' => $field]);
    }

    /**
     * 发布股权融资项目-第三步
     */
    public function actionAdd_3()
    {
        $model = EnterpriseBase::find()->where(['user_id' => $this->userid])->one();
        if (!$model)
        {
            $model = new EnterpriseBase;
        }
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post, 's_3'))
            {
                return $this->redirect(['call/mess', 'mess' => '发布成功', 'url' => Url::to(['stock-right/list'])]);
            }
        }
        # 融资轮次
        $financing_stage = Yii::$app->params['financing_stage'];
        return $this->render('add_3', ['model' => $model, 'financing_stage' => $financing_stage]);
    }

    /**
     * ajax添加融资历史
     */
    public function actionAjaxAddHistory()
    {
        if (Yii::$app->request->isAjax)
        {
            $data_financing_id = Yii::$app->request->post('data_financing_id', '');
            if (empty($data_financing_id))
            {
                //添加
                $projects_id = EnterpriseBase::find()->select('id')->where(['user_id' => $this->userid])->scalar();
                $request = Yii::$app->request;
                $data = [
                    'projects_id' => $projects_id,
                    'financing_time' => $request->post('financing_time'),
                    'financing_stage' => $request->post('financing_stage'),
                    'financing_money' => $request->post('financing_money'),
                    'financing_currency' => $request->post('financing_currency'),
                    'financing_valuation' => $request->post('financing_valuation'),
                    'financing_valuation_currency' => $request->post('financing_valuation_currency'),
                    'financing_investors' => $request->post('financing_investors'),
                    'create_time' => time()
                ];
                Yii::$app->db->createCommand()->insert("{{%financing_history}}", $data)->execute();
                $financing_id = Yii::$app->db->getLastInsertID();
                echo $financing_id;
                exit;
            }
            else
            {
                //编辑
                $request = Yii::$app->request;
                $data = [
                    'financing_time' => $request->post('financing_time'),
                    'financing_stage' => $request->post('financing_stage'),
                    'financing_money' => $request->post('financing_money'),
                    'financing_currency' => $request->post('financing_currency'),
                    'financing_valuation' => $request->post('financing_valuation'),
                    'financing_valuation_currency' => $request->post('financing_valuation_currency'),
                    'financing_investors' => $request->post('financing_investors'),
                ];
                FinancingHistory::updateAll($data, ['financing_id' => $data_financing_id]);
                echo $data_financing_id;
                exit;
            }
        }
    }

    /**
     * ajax删除融资历史
     */
    public function actionAjaxDelHistory()
    {
        $financing_id = Yii::$app->request->post('financing_id');
        $tag = FinancingHistory::deleteAll(['financing_id' => $financing_id]);
        if ($tag)
        {
            echo '1';
            exit;
        }
    }

    /**
     * ajax获取融资历史
     */
    public function actionAjaxGetHistory()
    {
        $financing_id = Yii::$app->request->post('financing_id');
        $info = FinancingHistory::find()->where(['financing_id' => $financing_id])->asArray()->one();
        echo json_encode($info);
        exit;
    }

}
