<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class EnterpriseBase extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%enterprise_base}}";
    }

    public function attributeLabels()
    {
        return [
            'enterprise_name' => '企业名称',
            'company_region_bid' => '省',
            'company_region_mid' => '市',
            'company_region_sid' => '县/区',
            'office_address' => '办公地址',
            'staff_num' => '公司人数',
            'register_capital' => '注册资本',
            'establish_time' => '成立时间',
            'company_type' => '企业性质',
            'tax_registration' => '工商注册号',
            'organization_code' => '企业统一社会信用代码',
            'contacts' => '真实姓名',
            'duties' => '职位名称',
            'contact_number' => '联系手机',
            'email' => '邮箱',
            'wechat' => '微信',
            'company_website' => '网址',
        ];
    }

    public function rules()
    {
        return [
                [['enterprise_name', 'company_region_bid', 'company_region_mid', 'company_region_sid', 'office_address', 'staff_num', 'register_capital', 'establish_time', 'contacts', 'duties', 'contact_number'], 'required', 'message' => '{attribute}必填'],
                [['staff_num', 'register_capital'], 'match', 'pattern' => '/^(0|[1-9]\d*)$/', 'message' => '{attribute}必须为正整数'],
                ['contact_number', 'match', 'pattern' => '/^[1][35678][0-9]{9}$/', 'message' => '{attribute}错误'],
                ['email', 'email', 'message' => '{attribute}格式错误'],
                ['company_website', 'url', 'defaultScheme' => 'http', 'message' => '正确填写{attribute}'],
                [['company_type', 'tax_registration', 'organization_code', 'wechat'], 'safe']
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
