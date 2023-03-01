<?php

namespace app\models;

use Yii;
use TCPDF;

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
        $image_file = Yii::$app->basePath . '/web/images/harmonia.png';
        $this->Image($image_file, 10, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
    }

    public function geraTabelaTouca($pdf, $listaBoletim, $touca, $atv1, $atv2, $atv3, $atv4, $atv5, $eixoX, $eixoY) {

        $cont = 0;
        //linha de datas
        foreach ($listaBoletim as $item) {
            if ($item->ds_cor_touca == $touca) {
                $cont++;
                $pdf->MultiCell(26.8, 7, $item->data, 1, 'L', 0, 0, '', '', true);
            }
        }
        for ($i = $cont; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
        $pdf->Ln(7);

        //linha de atividades  1                      
        $pdf->MultiCell(30, 7, $atv1, 1, 'L', 1, 0, '', '', true);


        for ($i = 0; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
        $pdf->Ln(7);
        //linha de atividades  2   
        $pdf->MultiCell(30, 7, $atv2, 1, 'L', 1, 0, '', '', true);

        for ($i = 0; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
        $pdf->Ln(7);

        //linha de atividades  3  
        $pdf->MultiCell(30, 7, $atv3, 1, 'L', 1, 0, '', '', true);


        for ($i = 0; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
        $pdf->Ln(7);

        //linha de atividades 4   
        $pdf->MultiCell(30, 7, $atv4, 1, 'L', 1, 0, '', '', true);
        for ($i = 0; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
        $pdf->Ln(7);

        //linha de atividades  5  

        $pdf->MultiCell(30, 7, $atv5, 1, 'L', 1, 0, '', '', true);
        for ($i = 0; $i < 5; $i++) {
            $pdf->MultiCell(26.8, 7, '', 1, 'L', 0, 0, '', '', true);
        }
       // $pdf->Ln(7);


        $x = $eixoX;
        $y = $eixoY;
        $cont = 0;
        $pos = 0;

        //imagem branca em todas as celulas
        //primeira linha de pexinho
        foreach ($listaBoletim as $item) {
            if ($item->ds_cor_touca == $touca) {
                if($touca == "Polimento"){
                    
                    /*$pdf->MultiCell(20, 7, $item->caixa1, 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $item->caixa2, 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $item->caixa3, 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $item->caixa4, 1, 'L', 1, 0, '', '', true);
                    $pdf->MultiCell(20, 7, $item->caixa5, 1, 'L', 1, 0, '', '', true);
                    */
                    if($item->caixa1 != null){
                        $y = $y + 5.5;
                        $pdf->writeHTMLCell(10, 0, $x, $y, $item->caixa1, 0, 1, 0, true, 'L');    
                    }
                    if($item->caixa2 != null){
                        $y = $y + 7;
                        $pdf->writeHTMLCell(10, 0, $x, $y, $item->caixa2, 0, 1, 0, true, 'L');    
                    }
                    if($item->caixa3 != null){
                        $y = $y + 7;
                        $pdf->writeHTMLCell(10, 0, $x, $y, $item->caixa3, 0, 1, 0, true, 'L');    
                    }
                    if($item->caixa4 != null){
                        $y = $y + 7;
                        $pdf->writeHTMLCell(10, 0, $x, $y, $item->caixa4, 0, 1, 0, true, 'L');    
                    }
                    if($item->caixa5 != null){
                        $y = $y + 7;
                        $pdf->writeHTMLCell(10, 0, $x, $y, $item->caixa5, 0, 1, 0, true, 'L');    
                    }
                        $y = $eixoY;
                        $x = $x + 27;
                    
                    
                }else{
                    $cont = 1;
                    $image_file = '';
                    if ($item->peixe1 == "Ouro") {
                        $image_file = Yii::$app->basePath . '/web/images/ouro.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe1 == "Prata") {
                        $image_file = Yii::$app->basePath . '/web/images/prata.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    } if ($item->peixe2 == "Ouro") {
                        $image_file = Yii::$app->basePath . '/web/images/ouro.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    } if ($item->peixe2 == "Prata") {
                        $image_file = Yii::$app->basePath . '/web/images/prata.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe3 == "Ouro") {
                        $image_file = Yii::$app->basePath . '/web/images/ouro.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe3 == "Prata") {
                        $image_file = Yii::$app->basePath . '/web/images/prata.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    } if ($item->peixe4 == "Ouro") {
                        $image_file = Yii::$app->basePath . '/web/images/ouro.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    } if ($item->peixe4 == "Prata") {
                        $image_file = Yii::$app->basePath . '/web/images/prata.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    } if ($item->peixe5 == "Ouro") {
                        $image_file = Yii::$app->basePath . '/web/images/ouro.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $eixoY;
                        $x = $x + 27;
                    } if ($item->peixe5 == "Prata") {
                        $image_file = Yii::$app->basePath . '/web/images/prata.png';
                        $pdf->SetXY($x, $y);

                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $eixoY;
                        $x = $x + 27;
                    } if ($item->peixe1 == null) {
                        $image_file = Yii::$app->basePath . '/web/images/naoFez.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe2 == null) {
                        $image_file = Yii::$app->basePath . '/web/images/naoFez.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe3 == null) {
                        $image_file = Yii::$app->basePath . '/web/images/naoFez.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                    $y = $y + 7.3;
                    }if ($item->peixe4 == null) {
                        $image_file = Yii::$app->basePath . '/web/images/naoFez.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $y + 7.3;
                    }if ($item->peixe5 == null) {
                        $image_file = Yii::$app->basePath . '/web/images/naoFez.png';
                        $pdf->SetXY($x, $y);
                        $pdf->Image($image_file, '', '', 14, 14, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
                        $y = $eixoY;
                        $x = $x + 27;
                    }
            }
            }
        }
    }
    
    public function geraTabelaEvolucao($pdf){
            $pdf->SetFont('helvetica', '', 15);
            $pdf->MultiCell(32, 7, '', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(66, 7, 'FEMININO', 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(66, 7, 'MASCULINO', 1, 'C', 1, 0, '', '', true);
            $pdf->Ln(7);// QUEBRA DE CELULA
            //TOTAL DA LINHA TEM QUE SER 164, DIVIDO ISSO PELA QTDE DE COLUNAS QUE QUERO
            $pdf->SetFont('helvetica', '', 12);
            $pdf->MultiCell(32, 7, 'IDADE', 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(33, 7, 'PESO', 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(33, 7, 'ALTURA', 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(33, 7, 'PESO', 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(33, 7, 'ALTURA', 1, 'C', 1, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '01', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '7800-12000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '70-81', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '7800-13100', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '71-83', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '02', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '9900-16700', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '83-95', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '10000-16800', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '83-96', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '03', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '10900-20100', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '89-115', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '11500-19000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '89-104', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '04', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '12000-23000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '97-118', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '13000-22000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '95-113', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '05', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '13000-29000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '102-120', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '13000-26000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '100-120', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '06', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '14000-30000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '107-127', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '14000-29000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '106-126', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '07', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '15000-34000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '112-134', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '15000-33000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '113-134', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '08', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '16000-37000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '117-139', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '16000-38000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '118-139', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '09', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '17000-42000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '122-145', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '17000-43000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '122-145', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '10', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '20000-46000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '127-150', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '18000-48000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '125-151', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '11', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '22000-47000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '132-157', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '19000-52000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '129-156', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '12', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '25000-56000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '136-162', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '22000-58000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '133-161', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '13', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '29000-61000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '143-167', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '24000-63000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '139-167', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '14', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '33000-65000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '146-172', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '30000-69000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '146-175', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            
            $pdf->MultiCell(32, 7, '15', 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '36000-78000', 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(33, 7, '154-182', 1, 'C', 0, 0, '', '', true);
            $pdf->Ln(7);
            $pdf->SetFont('times', '', 9);
            $pdf->Write(0, 'Fonte: Crescimento e Desenvolvimento Pubertário em Crianças e Adolescentes', '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Brasileiros - Marques, R.M.; Marcondes, E.;Berquô, E.; Prandi, R. & Yunes, J.', '', 0, 'L', true, 0, false, false, 0);
    }

}
