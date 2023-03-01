<?php

namespace app\controllers;

use Yii;
use app\models\TurmaAluno;
use app\models\Turma;
use app\models\TurmaAlunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TurmaalunoController implements the CRUD actions for TurmaAluno model.
 */
class TurmaalunoController extends Controller {

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
     * Lists all TurmaAluno models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new TurmaAlunoSearch();
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
     * Displays a single TurmaAluno model.
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
     * Creates a new TurmaAluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new TurmaAluno();

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
     * Updates an existing TurmaAluno model.
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
     * Deletes an existing TurmaAluno model.
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
     * Finds the TurmaAluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TurmaAluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = TurmaAluno::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionListaturma() {
        if (Yii::$app->user->id) {
            $searchModel = new TurmaAlunoSearch();
            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);

            return $this->render('listaturma', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionListaporturma($id) {
        if (Yii::$app->user->id) {
            return $this->render('listaporturma', [
                        'model' => Turma::findOne($id),
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
