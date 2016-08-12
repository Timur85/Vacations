<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VacationStatus */

$this->title = 'Create Vacation Status';
$this->params['breadcrumbs'][] = ['label' => 'Vacation Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
