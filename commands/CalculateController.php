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
        $responce = new Prices();
        $resp = $responce->PriceList($this->month,$this->type,$this->tonnage);

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
        echo 'Результат: ' . $resp['price'] . PHP_EOL;
        echo PHP_EOL . '+----------+----+----+----+-----+'. PHP_EOL;
        echo '| М\Т      | 25 | 50 | 75 | 100 |';
        foreach($resp['price_list'] as $key => $value) {
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