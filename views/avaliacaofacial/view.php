<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoFacial */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Facial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacao-facial-view">

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
                'ds_medico_responsavel',
                'ds_diagnostico',
                'ds_queixa',
                'ds_objetivo',
                'ds_hma',
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
        'ds_hp',
        'ds_medicacao_uso',
        'ds_face_comprometida',
        'ds_mimicas_faciais',
        'ds_observacao_mimicas',
        'dt_avaliacao',
        'ds_disfuncoes',
        'ds_historia_molestia',
    ],
])
?>


    </div>
</div>
