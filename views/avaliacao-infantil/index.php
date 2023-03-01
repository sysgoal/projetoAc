<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvaliacaoInfantilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avaliação Infantil';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-infantil-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>
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
                'contentOptions' => ['style' => 'width:700px; white-space: normal;'],
                'value' => function ($model, $index, $widget) {
                    if($model->aluno != null){
                        return $model->aluno->nm_aluno;
                    }
                },
                'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id_aluno',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um aluno-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                                'width' => '500px',
                            ],
                        ]
                ),
            ],
            'data',
                                    
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
