<?php

namespace app\controllers;

use Yii;
use app\models\Aluno;
use app\models\RelatorioInformativo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MYPDF;

/**
 * TurmaalunoController implements the CRUD actions for TurmaAluno model.
 */
class RelatorioinformativoController extends Controller {

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
    public function actionRelatorioinformativo($id, $nomeProf, $tipoRegistro, $nrRegistro, $descricao) {
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

            $atual = utf8_encode(strftime('%d de %B de %Y', strtotime('today')));

            $html = '<br>Contagem ' . $atual . '.<br>';
            $html .= '<br>Informamos que o paciente X' . $aluno->nm_aluno . ', ' .$descricao;



            $html .= '<div style="text-align: center;"><br><br><br><br><br><br><br><br><br><br> ___________________________ </div> ';
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

    public function actionView($id) {
        if (Yii::$app->user->id) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionCreate() {
        if (Yii::$app->user->id) {
            $aluno = new Aluno();
            $model = new RelatorioInformativo();
            if ($model->load(Yii::$app->request->post())) {
                return $this->redirect(['/relatorioinformativo/relatorioinformativo', 'id' => $model->nm_aluno,
                            'nomeProf' => $model->nm_profissional,
                            'tipoRegistro' => $model->tp_registro,
                            'nrRegistro' => $model->nr_registro,
                            'descricao' => $model->descricao]);
            }


            return $this->render('create', [
                        'model' => $model,
                        'aluno' => $aluno,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
