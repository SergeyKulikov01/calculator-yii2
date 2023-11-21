<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Modal;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Пользователи';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div>

                    <?php
                    Modal::begin(['id' =>'modal']);
                    Modal::end();
                    ?>

                    <?php
                    Pjax::begin([]);
                            echo GridView::widget([
                                'dataProvider' => new ArrayDataProvider([
                                    'allModels' => $allUsers,
                                ]),
                                //'filterModel' => $searchModel,
                                'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'label' => 'Id пользователя',
                                        'attribute' => 'id',
                                        'format' => 'raw',
                                    ],
                                    'name',
                                    'username',
                                    'role',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Действия',
                                        'headerOptions' => ['width' => '80'],
                                        'template' => '{update} {delete}',
                                        'buttons' => [
                                            'delete' => function ($url, $allUsers) {
                                                return Html::a('Удалить', $url, [
                                                    'title' => Yii::t('yii', 'Delete'),
                                                    'data-confirm' => Yii::t('yii', 'Вы уверены?'),
                                                    'data-method' => 'post',
                                                    'data-pjax' => '1',
                                                ]);
                                            },
                                        ],
                                    ],
                                ],
                            ]);
                            Pjax::end();
                     ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'title'=>'<h5>едактирование</h5>',
    'id'=>'update-modal',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>


<?php
$this->registerJs("$(function() {
   $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
?>



