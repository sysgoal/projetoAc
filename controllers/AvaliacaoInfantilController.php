<?php

namespace app\controllers;

use Yii;
use app\models\AvaliacaoInfantil;
use app\models\AvaliacaoInfantilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * AvaliacaoInfantilController implements the CRUD actions for AvaliacaoInfantil model.
 */
class AvaliacaoInfantilController extends Controller {

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
     * Lists all AvaliacaoInfantil models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {

                $searchModel = new AvaliacaoInfantilSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não permitido');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single AvaliacaoInfantil model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {


                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não permitido');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Creates a new AvaliacaoInfantil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {

                $model = new AvaliacaoInfantil();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('create', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não permitido');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing AvaliacaoInfantil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {

                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('update', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Usuário não permitido');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing AvaliacaoInfantil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {

                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            } else {
                throw new NotFoundHttpException('Usuário não permitido');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the AvaliacaoInfantil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvaliacaoInfantil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AvaliacaoInfantil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
    public function actionDadosAvaliacao($id) {
        if (Yii::$app->user->id) {

            // $aluno = Aluno::findOne($idAluno);
            $i = 0;
            $listaAvaliacao[] = array();
            $avaliacaoInfantil = AvaliacaoInfantil::find()->where(['id_aluno' => $id])->orderBy('data ASC')->all();
            if ($avaliacaoInfantil != null) {
                foreach ($avaliacaoInfantil as $value) {
                    $dtoAvaliacao = new DtoAvaliacaoInfantil();
                    $dtoAvaliacao->dataAvaliacao = $value->data;
                    $dtoAvaliacao->idade = $value->idade;
                    $dtoAvaliacao->peso = $value->peso;
                    $dtoAvaliacao->altura = $value->altura;
                    $dtoAvaliacao->flexao = $value->flexao;
                    $dtoAvaliacao->abdomen = $value->abdomem;
                    $dtoAvaliacao->postura = $value->postura;
                    
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }          

            echo \yii\helpers\Json::encode($listaAvaliacao);
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
}

class DtoAvaliacaoInfantil extends Model {

    public $dataAvaliacao;

    public $idade;

    public $peso;

    public $altura;
    
    public $abdomen;
    
    public $flexao;

    public $postura;
}
