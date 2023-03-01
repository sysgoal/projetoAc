<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$script = <<< JS

     
$('#dsatv').hide();
$('#dsdor').hide();        
$('#alco').hide();
        
$('#atv').click(function() {
   var x =  $('#atv input:radio:checked').val();        
    if (x == "Ativo") {
        $('#dsatv').show();       
    } else {          
        $('#dsatv').hide();
    };
});
        
$('#dor').click(function() {
   var y =  $('#dor input:radio:checked').val();           
    if (y == "Sim") {
        $('#dsdor').show();        
    } else {   
        $('#dsdor').hide();                
    };
});
     
$('#alcool').click(function() {
   var y =  $('#alcool input:radio:checked').val();           
    if (y == "Sim") {
        $('#alco').show();        
    } else {   
        $('#alco').hide();                
    };
});
           
        validaTextArea('digestivo');
 
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

    <div class="row">
        <div class="col-md-3">                
            <?php $accountStatus = array('Sim' => 'Sim', 'Não' => 'Não') ?>
            <?= $form->field($model, 'fl_restricao', ['options'=>['id'=>'rest']])->radioList($accountStatus) ?>	            
            

        </div>
        <div class="col-md-6">
               <?= $form->field($model, 'nr_refeicoes_dia')->textarea(['rows'=> 3,'style' => 'width:500px', 'id'=> 'nrRefeicao']) ?>
        </div>  
    </div>
    <div class="row">
         <div class="col-md-3">   
             <br>             
            <?php $accs = array('Regular' => 'Regular', 'Preso' => 'Preso', 'Solto'=>'Solto') ?>
            <?= $form->field($model, 'ds_intestino', ['options'=>['id'=>'intest']])->radioList($accs) ?>	            
        </div>   
         <div class="col-md-6">
          <?= $form->field($model, 'nr_litros_agua_dia')->textarea(['rows'=> 3, 'style' => 'width:500px', 'id' => 'nrAgua']) ?>

        </div>      
    </div>
    <div class="row">
         <div class="col-md-3">   
             <br>             
            <?php $acc2 = array('Sim' => 'Sim', 'Não' => 'Não') ?>
            <?= $form->field($model, 'ds_alcool', ['options'=>['id'=>'alcool']])->radioList($acc2) ?>	            
        </div>   
         <div class="col-md-6">
          <?= $form->field($model, 'ds_acool', ['options' => ['id' => 'alco']])->textInput(['style' => 'width:300px', 'id' =>'consumoAlcool']) ?>

        </div>      
    </div>
    <div class="row">
        <div class="col-md-6">  
        <?= $form->field($model, 'ds_comentario_disgestivo')->textarea(['style' => 'width:500px', 'id'=>'digestivo']) ?>
        </div></div>
</div>
    <br>
