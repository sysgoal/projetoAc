<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EspecialidadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisar Especialidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especialidade-index">


<?= Html::a('Cadastrar', ['create'], ['class' => 'btn btn-success']) ?>
    <p>
        
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nm_especialidade',
            'nr_tempo_duracao',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>


