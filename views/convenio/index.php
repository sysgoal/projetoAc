<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConvenioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisar Convênio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convenio-index">



 <div class="form-group">
        <?= Html::a('Cadastrar', ['/convenio/create'], ['class' => 'btn btn-success']) ?>


    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'ds_nome',
            'nr_registro_ans',
         //   'cd_operadora',
         //   'vs_tiss',
        //    'tb_preco',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
   

</div>
