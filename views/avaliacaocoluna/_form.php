<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\jui\Dialog;

?>

<div class="avaliacao-coluna-form">
    <?php
Dialog::begin([
    'id' => 'caixaDialog',
    'clientOptions' => [
        'modal' => false,
        'autoOpen' => false,
        'width' => 300,
        'height' => 320,
        'title' => 'Histórico',
        
        'position' => ['my' => 'right bottom', 'at' => 'right bottom'],        
    ]
]);

echo '<div id =historicos></div>';

Dialog::end();
?>
    <br>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'dt_avaliacao')->textInput(['style' => 'width:200px', 'value' => date('d/m/Y'), 'readonly'=> true]) ?>            
        </div>                
        <div class="col-md-3">            
            <?= $form->field($model, 'cd_avaliacao')->textInput(['style' => 'width:200px']) ?>               
        </div>   
        <div class="col-md-4">
             <?php 
                if($idAluno != null){
                    $alunos = $model->getDadoUmAluno($idAluno);
                }else{
                   $alunos = $model->getDataListAluno();
                }
            ?>
            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 450px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione um paciente-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>              
        </div>
        <div class="col-md-2">
             <div id="botao"></div>            
 	
        </div> 
    </div>
    <div class="row">
        <div class="col-md-2">
            <?php echo '<b>Idade: </b><br>'; ?> 
            <div id ="txt"></div>
        </div>
         <div class="col-md-2">
            <?php echo '<b>Profissão: </b><br>'; ?>  
             <div id ="prof"></div>
        </div>        
         <div class="col-md-2">
            <?= $form->field($model, 'nr_tempo_servico')->textInput(['style' => 'width:100px', 'id'=>'tempoServico']) ?>                         
        </div>
        <div class="col-md-2">
            <?php echo '<b>Convênio: </b><br>'; ?>  
             <div id ="conv"></div>
        </div> 
        <div class="col-md-2">
            <?php echo '<b>Cuidador: </b><br>'; ?>  
             <div id ="cuid"></div>
        </div>
        <div class="col-md-2">
            <?php echo '<b>Parentesco: </b><br>'; ?>  
             <div id ="parente"></div>
        </div>
         
    </div>
    <div class="row">
       
        <div class="col-md-6">
            <?= $form->field($model, 'ds_medico_responsavel')->textInput(['style' => 'width:500px', 'id'=> 'medicoResp']) ?>            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_diagnostico_medico')->textarea(['style' => 'width:500px', 'rows' => 6, 'id'=>'diagnostico']) ?>
        </div>
    </div>
<?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $model->getAvaliador($idProf)->id_profissional])->label(false) ?>
    

</div>
