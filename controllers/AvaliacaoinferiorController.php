<?php

namespace app\controllers;

use Yii;
use app\models\AvaliacaoInferior;
use app\models\AvaliacaoInferiorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacaoInferiorController implements the CRUD actions for AvaliacaoInferior model.
 */
class AvaliacaoinferiorController extends Controller {

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
     * Lists all AvaliacaoInferior models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                $searchModel = new AvaliacaoInferiorSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single AvaliacaoInferior model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Creates a new AvaliacaoInferior model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idAluno = null) {
        if (Yii::$app->user->id) {
            $idProf = null;
            $usuario = \app\models\Usuarios::findOne(Yii::$app->user->id);
            $professor = \app\models\Profissional::find()->where(['ds_cpf' => $usuario->cpf])->one();
            if ($professor != null) {
                $idProf = $professor->id_profissional;
            } else {
                throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
            }
            $model = new AvaliacaoInferior();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model,
                        'idAluno' => $idAluno,
                        'idProf' => $idProf,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing AvaliacaoInferior model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $idProf = null;
            $usuario = \app\models\Usuarios::findOne(Yii::$app->user->id);
            $professor = \app\models\Profissional::find()->where(['ds_cpf' => $usuario->cpf])->one();
            if ($professor != null) {
                $idProf = $professor->id_profissional;
            } else {
                throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
            }
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
                        'idAluno' => null,
                        'idProf' => $idProf,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing AvaliacaoInferior model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Administrador') {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            } else {
                throw new NotFoundHttpException('Usuário sem permissão para excluir');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the AvaliacaoInferior model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvaliacaoInferior the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = AvaliacaoInferior::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
