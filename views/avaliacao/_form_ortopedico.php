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
     
        validaTextArea('dsdor2');
        validaTextArea('atividade');
 
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
            <?php $accountStatus = array('Ativo' => 'Ativo', 'Sedentário' => 'Sedentário') ?>
            <?= $form->field($model, 'ds_ativo_sedentario', ['options'=>['id'=>'atv']])->radioList($accountStatus) ?>	            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_atividade_fisica', ['options'=>['id'=> 'dsatv', 'style' => 'width:500px']])->textarea(['rows' => 5, 'id'=>'atividade']) ?>
        </div>  
    </div>
    <div class="row">
         <div class="col-md-3">   
             <br>             
            <?php $accs = array('Sim' => 'Sim', 'Não' => 'Não') ?>
            <?= $form->field($model, 'fl_dor', ['options'=>['id'=>'dor']])->radioList($accs) ?>	            
        </div>   
         <div class="col-md-6">
            <?= $form->field($model, 'ds_dor', ['options'=>['id'=> 'dsdor','style' => 'width:500px' ]])->textarea(['rows' => 5, 'id'=>'dsdor2']) ?>
        </div>      
    </div>
    
</div>
    <br>
