<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тип отпуска';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacation-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый тип', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type',
            'days',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
