<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'vacation_id') ?>
    <?= $form->field($model, 'date_start') ?>
    <?= $form->field($model, 'end_date') ?>
    <?= $form->field($model, 'employee') ?>
    <?= $form->field($model, 'accounter') ?>
    <?php // echo $form->field($model, 'acc_date_approval') ?>
    <?php // echo $form->field($model, 'manager') ?>
    <?php // echo $form->field($model, 'm_date_approval') ?>
    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
