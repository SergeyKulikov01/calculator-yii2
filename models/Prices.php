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
            $tt[$type] = $mo;
        }
        $otv= ['price' => $calc->price,'price_list' => $tt];
        return $otv;
    }
    public function UpdatePrice($arr){
        $price = Prices::find()
            ->joinWith(['months','tonnages','raw_types'])
            ->where(['raw_types.name' => $arr['raw_type'],'months.name'=>$arr['month'],'tonnages.value'=>$arr['tonnage']])
            ->One();
        $price->price = $arr['value'];
        $price->save();
        return 'Успешно обновлено ' . $price->id;
    }
    public function AddPrice($arr){
        $id_month = Months::find()
            ->where(['name' => $arr['month']])
            ->one();
        $id_type = Raw_types::find()
            ->where(['name' => $arr['raw_type']])
            ->one();
        $id_tonnage = Tonnages::find()
            ->where(['value' => $arr['tonnage']])
            ->one();
        $req = new Prices();
        $req->price = $arr['value'];
        $req->month_id = $id_month->id;
        $req->raw_type_id = $id_type->id;
        $req->tonnage_id = $id_tonnage->id;
        $req->save();
        return 'Успешно добавлено';
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