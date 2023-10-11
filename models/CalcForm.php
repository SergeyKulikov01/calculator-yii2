<?php

namespace app\models;

use yii\base\Model;

class CalcForm extends Model
{
    public $month;
    public $material;
    public $weight;

    public function rules()
    {
        return [
            [['month', 'material','weight'], 'required'],
        ];
    }
}