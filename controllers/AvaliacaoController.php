<?php

namespace app\controllers;

use Yii;
use app\models\Avaliacao;
use app\models\AvaliacaoHipopressivo;
use app\models\AvaliacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use bsadnu\googlecharts\ComboChart;
use TCPDF;
use app\models\MYPDF;

/**
 * AvaliacaoController implements the CRUD actions for Avaliacao model.
 */
class AvaliacaoController extends Controller {

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

    public function actionFoto($filename) {
        if (Yii::$app->user->id) {

            return $this->render('foto', [
                        'filename' => $filename,]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Lists all Avaliacao models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            if (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador') {
                $searchModel = new AvaliacaoSearch();
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

    public function actionGraficos() {
        if (Yii::$app->user->id) {
            $searchModel = new \app\models\AvaliacaoHipopressivoSearch();

            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);


            return $this->render('graficos', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionBioimpedancia($id) {
        $model = new Avaliacao();
        $imc = $model->getDadosImc($id);
        $gordura = $model->getDadosGorduraCorporal($id);
        $avaliacaos = $model->getDadosTodasAvaliacao($id);
        $cinturaQuadril = $model->getDadosCinturaQuadril($id);
        $visceral = $model->getDadosGorduraVisceral($id);
        $esqueletico = $model->getDadosMusculoEsqueletico($id);
        $dadosAvaliacao = $model->getDadosAvaliacao($id);

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($dadosAvaliacao->aluno->nm_aluno);
        $pdf->SetTitle('Bioimpedância');
        $pdf->SetSubject('academia harmonia');
        $pdf->SetKeywords('harmonia, PDF, turma, dados');

// set default header data
        $pdf->SetHeaderData('harmonia.png', 60);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(20, 40, 40);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// --------------------------------------------------------------------------
// set font
        $pdf->SetFont('helvetica', '', 20);
// add a page
        $pdf->AddPage('L');

        $pdf->Write(0, 'Bioimpedância', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Ln(5);

        $pdf->SetFont('times', '', 14);
        $pdf->SetFillColor(255, 255, 200);

        $nome = 'Paciente: ' . $dadosAvaliacao->aluno->nm_aluno;
        $professor = 'Avaliador: ' . $dadosAvaliacao->profissional->nm_profissional . ' - ' . $dadosAvaliacao->profissional->tp_registro . ': ' . $dadosAvaliacao->profissional->nr_registro;

        $graf = ComboChart::widget([
                    'id' => 'my-simple-area-chart-id',
                    'data' => $imc,
                    'options' => [
                        'chartArea' => [
                            'left' => '15%',
                            'width' => '60%',
                            'height' => 350
                        ],
                        // 'MaxValue' => 50,
                        'width' => 900,
                        'height' => 400,
                        'isStacked' => true,
                        'legend' => 'bottom',
                        'seriesType' => 'area',
                        'areaOpacity' => 0.4,
                        'series' => [
                            0 => [
                                'lineWidth' => 0,
                                'visibleInLegend' => false,
                                'enableInteractivity' => false,
                            ],
                            1 => [
                                'lineWidth' => 0,
                                'visibleInLegend' => false,
                                'enableInteractivity' => false,
                            ],
                            2 => [
                                'lineWidth' => 0,
                                'visibleInLegend' => false,
                                'enableInteractivity' => false,
                            ],
                            3 => [
                                'lineWidth' => 0,
                                'visibleInLegend' => false,
                                'enableInteractivity' => false,
                            ],
                            4 => ['type' => 'line',
                                'color' => 'yellow',
                                'pointSize' => 4,
                                'lineWidth' => 1,
                                'pointShape' => 'square',
                                'visibleInLegend' => true,
                            ],
                            5 => ['type' => 'line',
                                'color' => 'green',
                                'pointSize' => 4,
                                'lineWidth' => 1,
                                'pointShape' => 'square',
                                'visibleInLegend' => true,
                            ],
                            6 => ['type' => 'line',
                                'color' => '#FF6633',
                                'pointSize' => 4,
                                'lineWidth' => 1,
                                'pointShape' => 'square',
                                'visibleInLegend' => true,
                            ],
                            7 => ['type' => 'line',
                                'color' => 'red',
                                'pointSize' => 4,
                                'pointShape' => 'square',
                                'visibleInLegend' => true,
                                'lineWidth' => 1,
                            ],
                            8 => ['type' => 'line',
                                'color' => 'black',
                                'pointSize' => 10,
                                'pointShape' => 'square',
                            ]
                        ],
                        'colors' => ['yellow', 'green', '#FF6633', 'red'],
                        'pointSize' => 4,
                        'vAxis' => [
                            'title' => 'Valor do IMC',
                            'titleTextStyle' => [
                                'fontSize' => 13,
                                'italic' => false
                            ],
                            'viewWindow' => ['min' => 0,
                                'max' => 40]
                        ],
                        'legend' => [
                            'position' => 'top',
                            'alignment' => 'end',
                            'textStyle' => [
                                'fontSize' => 12
                            ]
                        ],
                    ]
                ])
        ;

        // Multicell test
        $pdf->MultiCell(250, 7, $nome, 1, 'L', 0, 0, '', '', true);
        $pdf->Ln(7);
        $pdf->MultiCell(250, 7, $professor, 1, 'L', 0, 0, '', '', true);
        $pdf->Ln(7);
        $pdf->MultiCell(250, 7, $graf, 1, 'L', 0, 0, '', '', true);



// reset pointer to the last page
        $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
        $pdf->Output($dadosAvaliacao->aluno->nm_aluno . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }

    public function actionGraficoindividual($id) {
        if (Yii::$app->user->id) {
            $model = new Avaliacao();
            return $this->render('graficoindividual', ['model' => $model, 'id' => $id]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single Avaliacao model.
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
     * Creates a new Avaliacao model.
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


                $model = new Avaliacao();
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

            //*****************************************
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing Avaliacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
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
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post())) {
                  //  if (($model->situacao !== 'Concluída' && (Yii::$app->user->identity->permissao == 'Profissional') || Yii::$app->user->identity->permissao == 'Administrador')) {
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
                    return $this->render('update', [
                                'model' => $model,
                                'idAluno' => null,
                                'idProf' => $idProf,
                    ]);
               /* } else {
                    throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
                }*/
            } else {
                throw new NotFoundHttpException('Você não tem permissão para visualizar essa página.');
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing Avaliacao model.
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
     * Finds the Avaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (Yii::$app->user->id) {
            if (($model = Avaliacao::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
     public function actionGetAvaliacoes($id) {
        if (Yii::$app->user->id) {
             $avaliacoesAcademia = Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->all();
             $avaliacoesHipopressivo = \app\models\AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->all();
             //$avalicoesResultado[] = new Avaliacao();//$avaliacoesAcademia;
             
             foreach ($avaliacoesAcademia as $itemAvaliacaoAcademia){
                 $avalicoesResultado[] = $itemAvaliacaoAcademia;
             }
             
            foreach ($avaliacoesHipopressivo as $itemAvaliacaoHipo){
                 $item = new AvaliacaoHipopressivo();
                 $item->id_avaliacao = $itemAvaliacaoHipo->id_avaliacao;
                 $item->id_aluno = $itemAvaliacaoHipo->id_aluno;
                 $item->ds_motivo = $itemAvaliacaoHipo->ds_motivo;
                 $item->dt_avaliacao = $itemAvaliacaoHipo->dt_avaliacao;
                 $item->ds_medico_responsavel = $itemAvaliacaoHipo->ds_medico_responsavel;
                 $item->ds_cirurgia = $itemAvaliacaoHipo->ds_cirurgia;
                 $item->ds_anamnese_medico = $itemAvaliacaoHipo->ds_anamnese_medico;
                 $item->ds_patologia = $itemAvaliacaoHipo->ds_patologia;
                 $item->ds_medicamento = $itemAvaliacaoHipo->ds_medicamento;
                 $item->ds_aparelho_circ = $itemAvaliacaoHipo->ds_aparelho_circ;
                 $item->nr_refeicoes_dia = $itemAvaliacaoHipo->nr_refeicoes_dia;
                 $item->nr_litros_agua_dia = $itemAvaliacaoHipo->nr_litros_agua_dia;
                 $item->ds_comentario_disgestivo = $itemAvaliacaoHipo->ds_comentario_disgestivo;
                 $item->ds_sono = $itemAvaliacaoHipo->ds_sono;
                 $item->ds_alergia = $itemAvaliacaoHipo->ds_alergia;
                 $item->ds_doenca_respiratoria = $itemAvaliacaoHipo->ds_doenca_respiratoria;
                 $item->ds_atividade_fisica = $itemAvaliacaoHipo->ds_atividade_fisica;
                 $item->ds_dor = $itemAvaliacaoHipo->ds_dor;
                 $item->nr_filhos = $itemAvaliacaoHipo->nr_filhos;
                 $item->ds_sexo = $itemAvaliacaoHipo->ds_sexo;
                 $item->nr_nocturia = $itemAvaliacaoHipo->nr_nocturia;
                 $item->ds_incontinencia = $itemAvaliacaoHipo->ds_incontinencia;
                 $item->ds_avaliacao_postural = $itemAvaliacaoHipo->ds_avaliacao_postural;
                 $item->ds_braco_relax_d = $itemAvaliacaoHipo->ds_braco_relax_d;
                 $item->ds_braco_relax_e = $itemAvaliacaoHipo->ds_braco_relax_e;
                 $item->ds_antebraco_d = $itemAvaliacaoHipo->ds_antebraco_d; 
                 $item->ds_antebraco_e = $itemAvaliacaoHipo->ds_antebraco_e;
                 $item->ds_torax = $itemAvaliacaoHipo->ds_torax;
                 $item->ds_tonus = $itemAvaliacaoHipo->ds_tonus;
                 $item->ds_cintura = $itemAvaliacaoHipo->ds_cintura;
                 $item->ds_10_abaixo = $itemAvaliacaoHipo->ds_10_abaixo;
                 $item->ds_10_acima = $itemAvaliacaoHipo->ds_10_acima;
                 $item->ds_quadril = $itemAvaliacaoHipo->ds_quadril;
                 $item->ds_coxa_med_d = $itemAvaliacaoHipo->ds_coxa_med_d;
                 $item->ds_coxa_med_e = $itemAvaliacaoHipo->ds_coxa_med_e;
                 $item->ds_panturrilha_d = $itemAvaliacaoHipo->ds_panturrilha_d;
                 $item->ds_panturrilha_e = $itemAvaliacaoHipo->ds_panturrilha_e;
                 $item->ds_pa = $itemAvaliacaoHipo->ds_pa;
                 $item->ds_altura = $itemAvaliacaoHipo->ds_altura;
                 $item->ds_flexibilidade = $itemAvaliacaoHipo->ds_flexibilidade;
                 $item->ds_conduta = $itemAvaliacaoHipo->ds_conduta;
                 $item->ds_diastase = $itemAvaliacaoHipo->ds_diastase;
                 $item->ds_peso = $itemAvaliacaoHipo->ds_peso;
                 $item->ds_massa_gorda = $itemAvaliacaoHipo->ds_massa_gorda;
                 $item->ds_massa_magra = $itemAvaliacaoHipo->ds_massa_magra;
                 $item->ds_metabolismo = $itemAvaliacaoHipo->ds_metabolismo;
                 $item->ds_idade = $itemAvaliacaoHipo->ds_idade;
                 $item->ds_gordura_visceral = $itemAvaliacaoHipo->ds_gordura_visceral;
                 $item->ds_5_acima = $itemAvaliacaoHipo->ds_5_acima;
                 $item->ds_umbigo = $itemAvaliacaoHipo->ds_umbigo;
                 $item->ds_5_abaixo = $itemAvaliacaoHipo->ds_5_abaixo;
                 $item->ds_competencia = $itemAvaliacaoHipo->ds_competencia;
                 $avalicoesResultado[] = $item;
                 
             }
            
        
             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
           
            if ($avalicoesResultado != null) { 
                // echo \yii\helpers\Json::encode($avaliacoes);
                return $avalicoesResultado;
            }
             
        } else {
            return $this->redirect(['site/about']);
        }
    }

}

class DtoGrafico {

    public $dt_avalicao;
    public $id_aluno;

}
