<?php

use yii\helpers\Html;

$script = <<< JS

       
 $('#cintura').blur(function() {  
     var l =  $('#cintura').val().replace(",", ".");
       $('#cintura').val(l);
   });
   $('#ds_antebraco_d').blur(function() {  
     var l =  $('#ds_antebraco_d').val().replace(",", ".");
       $('#ds_antebraco_d').val(l);
   });
   $('#ds_antebraco_e').blur(function() {  
     var l =  $('#ds_antebraco_e').val().replace(",", ".");
       $('#ds_antebraco_e').val(l);
   });

   $('#ds_braco_relax_d').blur(function() {  
     var l =  $('#ds_braco_relax_d').val().replace(",", ".");
       $('#ds_braco_relax_d').val(l);
   });
   $('#ds_braco_relax_e').blur(function() {  
     var l =  $('#ds_braco_relax_e').val().replace(",", ".");
       $('#ds_braco_relax_e').val(l);
   });
   $('#ds_coxa_med_d').blur(function() {  
     var l =  $('#ds_coxa_med_d').val().replace(",", ".");
       $('#ds_coxa_med_d').val(l);
   });
   $('#ds_coxa_med_e').blur(function() {  
     var l =  $('#ds_coxa_med_e').val().replace(",", ".");
       $('#ds_coxa_med_e').val(l);
   });
   $('#ds_braco_cont_d').blur(function() {  
     var l =  $('#ds_braco_cont_d').val().replace(",", ".");
       $('#ds_braco_cont_d').val(l);
   });
   $('#ds_braco_cont_e').blur(function() {  
     var l =  $('#ds_braco_cont_e').val().replace(",", ".");
       $('#ds_braco_cont_e').val(l);
   });
   $('#ds_panturrilha_d').blur(function() {  
     var l =  $('#ds_panturrilha_d').val().replace(",", ".");
       $('#ds_panturrilha_d').val(l);
   });
   $('#ds_panturrilha_e').blur(function() {  
     var l =  $('#ds_panturrilha_e').val().replace(",", ".");
       $('#ds_panturrilha_e').val(l);
   });

   $('#ds_abdomen').blur(function() {  
     var l =  $('#ds_abdomen').val().replace(",", ".");
       $('#ds_abdomen').val(l);
   });
   $('#ds_ombro').blur(function() {  
     var l =  $('#ds_ombro').val().replace(",", ".");
       $('#ds_ombro').val(l);
   });
   $('#ds_torax').blur(function() {  
     var l =  $('#ds_torax').val().replace(",", ".");
       $('#ds_torax').val(l);
   });
   $('#ds_pescoco').blur(function() {  
     var l =  $('#ds_pescoco').val().replace(",", ".");
       $('#ds_pescoco').val(l);
   });

JS;
$this->registerJs($script);
?>

<br>
<div class="avaliacao-form">

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_antebraco_d')->textInput(['style' => 'width:100px', 'id' => 'ds_antebraco_d']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_antebraco_e')->textInput(['style' => 'width:100px', 'id' => 'ds_antebraco_e']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_braco_relax_d')->textInput(['style' => 'width:100px', 'id' => 'ds_braco_relax_d']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_braco_relax_e')->textInput(['style' => 'width:100px', 'id' => 'ds_braco_relax_e']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_coxa_med_d')->textInput(['style' => 'width:100px', 'id' => 'ds_coxa_med_d']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_coxa_med_e')->textInput(['style' => 'width:100px', 'id' => 'ds_coxa_med_e']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_braco_cont_d')->textInput(['style' => 'width:100px', 'id' => 'ds_braco_cont_d']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_braco_cont_e')->textInput(['style' => 'width:100px', 'id' => 'ds_braco_cont_e']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_panturrilha_d')->textInput(['style' => 'width:100px', 'id' => 'ds_panturrilha_d']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_panturrilha_e')->textInput(['style' => 'width:100px', 'id' => 'ds_panturrilha_e']) ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_abdomen')->textInput(['style' => 'width:100px', 'id' => 'ds_abdomen']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_cintura')->textInput(['style' => 'width:100px', 'id' => 'ds_cintura']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_ombro')->textInput(['style' => 'width:100px', 'id' => 'ds_ombro']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_torax')->textInput(['style' => 'width:100px', 'id' => 'ds_torax']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_pescoco')->textInput(['style' => 'width:100px', 'id' => 'ds_pescoco']) ?>
        </div>
    </div>

</div>