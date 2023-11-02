<?php

namespace app\models;

use yii\db\ActiveRecord;

class Months extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%months}}';
    }
}