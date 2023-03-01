<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;


$script = <<< JS


        validaTextArea('conduta');
        validaTextArea('obspiri');
        validaTextArea('obssubir');
        validaTextArea('obswil');
        validaTextArea('obsmack');
        validaTextArea('obsgilet');
        validaTextArea('obsesfig');
        validaTextArea('obsslump');
        validaTextArea('obsdis');
        validaTextArea('obscomp');
        validaTextArea('exames');
 
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

<div class="avaliacao-coluna-form">
   
    <br>
    <div class="row">
        <div class="col-md-6">
            <?php $loc = array('Positivo' => 'Positivo', 'Negativo' => 'Negativo') ?>
            <?= $form->field($model, 'ds_compressao')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_compressao')->textarea(['style' => 'width:500px', 'id'=>'obscomp']) ?>              
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_distracao')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_distracao')->textarea(['style' => 'width:500px','id'=>'obsdis']) ?>                          
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_slump')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_slump')->textarea(['style' => 'width:500px','id'=>'obsslump']) ?>                             
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_esfigmomanometro')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_esfigmomanometro')->textarea(['style' => 'width:500px', 'id'=>'obsesfig']) ?>                                
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_gillet')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_gillet')->textarea(['style' => 'width:500px','id'=>'obsgilet']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_mackenzie')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_mackenzie')->textarea(['style' => 'width:500px', 'id'=>'obsmack']) ?>                                   
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_william')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_william')->textarea(['style' => 'width:500px', 'id'=>'obswil']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_subirdescer')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_subirdescer')->textarea(['style' => 'width:500px', 'id'=>'obssubir']) ?>                                
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ds_piriforme')->radioList($loc) ?>	              
                <?= $form->field($model, 'ds_obs_piriforme')->textarea(['style' => 'width:500px', 'id'=>'obspiri']) ?>                                    
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'ds_exames_complementares')->textarea(['style' => 'width:500px', 'rows' => 6, 'id'=>'exames']) ?>    
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ds_conduta')->textarea(['style' => 'width:500px', 'rows' => 4, 'id'=>'conduta']) ?>   
            </div>
            
        <div class="col-md-6">
            <?php $items = ['Em andamento' => 'Em andamento', 'Concluída' => 'Concluída']; ?>
            <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
        </div>
  
        </div>    


    </div>
    <div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>