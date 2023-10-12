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
            ['month', 'required', 'message' => 'Пожалуйста укажите месяц.' ],
            ['material', 'required', 'message' => 'Пожалуйста укажите сырье.' ],
            ['weight', 'required', 'message' => 'Пожалуйста укажите массу.' ]
        ];
    }
}