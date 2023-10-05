<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Форма калькулятора</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
        <form>
  <div class="mb-3">
  <select class="form-select" aria-label="Выберите месяц">
  <option selected>Выберите месяц</option>
  <option value="jan">Январь</option>
  <option value="feb">Февраль</option>
  <option value="aug">Август</option>
  <option value="sep">Сентябрь</option>
  <option value="oct">Октябрь</option>
  <option value="nov">Ноябрь</option>
</select>
  </div>
  <div class="mb-3">
  <select class="form-select" aria-label="Выберите сырье">
  <option selected>Выберите сырье</option>
  <option value="shrot">Шрот</option>
  <option value="zhmih">Жмых</option>
  <option value="soya">Соя</option>
</select>
  </div>
  <div class="mb-3">
  <select class="form-select" aria-label="Выберите тоннаж">
  <option selected>Выберите тоннаж</option>
  <option value="25">25</option>
  <option value="50">50</option>
  <option value="75">75</option>
  <option value="100">100</option>
</select>
  </div>
  <button type="submit" class="btn btn-primary">Рассчитать</button>
</form>
        </div>
      </div>
    </div>
    

</div>
