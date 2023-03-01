<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvaliacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bioimpedância';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $alunos = $searchModel->getDataListAluno(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id_aluno',
                'contentOptions' => ['style' => 'width:800px; white-space: normal;'],
                'value' => function ($model, $index, $widget) {
                    return $model->aluno->nm_aluno;
                },
                'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id_aluno',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um paciente-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                                'width' => '500px',
                            ],
                        ]
                ),
            ],
           
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = '/web/index.php?r=avaliacao/graficoindividual&id=' . $model->id_aluno;                       
                        return Html::a('<span class="glyphicon glyphicon-stats"></span>', Url::to($url), ['title' => Yii::t('app', 'Relatório'),
                                    'target' => '_blank',
                        ]);                                      
                    }
                ]
            ],
        ],
    ]);
    ?>


</div>
