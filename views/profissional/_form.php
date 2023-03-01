<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Profissional */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$script = <<< JS
       
$(document).ready(function() {
        
  function limpa_formulario_cep() {
                // Limpa valores do formulário de cep.
                $('#rua').val('');               
                $('#cidade').val('');
                $('#bairro').val('');
                $('#uf').val('');
               
            }
            
            //Quando o campo cep perde o foco.
            $('#cep').blur(function() {                  
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $('#bairro').val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

JS;


$this->registerJs($script);
?>

<div class="profissional-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nm_profissional')->textInput(['maxlength' => true, 'style' => 'width:550px']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'dt_nascimento', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_cpf', ['options' => ['style' => 'width: 150px', 'id' => 'cpf']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99999999999']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">       
            <?= $form->field($model, 'ds_cep')->textInput(['maxlength' => 8, 'style' => 'width: 150px', 'id' => 'cep']) ?>    
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ds_endereco')->textInput(['maxlength' => true, 'style' => 'width:350px', 'id' => 'rua']) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'ds_complemento')->textInput(['maxlength' => true, 'style' => 'width:350px']) ?>
        </div> 
        <div class="col-md-4">
            <?= $form->field($model, 'ds_bairro')->textInput(['maxlength' => true, 'style' => 'width:350px', 'id' => 'bairro']) ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'ds_cidade')->textInput(['maxlength' => true, 'style' => 'width:350px', 'id' => 'cidade']) ?>
        </div> 
        <div class="col-md-4">
            <?= $form->field($model, 'ds_estado')->textInput(['style' => 'width:80px', 'id' => 'uf']) ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'nr_telefone', ['options' => ['style' => 'width: 250px']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)9999-9999']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'nr_whatsapp', ['options' => ['style' => 'width: 250px']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'nr_registro')->textInput(['maxlength' => true, 'style' => 'width:250px']) ?>
        </div>

        <div class="col-md-4">                       
            <?= $form->field($model, 'tp_registro')->dropDownList($model->getTipoRegistro(), ['style' => 'width:350px']) ?>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
