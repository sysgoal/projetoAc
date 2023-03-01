<?php

namespace app\controllers;

use Yii;
use app\models\Profissional;
use app\models\ProfissionalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfissionaController implements the CRUD actions for Profissional model.
 */
class ProfissionalController extends Controller {

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
     * Lists all Profissional models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new ProfissionalSearch();
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
     * Displays a single Profissional model.
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
     * Creates a new Profissional model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new Profissional();
            $searchModel = new ProfissionalSearch();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_profissional]);
            }

            return $this->render('create', [
                        'searchModel' => $searchModel,
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing Profissional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_profissional]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing Profissional model.
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

    public function actionDesativar($id) {
        if (Yii::$app->user->id) {
            $model = Profissional::updateAll(['ds_ativo' => 0], ['id_profissional' => $id]);

            //$this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionAtivar($id) {
        if (Yii::$app->user->id) {
            $model = Profissional::updateAll(['ds_ativo' => 1], ['id_profissional' => $id]);

            //$this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the Profissional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profissional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = Profissional::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
