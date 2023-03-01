<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TurmaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisar Turma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-index">

<h1><?= Html::encode($this->title) ?></h1>
 <div class="form-group">
         <?= Html::a('Cadastrar', ['/turma/create'], ['class'=>'btn btn-success']) ?>
        
        
    </div>
    <?php 
$turmas = $searchModel->getDataListTurma();
// echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           
            'id_turma',
            [
                    'attribute' => 'nm_turma',
                    'value' => function ($model, $index, $widget) 
                                { return $model->nm_turma; },
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
            'ds_turno',
           // 'nr_vagas',
           // 'hr_inicio',
            //'hr_fim',
            //'id_profissional',
            //'id_especialidade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   


</div>
