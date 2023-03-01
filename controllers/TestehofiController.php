<?php

namespace app\controllers;

use Yii;
use app\models\TesteHofi;
use app\models\TesteHofiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TesteHofiController implements the CRUD actions for TesteHofi model.
 */
class TestehofiController extends Controller {

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
     * Lists all TesteHofi models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new TesteHofiSearch();
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
     * Displays a single TesteHofi model.
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
     * Creates a new TesteHofi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new TesteHofi();

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
     * Updates an existing TesteHofi model.
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
     * Deletes an existing TesteHofi model.
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
     * Finds the TesteHofi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TesteHofi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = TesteHofi::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
