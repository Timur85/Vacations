<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacation */

$this->title = 'Update Vacation: ' . ' ' . $model->vacation_id;
$this->params['breadcrumbs'][] = ['label' => 'Vacations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vacation_id, 'url' => ['view', 'id' => $model->vacation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
