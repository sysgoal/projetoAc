<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoSuperiorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-superior-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'ds_convenio') ?>

    <?= $form->field($model, 'dt_avaliacao') ?>

    <?= $form->field($model, 'cd_avaliacao') ?>

    <?php // echo $form->field($model, 'ds_atividade_laboral') ?>

    <?php // echo $form->field($model, 'nr_tempo_servico') ?>

    <?php // echo $form->field($model, 'ds_cuidador') ?>

    <?php // echo $form->field($model, 'ds_parentesco') ?>

    <?php // echo $form->field($model, 'ds_profissao') ?>

    <?php // echo $form->field($model, 'ds_escolaridade') ?>

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

    <?php // echo $form->field($model, 'ds_reu') ?>

    <?php // echo $form->field($model, 'ds_movimentacao_ativa') ?>

    <?php // echo $form->field($model, 'ds_phalen') ?>

    <?php // echo $form->field($model, 'ds_observacao_phalen') ?>

    <?php // echo $form->field($model, 'ds_phalen_invertido') ?>

    <?php // echo $form->field($model, 'ds_obs_phalen_invertido') ?>

    <?php // echo $form->field($model, 'ds_de_quervain') ?>

    <?php // echo $form->field($model, 'ds_obs_de_quervain') ?>

    <?php // echo $form->field($model, 'ds_ultt') ?>

    <?php // echo $form->field($model, 'ds_observacao_ultt') ?>

    <?php // echo $form->field($model, 'ds_estresse_valgo') ?>

    <?php // echo $form->field($model, 'ds_obs_estresse_valgo') ?>

    <?php // echo $form->field($model, 'ds_estresse_varo') ?>

    <?php // echo $form->field($model, 'ds_obs_estresse_varo') ?>

    <?php // echo $form->field($model, 'ds_resistencia_flexao') ?>

    <?php // echo $form->field($model, 'ds_obs_resistencia_flexao') ?>

    <?php // echo $form->field($model, 'ds_resistencia_extensao') ?>

    <?php // echo $form->field($model, 'ds_obs_resistencia_extensao') ?>

    <?php // echo $form->field($model, 'ds_subescapular') ?>

    <?php // echo $form->field($model, 'ds_obs_subescapular') ?>

    <?php // echo $form->field($model, 'ds_supraespinhal') ?>

    <?php // echo $form->field($model, 'ds_obs_supraespinhal') ?>

    <?php // echo $form->field($model, 'ds_infraespinhal') ?>

    <?php // echo $form->field($model, 'ds_obs_infraespinhal') ?>

    <?php // echo $form->field($model, 'ds_redondo_menor') ?>

    <?php // echo $form->field($model, 'ds_obs_redondo_menor') ?>

    <?php // echo $form->field($model, 'ds_biceps') ?>

    <?php // echo $form->field($model, 'ds_obs_biceps') ?>

    <?php // echo $form->field($model, 'ds_end_feel') ?>

    <?php // echo $form->field($model, 'ds_obs_end_feel') ?>

    <?php // echo $form->field($model, 'ds_exames_complementares') ?>

    <?php // echo $form->field($model, 'ds_conduta') ?>

    <?php // echo $form->field($model, 'id_profissional') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
