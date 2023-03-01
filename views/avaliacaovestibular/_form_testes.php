
<?php 
use yii\helpers\Html;

$script = <<< JS
    
        validaTextArea('conduta');
 
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
            <?= $form->field($model, 'ds_unipodal_olhos_abertos')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_unipodal_olhos_fechados')->textInput() ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_apoio_mid')->textInput() ?>

        </div>
        <div class="col-md-6">           
            <?= $form->field($model, 'ds_apoio_mie')->textInput() ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'ds_index_nariz')->textInput() ?>
        </div>            
        <div class="col-md-6">             
            <?= $form->field($model, 'ds_pammhg_deitado')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">                  
            <?= $form->field($model, 'ds_pammhg_sentado')->textInput() ?>
        </div>
        <div class="col-md-6"> 
            <?= $form->field($model, 'ds_basiliar')->textInput() ?>
        </div>
    </div>     
    <div class="row">

        <div class="col-md-6">                

            <?= $form->field($model, 'ds_exames')->textInput() ?>
        </div>
        <div class="col-md-6"> 

            <?= $form->field($model, 'ds_conduta')->textarea(['id'=>'conduta']) ?>   
        </div>
    </div>
     <div class="row">
        <div class="col-md-6">
            <?php $items = ['Em andamento' => 'Em andamento', 'Concluída' => 'Concluída']; ?>
            <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
        </div>
    </div>
</div>
<br>
<div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
