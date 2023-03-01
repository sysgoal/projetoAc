<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoColuna */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS

$('#dsfisioterapia').hide();
$('#dscirurgia').hide();
$("#outros").hide();
$("#outros2").hide();
$("#caracl").hide();
$('#patologia').click(function() {    
   var namesp = $('#patologia input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(namesp.includes(' Outras')){ 
        $("#outros").show();
        $("#outros").val(namesp.replace(' Outras',''));
       // $("#outros").val("");     
       } else {
           $("#outros").val(namesp);              
        }
  });
        
        
$('#hphf').click(function() {    
   var names = $('#hphf input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(names == " Outras atividades"){
        $("#outros2").show();
        $("#outros2").val("");               
        } else {
            $("#outros2").val(names);               
        }
  });

$('#carac').click(function() {    
   var namesc = $('#carac input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(namesc == " Outros"){
         $("#caracl").show(); 
           $("#caracl").val("");                   
        } else {
            $("#caracl").val(namesc);                 
        }
  });

        
$('#cirurgia').click(function() {
    if($('#cirurgia input:checked')){
        $('#dscirurgia').show();
    }
});

   $('#fisioterapia').click(function() {
    if($('#fisioterapia input:checked')){
        $('#dsfisioterapia').show();
    }
});
        
        
$('#cirurgia').click(function() {
    if($('#cirurgia input:checked')){
        $('#dscirurgia').show();
    }
});

   $('#fisioterapia').click(function() {
    if($('#fisioterapia input:checked')){
        $('#dsfisioterapia').show();
    }
});
      
        validaTextArea('queixa');
        validaTextArea('dsfisioterapia');
        validaTextArea('dscirurgia');
        validaTextArea('medicamento');
        validaTextArea('dor');
        validaTextArea('hma');
        validaTextArea('avd');
 
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
            <?= $form->field($model, 'ds_queixa_atual')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'queixa']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_disfuncao_avds')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'avd']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo Html::img(Yii::getAlias('@web') . '/images/dor.jpg', ['width' => 500, 'height' => 150]); ?>
        </div>
        <div class="col-md-6">           
            <?= $form->field($model, 'ds_hma')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'hma']) ?>


        </div>

    </div>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'ds_dor')->textarea(['style' => 'width:500px', 'rows' => 5, 'id'=>'dor']) ?>
        </div>            
        <div class="col-md-6">   
            <br>
            <?= $form->field($model, 'ds_localizacao')->textInput(['style' => 'width:500px']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">                  
            <?php $accountStatus = array('Diária' => 'Diária', 'Semanal' => 'Semanal', 'Quinzenal' => 'Quinzenal', 'Esporádica' => 'Esporádica') ?>
            <?= $form->field($model, 'ds_frequencia_dor')->radioList($accountStatus) ?>	
        </div>
        <div class="col-md-6">                
            <?php $carac = array('Queimação' => 'Queimação', 'Lancinante' => 'Lancinante',
                'Choque' => 'Choque', 'Insuportável' => 'Insuportável', 'Difusa' => 'Difusa', 'Aos esforços' => 'Aos esforços', 'Outros' => 'Outros')
            ?>
            <?= $form->field($model, 'ds_caracteristica_dor')->checkboxList($carac, ['id' => 'carac']) ?>	
            <?= $form->field($model, 'ds_caracteristica_dor')->textInput(['id' => 'caracl', 'style' => 'width:500px'])->label(false) ?>
        </div>
    </div>     

    <div class="row">
        <div class="col-md-6">                
            <?php $pat = array('Cardiopatia' => 'Cardiopatia', 'DM' => 'DM',
                'HAS' => 'HAS', 'Insuficiência Renal' => 'Insuficiência Renal', 'Outras' => 'Outras')
            ?>
            <?= $form->field($model, 'ds_patologia_associada')->checkboxList($pat, ['id' => 'patologia']) ?>	
<?= $form->field($model, 'ds_patologia_associada')->textInput(['style' => 'width:500px', 'id' => 'outros'])->label(false) ?>
        </div>
        <div class="col-md-6"> 

<?= $form->field($model, 'ds_medicamento_uso')->textarea(['style' => 'width:500px', 'rows' => 3, 'id'=>'medicamento']) ?>                   
        </div>
    </div>     
    <div class="row">
        <div class="col-md-6">   
            <?php $pat = array('tabagista' => 'tabagista', 'etilista' => 'etilista',
                'sedentário' => 'sedentário', 'Outras atividades' => 'Outras atividades')
            ?>
<?= $form->field($model, 'ds_hp_hf_hs')->checkboxList($pat, ['id' => 'hphf']) ?>	
            <?= $form->field($model, 'ds_hp_hf_hs')->textInput(['style' => 'width:500px', 'id' => 'outros2'])->label(false) ?>
        </div>
        <div class="col-md-6">       
<?= $form->field($model, 'ds_cirurgia_internacao')->checkbox(['id' => 'cirurgia']) ?>
<?= $form->field($model, 'ds_cirurgia_internacao')->textarea(['id' => 'dscirurgia', 'style' => 'width:500px',])->label(false) ?>
        </div>
    </div>   

    <div class="row">
        <div class="col-md-6">   
<?= $form->field($model, 'ds_fisioterapia_quando')->checkbox(['id' => 'fisioterapia']) ?>
<?= $form->field($model, 'ds_fisioterapia_quando')->textarea(['id' => 'dsfisioterapia', 'style' => 'width:500px',])->label(false) ?>            
        </div>
        <div class="col-md-6">   
        </div>
    </div>



</div>
