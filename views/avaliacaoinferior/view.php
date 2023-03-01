<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoInferior */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Inferior', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacao-inferior-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        if ($model->situacao !== 'Concluída' && (Yii::$app->user->identity->permissao == 'Profissional') || Yii::$app->user->identity->permissao == 'Administrador') {
            echo Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>

    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                ['format' => 'raw',
                    'attribute' => 'Paciente',
                    'value' => function($model) {
                        return Html::a('Visualizar', ['aluno/view', 'id' => $model->id_aluno], ['class' => 'btn btn-primary', 'target' => '_blank']);
                    }
                ],
                [
                    'attribute' => 'id_profissional',
                    'value' => function($model, $index) {
                        return $model->profissional->nm_profissional;
                    },
                ],
                'situacao',
                'dt_avaliacao',
                'cd_avaliacao',
                'nr_tempo_servico',
                'ds_diagnostico_medico',
                'ds_medico_responsavel',
                'ds_queixa_atual',
                'ds_disfuncao_avds',
                'ds_hma',
                'ds_dor',
                'ds_localizacao',
                'ds_frequencia_dor',
                'ds_caracteristica_dor',
                'ds_patologia_associada',
                'ds_medicamento_uso',
                'ds_hp_hf_hs',
                'ds_cirurgia_internacao',
                'ds_fisioterapia_quando',
                'ds_locomocao',
                'ds_avaliacao_postural',
                'ds_movimentacao_ativa',
                'ds_trendelenburg',
                'ds_obs_trendelenburg',
            ],
        ])
        ?>

    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'ds_patrick',
                'ds_obs_patrick',
                'ds_gillet',
                'ds_obs_gillet',
                'ds_ober',
                'ds_obs_ober',
                'ds_teste_rigidez_quadril',
                'ds_obs_teste_rigidez_quadril',
                'ds_teste_apley',
                'ds_obs_teste_apley',
                'ds_gaveta_anterior',
                'ds_obs_gaveta_anterior',
                'ds_gaveta_posterior',
                'ds_obs_gaveta_posterior',
                'ds_teste_clarke',
                'ds_obs_teste_clarke',
                'ds_estresse_valgo',
                'ds_obs_estresse_valgo',
                'ds_estresse_varo',
                'ds_obs_estresse_varo',
                'ds_teste_thompson',
                'ds_obs_teste_thompson',
                'ds_adm_dorsiflexao',
                'ds_obs_adm_dorsiflexao',                
                'ds_exames_complementares',
                'ds_conduta',
            ],
        ])
        ?>

    </div>
</div>

