<?php

/** @var yii\web\View $this */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'История расчетов';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <?php Pjax::begin(); ?>
                <?php
                $admin = Yii::$app->user->can('isAdmin');
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Id расчета',
                            'attribute' => 'id',
                        ],
                        [
                            'label' => 'Id пользователя',
                            'attribute' => 'user_id',
                            'visible' => $admin
                        ],
                        [
                            'label' => 'Имя пользователя',
                            'attribute' => 'username',
                            'visible' => $admin
                        ],
                        [
                            'label' => 'Тоннаж',
                            'attribute' => 'tonnage',
                        ],
                        [
                            'label' => 'Месяц',
                            'attribute' => 'month',
                        ],
                        [
                            'label' => 'Тип сырья',
                            'attribute' => 'type',
                        ],
                        [
                            'label' => 'Цена',
                            'attribute' => 'price',
                        ],
                        [
                            'label' => 'Создано',
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Действия',
                            'headerOptions' => ['width' => '80'],
                            'template' => '{view} {delete}',
                            'visibleButtons' => ['delete' => $admin]
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>

