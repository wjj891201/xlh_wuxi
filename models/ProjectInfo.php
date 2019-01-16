<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class ProjectInfo extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%project_info}}";
    }

    public function attributeLabels()
    {
        return [
            'loans_num' => '融资金额',
            'loans_usage' => '货款用途',
            'guarantee_bid' => '一级担保',
            'guarantee_mid' => '二级担保',
            'guarantee_sid' => '三级担保',
            'other' => '估值',
            'loads_date' => '货款期限',
            'company_created' => '成立时间',
            'company_name' => '企业名称',
            'company_region_bid' => '省',
            'company_region_mid' => '市',
            'company_region_sid' => '县/区',
            'company_industry' => '所属行业',
            'sell_income_1' => '收入',
            'sell_income_2' => '收入',
            'sell_income_3' => '收入',
            'net_profit_1' => '净利润',
            'net_profit_2' => '净利润',
            'net_profit_3' => '净利润',
            'incur_debts' => '资产负债率',
            'manager_name' => '姓名',
            'manager_province' => '省',
            'manager_city' => '市',
            'user_name' => '联系人',
            'user_mobile' => '手机号码',
            'user_title' => '职务名称',
            'user_mail' => '邮箱信息',
            'document_url' => '营业执照'
        ];
    }

    public function rules()
    {
        return [
                [['loans_num', 'loans_usage', 'guarantee_bid', 'guarantee_mid', 'guarantee_sid', 'other', 'loads_date', 'company_created', 'company_name', 'company_region_bid', 'company_region_mid', 'company_region_sid', 'company_industry', 'sell_income_1', 'sell_income_2', 'sell_income_3', 'net_profit_1', 'net_profit_2', 'net_profit_3', 'manager_name', 'manager_province', 'manager_city', 'user_name', 'user_mobile', 'user_title', 'user_mail', 'document_url'], 'required', 'message' => '{attribute}必填'],
                [['loans_num', 'other', 'loads_date', 'sell_income_1', 'sell_income_2', 'sell_income_3', 'net_profit_1', 'net_profit_2', 'net_profit_3'], 'match', 'pattern' => '/^(0|[1-9]\d*)$/', 'message' => '{attribute}必须为正整数'],
                ['loads_date', 'compare', 'compareValue' => 1, 'operator' => '>=', 'message' => '{attribute}（1-24月）'],
                ['loads_date', 'compare', 'compareValue' => 24, 'operator' => '<=', 'message' => '{attribute}（1-24月）'],
                [['incur_debts'], 'number', 'message' => '{attribute}必须为数字'],
                ['user_mobile', 'match', 'pattern' => '/^[1][35678][0-9]{9}$/', 'message' => '{attribute}号码格式错误'],
                ['user_mail', 'email', 'message' => '{attribute}格式错误'],
                [['is_loads', 'company_address', 'company_business'], 'safe']
        ];
    }

    public function add($data)
    {
        if ($this->load($data) && $this->save())
        {
            return true;
        }
        return false;
    }

}
