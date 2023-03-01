<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;
use yii\helpers\Url;
use meysampg\formbuilder\FormBuilder;
/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
$scrip = <<< JS
        $('#profissional').change(function(){
        
        var id = $(this).val();
 
        $.get('index.php?r=declaracao/get-profissional', {id:id}, function(dados){
            var dados = $.parseJSON(dados);
         
            $('#nomeprof').val(dados.nm_profissional);
            $('#tpreg').val(dados.tp_registro);
            $('#nrreg').val(dados.nr_registro);       
            }
            
          )
         });
        
        
JS;

$this->registerJs($scrip);



?>

<div class="declaracao-form">
    <?php $form = ActiveForm::begin( ['options'=>['target'=>'_blank']]); ?>
    <div class="row">
        <div class="col-md-6">
            <?php $items = $aluno->getListNameAluno(); ?>         
            <?=
            $form->field($model, 'nm_aluno')->widget(Select2::classname(['maxlength' => true, 'style' => 'width:550px', 'id' => 'nome']), [
                'data' => $items, // the select option data items.The array keys are option values, and the array values are the corresponding option labels
                'options' => ['placeholder' => 'Selecione um aluno'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'data', ['options' => ['style' => 'width: 250px']])->widget(DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
        </div>
        <div class="col-md-2">
             <?= $form->field($model, 'horainicio', ['options' => ['style' => 'width: 110px']])->widget(MaskedInput::className(),['mask' => '99:99']) ?>       
        </div>
        <div class="col-md-3">
             <?= $form->field($model, 'horafim', ['options' => ['style' => 'width: 110px']])->widget(MaskedInput::className(),['mask' => '99:99']) ?>       
        </div>
    </div>
     

    
     <div class="col-md-3">
            <div class="form-group">                                
                <?= Html::submitButton('Gerar declaração', ['class' => 'btn btn-success']) ?>
            </div>
     </div>
    
     <div class="row">
        <div class="col-md-12">
          
        </div>
     </div>
 
 
  <?php ActiveForm::end(); ?>
   

</div>
