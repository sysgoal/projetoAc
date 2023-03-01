<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$script = <<< JS
 
        validaTextArea('obsquer');        
        validaTextArea('obspha');    
        validaTextArea('obsquer');    
        validaTextArea('obsult');
        validaTextArea('exame');
        validaTextArea('conduta');
        validaTextArea('obsfeel');
        validaTextArea('obsbi');
        validaTextArea('obsmenor');
        validaTextArea('obsinfra');
        validaTextArea('obssupra');
        validaTextArea('obssub');
        validaTextArea('obsext');
        validaTextArea('obsflex');
        validaTextArea('obsvaro');
        validaTextArea('obsest');
 
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

<div class="avaliacao-superior-form">

    <br>
    <div class="row">
        <div class="col-md-6">
            <?php $loc = array('Positivo' => 'Positivo', 'Negativo' => 'Negativo') ?>
            <?= $form->field($model, 'ds_phalen')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_phalen')->textarea(['style' => 'width:500px', 'id' => 'obspha']) ?>              
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_phalen_invertido')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_phalen_invertido')->textarea(['style' => 'width:500px', 'id' => 'obsinv']) ?>                          
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_de_quervain')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_de_quervain')->textarea(['style' => 'width:500px', 'id' => 'obsquer']) ?>                          
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_ultt')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_observacao_ultt')->textarea(['style' => 'width:500px', 'id' => 'obsult']) ?>                          
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_estresse_valgo')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_estresse_valgo')->textarea(['style' => 'width:500px', 'id' => 'obsest']) ?>                             
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_estresse_varo')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_estresse_varo')->textarea(['style' => 'width:500px', 'id' => 'obsvaro']) ?>                                
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_resistencia_flexao')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_resistencia_flexao')->textarea(['style' => 'width:500px', 'id' => 'obsflex']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_resistencia_extensao')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_resistencia_extensao')->textarea(['style' => 'width:500px', 'id' => 'obsext']) ?>                                
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_subescapular')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_subescapular')->textarea(['style' => 'width:500px', 'id' => 'obssub']) ?>                                
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_supraespinhal')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_supraespinhal')->textarea(['style' => 'width:500px', 'id' => 'obssupra']) ?>                                   
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_infraespinhal')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_infraespinhal')->textarea(['style' => 'width:500px', 'id' => 'obsinfra']) ?>                                   
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_redondo_menor')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_redondo_menor')->textarea(['style' => 'width:500px', 'id' => 'obsmenor']) ?>                                   
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_biceps')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_biceps')->textarea(['style' => 'width:500px', 'id' => 'obsbi']) ?>                                   
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_end_feel')->radioList($loc) ?>	              
            <?= $form->field($model, 'ds_obs_end_feel')->textarea(['style' => 'width:500px', 'id' => 'obsfeel']) ?>                                   
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_conduta')->textarea(['style' => 'width:500px', 'rows' => 4, 'id' => 'conduta']) ?>   
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_exames_complementares')->textarea(['style' => 'width:500px', 'rows' => 6, 'id' => 'exames']) ?>    
        </div>
    </div>
    <div class="row">
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