<?php

/** @var yii\web\View $this */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Months;
use app\models\Raw_types;
use app\models\Tonnages;
use yii\widgets\Pjax;

$this->title = 'Калькулятор';
?>
<div class="site-about">
    <h1>Калькулятор стоимости доставки сырья</h1>
    <?php if (!Yii::$app->user->isGuest) {
 ?>
    <div class="alert alert-success" role="alert" id="popup">
        <p>Здравствуйте, <?php echo Yii::$app->user->identity->name ?> , вы авторизовались в системе расчета стоимости доставки.
            Теперь все ваши расчеты будут сохранены для последующего просмотра в <a href="/history/index" class="alert-link">журнале расчетов</a></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="close-btn"></button>
    </div>
    <?php } ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5 ">
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
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-outline-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
        </div>

              <?php if (!empty($calculation)) {
                  echo '<div class="card mb-3 calc-result" >';
                  echo '<div class="card-header">';
                  echo '<h2> Результат: ';
                  echo number_format($calculation) . "₽";
                  echo '</h2>';
                  echo '</div>';
                  echo '<div class="card-body">';


                  foreach ($priceList as $id => $month){
                      foreach ($month as $monthname => $price){
                          $price['month'] = $monthname;
                          $array[] = $price;
                      }
                  }

                  echo GridView::widget([
                      'dataProvider' => new ArrayDataProvider([
                          'allModels' => $array,
                          'pagination' => false,
                      ]),
                      'summary' => false,
                      'tableOptions' => [
                          'class' => 'table table-striped table-bordered table-hover'
                      ],
                      'columns' => [
                          [
                              'attribute' => 'month',
                              'label' => 'Месяц',
                          ],
                          //'Месяц' => $key,
                          '25',
                          '50',
                          '75',
                          '100',
                      ],
                  ]);


              } ?>
          </div>
    </div>

      </div>
    </div>
</div>
<?php Pjax::end() ?>
<?php
$script = <<< JS

    if (document.cookie.match(/hidden=(.+?)(;|$)/)){
        document.getElementById("popup").hidden=true
    }
    $('#close-btn').on('click', function() {
         document.cookie = "hidden=true; max-age=100";
    });

JS;
$this->registerJs($script);
?>
