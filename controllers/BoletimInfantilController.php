<?php

namespace app\controllers;

use Yii;
use app\models\BoletimInfantil;
use app\models\BoletimInfantilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Aluno;
use app\models\MYPDF;
use app\models\AvaliacaoInfantil;
use DateTime;

/**
 * BoletimInfantilController implements the CRUD actions for BoletimInfantil model.
 */
class BoletimInfantilController extends Controller {

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
     * Lists all BoletimInfantil models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new BoletimInfantilSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }
    
     public function actionBoletim() {
        if (Yii::$app->user->id) {
            $searchModel = new BoletimInfantilSearch();
            $dataProvider = $searchModel->searchBoletim(Yii::$app->request->queryParams);

            return $this->render('boletim', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Displays a single BoletimInfantil model.
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
     * Creates a new BoletimInfantil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new BoletimInfantil();
            $model2 = new AvaliacaoInfantil();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model = new BoletimInfantil();
                $model2 = new AvaliacaoInfantil();
                 return $this->render('create', [
                        'model' => $model, 
                        'model2' => $model2, 
                        'situacao' =>'cadastradoT',
                ]);
            }
            if ($model2->load(Yii::$app->request->post()) && $model2->save()) {
                $model = new BoletimInfantil();
                $model2 = new AvaliacaoInfantil();
                 return $this->render('create', [
                        'model2' => $model2, 
                        'model' => $model,
                        'situacao' =>'cadastradoA',
                ]);                          
                 //$this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model, 
                        'situacao' => 'novo',
                        'model2' => $model2,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Updates an existing BoletimInfantil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->id) {
            $model = $this->findModel($id);
            $dateFesta = DateTime::createFromFormat('d/m/Y', $model->data);
            $model2 = AvaliacaoInfantil::find()->where(['id_aluno' => $model->id_aluno])->andWhere(['data'=>Yii::$app->formatter->asDate($dateFesta, 'php:Y-m-d')])->one();

             if($model == null && $model2 == null){
                $searchModel = new BoletimInfantilSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }
            if($model != null){
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                     $model = new BoletimInfantil();
                     $model2 = new AvaliacaoInfantil();
                     return $this->render('create', [
                            'model2' => $model2, 
                            'model' => $model,
                            'situacao' =>'cadastradoT',
                    ]);      
                }
            }
            
            if($model2 != null){
                if ($model2->load(Yii::$app->request->post()) && $model2->save()) {
                    $model = new BoletimInfantil();
                    $model2 = new AvaliacaoInfantil();
                    return $this->render('create', [
                           'model2' => $model2, 
                           'model' => $model,
                           'situacao' =>'cadastradoA',
                   ]);      
               }
            }

            if($model == null){
               $model = new BoletimInfantil();
            }
            if($model2 == null){
                $model2 = new AvaliacaoInfantil();
            }
            return $this->render('update', [
                        'model' => $model,
                        'situacao' =>'',
                        'model2' => $model2,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Deletes an existing BoletimInfantil model.
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
     * Finds the BoletimInfantil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BoletimInfantil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BoletimInfantil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBoletimInfantil($id) {
        if (Yii::$app->user->id) {

            $aluno = Aluno::findOne($id);
            $listaBoletim = BoletimInfantil::find()->where(['id_aluno' => $id])->orderBy('data')->all();
            $listaAvaliacao = AvaliacaoInfantil::find()->where(['id_aluno' => $id])->orderBy('data')->all();


            $nomeProfessor = '';

            if ($aluno === null) {
                throw new NotFoundHttpException;
            }

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($aluno->nm_aluno);
            $pdf->SetTitle('Boletim do aluno');
            $pdf->SetSubject('academia harmonia');
            $pdf->SetKeywords('harmonia, PDF, aluno, dados');

// set default header data
            //  $pdf->SetHeaderData('harmonia.png', 40);
            // echo Yii::getAlias('@web') .'/images/harmonia.png';
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
            
            
            
            $pdf->AddPage();
            
            $pdf->SetFont('times', '', 12);
            $pdf->Write(0, 'ACADEMIA HARMONIA LTDA.', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, 'TABELA DE EVOLUÇÃO PONDO-ESTATURAL (PESO-ALTURA).', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(7);
            $pdf->SetFillColor(255, 255, 200);
            $pdf->geraTabelaEvolucao($pdf);
            
            $pdf->AddPage();

            $pdf->SetFont('helvetica', '', 15);
            $pdf->Write(0, 'Rua Félix Francisco Chamon, 550 ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, 'Vera Cruz (Riacho) - Contagem - MG ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, 'FONE: (31) 3392-5013 ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(35);
            $pdf->SetFont('helvetica', '', 25);
            $pdf->Write(0, 'BOLETIM DO ALUNO ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', '', 15);
            $pdf->Write(0, 'BB, INFANTIL, JUVENIL ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(25);
            $pdf->SetFont('helvetica', '', 18);
            $pdf->Write(0, 'FESTA DAS TOUCAS', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, 'MARÇO - JULHO - NOVEMBRO', '', 0, 'C', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '', 13);
            $pdf->Write(0, '(Nos meses acima você fará um teste de ', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Write(0, 'Aprendizado e uma Avaliação Fisioterápica)', '', 0, 'C', true, 0, false, false, 0);
           
            $pdf->Ln(60);

            $pdf->SetFont('helvetica', '', 18);

// set color for background
            $pdf->SetFillColor(255, 255, 200);

            $nome = 'Nome : ' . $aluno->nm_aluno;
            $dataMatricula = 'Data da Matrícula: ' . $aluno->dt_registro;
            $dataNascimento = 'Data de Nascimento: ' . $aluno->dt_nascimento;
            $pdf->Write(0, $nome, '', 0, 'L', true, 0, false, false, 0);
            //  $pdf->Write(104, 7, $nome, 1, 'L', 0, 0, '', '', true);       
            $pdf->Write(0, $dataMatricula, '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, $dataNascimento, '', 0, 'L', true, 0, false, false, 0);
           
            $pdf->AddPage();

          
            
            $pdf->SetFont('times', '', 12);
            $pdf->MultiCell(164, 7, 'AVALIAÇÃO POSTURAL BIOMÉTRICA', 1, 'C', 1, 0, '', '', true);
            $pdf->SetFont('times', '', 9);
            $pdf->Ln(7);
            $pdf->MultiCell(20, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(20, 7, 'IDADE', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(20, 7, 'PESO', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(20, 7, 'ALTURA', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(20, 7, 'ABDOM', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(20, 7, 'FLEX', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(28, 7, 'POSTURA', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(16, 7, 'OBS', 1, 'L', 1, 0, '', '', true);
            $pdf->Ln(7);
            $val = 1;
            $comentarioObs = 'Observações: ';
            $auxCont = 0;
            foreach ($listaAvaliacao as $aval1) {
                $auxCont++;
                if($auxCont < 23){
                    $pdf->MultiCell(20, 7, $aval1->data, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $aval1->idade, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $aval1->peso, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $aval1->altura, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $aval1->abdomem, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $aval1->flexao, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(28, 7, $aval1->postura, 1, 'L', 0, 0, '', '', true);
                    if($aval1->observacao != null){
                        $pdf->MultiCell(16, 7, $val.' Sim', 1, 'L', 0, 0, '', '', true);
                        $comentarioObs = $comentarioObs.' '.$val.' '.$aval1->observacao.'.  ';
                        $val++;
                    }else{
                        $pdf->MultiCell(16, 7, $aval1->observacao, 1, 'L', 0, 0, '', '', true);
                    }
                    $pdf->Ln(7);
                }else{
                    $pdf->AddPage();
                    $auxCont = 0;
                }
            }
           // $pdf->Ln(7);
            $pdf->Write(0, 'Controle da evolução Pondo-Estatural: Padrão de referência do NCHS '
                    . '(aceito pela Organização Mundial da Saúde).', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Departamento de Pediatria - FMUSP', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Abdominal - força muscular abdominal avaliada segundo Daniels/Worthingham.', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Flexibilidade - medida no flexômetro - muscular posterior', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Coordenação - Dra. Yara Gandra - CREFITO MG4/3873 - CREF 006359-G/MG', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, '                        Dra. Mayra Gandra - CREFITO F-77127', '', 0, 'L', true, 0, false, false, 0);
            $pdf->MultiCell(164, 7, 'O teste dos peixinhos foi criado em 1990 por Yara Gandra e visa demonstrar a cronologia '
                    . 'e progressão do aprendizado dos alunos das turmas BB e Juvenil na área de Natação, dentro da Academia Harmonia.', 1, 'L', 0, 0, '', '', true);
            //24
            
            $pdf->MultiCell(167, 7, $comentarioObs, 0, 'L', 0, 0, 20, 250, true);
          //  $pdf->AddPage();
            //touca polimento
           
            $toucaPolimento = FALSE;
            $toucaAzul = FALSE;
            $toucaAmarela = FALSE;
            $toucaVerde = FALSE;
            $toucaCinza = FALSE;
            $toucaBranca = FALSE;
            $toucaPreta = FALSE;
            foreach ($listaBoletim as $item) {
                if ($item->ds_cor_touca == "Polimento" ) {
                    $toucaPolimento = TRUE;
                }
                if($item->ds_cor_touca == "Azul"){
                    $toucaAzul = TRUE;
                }
                if($item->ds_cor_touca == "Amarela"){
                    $toucaAmarela = TRUE;
                }
                if($item->ds_cor_touca == "Verde"){
                    $toucaVerde = TRUE;
                }
                if($item->ds_cor_touca == "Cinza"){
                    $toucaCinza = TRUE;
                }
                if($item->ds_cor_touca == "Branca"){
                    $toucaBranca = TRUE;
                }
                if($item->ds_cor_touca == "Preta"){
                    $toucaPreta = TRUE;
                }
            }
            if($toucaPolimento){
                $pdf->AddPage();
                 $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);

                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE TREINAMENTO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA POLIMENTO', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);
                //$pdf->SetFont('times', '', 9);
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Polimento', 'Mergulho 25m', 'Borboleta 3"',
                        'Costas 3"', 'Peito 3"', 'Crawl 3"', 55, 70.5);
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'Em cada data você tem a metragem conseguida em 3 minutos do nado. Observe: Você está progredindo?', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca AMARELA', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Ln(20);
                
            }
            if($toucaAzul){
                //touca azul
                $pdf->AddPage();
                $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA AZUL', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);            
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->SetFont('times', '', 8);
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Azul', 'Passar na ducha sozinho', 
                        'Entra na piscina alegre', 'Pula de bóia com ajuda', 'Molha o rosto', 
                        'Cata bichos com bóia', 55, 70.5);            
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca AMARELA', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Ln(20);
                
            }
            if($toucaAmarela){
                //touca amarela
                $pdf->AddPage();
                $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA AMARELA', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->SetFont('times', '', 8);                      
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Amarela', 'Pula sem ajuda', 
                        'Pega objetos no fundo da piscina', 'Faz borbolhas', 'Flutuação horizontal', 
                        'Pernada com prancha 25m', 55, 70.5);
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca VERDE', '', 0, 'L', true, 0, false, false, 0);                
                $pdf->Ln(20);       
            }
                if($toucaVerde){
                  //touca verde
                    $pdf->AddPage();
                    $pdf->SetFont('helvetica', '', 18);
                 $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                 $pdf->SetFont('helvetica', '', 15);
                 $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                 $pdf->Ln(5);
                 $pdf->SetFont('times', '', 8);
                 $pdf->MultiCell(30, 7, 'TOUCA VERDE', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);            
                 $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                 $pdf->Ln(7);
                 $pdf->SetFont('times', '', 9);
                 $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                 $pdf->SetFont('times', '', 8);
                 $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Verde', 'Nado livre 25m', 'Desliza sobre a água',
                         'Nada cahorrinho 25m', 'Passa debaixo da perna', 'Braçada e pernada com prancha', 55, 70.5);            
                 $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca BRANCA', '', 0, 'L', true, 0, false, false, 0);                
                $pdf->Ln(20);            
            }
            if($toucaBranca){ 
            //touca branca
                $pdf->AddPage();
                $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA BRANCA', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->SetFont('times', '', 8);
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Branca', 'Mergulho com deslocamento 10m', 
                        'Crawl com prancha 50m', 'Flutuação dorsal', 'Crawl completo 25m', 
                        'Saída de ponta', 55, 70.5);
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca CINZA', '', 0, 'L', true, 0, false, false, 0);                
                $pdf->Ln(20);         
            }
                //touca 

            if($toucaCinza){
                $pdf->AddPage();
                $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA CINZA', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);          
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->SetFont('times', '', 8);              
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Cinza', 'Mergulho profundo 15m', 
                        'Rolamento à frente/trás', 'Saída e 50m de Crawl', 'Saída e 50m de Costas', 
                        'Virada simples Crawl/Costas', 55, 70.5);   
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca PRETA', '', 0, 'L', true, 0, false, false, 0);                
                $pdf->Ln(20);         
            }
            
            if($toucaPreta){
                $pdf->AddPage();
                $pdf->SetFont('helvetica', '', 18);
                $pdf->Write(0, 'FESTA DAS TOUCAS - TESTE DOS PEIXINHOS', '', 0, 'C', true, 0, false, false, 0);
                $pdf->SetFont('helvetica', '', 15);
                $pdf->Write(0, 'TESTE DE ADAPTAÇÃO - NATAÇÃO', '', 0, 'C', true, 0, false, false, 0);
                $pdf->Ln(5);
                $pdf->SetFont('times', '', 8);
                $pdf->MultiCell(30, 7, 'TOUCA PRETA', 1, 'L', 1, 0, '', '', true, '', true, '', '', '', true);          
                $pdf->MultiCell(134, 7, 'DATAS', 1, 'C', 1, 0, '', '', true);
                $pdf->Ln(7);
                $pdf->SetFont('times', '', 9);
                $pdf->MultiCell(30, 7, 'Atividades', 1, 'L', 1, 0, '', '', true);
                $pdf->SetFont('times', '', 8);                    
                $pdf->geraTabelaTouca($pdf, $listaBoletim, 'Preta', 'Mergulho profundo 20m', 
                        'Saída e 50m Borboleta', 'Saída/Filipina e 50m Peito', '50m Costas com virada', 
                        '50m de Crawl com Virada Olímpica', 55, 70.5);   
                $pdf->Ln(10);
                $pdf->SetFont('times', '', 9);
                $pdf->Write(0, 'PEIXINHO OURO: Você foi ótimo - PEIXINHO PRATA: Você precisa treinar mais.', '', 0, 'L', true, 0, false, false, 0);
                $pdf->Write(0, 'COM 5 OURO (na mesma data): Você passou para touca POLIMENTO', '', 0, 'L', true, 0, false, false, 0);                
                $pdf->Ln(20);       
              
            }
                
            

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

}
