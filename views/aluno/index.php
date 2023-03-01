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
$this->title = 'Pesquisar Aluno';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="form-group">
        <?= Html::a('Cadastrar', ['/aluno/create'], ['class' => 'btn btn-success']) ?>
    </div>
 <?php $alunos = $searchModel->getListNameAluno();?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //  ['class' => 'yii\grid\SerialColumn'],            

             [
                    'attribute' => 'nm_aluno',
                    'value' => function ($model, $index, $widget) 
                                { return $model->nm_aluno; },
                    'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um aluno-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]
                    ),
                ],
             'ds_cpf',
            /*['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}',
              //  'visible' => Yii::$app->user->isGuest ? false : true,
            ],*/   
                                        
              ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->identity->permissao === 'Administrador';
                    }
                ],
            //  'visible' => Yii::$app->user->isGuest ? false : true,
            ],
        ],        
    ]);
    ?>
    

</div><!-- aluno-index -->
