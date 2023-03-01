<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Turma */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="turma-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nm_turma')->textInput(['maxlength' => true, 'style' => 'width:500px']) ?>  
        </div>  
        <div class="col-md-6">
            <?php $accountStatus1 = array('S' => 'Selecione...', 'MANHÃ' => 'MANHÃ', 'TARDE' => 'TARDE', 'NOITE' => 'NOITE') ?>
            <?= $form->field($model, 'ds_turno')->dropDownList($accountStatus1, ['style' => 'width:120px']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $items = $model->getDataListProfissional(); ?>
            <?= $form->field($model, 'id_profissional')->dropDownList($items) ?>  
        </div>
        <div class="col-md-6">
            <?php $especialidades = $model->getDataListEspecialidade(); ?>
            <?= $form->field($model, 'id_especialidade')->dropDownList($especialidades) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php $items = $model->getDataListProfissional(); ?>
            <?= $form->field($model, 'id_profissional2')->dropDownList($items) ?>  
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'nr_vagas')->textInput(['maxlength' => true, 'style' => 'width:80px']) ?>  
        </div> 
        <div class="col-md-2">
            <?= $form->field($model, 'hr_inicio', ['options' => ['style' => 'width: 110px']])->widget(MaskedInput::className(), ['mask' => '99:99']) ?>            

        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'hr_fim', ['options' => ['style' => 'width: 110px']])->widget(MaskedInput::className(), ['mask' => '99:99']) ?>            
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
