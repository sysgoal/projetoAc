<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoFacialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-facial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'id_profissional') ?>

    <?= $form->field($model, 'ds_medico_responsavel') ?>

    <?= $form->field($model, 'ds_diagnostico') ?>

    <?php // echo $form->field($model, 'ds_queixa') ?>

    <?php // echo $form->field($model, 'ds_objetivo') ?>

    <?php // echo $form->field($model, 'ds_hma') ?>

    <?php // echo $form->field($model, 'ds_hp') ?>

    <?php // echo $form->field($model, 'ds_medicacao_uso') ?>

    <?php // echo $form->field($model, 'ds_face_comprometida') ?>

    <?php // echo $form->field($model, 'ds_mimicas_faciais') ?>

    <?php // echo $form->field($model, 'ds_observacao_mimicas') ?>

    <?php // echo $form->field($model, 'dt_avaliacao') ?>

    <?php // echo $form->field($model, 'ds_disfuncoes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
