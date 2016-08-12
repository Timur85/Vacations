<?php

namespace app\controllers;
namespace frontend\controllers;

use Yii;
use app\models\Vacation;
use app\models\VacationSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacationController implements the CRUD actions for Vacation model.
 */
class VacationController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['create', 'update','calendar'],
                'rules'=>[
                    [
                        'allow'=> true,
                        'roles'=> ['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vacation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalendar(){
        if(isset($_POST['year'])) {
            $model = Vacation::findByYear($_POST['year']);
            if(!empty($model)) {
                echo json_encode($model);
            }
        }
        else {
            $searchModel = new VacationSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('calendar', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Vacation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vacation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacation();
        if ($model->load(Yii::$app->request->post())) {
            $id = Yii::$app->user->getId();
            $model->employee = $id;
            $model->accounter = 0;
            $model->manager = 0;
            $model->acc_date_approval = '0000-00-00';
            $model->m_date_approval = '0000-00-00';
            $model->status = 1;
            $model->save();
            return $this->redirect(['view', 'id' => $model->vacation_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*Approved by Accountant */
    public function actionApproved($id){

        $searchModel = new VacationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = $this->findModel($id);
        $id = Yii::$app->user->getId();
        $model->accounter = $id;
        $model->acc_date_approval = date('Y-m-d');
        $model->status = 2;
        if ($model->save())
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        else{
            return $this->render('site/error');

        }
    }

    /*Approved by Manager */
    public function actionApproved_manager($id){

        $searchModel = new VacationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = $this->findModel($id);
        $id = Yii::$app->user->getId();
        $model->manager = $id;
        $model->m_date_approval = date('Y-m-d');
        $model->status = 3;
        if ($model->save())
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        else{
            return $this->render('site/error');

        }
    }

    /**
     * Updates an existing Vacation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->vacation_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vacation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
