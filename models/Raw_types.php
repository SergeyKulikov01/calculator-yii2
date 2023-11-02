<?php

namespace app\models;

use yii\db\ActiveRecord;

class Raw_types extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%raw_types}}';
    }
}