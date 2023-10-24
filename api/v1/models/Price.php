<?php

namespace api\v1\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Price extends Model
{
    public $price;
    public $price_list;

    public function response($material, $month, $weight)
    {
        $arrays = Yii::$app->params['arrays'];
        $array = ArrayHelper::getValue($arrays, $material);
        $price = $array[$month][$weight];
        $this->price_list = $array;
        $this->price = $price;
    }

}