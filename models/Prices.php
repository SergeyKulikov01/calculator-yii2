<?php

namespace app\models;

use yii\db\ActiveRecord;

class Prices extends ActiveRecord
{
    public function PriceList($month,$type,$tonnage ){
        $calc = Prices::find()
            ->joinWith(['months','tonnages','raw_types'])
            ->where(['raw_types.name' => $type,'months.name'=>$month,'tonnages.value'=>$tonnage])
            ->One();
        $resp = Prices::find()
            ->JoinWith(['months','tonnages','raw_types'])
            ->select(['month' => 'months.name','tonnage' => 'tonnages.value','price'])
            ->where(['raw_types.name' => $type])
            ->asArray()
            ->all();
        foreach ($resp as $key => $value){
            $pr[$value["tonnage"]] =  $value["price"];
            $mo[$value["month"]] = $pr;
        }
        $otv= ['price' => $calc->price,'price_list' => $mo];
        return $otv;
    }
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