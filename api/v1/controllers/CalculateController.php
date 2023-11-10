<?php

namespace api\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Prices;

class CalculateController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $type = $request->get('type');
        $tonnage = $request->get('tonnage');
        $month = $request->get('month');
        if (empty($type)) {
            return 'Ошибка! Сырье не введено';
        }
        if (empty($tonnage)) {
            return 'Ошибка! Вес не введен';
        }
        if (empty($month)) {
            return 'Ошибка! Месяц не введен';
        }
        $responce = new Prices();
        return $responce->PriceList($month,$type,$tonnage);

    }
}