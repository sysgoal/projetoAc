<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TesteHofiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Boletim';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-hofi-index">

    <h1><?= Html::encode($this->title) ?></h1>

   
  <?php $alunos = $model->getDataListAluno(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                      [
            'attribute' => 'Nome do aluno',
                     'contentOptions' => ['style' => 'width:700px; white-space: normal;'],
                     'value' => function ($model, $index, $widget) 
                                { return $model->nm_aluno; },
                    'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um Aluno-- '],
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
            ],
        ],
    ]); ?>


</div>