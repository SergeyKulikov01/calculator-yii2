<?php

namespace app\models;

use yii\db\ActiveRecord;

class Raw_types extends ActiveRecord
{
    public function TypesList(){
        $otv = Raw_types::find()
            ->select(['name','id'])
            ->orderBy('id')->all();
        foreach ($otv as $key => $value){
            $resp[$value["id"]] =  $value["name"];
        }
        return $resp;
    }
    public function AddType($type){
        $req = new Raw_types();
        $req->name = $type;
        $req->save();
        return 'Успешно добавлено';
    }
    public function DeleteType($type){
        $req = Raw_types::find()
            ->where(['name' => $type])
            ->one();
        $req->delete();
        return 'Успешно удалено';
    }
    public static function tableName(): string
    {
        return '{{%raw_types}}';
    }
}