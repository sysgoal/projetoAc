<?php

namespace app\controllers;

use Yii;
use app\models\Relatorio;
use app\models\RelatorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MYPDF;
use DateTime;
use app\models\Aluno;

/**
 * RelatorioController implements the CRUD actions for Relatorio model.
 */
class RelatorioController extends Controller {

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
     * Lists all Relatorio models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new RelatorioSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionBioimpedanciapdf($id = -1) {
        if ($id != -1) {

            $aluno = Aluno::find()->where(['ds_chave_acesso' => $id])->one();
            $model = new \app\models\Avaliacao();
            if($aluno == null){
                 return $this->redirect(['site/about']);
            }

            return $this->render('bioimpedanciapdf', [
                        'id' => $aluno->id,
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single Relatorio model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->id) {
            return $this->redirect(['relatorioinformativo', 'target' => '_blank',
                        'id' => $id]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Creates a new Relatorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new Relatorio();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['relatorioinformativo',
                            'id' => $model->id]);
                //return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing Relatorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['relatorioinformativo',
                            'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing Relatorio model.
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
     * Finds the Relatorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relatorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Relatorio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRelatorioalunoindividual($id = 3) {
        if (Yii::$app->user->id) {
            $aluno = Aluno::findOne($id);
            if ($aluno === null) {
                throw new NotFoundHttpException;
            }

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($aluno->nm_aluno);
            $pdf->SetTitle('Dados do Aluno');
            $pdf->SetSubject('academia harmonia');
            $pdf->SetKeywords('harmonia, PDF, aluno, dados');

// set default header data
            $pdf->SetHeaderData('harmonia.png', 40);

// set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(20, 40, 20);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// ---------------------------------------------------------
// set font
            $pdf->SetFont('helvetica', '', 14);
// add a page
            $pdf->AddPage();

            if ($aluno->fl_paciente === '1') {
                $usuario = 'Paciente';
            } else {
                $usuario = 'Aluno';
            }
            $pdf->Write(0, 'Informações do ' . $usuario, '', 0, 'C', true, 0, false, false, 0);

            $pdf->Ln(5);

            $pdf->SetFont('times', '', 9);

//$pdf->SetCellPadding(0);
//$pdf->SetLineWidth(2);
// set color for background
            $pdf->SetFillColor(255, 255, 200);

            $nome = 'Nome : ' . $aluno->nm_aluno;
            $dataNascimento = 'Data de Nascimento: ' . $aluno->dt_nascimento;
            //calculo de idade
            $dtNasc = $aluno->dt_nascimento;

            $dataConv = str_replace("/", "-", $dtNasc);
            $dataConv = date('Y-m-d', strtotime($dataConv));
            //echo $dataConv;
            $date = new DateTime($dataConv);

            $interval = $date->diff(new DateTime(date('d-m-Y')));
            $x = $interval->format('%m');

            if ($x === '1') {
                $mes = $interval->format('%Y anos e %m mês');
            } else if ($x === '0') {
                $mes = $interval->format('%Y anos');
            } else {
                $mes = $interval->format('%Y anos e %m meses');
            }

            $idade = 'Idade: ' . $mes;
            $sexo = 'Sexo: ' . $aluno->ds_sexo;
            $cpf = 'CPF: ' . $aluno->ds_cpf;
            $identidade = 'Identidade: ' . $aluno->ds_identidade;
            $responsavel = 'Responsável: ' . $aluno->ds_responsaveis;


// print some rows just as example
            // Multicell test
            $pdf->MultiCell(164, 7, $nome, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(54, 7, $dataNascimento, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(56, 7, $idade, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(54, 7, $sexo, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(82, 7, $cpf, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(82, 7, $identidade, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(164, 7, $responsavel, 1, 'L', 0, 0, '', '', true);


            $pdf->Ln(15);

            $pdf->SetFont('helvetica', '', 14);

            $pdf->Write(0, 'Endereço', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(5);

            $pdf->SetFont('times', '', 9);

            $endereco = 'Endereço: ' . $aluno->ds_endereco;
            $cidade = 'Cidade: ' . $aluno->ds_cidade;
            $estado = 'Estado: ' . $aluno->ds_estado;
            $cep = 'Cep: ' . $aluno->ds_cep;
            $telefone = 'Telefone: ' . $aluno->ds_telefone1;
            $zap = 'WhastsApp: ' . $aluno->ds_whatsapp;
            $email = 'E-mail:' . $aluno->ds_email;

            $pdf->MultiCell(164, 7, $endereco, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(70, 7, $cidade, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(44, 7, $estado, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(50, 7, $cep, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(82, 7, $telefone, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(82, 7, $zap, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(164, 7, $email, 1, 'L', 0, 0, '', '', true);


            $pdf->Ln(15);

            $pdf->SetFont('helvetica', '', 14);

            $pdf->Write(0, 'Demais Informações', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(5);

            $pdf->SetFont('times', '', 9);

            $profissao = 'Profissão: ' . $aluno->ds_profissao;
            $observacao = 'Observação: ' . $aluno->ds_observacao;

            $pdf->MultiCell(164, 7, $profissao, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(164, 7, $observacao, 1, 'L', 0, 0, '', '', true);

            $pdf->Ln(15);

            $pdf->SetFont('helvetica', '', 14);

            $pdf->Write(0, 'Tipo de Consulta', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(5);

            $pdf->SetFont('times', '', 9);
            if ($aluno->id_convenio <> null) {
                $convenio = 'Convênio: ' . $aluno->id_convenio;
            } else {
                $convenio = 'Convênio: Não se aplica';
            }
            $matricula = 'Matrícula: ' . $aluno->nr_matricula_conv;
            $validade = 'Validade: ' . $aluno->dt_validade;
            if ($aluno->profissional <> null) {
                $profissional = 'Profissionail: ' . $aluno->profissional->nm_profissional;
            }

            $pdf->MultiCell(70, 7, $convenio, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(44, 7, $matricula, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(50, 7, $validade, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            if ($aluno->profissional <> null) {
                $pdf->MultiCell(164, 7, $profissional, 1, 'L', 0, 0, '', '', true);
            }




            //   $pdf->MultiRow('Row ' . ($i + 1), $idade . "\n");
// reset pointer to the last page
            $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
            $pdf->Output($aluno->nm_aluno . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionRelatorioalunoavaliacao($id = 5) {
        if (Yii::$app->user->id) {

            // chart.getImageURI();// passar o retorno dessa funcao para um hidden ou algo do tipo
// usando fdpf para gerar o pdf com a imagem
            $pic = $string_js_base64;

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(40, 10, 'Hello Image!');
            $pdf->Image($pic, 10, 30, $tamanho, $largura, 'png');
            $pdf->Output('tmp/doc.pdf');
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionRelatorioinformativo($id) {
        if (Yii::$app->user->id) {
            $model = $this->findModel($id);
            $aluno = $model->aluno;
            if ($aluno === null) {
                throw new NotFoundHttpException;
            }

            $nomeProf = $model->profissional->nm_profissional;
            $tipoRegistro = $model->profissional->tp_registro;
            $nrRegistro = $model->profissional->nr_registro;
            $descricao = $model->ds_relatorio;

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($aluno->nm_aluno);
            $pdf->SetTitle('Dados do Aluno');
            $pdf->SetSubject('academia harmonia');
            $pdf->SetKeywords('harmonia, PDF, aluno, dados');

// set default header data
            $pdf->SetHeaderData('harmonia.png', 40);

// set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(20, 40, 20);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// set font
            $pdf->SetFont('helvetica', '', 16);
// add a page
            $pdf->AddPage();

            $pdf->Write(0, 'Relatório', '', 0, 'C', true, 0, false, false, 0);

            $pdf->Ln(5);

            $pdf->SetFont('times', '', 12);


            $pdf->SetFillColor(255, 255, 200);
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            // $atual = utf8_encode(strftime('%d de %B de %Y', strtotime($model->dt_relatorio)));
            //$html = '<br>Contagem ' .date('d', $model->dt_relatorio). 'de '.date('B', $model->dt_relatorio). 'de '. date('Y', $model->dt_relatorio) . '.<br>';
            $date = DateTime::createFromFormat('d/m/Y', $model->dt_relatorio);
            $teste = Yii::$app->formatter->asDate($date, 'php:Y-m-d');
            $atual = utf8_encode(strftime('%d de %B de %Y', strtotime($teste)));
            $html = '<br>Contagem ' . $atual . '.<br>';
            $oa = $aluno->ds_sexo == 'Masculino' ? 'O': 'A';
            $html .= '<br>'.$oa.' paciente ' . $aluno->nm_aluno . ', ' . $aluno->getIdade() . ' anos, ' .nl2br($descricao) ;

            $html .= '<div style="text-align: center;"><br><br><br><br><br> ___________________________ </div> ';
            $html .= '<div style="text-align: center;">' . $nomeProf . '<br>' . $tipoRegistro . ': ' . $nrRegistro . '</div>';

            $pdf->writeHTML($html, false, false, true, false, '');

            $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
            $pdf->Output($aluno->nm_aluno . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionFichaAluno($id = 5) {
        if (Yii::$app->user->id) {
            $ficha = \app\models\FichaAluno::findOne($id);
            if ($ficha === null) {
                throw new NotFoundHttpException;
            }
            $turma = \app\models\TurmaAluno::find()->where(['id_aluno' => $ficha->id_aluno])->limit(1)->one();
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($ficha->aluno->nm_aluno);
            $pdf->SetTitle('Dados do Aluno');
            $pdf->SetSubject('academia harmonia');
            $pdf->SetKeywords('harmonia, PDF, aluno, dados');

// set default header data
            $pdf->SetHeaderData('harmonia.png', 40);

// set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetMargins(20, 40, 20);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// ---------------------------------------------------------
// set font
            $pdf->SetFont('helvetica', '', 14);
// add a page
            $pdf->AddPage();

            $pdf->Write(0, 'Ficha de Exercícios', '', 0, 'C', true, 0, false, false, 0);

            $pdf->Ln(1);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->Write(0, 'HOFI® - Hidroginástica Orientada por Fichas Individuais', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(1);

            $pdf->SetFont('helvetica', '', 8);
            $pdf->Write(0, 'Criado por: Yara Gandra (Fisioterapeuta/Educadora Física)', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(1);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Write(0, 'Reavaliar Janeiro/Maio/Setembro', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(5);
            $pdf->SetFont('times', '', 13);

            $pdf->SetFillColor(255, 255, 200);

// print some rows just as example
            // Multicell test
            $pdf->MultiCell(129, 7, 'Nome: ' . $ficha->aluno->nm_aluno, 1, 'L', 0, 0, '', '', true);

            $pdf->MultiCell(35, 7, 'Data: ' . $ficha->dt_ficha, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(118, 7, 'Profissional: ' . $ficha->profissional->nm_profissional, 1, 'L', 0, 0, '', '', true);
            if ($turma != null) {
                $pdf->MultiCell(46, 7, 'Turma: ' . $turma->turma->nm_turma, 1, 'L', 0, 0, '', '', true);
            } else {
                $pdf->MultiCell(46, 7, 'Turma: Não se aplica', 1, 'L', 0, 0, '', '', true);
            }




            $pdf->Ln(7);

            /*  $pdf->SetFont('helvetica', '', 14);

              $pdf->Write(0, 'Atividades', '', 0, 'C', true, 0, false, false, 0);
              $pdf->Ln(5);
             */
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->MultiCell(12, 7, 'Nº', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(128, 7, 'Descrição das atividades', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(24, 7, 'Repetições', 1, 'L', 0, 0, '', '', true);
            $pdf->SetFont('times', '', 13);
            for ($cont = 1; $cont < 19; $cont++) {
                $texto = 'exercicio' . $cont;
                $texto2 = 'nr_repeticao' . $cont;
                if ($ficha->$texto != null) {
                    $pdf->Ln(7);
                    $pdf->MultiCell(12, 7, $cont, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(128, 7, $ficha->$texto->nm_exercicio, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(24, 7, $ficha->$texto2 . ' X', 1, 'L', 0, 0, '', '', true);
                }
            }

            $pdf->Ln(5);


            $pdf->lastPage();
            $pdf->Output($ficha->aluno->nm_aluno . '.pdf', 'I');
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
