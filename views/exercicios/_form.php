<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exercicios-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-3">   
            <?= $form->field($model, 'nm_exercicio')->textInput(['style' => 'width:250px']) ?>
        </div>
        <div class="col-md-3"> 
            <?= $form->field($model, 'cd_tipo_exercicio')->textInput(['style' => 'width:350px']) ?>
        </div>
    </div>
        <div class="row">

            <div class="col-md-3"> 
                <?= $form->field($model, 'cd_subtipo_exercicio')->textInput(['style' => 'width:150px']) ?>
            </div>
            <div class="col-md-3">     
                <?php $items = $model->getDataListEspecialidade(); ?>
                <?= $form->field($model, 'id_especialidade')->dropDownList($items, ['id' => 'especialidade', 'style' => 'width:300px']) ?>               
            </div>

        </div>
        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
