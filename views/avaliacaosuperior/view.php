<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoSuperior */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Superior', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacao-superior-view">

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
                'ds_reu',
                'ds_movimentacao_ativa',
                'ds_phalen',
                'ds_observacao_phalen',
                'ds_phalen_invertido',
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
                'ds_obs_phalen_invertido',
                'ds_de_quervain',
                'ds_obs_de_quervain',
                'ds_ultt',
                'ds_observacao_ultt',
                'ds_estresse_valgo',
                'ds_obs_estresse_valgo',
                'ds_estresse_varo',
                'ds_obs_estresse_varo',
                'ds_resistencia_flexao',
                'ds_obs_resistencia_flexao',
                'ds_resistencia_extensao',
                'ds_obs_resistencia_extensao',
                'ds_subescapular',
                'ds_obs_subescapular',
                'ds_supraespinhal',
                'ds_obs_supraespinhal',
                'ds_infraespinhal',
                'ds_obs_infraespinhal',
                'ds_redondo_menor',
                'ds_obs_redondo_menor',
                'ds_biceps',
                'ds_obs_biceps',
                'ds_end_feel',
                'ds_obs_end_feel',
                'ds_exames_complementares',
                'ds_conduta',
            ],
        ])
        ?>

    </div>
</div>
