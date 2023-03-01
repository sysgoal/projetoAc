<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoInferiorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-inferior-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>    

    <?= $form->field($model, 'dt_avaliacao') ?>

    <?= $form->field($model, 'cd_avaliacao') ?>

    <?php // echo $form->field($model, 'ds_profissao') ?>

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

    <?php // echo $form->field($model, 'ds_trendelenburg') ?>

    <?php // echo $form->field($model, 'ds_obs_trendelenburg') ?>

    <?php // echo $form->field($model, 'ds_patrick') ?>

    <?php // echo $form->field($model, 'ds_obs_patrick') ?>

    <?php // echo $form->field($model, 'ds_gillet') ?>

    <?php // echo $form->field($model, 'ds_obs_gillet') ?>

    <?php // echo $form->field($model, 'ds_ober') ?>

    <?php // echo $form->field($model, 'ds_obs_ober') ?>

    <?php // echo $form->field($model, 'ds_teste_rigidez_quadril') ?>

    <?php // echo $form->field($model, 'ds_obs_teste_rigidez_quadril') ?>

    <?php // echo $form->field($model, 'ds_teste_apley') ?>

    <?php // echo $form->field($model, 'ds_obs_teste_apley') ?>

    <?php // echo $form->field($model, 'ds_gaveta_anterior') ?>

    <?php // echo $form->field($model, 'ds_obs_gaveta_anterior') ?>

    <?php // echo $form->field($model, 'ds_gaveta_posterior') ?>

    <?php // echo $form->field($model, 'ds_obs_gaveta_posterior') ?>

    <?php // echo $form->field($model, 'ds_teste_clarke') ?>

    <?php // echo $form->field($model, 'ds_obs_teste_clarke') ?>

    <?php // echo $form->field($model, 'ds_estresse_valgo') ?>

    <?php // echo $form->field($model, 'ds_obs_estresse_valgo') ?>

    <?php // echo $form->field($model, 'ds_estresse_varo') ?>

    <?php // echo $form->field($model, 'ds_obs_estresse_varo') ?>

    <?php // echo $form->field($model, 'ds_teste_thompson') ?>

    <?php // echo $form->field($model, 'ds_obs_teste_thompson') ?>

    <?php // echo $form->field($model, 'ds_adm_dorsiflexao') ?>

    <?php // echo $form->field($model, 'ds_obs_adm_dorsiflexao') ?>

    <?php // echo $form->field($model, 'ds_exames_complementares') ?>

    <?php // echo $form->field($model, 'ds_conduta') ?>

    <?php // echo $form->field($model, 'id_profissional') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
