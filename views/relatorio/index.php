<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relatórios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <?php $alunos = $searchModel->getDataListAluno(); ?>
    <?= GridView::widget([
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
                        
                         [
                'attribute' => 'id_profissional',                
                'value' => function ($model, $index, $widget) {
                    if($model->profissional != null){
                        return $model->profissional->nm_profissional;
                    }else{
                        return "Profissional não informado";
                    }
                },
              
            ],                       
            'dt_relatorio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
