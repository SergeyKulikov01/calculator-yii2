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
        $responce = new Prices();
        return $responce->PriceList($month,$material,$weight);

    }
}