<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Months;
use app\models\Raw_types;
use app\models\Tonnages;
use yii\widgets\Pjax;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Калькулятор стоимости доставки сырья</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
            <?php Pjax::begin() ?>
          <?php $form = ActiveForm::begin(['options' => ['data' => ['pjax' => true]]]); ?>
            <?= $form->field($model, 'month')->label('Выберите месяц: ')->dropDownList(
                Months::find()->select(['name', 'id'])->IndexBy('id')->OrderBy('id')->column(),
                ['prompt' => 'Выберите один вариант']); ?>
            <?= $form->field($model, 'material')->label('Выберите сырье: ')->dropDownList(
                Raw_types::find()->select(['name', 'id'])->IndexBy('id')->OrderBy('id')->column(),
                ['prompt' => 'Выберите один вариант']); ?>
            <?= $form->field($model, 'weight')->label('Выберите массу: ')->dropDownList(
                Tonnages::find()->select(['value', 'id'])->IndexBy('id')->OrderBy('id')->column(),
                ['prompt' => 'Выберите один вариант']); ?>
              
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
        </div>
          <?php if (!empty($calculation)) {
              echo number_format($calculation) . "₽";
              echo '<br>';
              echo PHP_EOL . '+----------+----+----+----+-----+'. PHP_EOL;
              echo '<br>';
              echo '| М\Т      | 25 | 50 | 75 | 100 |';
              echo '<br>';
              foreach($priceList as $key => $value) {
                  echo PHP_EOL . "+----------+----+----+----+-----+". PHP_EOL;
                  echo '<br>';
                  echo "| $key |";
                  foreach($value as $price) {
                      foreach($price as $aa) {
                          echo " $aa |";
                      }
                  }
              }
              echo '<br>';
              echo PHP_EOL . "+----------+----+----+----+-----+". PHP_EOL;
              var_dump($priceList) ;
          } ?>
      </div>
    </div>
</div>
<?php Pjax::end() ?>