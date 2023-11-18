<?php

/** @var yii\web\View $this */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Пользователи';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div>
                    <?php
                            echo GridView::widget([
                                'dataProvider' => new ArrayDataProvider([
                                    'allModels' => $allUsers,
                                ]),
                                //'filterModel' => $searchModel,
                                'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'id',
                                    'name',
                                    'username',
                                    'role',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Действия',
                                        'headerOptions' => ['width' => '80'],
                                        'template' => '{update} {delete}{link}',
                                    ],
                                ],
                            ]);
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>
