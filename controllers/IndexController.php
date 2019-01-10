<?php

namespace app\controllers;

use Yii;
use app\controllers\CommonController;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use app\models\News;
use app\models\Advert;
use app\models\WorkflowGroup;
use app\models\EnterpriseBase;
use app\models\EnterpriseLoan;
use app\models\EnterpriseDescribe;
use app\models\Area;
use app\models\Organization;

class IndexController extends CommonController
{

    public $group_id;
    public $loan_group_id;

    public function init()
    {
        parent::init();
        $this->group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'material'])->scalar();
        $this->loan_group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'loan'])->scalar();
    }

    public function actionIndex()
    {
        $this->layout = false;
        $limit = 20;
        # 公告
        $news = News::getNews(['mid' => 1, 'tid' => 111, 'max' => 10]);
        # 顶部logo
        $logo = Advert::get_one(['atid' => 1]);
        # 统计
        //企业申请总数
        $one_num = EnterpriseBase::apply_all_statistics();
        $one_town_list = Area::find()->select(['id', 'name'])->asArray()->all();
        foreach ($one_town_list as $key => $vo)
        {
            $one_town_list[$key]['count'] = EnterpriseBase::apply_all_statistics(['town_id' => $vo['id']]);
        }
        $one_enterprise = Yii::$app->params['enterprise'];
        foreach ($one_enterprise as $key => $vo)
        {
            $one_enterprise[$key]['count'] = EnterpriseDescribe::find()->where(new Expression('FIND_IN_SET(' . $vo['id'] . ', enterprise_type)'))->count();
        }
        $one_industry = Yii::$app->params['industry'];
        foreach ($one_industry as $key => $vo)
        {
            $one_industry[$key]['count'] = EnterpriseBase::apply_all_statistics(['industry_id' => $vo['id']]);
        }
        $one_company_count = ceil(EnterpriseBase::find()->count() / $limit);
        $one_company = EnterpriseBase::find()->select(['enterprise_name'])->limit($limit)->orderBy(['base_id' => SORT_DESC])->asArray()->all();
        //企业入库总数
        $two_num = EnterpriseBase::apply_in_statistics(['wl.group_id' => $this->group_id, 'wl.result' => 'finish']);
        $two_town_list = Area::find()->select(['id', 'name'])->asArray()->all();
        foreach ($two_town_list as $key => $vo)
        {
            $two_town_list[$key]['count'] = EnterpriseBase::apply_in_statistics(['wl.group_id' => $this->group_id, 'wl.result' => 'finish', 'eb.town_id' => $vo['id']]);
        }
        $two_enterprise = Yii::$app->params['enterprise'];
        foreach ($two_enterprise as $key => $vo)
        {
            $base_ids = EnterpriseDescribe::find()->select('base_id')->where(new Expression('FIND_IN_SET(' . $vo['id'] . ', enterprise_type)'))->asArray()->column();
            $two_enterprise[$key]['count'] = EnterpriseBase::apply_in_statistics(['and', ['wl.group_id' => $this->group_id, 'wl.result' => 'finish'], ['in', 'eb.base_id', $base_ids]]);
        }
        $two_industry = Yii::$app->params['industry'];
        foreach ($two_industry as $key => $vo)
        {
            $two_industry[$key]['count'] = EnterpriseBase::apply_in_statistics(['wl.group_id' => $this->group_id, 'wl.result' => 'finish', 'eb.industry_id' => $vo['id']]);
        }
        $two_company_count = EnterpriseBase::find()->alias('eb')->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->count();
        $two_company_count = ceil($two_company_count / $limit);
        $two_company = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->limit($limit)->orderBy(['eb.base_id' => SORT_DESC])->asArray()->all();
        //金融需求总数
        $three_num = EnterpriseLoan::find()->count();
        //金融受理总数
        $four_num = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['wl.group_id' => $this->loan_group_id, 'wl.result' => 'pass'])->count();
        # 金融需求统计
        //1.0(需求)
        $totle_1 = EnterpriseLoan::find()->sum('apply_amount');
        $data_1 = ['title' => '需求', 'count' => $three_num, 'totle' => $totle_1];
        //2.0（受理）
        $totle_2 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['wl.group_id' => $this->loan_group_id, 'wl.result' => 'pass'])->sum('el.apply_amount');
        $data_2 = ['title' => '受理', 'count' => $four_num, 'totle' => $totle_2];
        //3.0（授信）
        $count_3 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['wl.group_id' => $this->loan_group_id, 'wl.result' => 'grant'])->count();
        $totle_3 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['wl.group_id' => $this->loan_group_id, 'wl.result' => 'grant'])->sum('el.credit_amount');
        $data_3 = ['title' => '授信', 'count' => $count_3, 'totle' => $totle_3];
        //4.0（发放）
        $count_4 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.result' => 'grant'], "el.credit_amount = el.already_loan_amount"])->count();
        $totle_4 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.result' => 'grant'], "el.credit_amount = el.already_loan_amount"])->sum('el.already_loan_amount');
        $data_4 = ['title' => '发放', 'count' => $count_4, 'totle' => $totle_4];
        $jrxq = [$data_1, $data_2, $data_3, $data_4];
        //其他金融需求
        $fund = Yii::$app->params['supports']['fund'];
        $orther = Yii::$app->params['supports']['orther'];
        $all_supports = array_merge($fund, $orther);
        unset($all_supports[0], $all_supports[6]);
        $flag = [];
        foreach ($all_supports as $key => $vo)
        {
            $vo['count'] = EnterpriseLoan::find()->where(new Expression('FIND_IN_SET(' . $vo['id'] . ', fund_support)'))->count();
            $flag[] = $vo;
        }
        $all_supports = $flag;
        # 科技银行贷款
        $bank_tj = Organization::find()->alias('o')->select(['o.name organization_name', 'au.id approve_user_id'])->leftJoin('{{%approve_user}} au', 'au.belong=o.id')->where(['o.pid' => 4])->asArray()->all();
        $wmc = [];
        foreach ($bank_tj as $key => $vo)
        {
            //1.0（待受理）
            $b_count_1 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id']], ['OR', ['wl.result' => null], ['wl.result' => '']]])->count();
            $b_total_1 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id']], ['OR', ['wl.result' => null], ['wl.result' => '']]])->sum('el.apply_amount');
            //2.0（受理中）
            $b_count_2 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'pass']])->count();
            $b_total_2 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'pass']])->sum('el.apply_amount');
            //3.0（已授信）
            $b_count_3 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'grant']])->count();
            $b_total_3 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'grant']])->sum('el.credit_amount');
            //4.0（贷款落地）
            $b_count_4 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'grant'], "el.credit_amount = el.already_loan_amount"])->count();
            $b_total_4 = EnterpriseLoan::find()->alias('el')->leftJoin('{{%workflow_log}} wl', 'el.base_id=wl.app_id')->where(['and', ['wl.group_id' => $this->loan_group_id, 'wl.user_id' => $vo['approve_user_id'], 'wl.result' => 'grant'], "el.credit_amount = el.already_loan_amount"])->sum('el.already_loan_amount');

            $vo['b_count_1'] = $b_count_1;
            $vo['b_total_1'] = $b_total_1;
            $vo['b_count_2'] = $b_count_2;
            $vo['b_total_2'] = $b_total_2;
            $vo['b_count_3'] = $b_count_3;
            $vo['b_total_3'] = $b_total_3;
            $vo['b_count_4'] = $b_count_4;
            $vo['b_total_4'] = $b_total_4;
            $wmc[] = $vo;
        }
        $bank_tj = $wmc;

        return $this->render("index", [
                    'news' => $news, 'logo' => $logo,
                    'one_num' => $one_num, 'one_town_list' => $one_town_list, 'one_enterprise' => $one_enterprise, 'one_industry' => $one_industry, 'one_company_count' => $one_company_count, 'one_company' => $one_company,
                    'two_num' => $two_num, 'two_town_list' => $two_town_list, 'two_enterprise' => $two_enterprise, 'two_industry' => $two_industry, 'two_company_count' => $two_company_count, 'two_company' => $two_company,
                    'three_num' => $three_num,
                    'four_num' => $four_num,
                    'jrxq' => $jrxq,
                    'all_supports' => $all_supports,
                    'bank_tj' => $bank_tj
        ]);
    }

    /**
     * 获取企业
     */
    public function actionAjaxGetCompany()
    {
        if (Yii::$app->request->isAjax)
        {
            $type = Yii::$app->request->post('type');
            $id = Yii::$app->request->post('id');
            $page = Yii::$app->request->post('page', 0);
            $limit = 20;
            switch ($type)
            {
                case 's_area':
                    $count = EnterpriseBase::find()->select(['enterprise_name'])->where(['town_id' => $id])->count();
                    $list = EnterpriseBase::find()->select(['enterprise_name'])->where(['town_id' => $id])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 's_enterprise':
                    $base_ids = EnterpriseDescribe::find()->select('base_id')->where(new Expression('FIND_IN_SET(' . $id . ', enterprise_type)'))->asArray()->column();
                    $count = EnterpriseBase::find()->select(['enterprise_name'])->where(['IN', 'base_id', $base_ids])->count();
                    $list = EnterpriseBase::find()->select(['enterprise_name'])->where(['IN', 'base_id', $base_ids])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 's_industry':
                    $count = EnterpriseBase::find()->select(['enterprise_name'])->where(['industry_id' => $id])->count();
                    $list = EnterpriseBase::find()->select(['enterprise_name'])->where(['industry_id' => $id])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 'i_area':
                    $count = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['eb.town_id' => $id, 'wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->count();
                    $list = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['eb.town_id' => $id, 'wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 'i_enterprise':
                    $base_ids = EnterpriseDescribe::find()->select('base_id')->where(new Expression('FIND_IN_SET(' . $id . ', enterprise_type)'))->asArray()->column();
                    $count = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['AND', ['wl.group_id' => $this->group_id, 'wl.result' => 'finish'], ['IN', 'eb.base_id', $base_ids]])->count();
                    $list = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['AND', ['wl.group_id' => $this->group_id, 'wl.result' => 'finish'], ['IN', 'eb.base_id', $base_ids]])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 'i_industry':
                    $count = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['eb.industry' => $id, 'wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->count();
                    $list = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['eb.industry' => $id, 'wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->offset($page * $limit)->limit($limit)->asArray()->all();
                    break;
                case 's_company':
                    $count = 0;
                    $list = EnterpriseBase::find()->select(['enterprise_name'])->offset($page * $limit)->limit($limit)->orderBy(['base_id' => SORT_DESC])->asArray()->all();
                    break;
                case 'i_company':
                    $count = 0;
                    $list = EnterpriseBase::find()->alias('eb')->select(['eb.enterprise_name'])->leftJoin('{{%workflow_log}} wl', 'eb.base_id=wl.app_id')->where(['wl.group_id' => $this->group_id, 'wl.result' => 'finish'])->limit($limit)->offset($page * $limit)->limit($limit)->orderBy(['eb.base_id' => SORT_DESC])->asArray()->all();
                    break;
            }
            $data = [
                'num' => ceil($count / $limit),
                'list' => $list
            ];
            echo json_encode($data);
            exit;
        }
    }

}
