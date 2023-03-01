<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller {

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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                $searchModel = new UsuariosSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                $model = new Usuarios();

                if ($model->load(Yii::$app->request->post())) {
                    $model->password = sha1($model->password.'aa');
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        throw new NotFoundHttpException('Ocorreu um erro, verifique os dados informados e tente novamente!');
                    }
                }

                return $this->render('create', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post())) {
                    $model->password = sha1($model->password.'aa');
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        throw new NotFoundHttpException('Ocorreu um erro, verifique os dados informados e tente novamente!');
                    }
                }


                return $this->render('update', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            $usuario = Usuarios::findOne(Yii::$app->user->id);
            if ($usuario->permissao === 'Administrador') {
                if (($model = Usuarios::findOne($id)) !== null) {
                    return $model;
                }

                throw new NotFoundHttpException('The requested page does not exist.');
            } else {
                throw new NotFoundHttpException('Você não tem permissão para acessar essa página!');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
