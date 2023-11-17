<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($messege)) {
            echo $messege;
    } ?>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
//                'fieldConfig' => [
//                    //'template' => "{label}\n{input}\n{error}",
//                    //'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
//                    //'inputOptions' => ['class' => 'col-lg-3 form-control'],
//                    //'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
//                ],
            ]); ?>

            <?= $form->field($model, 'username')->label('Введите свой email: ')->input('email') ?>

            <?= $form->field($model, 'password')->label('Введите пароль: ')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->label('Запомнить меня')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary','disabled' => 'disabled', 'id' => 'input']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <?php if (!empty($msg)) {
                echo $msg;

            } ?>
        </div>
    </div>
</div>
<?php
$script = <<< JS
$('#login-form').on('change keyup paste', function(){
  var isFormEmpty = $(this).find('input').filter(function(){
    return $.trim($(this).val()).length === 0
  }).length > 0;
 
  if(isFormEmpty){
    $('#input').prop('disabled', true);
  }else{
    $('#input').prop('disabled', false);
  }
});
JS;
$this->registerJs($script);
?>
