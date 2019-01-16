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
            'enterprise_name' => '企业名称'
        ];
    }

    public function rules()
    {
        return [
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
