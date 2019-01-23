<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class StockEnterpriseIndustry extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%stock_enterprise_industry}}";
    }

    public static function getList($where = [])
    {
        $list = self::find()->where($where)->asArray()->all();
        return $list;
    }

}
