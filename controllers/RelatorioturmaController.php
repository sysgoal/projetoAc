<?php

namespace app\controllers;

use app\models\Turma;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use Yii;
use app\models\MYPDF;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class RelatorioturmaController extends Controller {

    public $model;

    public function actionReport() {
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportView');

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Moises teste'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
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

    /* public function actionTeste(){

      return $this->render('teste', [
      'model' => $this,
      ]);
      } */

    public function actionRelatorioturma($id) {
        if (Yii::$app->user->id) {
            $turma = Turma::findOne($id);
            if ($turma === null) {
                throw new NotFoundHttpException;
            }

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $alunosPorTurma = $turma->getDataListTurmaAlunos($turma->id_turma);
// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($turma->nm_turma);
            $pdf->SetTitle('Dados da Turma');
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

            $pdf->Write(0, 'Relatório da Turma', '', 0, 'C', true, 0, false, false, 0);
            $pdf->Ln(5);

            $pdf->SetFont('times', '', 14);
            $pdf->SetFillColor(255, 255, 200);

            $nome = 'Turma : ' . $turma->nm_turma;

            $dataInicio = 'Data Inicio : ' . $turma->hr_inicio;
            $dataFim = 'Data Fim : ' . $turma->hr_fim;

            $professor = 'Professor(es): ' . $turma->profissional->nm_profissional;
            if($turma->profissional2 != null){
                $professor = $professor. ' e '.$turma->profissional2->nm_profissional;
            }

            // Multicell test
            $pdf->MultiCell(250, 7, $nome, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(125, 7, $dataInicio, 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(125, 7, $dataFim, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(250, 7, $professor, 1, 'L', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->MultiCell(10, 7, 'Nº', 1, 'L', 2, 0, '', '', true);
            $pdf->MultiCell(100, 7, 'Aluno', 1, 'L', 2, 0, '', '', true);
            $pdf->MultiCell(56, 7, 'Conduta', 1, 'L', 2, 0, '', '', true);
            $pdf->MultiCell(84, 7, 'Frequência', 1, 'L', 2, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->SetFont('times', '', 9);
            $indice = 1;
            foreach ($alunosPorTurma as $aluno) {          
                $descricaoConduta = '';
                if ($aluno != null) {
                    $nomealuno = $aluno->aluno->nm_aluno;
                }

                $pdf->MultiCell(10, 7, $indice, 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(100, 7, $nomealuno, 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(56, 7, $descricaoConduta, 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->MultiCell(7, 7, '', 1, 'L', 0, 0, '', '', true);
                $pdf->Ln(7);
                $indice++;
            }




// print some rows just as example
            //  $pdf->MultiCell(41, 7, $aluno, 1, 'L', 0, 0, '', '', true);
            //    $pdf->MultiCell(41, 7, $valor, 1, 'L', 0, 0, '', '', true);
            //    $pdf->MultiCell(54, 7, $indice, 1, 'L', 0, 0, '', '', true);
            //   $pdf->MultiCell(56, 7, $alunosPorTurma, 1, 'L', 0, 0, '', '', true);
            //    $pdf->MultiCell(54, 7, $valor, 1, 'L', 0, 0, '', '', true);
            //   $pdf->MultiRow('Row ' . ($i + 1), $idade . "\n");
// reset pointer to the last page
            $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
            $pdf->Output($turma->nm_turma . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
