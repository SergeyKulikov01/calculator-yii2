<?php

namespace app\models;

use yii\db\ActiveRecord;

class Months extends ActiveRecord
{
    public function MonthsList(){
        $otv = Months::find()
            ->select(['name','id'])
            ->orderBy('id')->all();
        foreach ($otv as $key => $value){
            $resp[$value["id"]] =  $value["name"];
        }
        return $resp;
    }
    public function AddMonths($month){
        $req = new Months();
        $req->name = $month;
        $req->save();
        return 'Успешно добавлено';
    }
    public function DeleteMonths($month){
        $req = Months::find()
            ->where(['name' => $month])
            ->one();
        $req->delete();
        return 'Успешно удалено';
    }
    public static function tableName(): string
    {
        return '{{%months}}';
    }
}