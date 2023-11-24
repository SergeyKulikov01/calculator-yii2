<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
        <a href="/user/index"  class="btn btn-outline-success card-link">Назад</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'id',
                'attribute' => 'id',
            ],
            [
                'label' => 'Имя',
                'attribute' => 'name',
            ],
            [
                'label' => 'E-mail',
                'attribute' => 'username',
            ],
            [
                'label' => 'Роль',
                'attribute' => 'role',
            ],
        ],
    ]) ?>

</div>
