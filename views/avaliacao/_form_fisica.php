<?php
use yii\helpers\Html;
$script = <<< JS
        
$('#dsinco').hide();
$('#inco').click(function() {
   var x =  $('#inco input:radio:checked').val();        
    if (x == "Sim") {
        $('#dsinco').show();       
    } else {          
        $('#dsinco').hide();
    };
});
        
    $('#peso').blur(function() { 
         let j =  $('#peso').val().replace(",", "."); 
         $('#peso').val(j);
    });
        
    $('#altura').blur(function() { 
        var valAltura = $('#altura').val().replace(',','.');
        $('#altura').val(valAltura);
        //formatando altura com ponto
        if(valAltura.indexOf('.') == -1){      
           let valAlturaFormatado = valAltura.substr(0,1)+'.'+valAltura.substr(1);       
           $('#altura').val(valAlturaFormatado);
        }
        let valPeso = $('#peso').val();
        let valAltura2 = $('#altura').val();
        let conta = valPeso/(valAltura2 * valAltura2);
        let resultadoImc = parseFloat(conta.toFixed(1));
        $('#imc').val(resultadoImc);
   });
  
   $('#cintura').blur(function() {  
       var l =  $('#cintura').val().replace(",", ".");
       $('#cintura').val(l);
   });
        
    $('#quadril').blur(function() {  
        var m =  $('#quadril').val().replace(",", "."); 
        $('#quadril').val(m);
    }); 

        validaTextArea('conduta');
        validaTextArea('postural');
     
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
<div class="row">
    <div class="col-md-6">                     
        <?= $form->field($model, 'ds_avaliacao_postural')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'postural']) ?>	            
    </div>
    <div class="col-md-3">    
        <?= $form->field($model, 'ds_braco_de')->textInput(['id'=>'bracod']) ?>      
    </div>
    <div class="col-md-3">  
        <?= $form->field($model, 'ds_torax_abm')->textInput(['id'=> 'torax']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">        
        <?= $form->field($model, 'ds_cintura')->textInput(['id'=> 'cintura']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ds_quadril_culote')->textInput(['id'=> 'quadril']) ?>
    </div>
    <div class="col-md-3">             
        <?= $form->field($model, 'ds_coxa_de')->textInput(['id'=> 'coxa']) ?>
    </div>
    <div class="col-md-3"> 
        <?= $form->field($model, 'ds_panturrilha_de')->textInput(['id'=>'panturrilha']) ?>       

    </div>
</div>
<div class="row">


    <div class="col-md-6">
        <?php $lista2 = ['-F' => '-F', 'F' => 'F', '-B' => '-B', 'B' => 'B', '+B' => '+B', 'OT' => 'OT']; ?>
        <?= $form->field($model, 'ds_abdominal')->inline()->radioList($lista2) ?> 

    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'ds_pa')->textInput(['id' =>'pa']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ds_peso')->textInput(['id' => 'peso']) ?>          
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ds_altura')->textInput(['id' => 'altura']) ?> 
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'ds_flexibilidade')->textInput(['id'=>'flex']) ?>  
    </div>
 <?= $form->field($model, 'ds_imc')->hiddenInput(['id' => 'imc'])->label(false) ?> 
</div>
<div class="row">
 <div class="col-md-6">
            <?= $form->field($model, 'ds_conduta')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'conduta']) ?>
        </div>
    <div class="col-md-3">
        <?php $items = ['Em andamento'=>'Em andamento','Concluída'=>'Concluída']; ?>
        <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
    </div>
</div>

<br> 
<div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success', 'id'=>'salvar']) ?>
    </div>