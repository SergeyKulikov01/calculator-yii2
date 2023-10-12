<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\ArrayHelper;

class CalculateController extends Controller
{
    public $month;
    public $type;
    public $tonnage;
    
    public function options($actionID)
    {
        return ['month', 'type', 'tonnage'];
    }
    
    public function actionIndex()
    {
        $arrays = \Yii::$app->params['arrays'];
        $array = ArrayHelper::getValue($arrays, $this->type);
        if (!isset($this->month)) {
            echo "Возникла проблема!\n";
            echo "Введите месяц!\n";
        return ExitCode::OK;
        }
        if (!isset($this->type)) {
            echo "Возникла проблема!\n";
            echo "Введите тип!\n";
        return ExitCode::OK;
        }
        if (!isset($this->tonnage) || !isset($array[$this->month][$this->tonnage])) {
            echo "Возникла проблема!\n";
            echo "не найден прайс для значения --tonnage=$this->tonnage\n";
        return ExitCode::OK;
        }

        echo 'Введенные параметры:';
        echo 'Месяц:' . $this->month . PHP_EOL;
        echo 'Тип:' .$this->type . PHP_EOL;
        echo 'Тоннаж:' .$this->tonnage . PHP_EOL;
        echo 'Результат: ' . $array[$this->month][$this->tonnage]. PHP_EOL;
        echo PHP_EOL . '+----------+----+----+----+-----+'. PHP_EOL;
        echo '| М\Т      | 25 | 50 | 75 | 100 |';
        foreach($array as $key => $value) {
            echo PHP_EOL . "+----------+----+----+----+-----+". PHP_EOL;
            echo "| $key |";
          foreach($value as $price) {
          echo " $price |";
            }
          }
          echo PHP_EOL . "+----------+----+----+----+-----+". PHP_EOL;
        return ExitCode::OK;
    }
}