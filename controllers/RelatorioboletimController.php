<?php

namespace app\controllers;

use app\models\Aluno;
use app\models\TurmaAluno;
use Yii;
use app\models\TesteHofi;
use app\models\TestePilates;
use app\models\Avaliacao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;

use app\models\MYPDF;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class RelatorioboletimController extends Controller {

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
            'orientation' => Pdf::ORIENT_PORTRAIT,
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


    public function actionRelatorioboletim($id) {
         if (Yii::$app->user->id) {
        
        $aluno = Aluno::findOne($id);      
        $turma = TurmaAluno::find()->where(['id_aluno' => $id])->orderBy('id DESC')->limit(1)->one();       
        $hofi = TesteHofi::find()->where(['id_aluno' => $id])->orderBy('dt_teste')->all();
        $pilates = TestePilates::find()->where(['id_aluno' => $id])->orderBy('dt_teste')->all();
        $avaliacao = Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao')->all();
        $nomeTurma = '';
        $nomeProfessor = '';
        
          if($turma != null && $turma->turma != null){           
            $nomeTurma = $turma->turma->nm_turma;
            $nomeProfessor = $turma->turma->profissional->nm_profissional;
        }
        
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
       //$url = Yii::$app->basePath . '/web/images/harmonia.png';
       //$url = str_replace('\\', '/', $url);
        //$PDF_HEADER_LOGO ='harmonia.png';
        //$pdf->SetHeaderData($PDF_HEADER_LOGO, 40);
        
       // echo Yii::getAlias('@web') .'/images/harmonia.png';
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(20, 40, 20);
//, 'Academia Harmonia Faz Bem','(31) 3392-5013'       
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);     
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// ---------------------------------------------------------
// set font
        
// add a page
        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);     
    
        $pdf->Write(0, '(31) 3392-5013 ', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('helvetica', '', 14);
        $pdf->Write(0, 'Boletim do Aluno ', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Ln(2);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Write(0, '    HOFI®      NATAÇÃO     PILATES ', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, '  (01/05/09)    (04/08/12)      (02/06/10) ', '', 0, 'C', true, 0, false, false, 0);
        $pdf->Ln(5);

        $pdf->SetFont('times', '', 9);

        $pdf->SetFillColor(255, 255, 200);

        $nome = 'Nome : ' . $aluno->nm_aluno;
        $dataMatricula = 'Data da Matrícula: ' . $aluno->dt_registro;
        $professor = 'Professor: ' .$nomeProfessor ;
        $turma = 'Turma: '.$nomeTurma;

        $pdf->MultiCell(104, 7, $nome, 1, 'L', 0, 0, '', '', true);
        $pdf->MultiCell(60, 7, $dataMatricula, 1, 'L', 0, 0, '', '', true);
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, $turma, 1, 'L', 0, 0, '', '', true);
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, $professor, 1, 'L', 0, 0, '', '', true);
        $pdf->Ln(7);        
        $pdf->MultiCell(40, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(124, 7, 'Objetivo do aluno', 1, 'L', 1, 0, '', '', true);  
        $pdf->Ln(7);
         foreach ($avaliacao as $aval6) {                
             if ($aval6->ds_motivo != null) {
                    $pdf->Ln(1);
                    $pdf->MultiCell(40, 7, $aval6->dt_avaliacao, 1, 'L', 0, 0, '', '', true);
                    $pdf->MultiCell(124, 7, $aval6->ds_motivo, 1, 'L', 0, 2, '', '', true, '', true);             
                }
            }
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, 'Avaliação Fisioterápica', 1, 'C', 2, 0, '','', true);  
        $pdf->Ln(7);
        $pdf->MultiCell(24, 7, 'DATA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'ALTURA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'PESO', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'IMC', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'P.A', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'ABD', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(25, 7, 'FLEX', 1, 'C', 0, 0, '', '', true);
        
       // $pdf->Ln(7);
        foreach ($avaliacao as $aval7) {
            if (!($aval7->ds_altura == null && $aval7->ds_peso == null && $aval7->ds_imc == null && $aval7->ds_pa == null && $aval7->ds_abdominal == null && $aval7->ds_flexibilidade == null)) {
                   $pdf->Ln(7);
                    $pdf->MultiCell(24, 7, $aval7->dt_avaliacao, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval7->ds_altura , 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval7->ds_peso, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval7->ds_imc, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval7->ds_pa, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval7->ds_abdominal, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(25, 7, $aval7->ds_flexibilidade, 1, 'C', 0, 0, '', '', true);                    
                }
            }
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, 'Biometria', 1, 'C', 2, 0, '','', true); 
        $pdf->Ln(7);
        $pdf->MultiCell(26, 7, 'DATA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'BRAÇO', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'TORAX', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'ABDO', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'QUAD', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'COXA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(23, 7, 'PERNA', 1, 'C', 0, 0, '', '', true);
       // $pdf->Ln(7);
        foreach ($avaliacao as $aval5) {
                if (!($aval5->ds_cintura == null && $aval5->ds_braco_de == null && $aval5->ds_torax_abm == null && $aval5->ds_quadril_culote == null && $aval5->ds_coxa_de == null && $aval5->ds_panturrilha_de == null)) {
                    $pdf->Ln(7);
                    $pdf->MultiCell(26, 7, $aval5->dt_avaliacao, 1, 'C', 0, 0, '', '', true);                
                    $pdf->MultiCell(23, 7, $aval5->ds_braco_de, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval5->ds_torax_abm , 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval5->ds_cintura , 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval5->ds_quadril_culote, 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval5->ds_coxa_de , 1, 'C', 0, 0, '', '', true);
                    $pdf->MultiCell(23, 7, $aval5->ds_panturrilha_de , 1, 'C', 0, 0, '', '', true);
                                      
                }
            }

        
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, '100m NAT./HOFI', 1, 'C', 2, 0, '','', true); 
        $pdf->Ln(7);
        $pdf->MultiCell(41, 7, 'DATA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(41, 7, 'Temp', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(41, 7, 'Nado', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(41, 7, 'Obs', 1, 'C', 0, 0, '', '', true);
        $pdf->Ln(7);
        
        foreach ($hofi as $thofi) {
                $pdf->Ln(1);
                $pdf->MultiCell(41, 7, $thofi->dt_teste, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(41, 7, $thofi->ds_tempo, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(41, 7, $thofi->tp_nado, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(41, 7, $thofi->ds_observacao, 1, 'C', 0, 0, '', '', true);
            }
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, 'TESTE PILATES', 1, 'C', 2, 0, '','', true); 
        $pdf->Ln(7);
        $pdf->MultiCell(24, 7, 'DATA', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, '01', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, '02', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, '03', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, '04', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, '05', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, 'Total', 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(20, 7, 'Obs', 1, 'C', 0, 0, '', '', true);
        $pdf->Ln(7);
        foreach ($pilates as $pil) {
                $pdf->Ln(1);
                $pdf->MultiCell(24, 7, $pil->dt_teste, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_001, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_002, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_003, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_004, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_005, 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, ($pil->ds_005+$pil->ds_004+$pil->ds_003+$pil->ds_002+$pil->ds_001), 1, 'C', 0, 0, '', '', true);
                $pdf->MultiCell(20, 7, $pil->ds_observacao, 1, 'C', 0, 0, '', '', true);
            }
        $pdf->AddPage();
        $pdf->Ln(7);
        $pdf->MultiCell(164, 7, 'HISTÓRICO', 1, 'C', 2, 0, '','', true); 
        $pdf->Ln(7);
        $pdf->MultiCell(32, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(132, 7, 'PATOLOGIAS', 1, 'L', 1, 0, '', '', true);
        $pdf->Ln(7);
        foreach ($avaliacao as $aval1) {
                if ($aval1->ds_patologia != null) {
                    $pdf->Ln(1);
                    $pdf->MultiCell(32, 7, $aval1->dt_avaliacao, 1, 'L', 0, 0, '', '', true, 0);
                    $pdf->MultiCell(132, 7, $aval1->ds_patologia, 1, 'L', 0, 2, '', '', true, '',true);                                   
                }
            }

        
        $pdf->Ln(7);
        $pdf->MultiCell(32, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(132, 7, 'CIRURGIAS', 1, 'L', 1, 0, '', '', true);
        $pdf->Ln(7);
        foreach ($avaliacao as $aval2) {
                if ($aval2->ds_cirurgia != null) {
                    $pdf->Ln(1);
                    $pdf->MultiCell(32, 7, $aval2->dt_avaliacao, 1, 'L', 0, 0, '', '', true, 0);
                    $pdf->MultiCell(132, 7, $aval2->ds_cirurgia, 1, 'L', 0, 2, '', '', true, '',true);
                }
            }
        
        
        $pdf->Ln(7);        
        $pdf->MultiCell(32, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(132, 7, 'MEDICAMENTOS', 1, 'L', 1, 0, '', '', true);
        $pdf->Ln(7);
        foreach ($avaliacao as $aval3) {
                if ($aval3->ds_medicamento != null) {
                    $pdf->Ln(1);
                    $pdf->MultiCell(32, 7, $aval3->dt_avaliacao, 1, 'L', 0, 0, '', '', true, 0);
                    $pdf->MultiCell(132, 7, $aval3->ds_medicamento, 1, 'L', 0, 2, '', '', true, '',true);                   
                }
            }
                
        $pdf->Ln(7);
        $pdf->MultiCell(32, 7, 'DATA', 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(132, 7, 'CONDUTA', 1, 'L', 1, 0, '', '', true);
        $pdf->Ln(7);
        foreach ($avaliacao as $aval4) {
                if ($aval4->ds_conduta != null) {
                    $pdf->Ln(1);
                    $pdf->MultiCell(32, 7, $aval4->dt_avaliacao, 1, 'L', 0, 0, '', '', true, '',true);
                    $pdf->MultiCell(132, 7, $aval4->ds_conduta, 1, 'L', 0, 2, '', '', true, '',true);              
                }
            }
        
        $pdf->Ln(7);
        
        //$pdf->Image('images/image_demo.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
                                             
        //   $pdf->MultiRow('Row ' . ($i + 1), $idade . "\n");
// reset pointer to the last page
        $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
        $pdf->Output($aluno->nm_aluno.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
        } else {
            return $this->redirect(['site/about']);
        }
    }
    

}
