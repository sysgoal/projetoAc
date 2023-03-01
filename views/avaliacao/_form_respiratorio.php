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

$('#cigarro').hide();
$('#cigarro2').hide();        
$('#tmp').hide();      
$('#comentario1').hide();
$('#comentario2').hide();        
        
$('#tabagista').change(function() {
   
    var ccexists = $("#tabagista").prop("checked") ? true : false;
    if (ccexists == true) {
        $('#cigarro').show();
        $('#cigarro2').show();
        $('#comentario1').show();         
        
    } else {  
        $('#cigarro').hide();
        $('#cigarro2').hide();
        $('#comentario1').hide();
    };
});
        
$('#extab').change(function() {
   
    var ccexists = $("#extab").prop("checked") ? true : false;
    if (ccexists == true) {
        $('#tmp').show();
        $('#comentario2').show();
    } else {   
        $('#tmp').hide();        
        $('#comentario2').hide();
    };
});
 
        validaTextArea('respira');
        validaTextArea('dstabagismo');
        validaTextArea('sono');
        validaTextArea('alergia');
 
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
            <?= $form->field($model, 'ds_sono', ['options' => ['style' => 'width:500px']])->textarea(['rows' => 5, 'id'=>'sono']) ?>
        </div>
        <div class="col-md-6">      
            <?= $form->field($model, 'ds_alergia', ['options' => ['style' => 'width:500px']])->textarea(['rows' => 5, 'id'=>'alergia']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">    
            <?= $form->field($model, 'fl_tabagista')->checkbox(['value' => '1', 'id' => 'tabagista']) ?> 
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'nr_cigarro', ['options' => ['id' => 'cigarro', 'style' => 'width:130px']])->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'nr_tempo_tabagismo', ['options' => ['id' => 'cigarro2', 'style' => 'width:140px']])->textInput() ?>
        </div>
        <div class="col-md-6">      
            <?= $form->field($model, 'ds_comentario_tabagismo', ['options' => ['style' => 'width:500px', 'id' => 'comentario1']])->textarea(['rows' => 3, 'id'=>'dstabagismo']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"> 
            <input type="checkbox" id="extab" value="Ex Tabagista?"> Ex tabagista?
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'nr_tempo_ex_tabagismo', ['options' => ['style' => 'width:200px', 'id' => 'tmp']])->textInput() ?>
        </div>
        <div class="col-md-4">      
            <?= $form->field($model, 'ds_comentario_tabagismo', ['options' => ['style' => 'width:500px', 'id' => 'comentario2']])->textarea(['rows' => 3, 'id'=>'dstabagismo']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <br>
            <?= $form->field($model, 'ds_doenca_respiratoria')->textarea(['rows' => 5, 'id'=>'respira', 'style' => 'width:500px' ]) ?>        
        </div>

    </div>
</div>
    <br>

