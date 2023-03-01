<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;
use yii\helpers\Url;

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

<div class="relatorio-informativo-form">
    <?php $form = ActiveForm::begin(); ?>
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

        <div class="col-md-6">
            <?php $itemsProfissional = $aluno->getDataListProfissional(); ?>

            <?=
            $form->field($model, 'nm_profissional')->widget(Select2::classname(['maxlength' => true, 'style' => 'width:200px']), [
                'data' => $itemsProfissional, // the select option data items.The array keys are option values, and the array values are the corresponding option labels
                'options' => ['placeholder' => 'Selecione um professor', 'id' => 'profissional'],
                'pluginOptions' => [
                    'allowClear' => true
                ],]);
            ?>
        </div>


    </div>

 <div class="row">
        <div class="col-md-12">
       <?= $form->field($model, 'descricao')->textarea(['style' => 'width:800px', 'rows' => 7]) ?>
        </div>
 </div>

    <?= $form->field($model, 'nm_profissional')->hiddenInput(['id' => 'nomeprof'])->label(false) ?>
    <?= $form->field($model, 'tp_registro')->hiddenInput(['id' => 'tpreg'])->label(false) ?>
    <?= $form->field($model, 'nr_registro')->hiddenInput(['id' => 'nrreg'])->label(false) ?>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">                                
                <?= Html::submitButton('Gerar relatório', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div> 


    <?php ActiveForm::end(); ?>



</div>
