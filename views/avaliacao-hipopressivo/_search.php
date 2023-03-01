<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_avaliacao') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'ds_motivo') ?>

    <?= $form->field($model, 'ds_medicamento') ?>

    <?= $form->field($model, 'ds_patologia') ?>

    <?php // echo $form->field($model, 'ds_cirurgia') ?>

    <?php // echo $form->field($model, 'fl_tabagista') ?>

    <?php // echo $form->field($model, 'nr_cigarro') ?>

    <?php // echo $form->field($model, 'nr_tempo_tabagismo') ?>

    <?php // echo $form->field($model, 'nr_tempo_ex_tabagismo') ?>

    <?php // echo $form->field($model, 'ds_comentario_tabagismo') ?>

    <?php // echo $form->field($model, 'ds_doenca_respiratoria') ?>

    <?php // echo $form->field($model, 'ds_comentario_doenca_respiratoria') ?>

    <?php // echo $form->field($model, 'nr_filhos') ?>

    <?php // echo $form->field($model, 'ds_ciclo_cesaria') ?>

    <?php // echo $form->field($model, 'nr_nocturia') ?>

    <?php // echo $form->field($model, 'fl_relacao_dor') ?>

    <?php // echo $form->field($model, 'fl_relacao_prazer') ?>

    <?php // echo $form->field($model, 'fl_incontinencia') ?>

    <?php // echo $form->field($model, 'fl_endema') ?>

    <?php // echo $form->field($model, 'fl_dor_circulatorio') ?>

    <?php // echo $form->field($model, 'ds_comentario_circulatorio') ?>

    <?php // echo $form->field($model, 'fl_restricao') ?>

    <?php // echo $form->field($model, 'ds_comentario_disgestivo') ?>

    <?php // echo $form->field($model, 'nr_refeicoes_dia') ?>

    <?php // echo $form->field($model, 'nr_litros_agua_dia') ?>

    <?php // echo $form->field($model, 'ds_flexibilidade') ?>

    <?php // echo $form->field($model, 'ds_orientacoes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
