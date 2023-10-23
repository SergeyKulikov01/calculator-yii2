<?php

namespace api\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;


class CalculatePriceController extends Controller
{


    public function actionIndex(){
        $request = Yii::$app->request;
        $material = $request->get('material');
        $weight = $request->get('weight');
        $month = $request->get('month');
        if (empty($material)){
            return 'Ошибка! Сырье не введено';
            die();
        }
        if (empty($weight)){
            return 'Ошибка! Вес не введен';
            die();
        }
        if (empty($month)){
            return 'Ошибка! Месяц не введен';
            die();
        }
        $arrays = Yii::$app->params['arrays'];
        $array = ArrayHelper::getValue($arrays, $material);
        $calculation = $array[$month][$weight];
        return array($calculation,$array);
    }
}