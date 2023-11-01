<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tonnages extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%tonnages}}';
    }
}