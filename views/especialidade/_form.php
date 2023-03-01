<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Especialidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especialidade-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-6">   
            <?= $form->field($model, 'nm_especialidade')->textInput() ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">  
            <?= $form->field($model, 'nr_tempo_duracao')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
