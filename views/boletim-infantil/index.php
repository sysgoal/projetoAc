<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoletimInfantilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Festa das Toucas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boletim-infantil-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $alunos = $searchModel->getDataListAluno(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_aluno',
                'contentOptions' => ['style' => 'width:500px; white-space: normal;'],
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
            'ds_cor_touca',
            'data',
            //'ds_atv4',
            //'ds_atv5',
            //'data',
            //'id_aluno',
            ['class' => 'yii\grid\ActionColumn',
                /*'template' => '{view}{create}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = '/web/index.php?r=boletim-infantil/boletim-infantil&id=' . $model->id_aluno;

                        return Html::a('<span class="glyphicon glyphicon-book"></span>', Url::to($url), ['title' => Yii::t('app', 'Relatório'),
                                    'target' => '_blank',
                        ]);
                    }
                 * 
                 */
                
            ],
        // echo Html::a(Yii::t('app', 'Imprimir PDF'), ['/relatorioboletim/relatorioboletim', 'id' => $idAluno], ['class' => 'btn btn-success', 'style' => 'padding-right:10px;', 'target' => '_blank']);
        ],
    ]);
    ?>


</div>
