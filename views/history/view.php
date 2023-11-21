<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Подробная информация по рассчету';
$this->params['breadcrumbs'][] = ['label' => 'История расчетов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Уверены что хотите удалить данный расчет?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        echo DetailView::widget([
            'model' => $info,
            'attributes' => [
                [
                    'label' => 'Id рассчета',
                    'value' => $info->id,
                ],
                [
                    'label' => 'Месяц',
                    'value' => $info->month,
                ],
                [
                    'label' => 'Тоннаж',
                    'value' => $info->tonnage,
                ],
                [
                    'label' => 'Стоимость',
                    'value' => $info->price,
                ],
                [
                    'label' => 'Создано',
                    'value' => $info->created_at,
                    'format'=>'datetime'
                ],
        ],
    ]);

        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $model,
                'pagination' => false,
            ]),
            'summary' => false,
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-hover'
            ],
            'columns' => [
                [
                    'attribute' => 'month',
                    'label' => 'Месяц',
                ],
                '25',
                '50',
                '75',
                '100',
            ],
        ]);

    ?>

</div>
