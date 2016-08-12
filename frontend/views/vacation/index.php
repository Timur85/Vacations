<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки отпусков';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="vacation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status == 1){
                return ['class'=>'warning'];
            }
            else if($model->status == 2){
                return ['class'=>'info'];

            }else{
                return ['class'=>'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'vacation_id',
            'date_start',
            'end_date',
            [
                'attribute' => 'vacation_type',
                'value' => 'vacationType.type'
            ],
            [
                'attribute' => 'employee',
                'value' => 'userFIO'
            ],
            [
                'attribute' => 'accounter',
                'value' => 'userFIOAcc'
            ],
            // 'acc_date_approval',
            [
                'attribute' => 'manager',
                'value' => 'userFIOManage'
            ],
            // 'm_date_approval',
            [
                'attribute' => 'status',
                'value' => 'statusStatus.status_name'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {approved} {approved_manager} {canceled}',
                'buttons' => [
                    'approved' => function($url, $model){
                        return app\models\User::getUserRole() == 2 ? Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url,
                            [ 'title' => Yii::t('app', 'Одобрен'), ]) : '';
                    },
                    'approved_manager' => function($url, $model){
                        return app\models\User::getUserRole() == 3 ? Html::a('<span class="glyphicon glyphicon-saved"></span>', $url,
                            [ 'title' => Yii::t('app', 'Утвержден'), ]) : '';
                    },
                    'view' => function($url, $model){
                        return app\models\User::getUserRole() == 3 ? Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                            [ 'title' => Yii::t('app', 'Просмотр'), ]) : '';
                    },
                    'update' => function($url, $model){
                        return app\models\User::getUserRole() == 4 ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                            [ 'title' => Yii::t('app', 'Изменить'), ]) : '';
                    },
                    'delete' => function($url, $model){
                        return app\models\User::getUserRole() == 4 ? Html::a('<span class="glyphicon glyphicon-remove"></span>', $url,
                            [ 'title' => Yii::t('app', 'Отменить заявку'), ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        if(app\models\User::getUserRole() == 4){
                            $options = [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить данную запись?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                        }
                    },
                ],
            ],
        ],
    ]); ?>

</div>
