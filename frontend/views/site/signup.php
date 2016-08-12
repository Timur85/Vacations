<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Регистрация сотрудника';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'first_name')->textInput(['autofocus' => true])->label('Имя') ?>
                <?= $form->field($model, 'last_name')->label('Фамилия') ?>
                <?= $form->field($model, 'middle_name')->label('Отчество') ?>
                <?= $form->field($model, 'username')->label('Логин') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                <?= $form->field($model, 'position')->label('Должность') ?>
                <?= $form->field($model, 'role')->dropDownList(
                    ArrayHelper::map(\app\models\UserGroup::find()->all(), 'group_id', 'group_name')
                )->label("Роль") ?>
                <div class="form-group">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
