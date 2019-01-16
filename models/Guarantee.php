<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Guarantee extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%guarantee}}";
    }

    public static function getList($where = [])
    {
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

}
