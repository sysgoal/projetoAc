<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoInfantil */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$('#outros2').hide();
$('#al01').change(function() { 
    var id = $(this).val();  
    $.get('index.php?r=avaliacaocoluna/get-dados-aluno', { id: id}, function(data){
    var data = $.parseJSON(data); 
     var url = "/web/index.php?r=aluno/view&id="+data.id;
     $("#botao").append("<a href="+url+" target=_blank>Visualizar</a>").addClass("far fa-address-card");
    var dtnasc = data.dt_nascimento;
    var hoje = new Date;
    var arrDataExclusao = dtnasc.split('/');
    var stringFormatada = arrDataExclusao[1] + '-' + arrDataExclusao[0] + '-' +
     arrDataExclusao[2];
    var dataFormatada1 = new Date(stringFormatada);    
    var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
     $('#idade').val(idade);  
   });    
  
   });
 

        

        
        
JS;
$this->registerJs($script);
?>

<div class="avaliacao-infantil-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $aluno = $model->getDataListAluno(); ?>
    <div class="row">
        <div class="col-md-4">

            <?= $form->field($model, 'data', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose' => true], 'language' => 'pt-BR']) ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $aluno,
                'options' => ['placeholder' => ' --Selecione um aluno-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
        </div>
        <div class="col-md-2">
            <div id="botao"></div>            

        </div> 
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'idade')->textInput(['id' => 'idade', 'readonly' => false]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'peso')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'altura')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'abdomem')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'flexao')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'postura')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'observacao')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
