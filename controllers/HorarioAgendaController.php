<?php

namespace app\controllers;

use Yii;
use app\models\HorarioAgenda;
use app\models\Profissional;
use app\models\Aluno;
use app\models\Avaliacao;
use app\models\HorarioAgendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use app\models\Event;
use Date;
use DateTime;

/**
 * HorarioAgendaController implements the CRUD actions for HorarioAgenda model.
 */
class HorarioAgendaController extends Controller {

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
     * Creates a new HorarioAgenda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex($id = -1) {
        if (Yii::$app->user->id) {
            $teste = \app\models\Profissional::find()->select(['id_profissional', 'nm_profissional'])->all();
            if ($teste == null) {
                throw new NotFoundHttpException('Não existe nenhum Profissional cadastrado');
            }
            if (Yii::$app->user->identity->permissao == "Profissional") {

                $usuario = \app\models\Usuarios::findOne(Yii::$app->user->id);
                $professor = \app\models\Profissional::find()->where(['ds_cpf' => $usuario->cpf])->one();
                if ($professor != null) {
                    $idProf = $professor->id_profissional;
                    $model = new HorarioAgenda();
                    $ultimoRegistro = HorarioAgenda::find()->where(['id_profissional' => $idProf])->orderBy('id DESC')->limit(1)->one();

                    if ($ultimoRegistro != null) {

                        $model->load(Yii::$app->request->post());
                        $dataModel = str_replace("/", "-", $model->dt_inicio);
                        $dataFinal = date('Y-m-d', strtotime($dataModel));

                        if (($ultimoRegistro->id_aluno == $model->id_aluno || ($ultimoRegistro->nome != null && $ultimoRegistro->nome == $model->nome)) && ($ultimoRegistro->dt_inicio == $dataFinal)) {
                            $searchModel = new HorarioAgendaSearch();
                            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $id);
                            return $this->render('index', [
                                        'searchModel' => $searchModel,
                                        'dataProvider' => $dataProvider,
                                        'model' => $model,
                                        'id' => $idProf,
                            ]);
                        }
                    }
                    $searchModel = new HorarioAgendaSearch();
                    $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $idProf);
                    return $this->render('indexProfissional', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                'model' => $model,
                                'id' => $idProf,
                    ]);
                } else {
                    throw new NotFoundHttpException('Usuário não é um Profissional cadastrado');
                }
            } else {
                if ($id == -1) {
                    $prof = Profissional::find()->orderBy('nm_profissional ASC')->where(['ds_ativo' => 1])->limit(1)->one();
                    $id = $prof->id_profissional;
                }
                $model = new HorarioAgenda();

                $ultimoRegistro = HorarioAgenda::find()->where(['id_profissional' => $id])->orderBy('id DESC')->limit(1)->one();

                if ($ultimoRegistro != null) {

                    $model->load(Yii::$app->request->post());
                    $dataModel = str_replace("/", "-", $model->dt_inicio);
                    $dataFinal = date('Y-m-d', strtotime($dataModel));
                   // echo '<script> alert("oi"+'.var_dump($ultimoRegistro).');</script>';
                    if (($ultimoRegistro->id_aluno == $model->id_aluno || ($ultimoRegistro->nome != null && $ultimoRegistro->nome == $model->nome)) && ($ultimoRegistro->dt_inicio == $dataFinal)) {
                        $searchModel = new HorarioAgendaSearch();
                        $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $id);
                        return $this->render('index', [
                                    'searchModel' => $searchModel,
                                    'dataProvider' => $dataProvider,
                                    'model' => $model,
                                    'id' => $id,
                        ]);
                    }
                }

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $searchModel = new HorarioAgendaSearch();
                    $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $id);
                    return $this->render('index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                                'model' => $model,
                                'id' => $id,
                    ]);
                }
                // if ($controle == 1) {
                $searchModel = new HorarioAgendaSearch();
                $dataProvider = $searchModel->search2(Yii::$app->request->queryParams, $id);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                            'id' => $id,
                ]);
            }
        } else {
            return $this->redirect(['site/about']);
        }
        //}
    }

    public function actionInsereDatas($aluno = null, $profissional = null, $agendamento = null, $inicio = null, $fim = null, $datas = null, $nome = null) {
        if (Yii::$app->user->id) {
            $horario = new HorarioAgenda();
            $datas = explode(',', $datas);
            foreach ($datas as $data) {
                $horario = new HorarioAgenda();
                $horario->id_aluno = $aluno;
                $horario->id_profissional = $profissional;
                $horario->hr_inicio = $inicio;
                $horario->hr_fim = $fim;
                $horario->dt_inicio = $data;
                $horario->tp_agendamento = $agendamento;
                $horario->nome = $nome;
                $horario->save();
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }


    public function actionInsereDatasReagendamento($id = null, $inicio = null, $fim = null, $data = null) {
        if (Yii::$app->user->id) {
            $registro = HorarioAgenda::find()->where(['id' => $id])->one();
            $registro->status = 1;
            $registro->ds_usuario_modificacao = Yii::$app->user->identity->username;
            $dataOriginal = str_replace("-", "/", $registro->dt_inicio);
            $dataOriginal = Yii::$app->formatter->asDate($dataOriginal, 'php:d/m/Y');
            $registro->dt_inicio = $dataOriginal;
           // $registro->dt_modificacao = date('Y-m-d H:i');
            $registro->ds_agendamento = "Reagendado";
            $registro->ds_cor = "#ff8301";
            $registro->save();
            $horario = new HorarioAgenda();
            
            $horario->id_aluno = $registro->id_aluno;
            $horario->id_profissional = $registro->id_profissional;
            $horario->hr_inicio = $inicio;
            $horario->hr_fim = $fim;
            $horario->dt_inicio = $data;
            $horario->tp_agendamento = $registro->tp_agendamento;
            $horario->nome = $registro->nome;
            $horario->telefone = $registro->telefone;
            $horario->save();
           // }
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionUpdateHorario($id, $just, $cor = '#8B0000', $observacao = null, $descricao = null, $status = 0) {
        if (Yii::$app->user->id) {
            $data = HorarioAgenda::updateAll(['fl_efetuado' => '1', 'ds_cor' => $cor, 'ds_agendamento' => $just, 'ds_objetivo' => $observacao, 'ds_descricao' => $descricao, 'status' => $status], ['id' => $id]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionRecuperarTamanhoLista($profissional, $dataAlt, $horaIni) {
        if (Yii::$app->user->identity->permissao != "Administrador") {
            $datas = explode(',', $dataAlt);
            foreach ($datas as $data) {
                $data = str_replace("/", "-", $data);
                $data = Yii::$app->formatter->asDate($data, 'php:Y-m-d');
                $cont = HorarioAgenda::find()->where(['id_profissional'=> $profissional, 'dt_inicio' => $data, 'hr_inicio'=>$horaIni,  'status' => 0])->count(); 
                if($cont >= 6){
                    return $cont;
                }
            }

            return 1;
            
        }else{
            return 1;
        }
    }

    public function actionUpdateDataHorario($id, $dataAlt, $horaIni, $horaFim) {
        if (Yii::$app->user->id) {
            $dataAlt = str_replace("/", "-", $dataAlt);
            $dataAlt = Yii::$app->formatter->asDate($dataAlt, 'php:Y-m-d');
           /* $registro = HorarioAgenda::find()->where(['id' => $id])->one();
            $registro->dt_inicio = $dataAlt;
            $registro->hr_inicio = $dataAlt;//$horaIni;
            $registro->hr_fim = $horaFim;
            $registro->update();
            */
            //todo verificar para salvar usuario modificacao
            $data = HorarioAgenda::updateAll(['dt_inicio' => $dataAlt, 'hr_inicio' => $horaIni, 'hr_fim' => $horaFim], 'id = '.$id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionJsoncalendar($id = -1, $exibe = 'false') {
        if (Yii::$app->user->id) {
            $nomeProfissional = '';
            if ($id == -1) {
                $prof = Profissional::find()->select(['id_profissional', 'nm_profissional'])->orderBy('nm_profissional ASC')->limit(1)->one();
                $id = $prof->id_profissional;
                $nomeProfissional = $prof->nm_profissional;
            }else{
                $prof = Profissional::find()->select(['nm_profissional'])->where(['id_profissional' => $id])->orderBy('nm_profissional ASC')->limit(1)->one();
                $nomeProfissional = $prof->nm_profissional;
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // $times = \app\modules\timetrack\models\Timetable::find()->where(array('category'=>\app\modules\timetrack\models\Timetable::CAT_TIMETRACK))->all();
            if ($exibe == 'false') {
                $data = date('Y-m-d');
                $data = date('Y-m-d', strtotime('-30 days', strtotime($data)));
                $listaHorarios = HorarioAgenda::find()->select(['id', 'id_aluno', 'nome', 'telefone', 'ds_agendamento',
                            'tp_agendamento', 'hr_inicio', 'hr_fim', 'dt_inicio', 'id_profissional', 'ds_cor', 'ds_usuario_modificacao','status', 'dt_modificacao'])->where(['id_profissional' => $id])->andFilterCompare('dt_inicio', $data, '>')->all();
            } else {
                $listaHorarios = HorarioAgenda::find()->select(['id', 'id_aluno', 'nome', 'telefone', 'ds_agendamento',
                            'tp_agendamento', 'hr_inicio', 'hr_fim', 'dt_inicio', 'id_profissional', 'ds_cor', 'ds_usuario_modificacao', 'status', 'dt_modificacao'])->where(['id_profissional' => $id])->all();
            }
           // var_dump($listaHorarios);
            $listaParaExibicao[] = array();

            foreach ($listaHorarios as $horario) {
                $verificaPrimeiroHorario = 0;
                $horarioAux = new Event();
                if ($horario->id_aluno != null) {                 
                    $horarioAux->id = $horario->id;
                    $horarioAux->title = $horario->aluno->nm_aluno;
                    $horarioAux->idAluno = $horario->id_aluno;
                    $horarioAux->numero = $horario->aluno->ds_whatsapp;
                    if($horario->aluno->convenio != null){
                     $horarioAux->convenio = $horario->aluno->convenio->ds_nome;
                    }else{
                        $horarioAux->convenio = "Não há";
                    }
                } else {
                    $horarioAux->id = $horario->id;
                    $horarioAux->title = $horario->nome;
                    $horarioAux->numero = $horario->telefone;
                    $horarioAux->convenio = "Não há";
                }
                $horarioAux->status = $horario->status;
                $horarioAux->usuarioModificacao = $horario->ds_usuario_modificacao;
                $teste = new DateTime($horario->dt_modificacao);
                $horarioAux->dataModificacao = $teste->format('d/m/Y H:i:s');
                // $dateobject = new DateTime( $event->dt_inicio . '' . $event->hr_inicio );                        
                $horarioAux->start = $horario->dt_inicio . ' ' . $horario->hr_inicio;
                $horarioAux->end = $horario->dt_inicio . ' ' . $horario->hr_fim;
                $horarioAux->description = $horario->tp_agendamento;
                $horarioAux->profissional = $nomeProfissional;//$horario->profissional->nm_profissional;
                $horarioAux->backgroundColor = $horario->ds_cor;
                $horarioAux->color = $horario->ds_cor;
                $horarioAux->justificativa = $horario->ds_agendamento;
                //$horarioAux->descricao = $horario->ds_descricao;
                //$horarioAux->objetivo = $horario->ds_objetivo;

                $horarioAux->nome = $horario->nome;
                $horarioAux->telefone = $horario->telefone;
                if ($horarioAux->backgroundColor == null) {
                    if ((strtotime($horarioAux->end) > strtotime(date('Y-m-d H:i')))) {
                        if ($horarioAux->description == "fisioterapia") {
                            //COR AZUL
                            $horarioAux->color = '#00BFFF';
                            $horarioAux->backgroundColor = '#00BFFF';
                        } else {
                            if(strpos( $horarioAux->convenio, "UBS" ) !== false){
                                //COR PINK
                                $horarioAux->color = '#F3B1D6';
                                $horarioAux->backgroundColor = '#F3B1D6';
                            }else{
                                //COR BRANCA
                                $horarioAux->color = '#FFFAFA';
                                $horarioAux->backgroundColor = '#FFFAFA';
                            }
                        }
                        $horarioAux->textColor = 'black';
                    } else {
                        if($horarioAux->justificativa == null){
                            //HORARIO PENDENTE DE AÇÃO - COR AZUL
                            $horarioAux->color = '#1797f7';
                            $horarioAux->backgroundColor = '#1797f7';
                        }else{
                            //HORARIO VENCIDO COM NAO COMPARECEU - COR VERMELHA
                            $horarioAux->color = '#8B0000';
                            $horarioAux->backgroundColor = '#8B0000';
                        }
                    }
                }
                foreach ($listaHorarios as $itemHorario) {
                    if ($horarioAux->idAluno == $itemHorario->id_aluno) {
                        $verificaPrimeiroHorario++;
                    }
                }
                if ($verificaPrimeiroHorario == 1 && (strtotime($horarioAux->end) > strtotime(date('Y-m-d H:i')))
                ) {
                    //PRIMEIRO HORARIO - COR ROXA
                    $horarioAux->color = '#993399';
                    $horarioAux->backgroundColor = '#993399';
                }
                $listaParaExibicao[] = $horarioAux;
            }

            return $listaParaExibicao;
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDadosAgenda($idAluno) {
        if (Yii::$app->user->id) {
            $listaHorario = HorarioAgenda::find()->select(['id_aluno', 'id_profissional', 'dt_inicio', 'ds_agendamento', 'ds_descricao', 'ds_objetivo'])->where(['id_aluno' => $idAluno])->andWhere(['not', ['ds_agendamento' => NULL]])->orderBy('dt_inicio')->all();
             $listaParaExibicao = null; 
            foreach ($listaHorario as $item) {
                $item->nome = $item->profissional->nm_profissional;
                $listaParaExibicao[] = $item;
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $listaParaExibicao;
            //echo \yii\helpers\Json::encode($lista);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDadosAluno($idAluno) {
        if (Yii::$app->user->id) {

            $data = Aluno::findOne($idAluno);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDadosConvenio($id) {
        if (Yii::$app->user->id) {

            $data = \app\models\Convenio::findOne($id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
            // echo \yii\helpers\Json::encode($data);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDadosAvaliacao($id) {
        if (Yii::$app->user->id) {

            // $aluno = Aluno::findOne($idAluno);
            $i = 0;
            $listaAvaliacao[] = array();
            $avaliacaoAcademia = Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoHipopressivo = \app\models\AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoColuna = \app\models\AvaliacaoColuna::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoInferior = \app\models\AvaliacaoInferior::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoSuperior = \app\models\AvaliacaoSuperior::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoVestibular = \app\models\AvaliacaoVestibular::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            $avaliacaoFacial = \app\models\AvaliacaoFacial::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
            if ($avaliacaoAcademia != null) {
                foreach ($avaliacaoAcademia as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id_avaliacao;
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação da academia";
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacao/view&id=' . $value->id_avaliacao;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoHipopressivo != null) {
                foreach ($avaliacaoHipopressivo as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id_avaliacao;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação Hipopressivo";
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacao-hipopressivo/view&id=' . $value->id_avaliacao;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoColuna != null) {
                foreach ($avaliacaoColuna as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação de Coluna";
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacaocoluna/view&id=' . $value->id;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoInferior != null) {
                foreach ($avaliacaoInferior as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação Inferior";
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacaoinferior/view&id=' . $value->id;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoSuperior != null) {
                foreach ($avaliacaoSuperior as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id;
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação Superior";
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacaosuperior/view&id=' . $value->id;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoFacial != null) {
                foreach ($avaliacaoFacial as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id;
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação Facial";
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacaofacial/view&id=' . $value->id;
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            if ($avaliacaoVestibular != null) {
                foreach ($avaliacaoVestibular as $value) {
                    $dtoAvaliacao = new DtoAvaliacao();
                    $dtoAvaliacao->dataAvaliacao = $value->dt_avaliacao;
                    $dtoAvaliacao->idAvaliacao = $value->id;
                    $dtoAvaliacao->profissional = $value->profissional->nm_profissional;
                    $dtoAvaliacao->url = '/web/index.php?r=avaliacaovestibular/view&id=' . $value->id;
                    $dtoAvaliacao->tpAvaliacao = "Avaliação Vestibular";
                    $listaAvaliacao[$i] = $dtoAvaliacao;
                    $i++;
                }
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $listaAvaliacao;
            // echo \yii\helpers\Json::encode($listaAvaliacao);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDeleteHorario($id) {
        if (Yii::$app->user->id) {
            $model = HorarioAgenda::findOne($id);
            $idProf = $model->id_profissional;
            $model->delete();
            return $this->redirect(['index', 'id' => $idProf]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDadosProfessor($id) {
        if (Yii::$app->user->id) {
            $data = Profissional::findOne($id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->redirect(['site/about']);
        }
    }

}

class DtoAvaliacao extends Model {

    /**
     * The description text for an event
     * @var string
     */
    public $dataAvaliacao;

    /**
     * The description text for an event
     * @var string
     */
    public $idAvaliacao;

    /**
     * The description text for an event
     * @var string
     */
    public $tpAvaliacao;

    /**
     * The description text for an event
     * @var string
     */
    public $profissional;
    public $url;

}
