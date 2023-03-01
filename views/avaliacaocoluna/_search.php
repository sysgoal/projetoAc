<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoColunaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-coluna-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'dt_avaliacao') ?>

    <?= $form->field($model, 'cd_avaliacao') ?>

    <?= $form->field($model, 'ds_convenio') ?>

    <?php // echo $form->field($model, 'nr_tempo_servico') ?>

    <?php // echo $form->field($model, 'ds_cuidador') ?>

    <?php // echo $form->field($model, 'ds_parentesco') ?>

    <?php // echo $form->field($model, 'ds_diagnostico_medico') ?>

    <?php // echo $form->field($model, 'ds_medico_responsavel') ?>

    <?php // echo $form->field($model, 'ds_queixa_atual') ?>

    <?php // echo $form->field($model, 'ds_disfuncao_avds') ?>

    <?php // echo $form->field($model, 'ds_hma') ?>

    <?php // echo $form->field($model, 'ds_dor') ?>

    <?php // echo $form->field($model, 'ds_localizacao') ?>

    <?php // echo $form->field($model, 'ds_frequencia_dor') ?>

    <?php // echo $form->field($model, 'ds_caracteristica_dor') ?>

    <?php // echo $form->field($model, 'ds_patologia_associada') ?>

    <?php // echo $form->field($model, 'ds_medicamento_uso') ?>

    <?php // echo $form->field($model, 'ds_hp_hf_hs') ?>

    <?php // echo $form->field($model, 'ds_cirurgia_internacao') ?>

    <?php // echo $form->field($model, 'ds_fisioterapia_quando') ?>

    <?php // echo $form->field($model, 'ds_locomocao') ?>

    <?php // echo $form->field($model, 'ds_avaliacao_postural') ?>

    <?php // echo $form->field($model, 'ds_movimentacao_ativa') ?>

    <?php // echo $form->field($model, 'ds_compressao') ?>

    <?php // echo $form->field($model, 'ds_observacao_compressao') ?>

    <?php // echo $form->field($model, 'ds_distracao') ?>

    <?php // echo $form->field($model, 'ds_observacao_distracao') ?>

    <?php // echo $form->field($model, 'ds_slump') ?>

    <?php // echo $form->field($model, 'ds_observacao_slump') ?>

    <?php // echo $form->field($model, 'ds_esfigmomanometro') ?>

    <?php // echo $form->field($model, 'ds_obs_esfigmomanometro') ?>

    <?php // echo $form->field($model, 'ds_gillet') ?>

    <?php // echo $form->field($model, 'ds_observacao_gillet') ?>

    <?php // echo $form->field($model, 'ds_mackenzie') ?>

    <?php // echo $form->field($model, 'ds_obs_mackenzie') ?>

    <?php // echo $form->field($model, 'ds_william') ?>

    <?php // echo $form->field($model, 'ds_obs_william') ?>

    <?php // echo $form->field($model, 'ds_subirdescer') ?>

    <?php // echo $form->field($model, 'ds_obs_subirdescer') ?>

    <?php // echo $form->field($model, 'ds_piriforme') ?>

    <?php // echo $form->field($model, 'ds_obs_piriforme') ?>

    <?php // echo $form->field($model, 'ds_exames_complementares') ?>

    <?php // echo $form->field($model, 'ds_conduta') ?>

    <?php // echo $form->field($model, 'id_profissional') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
