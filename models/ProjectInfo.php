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
            'loans_num' => '融资金额'
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
