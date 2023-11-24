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

    <?php if (Yii::$app->request->get('status')) {
        ?>
        <div class="alert alert-success" role="alert" id="popup">
            <p>Вы успешно зарегистрировались. Теперь вы можете авторизоваться.</p>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
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
