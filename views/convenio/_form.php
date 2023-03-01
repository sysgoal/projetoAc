<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="convenio-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_nome')->textInput(['maxlength' => true, 'style' => 'width:500px']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'nr_registro_ans')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'cd_operadora')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'vs_tiss')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'tb_preco')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
