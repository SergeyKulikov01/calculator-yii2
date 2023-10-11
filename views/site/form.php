<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Форма калькулятора</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
          <?php $form = ActiveForm::begin(); ?>
              <?= $form->field($model, 'month')->label('Выберите месяц: ')
                ->dropDownList([
                    'jan' => 'Январь',
                    'feb' => 'Февраль',
                    'aug' => 'Август',
                    'sep' => 'Сентябрь',
                    'oct' => 'Октябрь',
                    'nov' => 'Ноябрь'
                  ],
                  [
                      'prompt' => 'Выберите один вариант'
                  ]); ?>

              <?= $form->field($model, 'material')->label('Выберите сырье: ')
                ->dropDownList([
                    'shrot' => 'Шрот',
                    'zhmih' => 'Жмых',
                    'soya' => 'Соя'
                  ],
                  [
                      'prompt' => 'Выберите один вариант'
                  ]); ?>

              <?= $form->field($model, 'weight')->label('Выберите массу: ')
                ->dropDownList([
                    '25' => '25',
                    '50' => '50',
                    '75' => '75',
                    '100' => '100'
                  ],
                  [
                      'prompt' => 'Выберите один вариант'
                  ]); ?>
              

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
    

</div>
