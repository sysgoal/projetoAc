<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoVestibularSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-vestibular-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'id_profissional') ?>

    <?= $form->field($model, 'dt_avaliacao') ?>

    <?= $form->field($model, 'ds_diagnostico') ?>

    <?php // echo $form->field($model, 'ds_medico_responsavel') ?>

    <?php // echo $form->field($model, 'ds_queixa_atual') ?>

    <?php // echo $form->field($model, 'ds_disfuncao_avds') ?>

    <?php // echo $form->field($model, 'ds_hma') ?>

    <?php // echo $form->field($model, 'fl_dor') ?>

    <?php // echo $form->field($model, 'ds_localizacao_dor') ?>

    <?php // echo $form->field($model, 'ds_frequencia_dor') ?>

    <?php // echo $form->field($model, 'ds_patologias_associadas') ?>

    <?php // echo $form->field($model, 'ds_medicamento_uso') ?>

    <?php // echo $form->field($model, 'ds_hp_hf_hs') ?>

    <?php // echo $form->field($model, 'ds_cirurgias') ?>

    <?php // echo $form->field($model, 'ds_unipodal_olhos_abertos') ?>

    <?php // echo $form->field($model, 'ds_unipodal_olhos_fechados') ?>

    <?php // echo $form->field($model, 'ds_apoio_mid') ?>

    <?php // echo $form->field($model, 'ds_apoio_mie') ?>

    <?php // echo $form->field($model, 'ds_index_nariz') ?>

    <?php // echo $form->field($model, 'ds_pammhg_deitado') ?>

    <?php // echo $form->field($model, 'ds_pammhg_sentado') ?>

    <?php // echo $form->field($model, 'ds_basiliar') ?>

    <?php // echo $form->field($model, 'ds_exames') ?>

    <?php // echo $form->field($model, 'ds_conduta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
