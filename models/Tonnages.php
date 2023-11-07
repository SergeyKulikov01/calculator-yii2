<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tonnages extends ActiveRecord
{
    public function TonnagesList(){
        $otv = Tonnages::find()
            ->select(['value','id'])
            ->orderBy('id')->all();
        foreach ($otv as $key => $value){
            $resp[$value["id"]] =  $value["value"];
        }
        return $resp;
    }

    public function AddTonnage($tonnage){
        $req = new Tonnages();
        $req->value = $tonnage;
        $req->save();
        return 'Успешно добавлено';
    }
    public function DeleteTonnage($tonnage){
        $req = Tonnages::find()
            ->where(['value' => $tonnage])
            ->one();
        $req->delete();
        return 'Успешно удалено';
    }
    public static function tableName(): string
    {
        return '{{%tonnages}}';
    }
}