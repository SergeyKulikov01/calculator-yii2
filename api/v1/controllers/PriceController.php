<?php

namespace api\v1\controllers;

use app\models\Prices;
use Yii;
use yii\rest\Controller;

class PriceController extends Controller
{
    public function actionIndex()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $request = Yii::$app->request;
            $arr = $request->bodyParams;
            $responce = new Prices();
            return $responce->UpdatePrice($arr);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $request = Yii::$app->request;
            $type = $request->post();
            $responce = new Prices();
            return $responce->AddPrice($type);
        }

    }
}