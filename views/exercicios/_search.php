<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExerciciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exercicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nm_exercicio') ?>

    <?= $form->field($model, 'cd_tipo_exercicio') ?>

    <?= $form->field($model, 'cd_subtipo_exercicio') ?>

    <?= $form->field($model, 'id_especialidade') ?>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
