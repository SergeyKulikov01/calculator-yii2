<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Профиль';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div>
                        <h2>Имя: <?= $user->name ?></h2>
                    <div>
                        <p ><strong>Почта:</strong> <?= $user->username ?></p>
                        <p ><strong>Роль:</strong> <?= $userRole[0]->description  ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>