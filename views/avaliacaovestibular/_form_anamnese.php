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
$("#hphf2").hide();
$("#caracl").hide();
$('#patologia').click(function() {    
   var namesp = $('#patologia input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(namesp == " Outras"){  
        $("#outros").show(); 
        $("#outros").val("");     
       } else {
            $("#outros").val(namesp);     
            
        }
  });
        
        
$('#hphf').click(function() {    
   var names2 = $('#hphf input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(names2 == " Outras"){      
        $("#hphf2").show();
        $("#hphf2").val("");               
        } else {                  
            $("#hphf2").val(names2);               
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
                
        validaTextArea('dscirurgia');
        validaTextArea('medicamentos');
        validaTextArea('localizacao');
        validaTextArea('dor');
        validaTextArea('hma');
        validaTextArea('disfuncao');
        validaTextArea('queixa');
        
 
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
            <?= $form->field($model, 'ds_queixa_atual')->textarea(['style' => 'width:500px', 'rows' => 5, 'id' => 'queixa']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_disfuncao_avds')->textarea(['style' => 'width:500px', 'rows' => 5, 'id' => 'disfuncao']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo Html::img(Yii::getAlias('@web') . '/images/dor.jpg', ['width' => 500, 'height' => 150]); ?>
        </div>
        <div class="col-md-6">           
            <?= $form->field($model, 'ds_hma')->textarea(['style' => 'width:500px', 'rows' => 5, 'id' => 'hma']) ?>


        </div>

    </div>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'ds_dor')->textarea(['style' => 'width:500px', 'rows' => 5, 'id' => 'dor']) ?>
        </div>            
        <div class="col-md-6">   
            <br>
            <?= $form->field($model, 'ds_localizacao_dor')->textInput(['style' => 'width:500px', 'id' => 'localizacao']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">                  
            <?php $accountStatus = array('Diária' => 'Diária', 'Semanal' => 'Semanal', 'Quinzenal' => 'Quinzenal', 'Esporádica' => 'Esporádica') ?>
            <?= $form->field($model, 'ds_frequencia_dor')->radioList($accountStatus) ?>	
        </div>

    </div>      

    <div class="row">
        <div class="col-md-6">                
            <?php $pat = array('Cardiopatia' => 'Cardiopatia', 'DM' => 'DM',
                'HAS' => 'HAS', 'Insuficiência Renal' => 'Insuficiência Renal', 'Outras' => 'Outras')
            ?>
            <?= $form->field($model, 'ds_patologias_associadas')->checkboxList($pat, ['id' => 'patologia']) ?>	
            <?= $form->field($model, 'ds_patologias_associadas')->textInput(['style' => 'width:500px', 'id' => 'outros'])->label(false) ?>
        </div>
        <div class="col-md-6"> 

            <?= $form->field($model, 'ds_medicamento_uso')->textarea(['style' => 'width:500px', 'rows' => 3, 'id' => 'medicamentos']) ?>                   
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6">   
            <?php $itensLista = ['tabagista' => 'tabagista', 'etilista' => 'etilista',
                'sedentário' => 'sedentário', 'Outras' => 'Outras atividades']
            ?>
            <?= $form->field($model, 'ds_hp_hf_hs')->checkboxList($itensLista, ['id' => 'hphf']) ?>	
<?= $form->field($model, 'ds_hp_hf_hs')->textInput(['style' => 'width:500px', 'id' => 'hphf2'])->label(false) ?>
        </div>
        <div class="col-md-6">       
            <?= $form->field($model, 'ds_cirurgias')->checkbox(['id' => 'cirurgia']) ?>
<?= $form->field($model, 'ds_cirurgias')->textInput(['id' => 'dscirurgia', 'style' => 'width:500px'])->label(false) ?>
        </div>
    </div>   



</div>
