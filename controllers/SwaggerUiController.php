<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class SwaggerUiController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}