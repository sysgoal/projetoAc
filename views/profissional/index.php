<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\grid\GridView;
;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfissionalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Profissional */
$this->title = 'Pesquisar Profissional';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="aluno-index">
    <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //     'id_profissional',
            'nm_profissional',
            'tp_registro',
            'nr_registro',
            [
                'attribute' => 'ds_ativo',
                'value' => function($model, $index) {
                    if ($model->ds_ativo == 1) {
                        return 'ATIVO';
                    } else {
                        return 'INATIVO';
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}',
            //  'visible' => Yii::$app->user->isGuest ? false : true,
            ],
        ],
    ]);
    ?>


</div>
