<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$script = <<< JS
           
        validaTextArea('obstren');
        validaTextArea('obspat');
        validaTextArea('obsgil');
        validaTextArea('conduta');
        validaTextArea('exame');
        validaTextArea('obstho');
        validaTextArea('obsdor');
        validaTextArea('obsvaro');
        validaTextArea('obsvalgo');
        validaTextArea('obsclac');
        validaTextArea('obspos');
        validaTextArea('obsant');
        validaTextArea('obsaple');
        validaTextArea('obsquad');
        validaTextArea('obsober');
 
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

<div class="avaliacao-inferior-form">

    <br>
    <div class="row">
        <div class="col-md-6">
            <?php $loc = array('Positivo' => 'Positivo', 'Negativo' => 'Negativo') ?>
            <?= $form->field($model, 'ds_trendelenburg')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_trendelenburg')->textarea(['style' => 'width:500px', 'id' => 'obstren']) ?>              
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_patrick')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_patrick')->textarea(['style' => 'width:500px', 'id' => 'obspat']) ?>                          
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_gillet')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_gillet')->textarea(['style' => 'width:500px', 'id' => 'obsgil']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_ober')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_ober')->textarea(['style' => 'width:500px', 'id' => 'obsober']) ?>                                
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_teste_rigidez_quadril')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_teste_rigidez_quadril')->textarea(['style' => 'width:500px', 'id' => 'obsquad']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_teste_apley')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_teste_apley')->textarea(['style' => 'width:500px', 'id' => 'obsaple']) ?>                             
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'ds_gaveta_anterior')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_gaveta_anterior')->textarea(['style' => 'width:500px', 'id' => 'obsant']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_gaveta_posterior')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_gaveta_posterior')->textarea(['style' => 'width:500px', 'id' => 'obspos']) ?>                                
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_teste_clarke')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_teste_clarke')->textarea(['style' => 'width:500px', 'id' => 'obsclac']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_estresse_valgo')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_estresse_valgo')->textarea(['style' => 'width:500px', 'id' => 'obsvalgo']) ?>                                
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_estresse_varo')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_estresse_varo')->textarea(['style' => 'width:500px', 'id' => 'obsvaro']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_adm_dorsiflexao')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_adm_dorsiflexao')->textarea(['style' => 'width:500px', 'id' => 'obsdor']) ?>                                
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_teste_thompson')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_teste_thompson')->textarea(['style' => 'width:500px', 'id' => 'obstho']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_exames_complementares')->textarea(['style' => 'width:500px', 'rows' => 6, 'id' => 'exame']) ?>   
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_conduta')->textarea(['style' => 'width:500px', 'rows' => 4, 'id' => 'conduta']) ?>    
        </div>
        <div class="col-md-6">
            <?php $items = ['Em andamento' => 'Em andamento', 'Concluída' => 'Concluída']; ?>
            <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
        </div>
    </div>

</div>


<br>
<div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
</div>
