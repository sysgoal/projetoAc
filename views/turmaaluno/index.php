<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TurmaAlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisa de aluno x turma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-aluno-index">
<h1><?= Html::encode($this->title) ?></h1>

  <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <?php $turmas = $searchModel->getDataListTurma();
        $alunos = $searchModel->getDataListAluno();
  ?>
    
    <?=    
         
           //  $form->field($searchModel, 'id_turma')->dropDownList($items, ['style' => 'width:300px']);
        
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

           /* [Select2::classname(), [
                                    'data' => $alunos,
                                    'options' => ['placeholder' => 'Select a state ...'],
                                    'pluginOptions' => ['allowClear' => true],
                                    ]
                ],*/
           [
                    'attribute' => 'id_aluno',
                    'value' => function ($model, $index, $widget) 
                                { return $model->aluno->nm_aluno; },
                    'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id_aluno',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um aluno-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]
                    ),
                ],
                                        
            [
                    'attribute' => 'id_turma',
                    'value' => function ($model, $index, $widget) 
                                { return $model->turma->nm_turma; },
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
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
