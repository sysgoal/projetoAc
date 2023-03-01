<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title
?>
<div class="avaliacao-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if ($model->situacao !== 'Concluída' && (Yii::$app->user->identity->permissao == 'Profissional') || Yii::$app->user->identity->permissao == 'Administrador' ) {
            echo Html::a('Atualizar', ['update', 'id' => $model->id_avaliacao], ['class' => 'btn btn-primary']);
        } ?>
    </p>

    <div class="col-sm-6 col-md-6 col-lg-6" >


        <font color = "blue"><b>Dados Gerais</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='max-width;'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                ['format' => 'raw',
                    'attribute' => 'Aluno',
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
                'ds_idade_atual',
                [
                    'attribute' => 'Profissão',
                    'value' => function($model, $index) {
                        return $model->aluno->ds_profissao;
                    },
                ],
                'dt_avaliacao',
                'ds_motivo',
                'ds_conduta',
            ],
        ])
        ?>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"><b>Aparelho Cardíaco/Circulatório</b></font><br><br>

        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'ds_medico_responsavel',
                'ds_anamnese_medico',
                'ds_patologia',
                'ds_cirurgia',
                'ds_medicamento',
              //  'fl_endema',
              //  'ds_endema',
                'ds_aparelho_circ',
            ],
        ])
        ?>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"><b>Aparelho Digestivo</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'fl_restricao',
                'nr_refeicoes_dia',
                'ds_intestino',
                'nr_litros_agua_dia',
                'ds_acool',
                'ds_comentario_disgestivo',
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"><b>Aparelho Respiratório</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'ds_sono',
                'ds_alergia',
                [
                    'attribute' => 'fl_tabagista',
                    'value' => function($model, $index) {
                        if ($model->fl_tabagista == 1) {
                            return 'Sim';
                        } else {
                            return 'Não';
                        }
                    },
                ],
                'nr_cigarro',
                'nr_tempo_tabagismo',
                'nr_tempo_ex_tabagismo',
                'ds_comentario_tabagismo',
                'ds_doenca_respiratoria',
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"><b>Aparelho Ortopédico</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'ds_ativo_sedentario',
                'ds_atividade_fisica',
                'fl_dor',
                'ds_dor',
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"><b>Aparelho Reprodutor</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'nr_filhos',
               // 'fl_relacao_prazer',
               // 'fl_relacao_dor',
                'fl_incontinencia',
                'ds_incontinencia',
                'nr_nocturia',
                'ds_sexo',
            ],
        ]);
        ?>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6" >
        <font color = "blue"> <b>Avaliação Fisioterápica</b></font><br><br>
        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                'ds_braco_de',
                'ds_torax_abm',
                'ds_cintura',
                'ds_quadril_culote',
                'ds_coxa_de',
                'ds_panturrilha_de',
                'ds_abdominal',
                'ds_pa',
                'ds_peso',
                'ds_altura',
                'ds_imc',
                'ds_flexibilidade',
            ],
        ]);
        ?>
    </div>


    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                [
                    'attribute' => 'image1',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto1 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto1, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto1]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto1;
                        }
                    },
                ],
                [
                    'attribute' => 'image2',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto2 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto2, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto2]);
                            // return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto2;
                        }
                    },
                ],
                [
                    'attribute' => 'image3',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto3 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto3, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto3]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto3;
                        }
                    },
                ],
                [
                    'attribute' => 'image4',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto4 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto4, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto4]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto4;
                        }
                    },
                ],
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                [
                    'attribute' => 'image5',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto5 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto5, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto5]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto5;
                        }
                    },
                ],
                [
                    'attribute' => 'image6',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto6 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto6, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto6]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto6;
                        }
                    },
                ],
                [
                    'attribute' => 'image7',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_foto7 == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto7, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->ds_foto7]);
                            //return Yii::getAlias('@web') . '/imagesavaliacao/' . $model->ds_foto7;
                        }
                    },
                ],
                [
                    'attribute' => 'video',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->ds_video == null) {
                            return 'Sem vídeo';
                        } else {
                             return '<iframe class="embed-responsive-item" src="'.Yii::getAlias('@web') . '/video/' . $model->ds_video.'" frameborder="0" allowfullscreen></iframe>';
                            //return Yii::getAlias('@web') . '/video/' . $model->ds_video;
                        }
                    },
                ],
            ],
        ]);
        ?>
    </div>
</div>
