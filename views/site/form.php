<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Months;
use app\models\Raw_types;
use app\models\Tonnages;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Калькулятор стоимости доставки сырья</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
          <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>
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
      </div>
    </div>
</div>
<?php
$js = <<<JS
     $('form').on('beforeSubmit', function(){
	 var data = $(this).serialize();
	 $.ajax({
	    url: '/site/form',
	    type: 'POST',
	    data: data,
	    success: function(res){
	       console.log(res);
	    },
	    error: function(){
	       alert('Error!');
	    }
	 });
	 return false;
     });
JS;

$this->registerJs($js);
?>
