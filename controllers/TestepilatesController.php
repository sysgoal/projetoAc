<?php

namespace app\controllers;

use Yii;
use app\models\TestePilates;
use app\models\TestePilatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestePilatesController implements the CRUD actions for TestePilates model.
 */
class TestepilatesController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TestePilates models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new TestePilatesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single TestePilates model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->id) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Creates a new TestePilates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new TestePilates();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing TestePilates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing TestePilates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->id) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the TestePilates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestePilates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = TestePilates::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
