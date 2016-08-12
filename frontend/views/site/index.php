<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Vacation';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Vacation!</h2>

        <p class="lead">Бизнес - процесс выход на отпуск.</p>

        <p><a class="btn btn-lg btn-success" <?= Html::a('Заявка на отпуск', ['vacation/create']) ?></a></p>
    </div>

    <div class="body-content">


    </div>
</div>
