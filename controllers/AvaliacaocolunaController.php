<?php

namespace app\controllers;

use Yii;
use app\models\AvaliacaoColuna;
use app\models\AvaliacaoColunaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\JsonParser;

/**
 * AvaliacaoColunaController implements the CRUD actions for AvaliacaoColuna model.
 */
class AvaliacaocolunaController extends Controller {

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
     * Lists all AvaliacaoColuna models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                $searchModel = new AvaliacaoColunaSearch();
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
     * Displays a single AvaliacaoColuna model.
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
     * Creates a new AvaliacaoColuna model.
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
            $model = new AvaliacaoColuna();

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
     * Updates an existing AvaliacaoColuna model.
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
     * Deletes an existing AvaliacaoColuna model.
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
     * Finds the AvaliacaoColuna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvaliacaoColuna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = AvaliacaoColuna::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionGetDadosAluno($id) {
        if (Yii::$app->user->id) {
            $data = \app\models\Aluno::findOne($id);
            if ($data != null && $data->id_convenio != null) {
                $data->nomeConvenio = $data->convenio->ds_nome;
            }
            echo \yii\helpers\Json::encode($data);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionGetDadosAlunoConvenio($id) {
        if (Yii::$app->user->id) {
            $data = \app\models\Convenio::findOne($id);

            echo \yii\helpers\Json::encode($data);
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
     public function actionGetAvaliacoes($id) {
        if (Yii::$app->user->id) {
             $avaliacoes = AvaliacaoColuna::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->all();
             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           
            if ($avaliacoes != null) {                
                // echo \yii\helpers\Json::encode($avaliacoes);
                return $avaliacoes;
            }
             
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
