<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TurmaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="turma-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_turma') ?>

    <?= $form->field($model, 'nm_turma') ?>

    <?= $form->field($model, 'ds_turno') ?>

    <?= $form->field($model, 'nr_vagas') ?>

    <?= $form->field($model, 'hr_inicio') ?>

    <?php // echo $form->field($model, 'hr_fim') ?>

    <?php // echo $form->field($model, 'dt_inicio') ?>

    <?php // echo $form->field($model, 'dt_fim') ?>

    <?php // echo $form->field($model, 'id_profissional') ?>

    <?php // echo $form->field($model, 'id_especialidade') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
