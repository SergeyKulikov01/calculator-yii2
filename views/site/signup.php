<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\User $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните данные для регистрации:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
            <?= $form->field($model, 'name')->input('text')->label('Введите имя:') ?>
            <?= $form->field($model, 'username',['enableAjaxValidation' => true])->label('Введите свой email: ')->input('email') ?>
            <?= $form->field($model, 'password')->label('Введите пароль: ')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->label('Повторите пароль: ')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary','disabled' => 'disabled', 'id' => 'input']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$script = <<< JS
$('#signup-form').on('change keyup paste', function(){
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



