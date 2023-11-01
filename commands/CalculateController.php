<?php

namespace app\commands;

use app\models\Prices;
use yii\console\Controller;
use yii\console\ExitCode;

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
        $resp = Prices::find()
            ->JoinWith(['months','tonnages','raw_types'])
            ->select(['month' => 'months.name','tonnage' => 'tonnages.value','price'])
            ->where(['raw_types.name' => $this->type])
            ->asArray()
            ->all();
        foreach ($resp as $key => $value){
            $pr[$value["tonnage"]] =  $value["price"];
            $mo[$value["month"]] = $pr;
        }
        $calculation = Prices::find()
            ->joinWith(['months','tonnages','raw_types'])
            ->where(['raw_types.name' => $this->type,'months.name'=>$this->month,'tonnages.value'=>$this->tonnage])
            ->One();

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
        if (!isset($this->tonnage)) {
            echo "Возникла проблема!\n";
            echo "не найден прайс для значения --tonnage=$this->tonnage\n";
        return ExitCode::OK;
        }

        echo 'Введенные параметры:';
        echo 'Месяц:' . $this->month . PHP_EOL;
        echo 'Тип:' .$this->type . PHP_EOL;
        echo 'Тоннаж:' .$this->tonnage . PHP_EOL;
        echo 'Результат: ' . $calculation->price . PHP_EOL;
        echo PHP_EOL . '+----------+----+----+----+-----+'. PHP_EOL;
        echo '| М\Т      | 25 | 50 | 75 | 100 |';
        foreach($mo as $key => $value) {
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