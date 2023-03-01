<?php
$script = <<< JS

        validaTextArea('filhos');          
        validaTextArea('noct');
        validaTextArea('inco');
        validaTextArea('sex');
 
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
        <?= $form->field($model, 'nr_filhos')->textarea(['rows' => 5,'style' => 'width:500px', 'id'=>'filhos']) ?>
    </div>
   <div class="col-md-6">           
        <?= $form->field($model, 'ds_sexo')->textarea(['rows' => 5,'style' => 'width:500px', 'id'=>'sex']) ?>
    </div>
   
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'nr_nocturia')->textarea(['rows' => 5,'style' => 'width:500px', 'id'=> 'noc']) ?>        
    </div>
    <div class="col-md-6">           
        <?= $form->field($model, 'ds_incontinencia')->textarea(['rows' => 5,'style' => 'width:500px', 'id'=>'inco']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">        
        <?php $loc2 = array('Esforço' => 'Esforço', 'Urgência' => 'Urgência', 'Mista' => 'Mista') ?>
        <?= $form->field($model, 'fl_incontinencia')->radioList($loc2) ?>	                     
    </div>
    
</div>
<br>