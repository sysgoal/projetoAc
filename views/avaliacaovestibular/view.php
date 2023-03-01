<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoVestibular */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Vestibular', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacao-vestibular-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if ($model->situacao !== 'Concluída' && (Yii::$app->user->identity->permissao == 'Profissional') || Yii::$app->user->identity->permissao == 'Administrador' ) {
            echo Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
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
                'ds_diagnostico',
                'ds_medico_responsavel',
                'ds_queixa_atual',
                'ds_disfuncao_avds',
                'ds_hma',               
                'ds_localizacao_dor',
                'ds_frequencia_dor',
                'ds_patologias_associadas',
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
               
                'ds_medicamento_uso',
                'ds_hp_hf_hs',
                'ds_cirurgias',
                'ds_unipodal_olhos_abertos',
                'ds_unipodal_olhos_fechados',
                'ds_apoio_mid',
                'ds_apoio_mie',
                'ds_index_nariz',
                'ds_pammhg_deitado',
                'ds_pammhg_sentado',
                'ds_basiliar',
                'ds_exames',
                'ds_conduta',
            ],
        ])
        ?>

    </div>


</div>
