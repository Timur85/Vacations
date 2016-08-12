<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VacationType */

$this->title = 'Create Vacation Type';
$this->params['breadcrumbs'][] = ['label' => 'Vacation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
