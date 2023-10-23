<?php

namespace api\v1\controllers;

use Yii;
use yii\rest\Controller;
use api\v1\models\Price;

class CalculatePriceController extends Controller
{
    public function actionIndex()
    {
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
        $resp = new Price();
        $resp->response($material, $month, $weight);
        return $resp;
    }
}