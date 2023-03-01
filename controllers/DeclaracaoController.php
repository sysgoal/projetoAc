<?php

namespace app\controllers;

use Yii;
use app\models\Aluno;
use app\models\Turma;
use app\models\AlunoSearch;
use app\models\Declaracao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use TCPDF;

/**
 * TurmaalunoController implements the CRUD actions for TurmaAluno model.
 */
class DeclaracaoController extends Controller {

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

    public function actionGetProfissional($id) {
        if (Yii::$app->user->id) {
            $data = \app\models\Profissional::findOne($id);


            echo \yii\helpers\Json::encode($data);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Lists all TurmaAluno models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionDeclaracao($id, $dataDeclaracao, $horaInicio, $horaFim) {
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
            $pdf->SetHeaderData('img_declaracao.jpeg', 40);

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

            $pdf->Write(0, 'Declaração', '', 0, 'C', true, 0, false, false, 0);

            $pdf->Ln(5);

            $pdf->SetFont('times', '', 12);

//$pdf->SetCellPadding(0);
//$pdf->SetLineWidth(2);
// set color for background

            $pdf->SetFillColor(255, 255, 200);

            $html = '<h1></h1>
         <table>
         <tbody>';
            $html .= '<tr>Declaro para os devidos fins que ' . $aluno->nm_aluno . ', esteve em tratamento nesta clínica no dia ' . $dataDeclaracao . ', das ' . $horaInicio . ' às ' . $horaFim;
            $html .= ' <br><br> Atenciosamente ';

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
     * Creates a new TurmaAluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->id) {
            $aluno = new Aluno();
            $model = new Declaracao();
            if ($model->load(Yii::$app->request->post())) {
                return $this->redirect(['/declaracao/declaracao', 'id' => $model->nm_aluno,
                            'nomeProf' => $model->nm_profissional,
                            'dataDeclaracao' => $model->data,
                            'horaInicio' => $model->horainicio,
                            'horaFim' => $model->horafim,
                            'tipoRegistro' => $model->tp_registro,
                            'nrRegistro' => $model->nr_registro]);
            }


            return $this->render('create', [
                        'model' => $model,
                        'aluno' => $aluno,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    /**
     * Finds the TurmaAluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TurmaAluno the loaded model
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

    public function actionListaturma() {
        if (Yii::$app->user->id) {
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams);

            return $this->render('listaturma', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionListaporturma($id) {
        if (Yii::$app->user->id) {
            return $this->render('listaporturma', [
                        'model' => Turma::findOne($id),
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

}

class MYPDF extends TCPDF {

    public function MultiRow($left, $right) {
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)

        $page_start = $this->getPage();
        $y_start = $this->GetY();

        // write the left cell
        $this->MultiCell(40, 0, $left, 1, 'R', 1, 2, '', '', true, 0);

        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();

        $this->setPage($page_start);

        // write the right cell
        $this->MultiCell(0, 0, $right, 1, 'J', 0, 1, $this->GetX(), $y_start, true, 0);

        $page_end_2 = $this->getPage();
        $y_end_2 = $this->GetY();

        // set the new row position by case
        if (max($page_end_1, $page_end_2) == $page_start) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 == $page_end_2) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 > $page_end_2) {
            $ynew = $y_end_1;
        } else {
            $ynew = $y_end_2;
        }

        $this->setPage(max($page_end_1, $page_end_2));
        $this->SetXY($this->GetX(), $ynew);
    }

    public function Header() {
        // Logo
        $image_file = Yii::$app->basePath . '/web/images/img_declaracao.png';
        $this->Image($image_file, 10, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
    }
    
     public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Rua Felix Francisco Chamon, 550 A - Jardim Vera Cruz, - Contagem/MG - (31) 3392-5013', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

