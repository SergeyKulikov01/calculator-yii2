<?php

namespace app\models;

use yii\db\ActiveRecord;

class Prices extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%prices}}';
    }
    public function getTonnages()
    {
        return $this->hasMany(Tonnages::class, ['id' => 'tonnage_id']);
    }
    public function getMonths()
    {
        return $this->hasMany(Months::class, ['id' => 'month_id']);
    }
    public function getRaw_types()
    {
        return $this->hasMany(Raw_types::class, ['id' => 'raw_type_id']);
    }
}