<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Результат расчета стоимости доставки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
            <?php 
                echo 'Стоимость доставки для выбранных Вами параметров равна: '. $calculation;
                echo '<br>';
                echo '<br>';
                echo '<table class="table" >';
                echo "<tr>";
                echo '<td>  </td>';
                echo '<td>25</td>';
                echo '<td>50</td>';
                echo '<td>75</td>';
                echo '<td>100</td>';
                echo "</tr>";
                foreach($array as $key => $value) {
                    echo "<tr>";
                    echo "<td> $key </td>";
                    foreach($value as $price) {
                        echo "<td> $price </td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>
      </div>
    </div>
</div>
