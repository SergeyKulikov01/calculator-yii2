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
        $request = Yii::$app->request;
        if ($request->isGet) {
            $responce = new Months();
            return $responce->MonthsList();
        }else if ($request->isPost) {
            $name = $request->post();
            $responce = new Months();
            return $responce->AddMonths($name["month"]);
        } else if ($request->isDelete){
            $month = $request->get('month');
            $responce = new Months();
            return $responce->DeleteMonths($month);
        }

    }
}