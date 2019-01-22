<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class FinancingHistory extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%financing_history}}";
    }

}
