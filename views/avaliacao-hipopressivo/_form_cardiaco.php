<?php

$script = <<< JS

 $('#dsend').hide();
        
$('#red').click(function() {
   var k =  $('input:radio:checked').val();          
    if (k == "Sim") {
        $('#dsend').show();       
    } else {          
        $('#dsend').hide();
    }
});       

        validaTextArea('endema');
          validaTextArea('medicamento');
          validaTextArea('apacirc');
          validaTextArea('patologia');
          validaTextArea('medico');
          validaTextArea('cirurgia');
 
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
            <?= $form->field($model, 'ds_medico_responsavel')->textInput(['style' => 'width:500px', 'id'=> 'medicoResp']) ?>            
        </div>
        <div class="col-md-6">              
               <?= $form->field($model, 'ds_cirurgia')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'cirurgia']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'ds_anamnese_medico')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'medico']) ?>            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_patologia')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'patologia']) ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-6">
                <?= $form->field($model, 'ds_medicamento')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'medicamento']) ?>
            </div>
         <div class="col-md-6">
              <?= $form->field($model, 'ds_aparelho_circ')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'apacirc']) ?>
         </div>
    </div>

</div>
<br>