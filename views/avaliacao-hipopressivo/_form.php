<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$script = <<< JS
       
   $('#idade').hide();
                
   validaTextArea('motivo');
 
        function validaTextArea(nomeId){
          
            let contador = 0;
            $('#'+nomeId+'').keyup(function(e){             
            if (e.keyCode != 13){
                contador++;            
            }
            if(contador >= 43 && e.keyCode == 32){
           $('#'+nomeId+'').val($('#'+nomeId+'').val()+'\\n');
             contador = 0;
            }
        });
        }  


JS;
$this->registerJs($script);
?>
<br>
<div class="avaliacao-form">

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

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dt_avaliacao')->textInput(['style' => 'width:200px', 'value' => date('d/m/Y'), 'readonly' => true]) ?>            
        </div>
        <div class="col-md-6">
     
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
             <?php 
                if($idAluno != null){
                    $alunos = $model->getDadoUmAluno($idAluno);
                }else{
                   $alunos = $model->getDataListAluno();
                }
            ?>

            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione um paciente-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>     
        </div>
        <div class="col-md-2">
            <?php echo '<b>Idade: </b><br>'; ?> 
            <div id ="txt"></div>
            <?= $form->field($model, 'ds_idade_atual')->textInput(['style' => 'width:500px', 'id'=> 'idade'])->label(false) ?>            
        </div>
        <div class="col-md-2">
            <?php echo '<b>Profissão: </b><br>'; ?>  
            <div id ="prof"></div>
        </div>  
         <div class="col-md-2">
             <div id="botao"></div>            
 	
        </div>  
    </div>

    <div class="row">
       
        <div class="col-md-6">
           <?= $form->field($model, 'ds_motivo')->textarea(['style' => 'width:500px','rows' => 3, 'id'=>'motivo']) ?>
        </div>
       
    </div>

</div>


    <div class="row">
        
        <div class="col-md-6">
           <?= $form->field($model, 'image1')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'image2')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
            </div>
<div class="row">
        <div class="col-md-6">
           <?= $form->field($model, 'image3')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'image4')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
        </div>
<div class="row">
        <div class="col-md-6">
           <?= $form->field($model, 'image5')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'image6')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
        </div>
<div class="row">
        <div class="col-md-6">
           <?= $form->field($model, 'image7')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'video')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['avi', 'mkv', 'rmvb', 'mp4', 'AVI', 'RMVB', 'MKV', 'MP4']]]); ?>
        </div>
        <div class="col-md-6">
         <?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $model->getAvaliador($idProf)->id_profissional])->label(false) ?>
        </div>
    </div>
