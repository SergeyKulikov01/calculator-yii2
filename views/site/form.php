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