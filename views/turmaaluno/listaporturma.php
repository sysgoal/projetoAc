<?php

use app\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);

$css = "
        
table.quotation {
  border: 3px solid #037547;
  border-collapse: collapse;
  margin: 0 auto;
}

.quotation thead,tfoot {
  border-width: 3px;
  border-style: solid;
}

.quotation th,.quotation td{
  border: 1px solid #037547;
  color: #037547;
  padding: 4px 25px;
  width: auto;
}

.quotation thead th,
.quotation tfoot th{
  background-color: #E0EBE3;
}

.quotation tbody td {
  background-color: #FFFBFE;
}
";



$this->registerCss($css);
$alunosPorTurma = $model->getDataListTurmaAlunos($model->id_turma);
/* @var $this yii\web\View */
/* @var $model app\models\TurmaAluno */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
@media print { 
#noprint { display:none; } 
body { background: #fff; }
@page {size: landscape}
}
</style>
<div id="noprint">
<p align = "center">
       <?= Html::a(Yii::t('app','Imprimir'), ['/relatorioturma/relatorioturma', 'id' => $model->id_turma], ['class' => 'btn btn-success', 'style' => 'padding-right:10px;', 'target' =>'_blank']) ?>
           
       
</p>
<?php //Html::buttonInput('Print', ['class' => 'btn btn-success', 'id' => 'imprime',])
  ?>
</div>
<div class="print" id="print">
<table class="quotation">
  <thead>
    <tr>
      <th colspan="15">Turma: <?php echo $model->nm_turma ?> </th>
    </tr>
    <tr>
        <th colspan="15">Data: <b><?php echo date('d/m/Y') ?></b>  Horário:<b> <?php echo $model->hr_inicio?> às <?php echo $model->hr_fim?></b></th>
    </tr>
    <tr>
      <th colspan="15">Professor(es): <?php 
        if($model->profissional2 != null){
            echo $model->profissional->nm_profissional. ' e '.$model->profissional2->nm_profissional;  
        }else{
            echo $model->profissional->nm_profissional;
        }
          ?></th>
    </tr>      
    <th>Número</th>
    <th>Aluno</th>
    <th>Conduta</th>
     <th  colspan="12" style="text-align: center;">Chamada</th> 
  </thead>
  <tbody>    
        <?php 
        $indice = 1;        
            foreach ($alunosPorTurma as $aluno) {              
                $valor = "";                                                      
                echo '<tr>';
                echo '<td style=width:30px>'.$indice.'</td>';
                echo '<td style=width:400px>'.$aluno->aluno->nm_aluno.'</td>';    
                echo '<td style=width:400px>'.$valor.'</td>';
                for($i = 0; $i<12; $i++){
                    echo '<td style=width:10px></td>';
                }
                echo '</tr>';   
                
                $indice++;
            }
         ?>             
  </tbody>
  <tfoot>
    <tr >
        <th colspan="15">Academia Harmonia Faz Bem - <?php echo date('Y') ?></th>
    </tr>
  </tfoot>
</table>
</div>
<br>
