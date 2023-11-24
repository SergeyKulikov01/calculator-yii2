<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->label('Id: ')->textInput() ?>

    <?= $form->field($model, 'name')->label('Имя: ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->label('E-mail: ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->label('Выберите роль: ')->dropdownList([
        'administrator' => 'Администратор',
        'user' => 'Пользователь'],
        ['prompt'=>'Выберите роль']
    ); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
