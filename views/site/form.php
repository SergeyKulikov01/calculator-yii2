<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Калькулятор стоимости доставки сырья</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
          <?php $form = ActiveForm::begin(); ?>
              <?= $form->field($model, 'month')->label('Выберите месяц: ')->dropDownList([
                    'Январь' => 'Январь',
                    'Февраль' => 'Февраль',
                    'Август' => 'Август',
                    'Сентябрь' => 'Сентябрь',
                    'Октябрь' => 'Октябрь',
                    'Ноябрь' => 'Ноябрь'
                  ],
                  ['prompt' => 'Выберите один вариант']); ?>
              <?= $form->field($model, 'material')->label('Выберите сырье: ')->dropDownList([
                    'Шрот' => 'Шрот',
                    'Жмых' => 'Жмых',
                    'Соя' => 'Соя'
                  ],
                  ['prompt' => 'Выберите один вариант']); ?>
              <?= $form->field($model, 'weight')->label('Выберите массу: ')->dropDownList([
                    '25' => '25',
                    '50' => '50',
                    '75' => '75',
                    '100' => '100'
                  ],
                  ['prompt' => 'Выберите один вариант']); ?>
              
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
    

</div>
