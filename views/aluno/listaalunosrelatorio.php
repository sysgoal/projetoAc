<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form ActiveForm */
?>
<div class="aluno-index">
  <?php $alunos = $searchModel->getListNameAluno();?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //  ['class' => 'yii\grid\SerialColumn'],            
            [                     
                    'attribute' => 'nm_aluno',
                     'contentOptions' => ['style' => 'width:700px; white-space: normal;'],
                     'value' => function ($model, $index, $widget) 
                                { return $model->nm_aluno; },
                    'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id',
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
            'ds_cpf',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}',
               // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                         $url = '/web/index.php?r=relatorio/relatorioalunoindividual&id='.$model->id;
                       //  $url = '/index.php?r=relatorio/relatorioalunoindividual&id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-book"></span>',  Url::to($url), 
                                
                                ['title' => Yii::t('app', 'Relatório'),
                                 'target' =>'_blank',                                    
                                ]);
//return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                        //	'title' => Yii::t('yii', 'Create'),
//				]);                                         
                    }
                ]
            ],
        ],
    ]);
    ?>
   

</div><!-- aluno-index -->
