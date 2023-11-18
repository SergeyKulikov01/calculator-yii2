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

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Калькулятор стоимости доставки сырья</h1>
    <?php if (!Yii::$app->user->isGuest) {
 ?>
    <div class="alert alert-success" role="alert" id="popup">
        <p>Здравствуйте,<?php echo Yii::$app->user->identity->name ?>, вы авторизовались в системе расчета стоимости доставки.
            Теперь все ваши расчеты будут сохранены для последующего просмотра в <a href="calculation/history" class="alert-link">журнале расчетов</a></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="hideBlock()"></button>
    </div>
    <?php } ?>
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

                foreach ($priceList as $key => $value) {
                    echo GridView::widget([
                        'dataProvider' => new ArrayDataProvider([
                            'allModels' => $value,
                            'pagination' => false,
                        ]),
                        'columns' => [
                                [
                                    //'attribute' => $value,
                                    'label' => 'Месяц',
                                ],
                            //'Месяц' => $key,
                            '25',
                            '50',
                            '75',
                            '100',
                        ],
                    ]);
                }

          } ?>
      </div>
    </div>
</div>
<?php Pjax::end() ?>
<?php
$script = <<< JS
var block = document.getElementById("#popup");

// Проверяем, был ли блок скрыт ранее
if (localStorage.getItem("blockHidden") === "true") {
  block.style.display = "none"; // Скрываем блок
}

// Функция для скрытия блока и сохранения состояния
function hideBlock() {
  block.style.display = "none"; // Скрываем блок
  localStorage.setItem("blockHidden", "true"); // Сохраняем состояние
}
JS;
$this->registerJs($script);
?>
