<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class IncubatorBase extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%incubator_base}}";
    }

    public function attributeLabels()
    {
        return [
            'incubator_name' => '品牌名称',
            'facilitating_agency_name' => '机构全称',
            'incubator_type' => '载体资质',
            'incubator_vector' => '载体类型',
            'facility_ops' => '基础设施',
            'service_ops' => '特色服务',
            'incubator_address' => '详细地址',
            'incubator_contact' => '联系人姓名',
            'incubator_contact_phone' => '联系人手机号',
            'incubator_tell' => '联系固话',
            'contact_user_position' => '联系人职位',
            'enterprise_count' => '注册企业数',
            'incubator_property' => '载体性质',
            'incubator_logo' => '园区log',
            'incubator_created' => '成立时间',
            'incubator_intro' => '孵化简介',
            'incubator_condition' => '入驻规则'
        ];
    }

    public function rules()
    {
        return [
                [['incubator_name', 'facilitating_agency_name', 'incubator_type', 'incubator_vector', 'facility_ops', 'service_ops', 'incubator_address', 'incubator_contact', 'incubator_contact_phone', 'incubator_tell', 'contact_user_position', 'enterprise_count', 'incubator_property', 'incubator_logo', 'incubator_created', 'incubator_intro', 'incubator_condition'], 'required', 'message' => '{attribute}必填'],
                ['incubator_contact_phone', 'match', 'pattern' => '/^[1][35678][0-9]{9}$/', 'message' => '{attribute}格式错误'],
                ['enterprise_count', 'number', 'message' => '{attribute}必须为数字'],
                ['create_time', 'default', 'value' => time()],
                ['incubator_recommend_index', 'safe']
        ];
    }

    public function add($data)
    {
        $data['IncubatorBase']['facility_ops'] = implode(',', $data['IncubatorBase']['facility_ops']);
        $data['IncubatorBase']['service_ops'] = implode(',', $data['IncubatorBase']['service_ops']);
        if ($this->load($data) && $this->save())
        {
            return true;
        }
        return false;
    }

    public static function getData($where = [])
    {
        $result = self::find()->where($where)->all();
        return $result;
    }

    public function getOffice()
    {
        return $this->hasMany(IncubatorOffice::className(), ['incubator_id' => 'incubator_id']);
    }

}
