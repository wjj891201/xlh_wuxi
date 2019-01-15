<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Member;

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

}
