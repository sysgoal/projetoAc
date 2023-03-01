<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TurmaSearch;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TurmaAlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisa de Turma';
$this->params['breadcrumbs'][] = $this->title;
$id = 0;
?>
<div class="turma-aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $turmas = $searchModel->getDataListTurma(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'Nome da turma',
                'value' => function ($model, $index, $widget) {
                    return $model->turma->nm_turma;
                },
                'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id_turma',
                            'data' => $turmas,
                            'options' => ['placeholder' => ' --Selecione uma turma-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]
                ),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                //  'visible' => Yii::$app->user->isGuest ? false : true,
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=turmaaluno/listaporturma&id='.$model->turma->id_turma;                   
                        return $url;
                       // $url ='index.php?r=turmaaluno/_listaTurma&id='.$model->id;
                        //return $url;
                    }                
                 },
           ]
        ],
    ]);
    ?>


</div>
