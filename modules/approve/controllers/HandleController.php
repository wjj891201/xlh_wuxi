<?php

namespace app\modules\approve\controllers;

use app\modules\approve\controllers\CommonController;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\models\WorkflowLog;
use app\models\WorkflowNode;
use app\models\WorkflowAction;
use app\models\WorkflowGroup;

class HandleController extends CommonController
{

    public $group_id;
    public $loan_group_id;

    public function init()
    {
        $this->group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'material'])->scalar();
        $this->loan_group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'loan'])->scalar();
    }

    /**
     * 待审核企业
     */
    public function actionWaitFor()
    {
        $supports        = Yii::$app->params['supports'];
        $fund            = ArrayHelper::map($supports['fund'], 'id', 'name');
        $orther          = ArrayHelper::map($supports['orther'], 'id', 'name');
        $all_supports    = $fund + $orther;
        $approve_user_id = Yii::$app->approvr_user->identity->id;
        $pageSize        = 20;

        $enterprise_name = Yii::$app->request->get('enterprise_name', '');
        $start_time      = Yii::$app->request->get('start_time', '');
        $start_time      = ($start_time !== '') ? $start_time . ' 00:00:00' : '';
        $end_time        = Yii::$app->request->get('end_time', '');
        $end_time        = ($end_time !== '') ? $end_time . ' 23:59:59' : '';
  
        $query = WorkflowLog::find()->alias('wfl')
                ->select([
                    'wfl.id workflow_log_id', 'wfl.app_id', 'wfl.group_id', 'wfl.user_id approve_user_id', 'wfl.node_id', 'wfl.is_read',
                    'b.base_id', 'b.enterprise_name', 'b.contact_person_man', 'b.contact_person_phone', 'b.base_create_time',
                    'l.loan_id', 'l.fund_support', 'l.want_financing',
                    'd.qualification_certificate',
                    'f.annual_sales',
                    'tl.name town_name',
                ])
                ->innerJoin('{{%enterprise_base}} b', 'b.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_loan}} l', 'l.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_describe}} d', 'd.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_finance}} f', 'f.base_id=wfl.app_id')
                ->leftJoin('{{%town_list}} tl', 'tl.id=b.town_id')
                ->where(['AND', ['wfl.user_id' => $approve_user_id], ['OR', ['wfl.result' => null], ['wfl.result' => ''], ['wfl.result' => 'pass']], ['wfl.group_id' => $this->group_id]])
                ->andFilterWhere(['like', 'b.enterprise_name', $enterprise_name])
                ->andFilterWhere(['>=', 'b.base_create_time', $start_time])
                ->andFilterWhere(['<=', 'b.base_create_time', $end_time]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['b.base_id' => SORT_DESC])->asArray()->all();
        $temp = [];
        foreach ($data as $key => $vo)
        {
            $fund_support_cn = '';
            if (!empty($vo['fund_support']))
            {
                $fund_support_arr = explode(',', $vo['fund_support']);
                foreach ($fund_support_arr as $v)
                {
                    $fund_support_cn .= '【' . $all_supports[$v] . '】<br/>';
                }
            }
            $vo['fund_support_cn'] = $fund_support_cn;
            #根据节点获取该节点具有的动作
            $vo['actionList'] = WorkflowAction::getData(['workflow_node_id' => $vo['node_id']]);
            $temp[] = $vo;
        }
        $data = $temp;
        return $this->render("wait-for", ['data' => $data, 'pages' => $pages]);
    }

    /**
     * 被终止企业
     */
    public function actionEnd()
    {
        $supports     = Yii::$app->params['supports'];
        $fund         = ArrayHelper::map($supports['fund'], 'id', 'name');
        $orther       = ArrayHelper::map($supports['orther'], 'id', 'name');
        $all_supports = $fund + $orther;
        $app_ids      = WorkflowLog::find()->select('app_id')->where(['user_id' => Yii::$app->approvr_user->identity->id])->asArray()->column();
        $pageSize     = 20;

        $enterprise_name = Yii::$app->request->get('enterprise_name', '');
        $start_time      = Yii::$app->request->get('start_time', '');
        $start_time      = ($start_time !== '') ? $start_time . ' 00:00:00' : '';
        $end_time        = Yii::$app->request->get('end_time', '');
        $end_time        = ($end_time !== '') ? $end_time . ' 23:59:59' : '';

        $query = WorkflowLog::find()->alias('wfl')
                ->select([
                    'wfl.id workflow_log_id', 'wfl.app_id', 'wfl.group_id', 'wfl.user_id approve_user_id', 'wfl.node_id', 'wfl.is_read',
                    'b.base_id', 'b.enterprise_name', 'b.contact_person_man', 'b.contact_person_phone', 'b.base_create_time',
                    'l.loan_id', 'l.fund_support', 'l.want_financing',
                    'd.qualification_certificate',
                    'f.annual_sales',
                    'tl.name town_name',
                ])
                ->innerJoin('{{%enterprise_base}} b', 'b.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_loan}} l', 'l.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_describe}} d', 'd.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_finance}} f', 'f.base_id=wfl.app_id')
                ->leftJoin('{{%town_list}} tl', 'tl.id=b.town_id')
                ->where(['AND', ['IN', 'wfl.app_id', $app_ids], ['wfl.result' => 'end'], ['wfl.group_id' => $this->group_id]])
                ->andFilterWhere(['like', 'b.enterprise_name', $enterprise_name])
                ->andFilterWhere(['>=', 'b.base_create_time', $start_time])
                ->andFilterWhere(['<=', 'b.base_create_time', $end_time]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['b.base_id' => SORT_DESC])->asArray()->all();

        $temp = [];
        foreach ($data as $key => $vo)
        {
            $fund_support_cn = '';
            if (!empty($vo['fund_support']))
            {
                $fund_support_arr = explode(',', $vo['fund_support']);
                foreach ($fund_support_arr as $v)
                {
                    $fund_support_cn .= '【' . $all_supports[$v] . '】<br/>';
                }
            }
            $vo['fund_support_cn'] = $fund_support_cn;
            $temp[] = $vo;
        }
        $data = $temp;
        return $this->render("end", ['data' => $data, 'pages' => $pages]);
    }

    /**
     * 被退回企业
     */
    public function actionBack()
    {
        $supports     = Yii::$app->params['supports'];
        $fund         = ArrayHelper::map($supports['fund'], 'id', 'name');
        $orther       = ArrayHelper::map($supports['orther'], 'id', 'name');
        $all_supports = $fund + $orther;
        $app_ids      = WorkflowLog::find()->select('app_id')->where(['user_id' => Yii::$app->approvr_user->identity->id])->asArray()->column();
        $pageSize     = 20;

        $enterprise_name = Yii::$app->request->get('enterprise_name', '');
        $start_time      = Yii::$app->request->get('start_time', '');
        $start_time      = ($start_time !== '') ? $start_time . ' 00:00:00' : '';
        $end_time        = Yii::$app->request->get('end_time', '');
        $end_time        = ($end_time !== '') ? $end_time . ' 23:59:59' : '';

        $query = WorkflowLog::find()->alias('wfl')
                ->select([
                    'wfl.id workflow_log_id', 'wfl.app_id', 'wfl.group_id', 'wfl.user_id approve_user_id', 'wfl.node_id',
                    'b.base_id', 'b.enterprise_name', 'b.contact_person_man', 'b.contact_person_phone', 'b.base_create_time',
                    'l.loan_id', 'l.fund_support', 'l.want_financing',
                    'd.qualification_certificate',
                    'f.annual_sales',
                    'tl.name town_name',
                ])
                ->innerJoin('{{%enterprise_base}} b', 'b.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_loan}} l', 'l.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_describe}} d', 'd.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_finance}} f', 'f.base_id=wfl.app_id')
                ->leftJoin('{{%town_list}} tl', 'tl.id=b.town_id')
                ->where(['AND', ['IN', 'wfl.app_id', $app_ids], ['wfl.result' => 'back'], ['wfl.group_id' => $this->group_id]])
                ->andFilterWhere(['like', 'b.enterprise_name', $enterprise_name])
                ->andFilterWhere(['>=', 'b.base_create_time', $start_time])
                ->andFilterWhere(['<=', 'b.base_create_time', $end_time]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['b.base_id' => SORT_DESC])->asArray()->all();
        
        $temp = [];
        foreach ($data as $key => $vo)
        {
            $fund_support_cn = '';
            if (!empty($vo['fund_support']))
            {
                $fund_support_arr = explode(',', $vo['fund_support']);
                foreach ($fund_support_arr as $v)
                {
                    $fund_support_cn .= '【' . $all_supports[$v] . '】';
                }
            }
            $vo['fund_support_cn'] = $fund_support_cn;
            $temp[] = $vo;
        }
        $data = $temp;
        return $this->render("back", ['data' => $data, 'pages' => $pages]);
    }

    /**
     * 被暂存企业
     */
    public function actionDefer()
    {
        $approve_user_id = Yii::$app->approvr_user->identity->id;
        $approve_organization_id = Yii::$app->approvr_user->identity->belong;
        $app_ids = WorkflowLog::find()->select('app_id')->where(['user_id' => Yii::$app->approvr_user->identity->id])->asArray()->column();
        $pageSize = 20;
        $query = WorkflowLog::find()->alias('wfl')
                ->select([
                    'wfl.id workflow_log_id', 'wfl.app_id', 'wfl.group_id', 'wfl.user_id approve_user_id',
                    'b.base_id', 'b.enterprise_name', 'b.contact_person_man', 'b.contact_person_phone', 'b.base_create_time',
                    'd.qualification_certificate',
                    'tl.name town_name',
                ])
                ->innerJoin('{{%enterprise_base}} b', 'b.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_describe}} d', 'd.base_id=wfl.app_id')
                ->leftJoin('{{%town_list}} tl', 'tl.id=b.town_id')
                ->where(['AND', ['IN', 'wfl.app_id', $app_ids], ['wfl.result' => 'defer'], ['wfl.group_id' => $this->group_id]]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['b.base_id' => SORT_DESC])->asArray()->all();
        #获取用户要审批哪个节点 1先用审批用户id去查 2再用审批用户所属机构去查
        $nodeInfo = WorkflowNode::find()->where(['approve_user_id' => $approve_user_id])->asArray()->one();
        if (!empty($nodeInfo))
        {
            $node_id = $nodeInfo['id'];
        }
        else
        {
            $nodeInfo = WorkflowNode::find()->where(['organization_id' => $approve_organization_id])->asArray()->one();
            $node_id = !empty($nodeInfo) ? $nodeInfo['id'] : '';
        }
        #根据节点获取该节点具有的动作
        $actionList = WorkflowAction::getData(['workflow_node_id' => $node_id]);
        return $this->render("defer", ['data' => $data, 'pages' => $pages, 'actionList' => $actionList]);
    }

    /**
     * 已通过企业
     */
    public function actionFinish()
    {
        $supports     = Yii::$app->params['supports'];
        $fund         = ArrayHelper::map($supports['fund'], 'id', 'name');
        $orther       = ArrayHelper::map($supports['orther'], 'id', 'name');
        $all_supports = $fund + $orther;
        $app_ids      = WorkflowLog::find()->select('app_id')->where(['user_id' => Yii::$app->approvr_user->identity->id])->asArray()->column();
        $pageSize     = 20;

        $enterprise_name = Yii::$app->request->get('enterprise_name', '');
        $start_time      = Yii::$app->request->get('start_time', '');
        $start_time      = ($start_time !== '') ? $start_time . ' 00:00:00' : '';
        $end_time        = Yii::$app->request->get('end_time', '');
        $end_time        = ($end_time !== '') ? $end_time . ' 23:59:59' : '';

        $query = WorkflowLog::find()->alias('wfl')
                ->select([
                    'wfl.id workflow_log_id', 'wfl.app_id', 'wfl.group_id', 'wfl.user_id approve_user_id', 'wfl.node_id',
                    'b.base_id', 'b.enterprise_name', 'b.contact_person_man', 'b.contact_person_phone', 'b.base_create_time',
                    'l.loan_id', 'l.fund_support', 'l.want_financing',
                    'd.qualification_certificate',
                    'f.annual_sales',
                    'tl.name town_name',
                ])
                ->innerJoin('{{%enterprise_base}} b', 'b.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_loan}} l', 'l.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_describe}} d', 'd.base_id=wfl.app_id')
                ->innerJoin('{{%enterprise_finance}} f', 'f.base_id=wfl.app_id')
                ->leftJoin('{{%town_list}} tl', 'tl.id=b.town_id')
                ->where(['AND', ['IN', 'wfl.app_id', $app_ids], ['wfl.result' => 'finish'], ['wfl.group_id' => $this->group_id]])
                ->andFilterWhere(['like', 'b.enterprise_name', $enterprise_name])
                ->andFilterWhere(['>=', 'b.base_create_time', $start_time])
                ->andFilterWhere(['<=', 'b.base_create_time', $end_time]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->orderBy(['b.base_id' => SORT_DESC])->asArray()->all();

        $temp = [];
        foreach ($data as $key => $vo)
        {
            $fund_support_cn = '';
            if (!empty($vo['fund_support']))
            {
                $fund_support_arr = explode(',', $vo['fund_support']);
                foreach ($fund_support_arr as $v)
                {
                    $fund_support_cn .= '【' . $all_supports[$v] . '】';
                }
            }
            $vo['fund_support_cn'] = $fund_support_cn;
            $temp[] = $vo;
        }
        $data = $temp;
        return $this->render("finish", ['data' => $data, 'pages' => $pages]);
    }

}
