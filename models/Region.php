<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Region extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%region}}";
    }

    public static function getList($where = [])
    {
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

}
