<?php

namespace api\v1\controllers;

use app\models\Tonnages;
use Yii;
use yii\rest\Controller;

class TonnagesController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $responce = new Tonnages();
            return $responce->TonnagesList();
        }else if ($request->isPost) {
            $tonnage = $request->post();
            $responce = new Tonnages();
            return $responce->AddTonnage($tonnage["tonnage"]);
        } else if ($request->isDelete){
            $tonnage = $request->get('tonnage');
            $responce = new Tonnages();
            return $responce->DeleteTonnage($tonnage);
        }

    }
}