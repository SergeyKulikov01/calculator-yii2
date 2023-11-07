<?php

namespace api\v1\controllers;

use app\models\Raw_types;
use Yii;
use yii\rest\Controller;

class TypesController extends Controller
{
    public function actionIndex()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $responce = new Raw_types();
            return $responce->TypesList();
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = Yii::$app->request;
            $name = $request->post();
            $responce = new Raw_types();
            return $responce->AddType($name["raw_type"]);
        } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $request = Yii::$app->request;
            $type = $request->getBodyParam('raw_type');
            $responce = new Raw_types();
            return $responce->DeleteType($type);
        }

    }
}