<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class EnterpriseLoan extends ActiveRecord
{

    public $agreement = true;

    public static function tableName()
    {
        return "{{%enterprise_loan}}";
    }

    public function attributeLabels()
    {
        return [
            'want_financing' => '是否有金融需求',
            'apply_amount' => '申请金额',
            'period_month' => '申请期限',
            'loan_purpose' => '贷款用途',
            'bank_id' => '银行',
            //授信编辑
            'credit_amount' => '授信金额',
            'credit_time' => '授信时间',
            'credit_validity' => '授信有效期',
        ];
    }

    public function rules()
    {
        return [
                ['want_financing', 'required', 'message' => '{attribute}必填', 'on' => ['y_operate', 'n_operate']],
                [['apply_amount', 'period_month', 'loan_purpose', 'bank_id'], 'required', 'message' => '{attribute}必填', 'on' => 'y_operate'],
                ['apply_amount', 'number', 'message' => '{attribute}必须为数字', 'on' => 'y_operate'],
                [['apply_amount', 'period_month'], 'match', 'pattern' => '/^[1-9]d*|0$/', 'message' => '{attribute}必须为正整数', 'on' => 'y_operate'],
                ['period_month', 'compare', 'compareValue' => 1, 'operator' => '>=', 'message' => '{attribute}（1-12月）', 'on' => 'y_operate'],
                ['period_month', 'compare', 'compareValue' => 12, 'operator' => '<=', 'message' => '{attribute}（1-12月）', 'on' => 'y_operate'],
                ['user_id', 'default', 'value' => Yii::$app->session['member']['userid'], 'on' => ['y_operate', 'n_operate']],
                ['base_id', 'default', 'value' => EnterpriseBase::getBaseId(), 'on' => ['y_operate', 'n_operate']],
                [['credit_amount', 'credit_time', 'credit_validity'], 'required', 'message' => '{attribute}必填', 'on' => 'grant_edit'],
                [['credit_time', 'credit_validity'], 'date', 'format' => 'yyyy-mm-dd', 'message' => '{attribute}格式错误', 'on' => 'grant_edit'],
                ['agreement', 'validateAgreement', 'on' => ['y_operate', 'n_operate']],
                [['fund_support', 'fund_support_other', 'other_support_other'], 'safe']
        ];
    }

    //验证协议是否勾选
    public function validateAgreement()
    {
        if (!$this->hasErrors())
        {
            if ($this->agreement == 0)
            {
                $this->addError("agreement", "请阅读并勾选协议");
            }
        }
    }

    public function add($data)
    {
        if ($data['EnterpriseLoan']['want_financing'] == 1)
        {
            $this->scenario = "y_operate";
        }
        else
        {
            $this->scenario = "n_operate";
        }
        $data['EnterpriseLoan']['fund_support'] = implode(',', $data['fund_support']);
        unset($data['fund_support']);
        if ($this->load($data) && $this->save())
        {
            return true;
        }
        return false;
    }

    public function grant_edit($data, $where)
    {
        $this->scenario = "grant_edit";
        $this->setAttributes($data);
        if ($this->validate())
        {
            return self::updateAll($data, $where);
        }
        else
        {
            return false;
        }
    }

}
