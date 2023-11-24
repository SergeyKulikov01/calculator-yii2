<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class History extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%history}}';
    }
    public function historyAdd($user_id,$tonnage,$type,$price,$month,$full_pricelist){
        $newHistory = new History();
        $newHistory->user_id = $user_id;
        $newHistory->username = Yii::$app->user->identity->username;
        $newHistory->tonnage = $tonnage;
        $newHistory->type = $type;
        $newHistory->price = $price;
        $newHistory->month = $month;
        $newHistory->full_pricelist = $full_pricelist;
        $newHistory->save();

    }
}