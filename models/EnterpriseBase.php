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
            'bp_name' => '项目名称',
            'bp_instroduction' => '项目概述',
            'bp_project_content' => '项目简介',
            'bp_region_bid' => '省',
            'bp_region_mid' => '市',
            'bp_region_sid' => '县/区',
            'bp_industry_id' => '所属领域',
            'bp_big_img' => '项目图片',
            'bp_gain_model' => '商业模式',
            'bp_analysis' => '竞争优势',
            'bp_tactic_plan' => '主要竞争对手'
        ];
    }

    public function rules()
    {
        return [
                ['user_id', 'default', 'value' => Yii::$app->session['member']['userid'], 'on' => 's_1'],
                [['enterprise_name', 'company_region_bid', 'company_region_mid', 'company_region_sid', 'office_address', 'staff_num', 'register_capital', 'establish_time', 'contacts', 'duties', 'contact_number'], 'required', 'message' => '{attribute}必填', 'on' => 's_1'],
                [['staff_num', 'register_capital'], 'match', 'pattern' => '/^(0|[1-9]\d*)$/', 'message' => '{attribute}必须为正整数', 'on' => 's_1'],
                ['contact_number', 'match', 'pattern' => '/^[1][35678][0-9]{9}$/', 'message' => '{attribute}错误', 'on' => 's_1'],
                ['email', 'email', 'message' => '{attribute}格式错误', 'on' => 's_1'],
                ['company_website', 'url', 'defaultScheme' => 'http', 'message' => '正确填写{attribute}', 'on' => 's_1'],
                [['company_type', 'tax_registration', 'organization_code', 'wechat'], 'safe', 'on' => 's_1'],
                [['bp_name', 'bp_instroduction', 'bp_project_content', 'bp_region_bid', 'bp_region_mid', 'bp_region_sid', 'bp_industry_id', 'bp_big_img', 'bp_gain_model', 'bp_analysis'], 'required', 'message' => '{attribute}必填', 'on' => 's_2'],
                [['bp_tactic_plan'], 'safe', 'on' => 's_2'],
        ];
    }

    public function add($data, $scenario)
    {
        $this->scenario = $scenario;
        if ($this->load($data) && $this->save())
        {
            return true;
        }
        return false;
    }

}
