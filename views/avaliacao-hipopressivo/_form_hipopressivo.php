<?php
use yii\helpers\Html;
$script = <<< JS

$('#salvar').click(function() { 
  
        let varAltura = $('#altura').val();
        let varPeso = $('#peso').val();
        let varImc = $('#imc').val();
        
        if(varAltura.trim() != null && varPeso.trim() != null && (varImc == null || varImc == '' || varImc == 0 ||isNaN(varImc) )){
            alert('Altura e/ou peso possui valor incorreto, corrija-os!');
            return false;
        }
        
  })

      
    $('#peso').blur(function() { 
         let j =  $('#peso').val().replace(",", "."); 
         $('#peso').val(j);
         let valPeso = $('#peso').val();
        let valAltura2 = $('#altura').val();
        let conta = valPeso/(valAltura2 * valAltura2);
        let resultadoImc = parseFloat(conta.toFixed(1));
        $('#imc').val(resultadoImc);
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
     
   var l =  $('#cintura').val().replace(",", ".");
       $('#cintura').val(l);
   var m =  $('#quadril').val().replace(",", "."); 
        $('#quadril').val(m);
        var conta1 = l/m;
       var result2= parseFloat(conta1.toFixed(1));
   $('#rcq').val(result2);
}); 

        validaTextArea('competencia');
        validaTextArea('conduta');
        validaTextArea('postural');
        validaTextArea('dias');
 
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
        <div class="col-md-6">                     
            <?= $form->field($model, 'ds_avaliacao_postural')->textarea(['style' => 'width:550px', 'rows' => 5, 'id'=>'postural']) ?>	             
        </div>   
         
        <div class="col-md-6">
            <?= $form->field($model, 'ds_diastase')->textarea(['style' => 'width:550px', 'rows' => 5, 'id'=>'dias']) ?> 
        </div>       
    </div>



    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_altura')->textInput(['id' => 'altura']) ?> 

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_peso')->textInput(['id' => 'peso']) ?> 
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_massa_gorda')->textInput(['id' =>'mGorda']) ?> 

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_massa_magra')->textInput(['id'=>'mMagra']) ?> 

        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_metabolismo')->textInput(['id'=>'metabolismo']) ?> 

        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_idade')->textInput(['id'=> 'idadeC']) ?> 
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_gordura_visceral')->textInput(['id'=>'visceral']) ?> 
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_10_acima')->textInput(['id'=> '10Acima']) ?> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_5_acima')->textInput(['id'=>'5Acima']) ?> 
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_umbigo')->textInput(['id' => 'cintura']) ?>          
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_5_abaixo')->textInput(['id'=>'5Abaixo']) ?>   
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_10_abaixo')->textInput(['id'=>'10Abaixo']) ?> 
        </div>
    </div>

    <div class="row">
       
        <div class="col-md-3">
            <?= $form->field($model, 'ds_quadril')->textInput(['id' => 'quadril']) ?>          
        </div>

            <div class="col-md-3">
            <?= $form->field($model, 'ds_competencia')->textarea(['id'=> 'competencia', 'rows'=>5]) ?>  
    
        </div>     
        <div class="col-md-3">
            <?= $form->field($model, 'ds_pa')->textInput(['id'=>'pa']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_flexibilidade')->textInput(['id'=>'flex']) ?>  
        </div>
    </div>
    <div class="row">
         <div class="col-md-3">
            <?= $form->field($model, 'ds_imc')->textInput(['id' => 'imc','readonly' => true]) ?> 
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'ds_rcq')->textInput(['id' => 'rcq']) ?> 
        </div>
         <div class="col-md-6">
            <?= $form->field($model, 'ds_conduta')->textarea(['style' => 'width:550px;', 'rows' => 5, 'id'=> 'conduta']) ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-3">
            <?php $items = ['Em andamento' => 'Em andamento', 'Concluída' => 'Concluída']; ?>
            <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
        </div>
    </div>
</div>
<br>
 <div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success', 'id'=>'salvar']) ?>
    </div>


