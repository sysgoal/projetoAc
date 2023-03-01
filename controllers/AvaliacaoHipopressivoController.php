<?php

namespace app\controllers;

use Yii;
use app\models\AvaliacaoHipopressivo;
use app\models\AvaliacaoHipopressivoSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacaoHipopressivoController implements the CRUD actions for AvaliacaoHipopressivo model.
 */
class AvaliacaoHipopressivoController extends Controller {

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
     * Lists all AvaliacaoHipopressivo models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                $searchModel = new AvaliacaoHipopressivoSearch();
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
     * Displays a single AvaliacaoHipopressivo model.
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
     * Creates a new AvaliacaoHipopressivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idAluno = null) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                $idProf = null;
                $usuario = \app\models\Usuarios::findOne(Yii::$app->user->id);
                $professor = \app\models\Profissional::find()->where(['ds_cpf' => $usuario->cpf])->one();
                if ($professor != null) {
                    $idProf = $professor->id_profissional;
                } else {
                    throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
                }
                $model = new AvaliacaoHipopressivo();

                if ($model->load(Yii::$app->request->post())) {
                    // get the uploaded file instance. for multiple file uploads
                    // the following data will return an array

                    $image1 = UploadedFile::getInstance($model, 'image1');
                    $image2 = UploadedFile::getInstance($model, 'image2');
                    $image3 = UploadedFile::getInstance($model, 'image3');
                    $image4 = UploadedFile::getInstance($model, 'image4');
                    $image5 = UploadedFile::getInstance($model, 'image5');
                    $image6 = UploadedFile::getInstance($model, 'image6');
                    $image7 = UploadedFile::getInstance($model, 'image7');
                    $video = UploadedFile::getInstance($model, 'video');
                    $path1 = null;
                    $path2 = null;
                    $path3 = null;
                    $path4 = null;
                    $path5 = null;
                    $path6 = null;
                    $path7 = null;
                    $path8 = null;
                    if ($image1 <> null) {
                        $fotoName = 'foto_1_' . $model->aluno->ds_cpf . '.' . $image1->getExtension();

                        // $path1 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path1 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto1 = $fotoName;
                    }
                    if ($image2 <> null) {
                        $fotoName = 'foto_2_' . $model->aluno->ds_cpf . '.' . $image2->getExtension();
                        //$path2 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path2 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto2 = $fotoName;
                    }
                    if ($image3 <> null) {
                        $fotoName = 'foto_3_' . $model->aluno->ds_cpf . '.' . $image3->getExtension();
                        //$path3 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path3 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto3 = $fotoName;
                    }
                    if ($image4 <> null) {
                        $fotoName = 'foto_4_' . $model->aluno->ds_cpf . '.' . $image4->getExtension();
                        // $path4 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path4 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto4 = $fotoName;
                    }
                    if ($image5 <> null) {
                        $fotoName = 'foto_5_' . $model->aluno->ds_cpf . '.' . $image5->getExtension();
                        // $path5 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName; 
                        $path5 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto5 = $fotoName;
                    }
                    if ($image6 <> null) {
                        $fotoName = 'foto_6_' . $model->aluno->ds_cpf . '.' . $image6->getExtension();
                        //$path6 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path6 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto6 = $fotoName;
                    }
                    if ($image7 <> null) {
                        $fotoName = 'foto_7_' . $model->aluno->ds_cpf . '.' . $image7->getExtension();
                        //$path7 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                        $path7 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                        $model->ds_foto7 = $fotoName;
                    }
                    if ($video <> null) {
                        $fotoName = 'video_' . $model->aluno->ds_cpf . '.' . $video->getExtension();
                        //$path1 = Yii::$app->basePath . '\\web\\video\\'. $fotoName;
                        $path8 = Yii::$app->basePath . '/web/video/' . $fotoName;
                        $model->ds_video = $fotoName;
                    }
                    if ($model->save()) {
                        if ($path1 <> null) {
                            $image1->saveAs($path1);
                        }
                        if ($path2 <> null) {
                            $image2->saveAs($path2);
                        }
                        if ($path3 <> null) {
                            $image3->saveAs($path3);
                        }
                        if ($path4 <> null) {
                            $image4->saveAs($path4);
                        }
                        if ($path5 <> null) {
                            $image5->saveAs($path5);
                        }
                        if ($path6 <> null) {
                            $image6->saveAs($path6);
                        }
                        if ($path7 <> null) {
                            $image7->saveAs($path7);
                        }
                        if ($path8 <> null) {
                            $video->saveAs($path8);
                        }
                    } else {
                        echo print_r($model->getErrors());
                    }
                    return $this->redirect(['view', 'id' => $model->id_avaliacao]);
                }
                return $this->render('create', [
                            'model' => $model,
                            'idAluno' => $idAluno,
                            'idProf' => $idProf,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing AvaliacaoHipopressivo model.
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

            if ($model->load(Yii::$app->request->post())) {
                // get the uploaded file instance. for multiple file uploads
                // the following data will return an array

                $image1 = UploadedFile::getInstance($model, 'image1');
                $image2 = UploadedFile::getInstance($model, 'image2');
                $image3 = UploadedFile::getInstance($model, 'image3');
                $image4 = UploadedFile::getInstance($model, 'image4');
                $image5 = UploadedFile::getInstance($model, 'image5');
                $image6 = UploadedFile::getInstance($model, 'image6');
                $image7 = UploadedFile::getInstance($model, 'image7');
                $video = UploadedFile::getInstance($model, 'video');
                $path1 = null;
                $path2 = null;
                $path3 = null;
                $path4 = null;
                $path5 = null;
                $path6 = null;
                $path7 = null;
                $path8 = null;
                if ($image1 <> null) {
                    $fotoName = 'foto_1_' . $model->aluno->ds_cpf . '.' . $image1->getExtension();

                    // $path1 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path1 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto1 = $fotoName;
                }
                if ($image2 <> null) {
                    $fotoName = 'foto_2_' . $model->aluno->ds_cpf . '.' . $image2->getExtension();
                    //$path2 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path2 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto2 = $fotoName;
                }
                if ($image3 <> null) {
                    $fotoName = 'foto_3_' . $model->aluno->ds_cpf . '.' . $image3->getExtension();
                    // $path3 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path3 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto3 = $fotoName;
                }
                if ($image4 <> null) {
                    $fotoName = 'foto_4_' . $model->aluno->ds_cpf . '.' . $image4->getExtension();
                    //$path4 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path4 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto4 = $fotoName;
                }
                if ($image5 <> null) {
                    $fotoName = 'foto_5_' . $model->aluno->ds_cpf . '.' . $image5->getExtension();
                    //$path5 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName; 
                    $path5 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto5 = $fotoName;
                }
                if ($image6 <> null) {
                    $fotoName = 'foto_6_' . $model->aluno->ds_cpf . '.' . $image6->getExtension();
                    //$path6 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path6 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto6 = $fotoName;
                }
                if ($image7 <> null) {
                    $fotoName = 'foto_7_' . $model->aluno->ds_cpf . '.' . $image7->getExtension();
                    //$path7 = Yii::$app->basePath . '\\web\\imagesavaliacao\\'. $fotoName;
                    $path7 = Yii::$app->basePath . '/web/imagesavaliacao/' . $fotoName;
                    $model->ds_foto7 = $fotoName;
                }
                if ($video <> null) {
                    $fotoName = 'video_' . $model->aluno->ds_cpf . '.' . $video->getExtension();
                    //$path1 = Yii::$app->basePath . '\\web\\video\\'. $fotoName;
                    $path8 = YYii::$app->basePath . '/web/video/' . $fotoName;
                    $model->ds_video = $fotoName;
                }
                if ($model->save()) {
                    if ($path1 <> null) {
                        $image1->saveAs($path1);
                    }
                    if ($path2 <> null) {
                        $image2->saveAs($path2);
                    }
                    if ($path3 <> null) {
                        $image3->saveAs($path3);
                    }
                    if ($path4 <> null) {
                        $image4->saveAs($path4);
                    }
                    if ($path5 <> null) {
                        $image5->saveAs($path5);
                    }
                    if ($path6 <> null) {
                        $image6->saveAs($path6);
                    }
                    if ($path7 <> null) {
                        $image7->saveAs($path7);
                    }
                    if ($path8 <> null) {
                        $video->saveAs($path8);
                    }
                } else {
                    echo print_r($model->getErrors());
                }
                return $this->redirect(['view', 'id' => $model->id_avaliacao]);
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
     * Deletes an existing AvaliacaoHipopressivo model.
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
     * Finds the AvaliacaoHipopressivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AvaliacaoHipopressivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = AvaliacaoHipopressivo::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
    public function actionGetAvaliacoes($id) {
        if (Yii::$app->user->id) {
             $avaliacoes = AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->all();
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
