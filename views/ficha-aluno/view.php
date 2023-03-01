<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FichaAluno */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Ficha Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ficha-aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', 'Imprimir'), ['/relatorio/ficha-aluno', 'id' => $model->id], ['class' => 'btn btn-success', 'style' => 'padding-right:10px;', 'target' => '_blank']); ?>
    </p>


    <div class="col-sm-6 col-md-6 col-lg-6" >



        <?=
        DetailView::widget([
            'model' => $model,
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            'attributes' => [
                [
                    'attribute' => 'id_aluno',
                    'value' => function($model, $index) {
                        return $model->aluno->nm_aluno;
                    },
                ],
                [
                    'attribute' => 'id_profissional',
                    'value' => function($model, $index) {
                        return $model->profissional->nm_profissional;
                    },
                ],
                [
                    'attribute' => 'id_exercicio_1',
                    'value' => function($model, $index) {
                        if ($model->exercicio1 != null) {
                            return $model->exercicio1->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_2',
                    'value' => function($model, $index) {
                        if ($model->exercicio2 != null) {
                            return $model->exercicio2->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_3',
                    'value' => function($model, $index) {
                        if ($model->exercicio3 != null) {
                            return $model->exercicio3->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_4',
                    'value' => function($model, $index) {
                        if ($model->exercicio4 != null) {
                            return $model->exercicio4->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_5',
                    'value' => function($model, $index) {
                        if ($model->exercicio5 != null) {
                            return $model->exercicio5->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_6',
                    'value' => function($model, $index) {
                        if ($model->exercicio6 != null) {
                            return $model->exercicio6->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_7',
                    'value' => function($model, $index) {
                        if ($model->exercicio7 != null) {
                            return $model->exercicio7->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_8',
                    'value' => function($model, $index) {
                        if ($model->exercicio8 != null) {
                            return $model->exercicio8->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_9',
                    'value' => function($model, $index) {
                        if ($model->exercicio9 != null) {
                            return $model->exercicio9->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_10',
                    'value' => function($model, $index) {
                        if ($model->exercicio10 != null) {
                            return $model->exercicio10->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_11',
                    'value' => function($model, $index) {
                        if ($model->exercicio11 != null) {
                            return $model->exercicio11->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_12',
                    'value' => function($model, $index) {
                        if ($model->exercicio12 != null) {
                            return $model->exercicio12->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_13',
                    'value' => function($model, $index) {
                        if ($model->exercicio13 != null) {
                            return $model->exercicio13->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_14',
                    'value' => function($model, $index) {
                        if ($model->exercicio14 != null) {
                            return $model->exercicio14->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_15',
                    'value' => function($model, $index) {
                        if ($model->exercicio15 != null) {
                            return $model->exercicio15->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_16',
                    'value' => function($model, $index) {
                        if ($model->exercicio16 != null) {
                            return $model->exercicio16->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_17',
                    'value' => function($model, $index) {
                        if ($model->exercicio17 != null) {
                            return $model->exercicio17->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
                [
                    'attribute' => 'id_exercicio_18',
                    'value' => function($model, $index) {
                        if ($model->exercicio18 != null) {
                            return $model->exercicio18->nm_exercicio;
                        } else {
                            return '';
                        }
                    },
                ],
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
        'dt_ficha',
        [
            'attribute' => 'Turma',
            'value' => function($model, $index) {
                $turma = $model->getTurmaAluno($model->id_aluno);
                if ($turma != null) {
                    return $turma->turma->nm_turma;
                } else {
                    return 'Não se aplica';
                }
            },
        ],
        'nr_repeticao1',
        'nr_repeticao2',
        'nr_repeticao3',
        'nr_repeticao4',
        'nr_repeticao5',
        'nr_repeticao6',
        'nr_repeticao7',
        'nr_repeticao8',
        'nr_repeticao9',
        'nr_repeticao10',
        'nr_repeticao11',
        'nr_repeticao12',
        'nr_repeticao13',
        'nr_repeticao14',
        'nr_repeticao15',
        'nr_repeticao16',
        'nr_repeticao17',
        'nr_repeticao18',
    ],
])
?>

    </div>

</div>
