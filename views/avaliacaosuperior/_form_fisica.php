<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoColuna */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
        
$('#dslocomocao').hide();
$('#locomocao').click(function() {
    var k = $( "#locomocao input:checked" ).val();
        p = document.getElementById('dslocomocao').value;
        if(typeof p === 'undefined'){
        alert(k);
            document.getElementById('dslocomocao').value = k;
        }else{
          document.getElementById('dslocomocao').value = k + ": ";
        }            
    if(k != null){
        $('#dslocomocao').show();
    }else{
        $('#dslocomocao').hide();
    }
});

        validaTextArea('postural');
        validaTextArea('movimentacao');        
        
 
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
                <?= $form->field($model, 'ds_avaliacao_postural')->textarea(['style' => 'width:500px','rows' => 6, 'id'=>'postural']) ?>
        </div>
        <div class="col-md-6">
              <?php $loc = array('Marcha alterada' => 'Marcha alterada', 'Claudicante' => 'Claudicante', 
            'C/Auxílio' => 'C/Auxílio') ?>
            <?= $form->field($model, 'ds_locomocao')->radioList($loc, ['id' => 'locomocao']) ?>	              
            <?= $form->field($model, 'ds_locomocao')->textInput(['id' => 'dslocomocao', 'style' => 'width:500px'])->label(false) ?>        

        </div>
                <div class="col-md-6">
              <?php $loc = array('Normal' => 'Normal', 'Alterado' => 'Alterado') ?>
            <?= $form->field($model, 'ds_reu')->radioList($loc, ['id' => 'locomocao']) ?>	              
                

        </div>
    </div>
     <div class="row">
        <div class="col-md-6">           
                <?= $form->field($model, 'ds_movimentacao_ativa')->textarea(['style' => 'width:500px','rows' => 6, 'id'=>'movimentacao']) ?>
        </div>
     </div>


</div>