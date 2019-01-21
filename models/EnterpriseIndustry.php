<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class EnterpriseIndustry extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%enterprise_industry}}";
    }

    public static function getList($where = [])
    {
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

}
