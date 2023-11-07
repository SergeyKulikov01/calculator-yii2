<?php

namespace api\v1\controllers;

use app\models\Tonnages;
use Yii;
use yii\rest\Controller;

class TonnagesController extends Controller
{
    public function actionIndex()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $responce = new Tonnages();
            return $responce->TonnagesList();
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = Yii::$app->request;
            $tonnage = $request->post();
            $responce = new Tonnages();
            return $responce->AddTonnage($tonnage["tonnage"]);
        } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $request = Yii::$app->request;
            $tonnage = $request->getBodyParam('tonnage');
            $responce = new Tonnages();
            return $responce->DeleteTonnage($tonnage);
        }

    }
}