<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Industry extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%industry}}";
    }

    public static function getList($where = [])
    {
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

}
