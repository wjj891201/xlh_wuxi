<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class IncubatorOffice extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%incubator_office}}";
    }

}
