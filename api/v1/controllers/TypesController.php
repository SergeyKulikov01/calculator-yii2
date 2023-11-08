<?php

namespace api\v1\controllers;

use app\models\Raw_types;
use Yii;
use yii\rest\Controller;

class TypesController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isGet) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $responce = new Raw_types();
            return $responce->TypesList();
        }else if ($request->isPost) {
            $name = $request->post();
            $responce = new Raw_types();
            return $responce->AddType($name["raw_type"]);
        } else if ($request->isDelete){
            $type = $request->get('type');
            $responce = new Raw_types();
            return $responce->DeleteType($type);
        }

    }
}