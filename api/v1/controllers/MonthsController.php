<?php

namespace api\v1\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Months;

class MonthsController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $responce = new Months();
            return $responce->MonthsList();
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = Yii::$app->request;
            $name = $request->post();
            $responce = new Months();
            return $responce->AddMonths($name["month"]);
        } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $request = Yii::$app->request;
            $month = $request->getBodyParam('month');
            $responce = new Months();
            return $responce->DeleteMonths($month);
        }

    }
}