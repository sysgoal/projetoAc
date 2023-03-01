<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExerciciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicios-index">


     <?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            

            'cd_tipo_exercicio',
            'cd_subtipo_exercicio',
            'nm_exercicio',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
