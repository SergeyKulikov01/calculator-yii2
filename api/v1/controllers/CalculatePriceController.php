<?php

namespace api\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Prices;

class CalculatePriceController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $material = $request->get('material');
        $weight = $request->get('weight');
        $month = $request->get('month');
        if (empty($material)) {
            return 'Ошибка! Сырье не введено';
        }
        if (empty($weight)) {
            return 'Ошибка! Вес не введен';
        }
        if (empty($month)) {
            return 'Ошибка! Месяц не введен';
        }

        $calc = Prices::find()
            ->joinWith(['months','tonnages','raw_types'])
            ->where(['raw_types.name' => $material,'months.name'=>$month,'tonnages.value'=>$weight])
            ->One();
        $resp = Prices::find()
            ->JoinWith(['months','tonnages','raw_types'])
            ->select(['month' => 'months.name','tonnage' => 'tonnages.value','price'])
            ->where(['raw_types.name' => $material])
            ->asArray()
            ->all();
        foreach ($resp as $key => $value){
            $pr[$value["tonnage"]] =  $value["price"];
            $mo[$value["month"]] = $pr;
    }

        $otv= ['price' => $calc->price,'price_list' => $mo];
        return $otv;

    }
}