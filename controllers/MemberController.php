<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\libs\Tool;
use app\models\Member;
use app\models\EnterpriseBase;
use app\models\WorkflowGroup;
use app\models\WorkflowLog;
use app\models\ApproveUser;
use app\models\Organization;
use app\models\WorkflowNode;
use app\models\EnterpriseLoanContract;
use app\models\EnterpriseFinance;
use app\models\EnterpriseDescribe;

class MemberController extends CheckController
{

    /**
     * 会员中心~~~~账号管理
     */
    public function actionCenter()
    {

        return $this->render('center');
    }

    /**
     * 会员中心~~~~密码管理
     */
    public function actionPsw()
    {
        $model = new Member;
        $request = Yii::$app->request;
        if ($request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->changePass($post))
            {
                return $this->redirect(['call/mess', 'mess' => '密码修改成功', 'url' => Url::to(['member/center'])]);
            }
        }
        return $this->render('psw', ['model' => $model]);
    }

    /**
     * 科技贷申请管理
     */
    public function actionLoanList()
    {
        # 1.0获取流程组id
        $loan_group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'loan'])->scalar();
        # 2.0查询列表
        $list = EnterpriseBase::find()->alias('eb')
                        ->select(['eb.enterprise_name', 'el.*', 'o.name bank_name'])
                        ->innerJoin('{{%enterprise_loan}} el', 'eb.base_id=el.base_id')
                        ->leftJoin('{{%organization}} o', 'o.id=el.bank_id')
                        ->where(['eb.user_id' => $this->userid, 'el.want_financing' => 1])
                        ->asArray()->all();
        $temp = [];
        foreach ($list as $key => $vo)
        {
            $log_info = WorkflowLog::find()->select(['id', 'user_id', 'node_id', 'result'])->where(['app_id' => $vo['base_id'], 'group_id' => $loan_group_id])->orderBy(['id' => SORT_DESC])->asArray()->one();
            $vo['log_id'] = $log_info['id'];
            $vo['approve_user_id'] = $log_info['user_id'];
            $approve_user_info = ApproveUser::find()->select(['username', 'belong'])->where(['id' => $log_info['user_id']])->asArray()->one();
            $vo['approve_user_name'] = $approve_user_info['username'];
            $vo['result'] = $log_info['result'];
            $vo['organization_name'] = Organization::find()->select('name')->where(['id' => $approve_user_info['belong']])->scalar();
            $vo['node_name'] = WorkflowNode::find()->select('node_name')->where(['id' => $log_info['node_id']])->scalar();
            $str = '';
            switch ($log_info['result'])
            {
                case 'pass':
                    $str = '通过';
                    break;
                case 'back':
                    $str = '退回';
                    break;
                case 'end':
                    $str = '终止';
                    break;
                case 'defer':
                    $str = '暂缓';
                    break;
                case 'grant':
                    $str = '授信';
                    break;
                case 'finish':
                    $str = '已通过';
                    break;
                default:
                    break;
            }
            $vo['result_cn'] = $str;
            $vo['loan_repay'] = EnterpriseLoanContract::find()->where(['loan_id' => $vo['loan_id']])->asArray()->all();
            $temp[] = $vo;
        }
        $list = $temp;

        $repayment_status = Yii::$app->params['repayment_status'];
        $repayment_status = ArrayHelper::index($repayment_status, 'id');
        return $this->render('loan-list', ['list' => $list, 'repayment_status' => $repayment_status]);
    }

    /**
     * 贷款详情页
     */
    public function actionLoanDetail()
    {
        $base_id = Yii::$app->request->get('base_id');
        $base = EnterpriseBase::findOne(['base_id' => $base_id]);
        $supports = Yii::$app->params['supports'];
        $fund = ArrayHelper::map($supports['fund'], 'id', 'name');
        $orther = ArrayHelper::map($supports['orther'], 'id', 'name');
        $all_supports = $fund + $orther;
        return $this->render('four_detail', ['base' => $base, 'all_supports' => $all_supports]);
    }

    /**
     * 科技资质认证管理
     */
    public function actionEnterpriseList()
    {
        # 1.0获取流程组id
        $group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'material'])->scalar();
        # 2.0查询列表
        $list = EnterpriseBase::find()->alias('eb')
                        ->select(['eb.*', 'tl.name town_name'])
                        ->leftJoin('{{%town_list}} tl', 'eb.town_id=tl.id')
                        ->where(['eb.user_id' => $this->userid])
                        ->asArray()->all();
        $temp = [];
        foreach ($list as $key => $vo)
        {
            $log_info = WorkflowLog::find()->select(['id', 'user_id', 'node_id', 'result'])->where(['app_id' => $vo['base_id'], 'group_id' => $group_id])->orderBy(['id' => SORT_DESC])->asArray()->one();
            $vo['log_id'] = $log_info['id'];
            $vo['approve_user_id'] = $log_info['user_id'];
            $approve_user_info = ApproveUser::find()->select(['username', 'belong'])->where(['id' => $log_info['user_id']])->asArray()->one();
            $vo['approve_user_name'] = $approve_user_info['username'];
            $vo['result'] = $log_info['result'];
            $vo['organization_name'] = Organization::find()->select('name')->where(['id' => $approve_user_info['belong']])->scalar();
            $vo['node_name'] = WorkflowNode::find()->select('node_name')->where(['id' => $log_info['node_id']])->scalar();
            $str = '';
            switch ($log_info['result'])
            {
                case 'pass':
                    $str = '通过';
                    break;
                case 'back':
                    $str = '退回';
                    break;
                case 'end':
                    $str = '终止';
                    break;
                case 'defer':
                    $str = '暂缓';
                    break;
                case 'grant':
                    $str = '授信';
                    break;
                case 'finish':
                    $str = '已通过';
                    break;
                default:
                    break;
            }
            $vo['result_cn'] = $str;
            //判断入库的资料是否全部填写
            $f_count = EnterpriseFinance::find()->where(['base_id' => $vo['base_id']])->count();
            $d_count = EnterpriseDescribe::find()->where(['base_id' => $vo['base_id']])->count();
            if ($f_count > 0 && $d_count > 0)
            {
                $vo['flag'] = true;
            }
            else
            {
                $vo['flag'] = false;
            }
            $temp[] = $vo;
        }
        $list = $temp;
        return $this->render('enterprise-list', ['list' => $list]);
    }

    /**
     * 资质详情页
     */
    public function actionBaseDetail()
    {
        $base_id = Yii::$app->request->get('base_id');
        $base = EnterpriseBase::findOne(['base_id' => $base_id]);
        return $this->render('four_detail', ['base' => $base]);
    }

    /**
     * 下载模板文件
     */
    public function actionDownloadGuideFiles()
    {
        $type = Yii::$app->request->get('type');
        $file = Yii::$app->request->get('file');
        switch ($type)
        {
            case '1':
                $true_file = 'public/kjd/file/export_report.pdf';
                break;
            case '2':
                $true_file = $file;
                break;
        }
        Tool::downloadFile($true_file);
    }

    /**
     * 获取原因
     */
    public function actionGetReason()
    {
        $log_id = Yii::$app->request->post('log_id');
        $info = WorkflowLog::find()->alias('l')->select(['o.name organization_name', 'l.comment', 'from_unixtime(l.update_time,"%Y-%m-%d") update_time'])
                        ->leftJoin('{{%approve_user}} au', 'au.id=l.user_id')
                        ->leftJoin('{{%organization}} o', 'o.id=au.belong')
                        ->where(['l.id' => $log_id])->asArray()->one();
        echo json_encode($info);
        exit;
    }

    /**
     * 科技贷申请管理点击立即申请验证（需入库才能生效）
     */
    public function actionGetCheck()
    {
        if (Yii::$app->request->isAjax)
        {
            $group_id = WorkflowGroup::find()->select('id')->where(['group_key' => 'material'])->scalar();
            $info = EnterpriseBase::find()->alias('b')->select(['wl.result'])
                            ->leftJoin('{{%workflow_log}} wl', 'wl.app_id=b.base_id')
                            ->where(['b.user_id' => $this->userid, 'wl.group_id' => $group_id])
                            ->orderBy(['wl.id' => SORT_DESC])->asArray()->one();
            if (empty($info))
            {
                echo 0;
            }
            else
            {
                if ($info['result'] == 'finish')
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            exit;
        }
    }

}
