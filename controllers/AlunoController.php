<?php

namespace app\controllers;

use Yii;
use app\models\Aluno;
use app\models\AlunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Avaliacao;
use app\models\AvaliacaoHipopressivo;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller {

    public $model;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        $model = new Aluno();
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
     * Lists all Aluno models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {
                $searchModel = new AlunoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionFoto($filename) {
        if (Yii::$app->user->id) {

            return $this->render('foto', [
                        'filename' => $filename,]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single Aluno model.
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

    public function actionListaalunosrelatorio() {
        if (Yii::$app->user->id) {
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('listaalunosrelatorio', ['searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,]);
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
      public function actionListaalunosavaliacoes() {
        if (Yii::$app->user->id) {
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('listaalunoavaliacoes', ['searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionCreate() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {
                $model = new Aluno();
                if ($model->load(Yii::$app->request->post())) {
// get the uploaded file instance. for multiple file uploads
// the following data will return an array
                    $model->ds_chave_acesso = uniqid(rand());
                    $declaracao = UploadedFile::getInstance($model, 'pdfDeclaracao');
                    $image = UploadedFile::getInstance($model, 'image');

                    $model->dt_registro = date('d/m/Y');
                    $model->ds_ativo = 1;
                    $path = null;
                    $path2 = null;

                    if ($image <> null) {
                        $fotoName = 'aluno_' . $model->ds_cpf . '.' . $image->getExtension();
                        $path = Yii::$app->basePath . '/web/images/' . $fotoName;
                        $model->filename = $fotoName;
                    }
                    if ($declaracao <> null) {
                        $declaracaoName = 'declaracao_' . $model->ds_cpf . '.' . $declaracao->getExtension();
                        $path2 = Yii::$app->basePath . '/web/declaracao/' . $declaracaoName;
                        $model->declaracao = $declaracaoName;
                    }
                    for ($i = 1; $i <= 10; $i++) {
                        $arquivo = UploadedFile::getInstance($model, 'arquivo' . $i);
                        if ($arquivo <> null) {
                            $variavel = 'ds_arquivo' . $i;
                            $nomeArquivo = 'arquivo' . $i . '_' . $arquivo->getBaseName() . '.' . $arquivo->getExtension();
                            $pathArquivo = Yii::$app->basePath . '/web/arquivos/' . $nomeArquivo;
                            $model->$variavel = $nomeArquivo;
                            if ($pathArquivo <> null) {
                                $arquivo->saveAs($pathArquivo);
                            }
                        }
                    }


                    if ($model->save()) {
                        if ($path <> null) {
                            $image->saveAs($path);
                        }
                        if ($path2 <> null) {
                            $declaracao->saveAs($path2);
                        }
                    } else {
                        echo print_r($model->getErrors());
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionRelatorio() {
        if (Yii::$app->user->id) {
            $model = new Aluno();
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('relatorio', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Secretaria' || Yii::$app->user->identity->permissao == 'Administrador') {
                $model = $this->findModel($id);
                $chave = $model->ds_chave_acesso;
                if ($model->load(Yii::$app->request->post())) {
                    if ($model->ds_ativo == 0) {
                        $avaliacaoAcademia = Avaliacao::find()->where(['id_aluno' => $id])->all();
                        $i = 0;
                        foreach ($avaliacaoAcademia as $aval) {
                            if ($aval != null) {
                                if ($aval->ds_foto1 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto1);
                                    $aval->ds_foto1 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto2 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto2);
                                    $aval->ds_foto2 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto3 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto3);
                                    $aval->ds_foto3 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto4 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto4);
                                    $aval->ds_foto4 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto5 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto5);
                                    $aval->ds_foto5 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto6 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto6);
                                    $aval->ds_foto6 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto7 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto7);
                                    $aval->ds_foto7 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_video != null) {
                                    unlink(Yii::$app->basePath . '/web/video/' . $aval->ds_video);
                                    $aval->ds_video = null;
                                    $i = 1;
                                }
                                if ($i == 1) {
                                    $aval->save();
                                }
                            }
                        }
                        $avaliacaoHipopressivo = AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->all();
                        $i = 0;
                        foreach ($avaliacaoHipopressivo as $aval) {
                            if ($aval != null) {
                                if ($aval->ds_foto1 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto1);
                                    $aval->ds_foto1 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto2 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto2);
                                    $aval->ds_foto2 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto3 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto3);
                                    $aval->ds_foto3 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto4 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto4);
                                    $aval->ds_foto4 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto5 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto5);
                                    $aval->ds_foto5 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto6 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto6);
                                    $aval->ds_foto6 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_foto7 != null) {
                                    unlink(Yii::$app->basePath . '/web/imagesavaliacao/' . $aval->ds_foto7);
                                    $aval->ds_foto7 = null;
                                    $i = 1;
                                }
                                if ($aval->ds_video != null) {
                                    unlink(Yii::$app->basePath . '/web/video/' . $aval->ds_video);
                                    $aval->ds_video = null;
                                    $i = 1;
                                }
                                if ($i == 1) {
                                    $aval->save();
                                }
                            }
                        }
                    }

                    $declaracao = UploadedFile::getInstance($model, 'pdfDeclaracao');
                    $image = UploadedFile::getInstance($model, 'image');

                    $path = null;
                    $path2 = null;

                    if ($chave == null) {
                        $model->ds_chave_acesso = uniqid(rand());
                    }
                    if ($image <> null) {
                        $fotoName = 'aluno_' . Yii::$app->security->generateRandomString() . '.' . $image->getExtension();
                        $path = Yii::$app->basePath . '/web/images/' . $fotoName;
                        $model->filename = $fotoName;
                    }
                    if ($declaracao <> null) {
                        $declaracaoName = 'declaracao_' . Yii::$app->security->generateRandomString() . '.' . $declaracao->getExtension();

                        $path2 = Yii::$app->basePath . '/web/declaracao/' . $declaracaoName;
                        $model->declaracao = $declaracaoName;
                    }
                    for ($i = 1; $i <= 10; $i++) {
                        $arquivo = UploadedFile::getInstance($model, 'arquivo' . $i);
                        if ($arquivo <> null) {
                            $variavel = 'ds_arquivo' . $i;
                            $nomeArquivo = 'arquivo' . $i . '_' . $arquivo->getBaseName() . '.' . $arquivo->getExtension();
                            $pathArquivo = Yii::$app->basePath . '/web/arquivos/' . $nomeArquivo;
                            $model->$variavel = $nomeArquivo;
                            if ($pathArquivo <> null) {
                                $arquivo->saveAs($pathArquivo);
                            }
                        }
                    }
                    if ($model->save()) {
                        if ($path <> null) {
                            $image->saveAs($path);
                        }
                        if ($path2 <> null) {
                            $declaracao->saveAs($path2);
                        }

                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        echo print_r($model->getErrors());
                    }
                }

                return $this->render('update', [
                            'model' => $model,
                ]);
            } else {
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing Aluno model.
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
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = Aluno::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
