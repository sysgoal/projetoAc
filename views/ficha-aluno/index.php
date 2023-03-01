<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichaAlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ficha de Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $alunos = $searchModel->getDataListAluno(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_aluno',
                'contentOptions' => ['style' => 'width:600px; white-space: normal;'],
                'value' => function ($model, $index, $widget) {
                    return $model->aluno->nm_aluno;
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
            
            [
                'attribute' => 'Data da Ficha',
                'value' => function($model, $index) {
                    return $model->dt_ficha;
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return (Yii::$app->user->identity->permissao == 'Profissional' || Yii::$app->user->identity->permissao == 'Administrador' );
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->identity->permissao === 'Administrador';
                    }
                ],
            //  'visible' => Yii::$app->user->isGuest ? false : true,
            ],
        ],
    ]);
    ?>


</div>
