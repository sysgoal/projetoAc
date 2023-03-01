<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BoletimInfantil */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Festa das Toucas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="boletim-infantil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'template' => "<tr><th  style='width:300px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'id',
            'data',
            [
                'attribute' => 'id_profissional',
                'value' => function($model, $index) {
                    return $model->profissional->nm_profissional;
                },
            ],
            [
                'attribute' => 'id_aluno',
                'value' => function($model, $index) {
                    return $model->aluno->nm_aluno;
                },
            ],
            'ds_cor_touca',
            [
                'attribute' => $model->ds_atv1,
                'value' => function($model, $index) {
                    if($model->peixe1 != null){
                        return $model->peixe1;
                    }else if($model->caixa1 != null){
                        return $model->caixa1;
                    }else{
                        return 'Não Fez';
                    }
                },
            ],
            [
                'attribute' => $model->ds_atv2,
                'value' => function($model, $index) {
                     if($model->peixe2 != null){
                        return $model->peixe2;
                    }else if($model->caixa2 != null){
                        return $model->caixa2;
                    }else{
                        return 'Não Fez';
                    }
                },
            ],
            [
                'attribute' => $model->ds_atv3,
                'value' => function($model, $index) {
                     if($model->peixe3 != null){
                        return $model->peixe3;
                    }else if($model->caixa3 != null){
                        return $model->caixa3;
                    }else{
                        return 'Não Fez';
                    }
                },
            ],
            [
                'attribute' => $model->ds_atv4,
                'value' => function($model, $index) {
                     if($model->peixe4 != null){
                        return $model->peixe4;
                    }else if($model->caixa4 != null){
                        return $model->caixa4;
                    }else{
                        return 'Não Fez';
                    }
                },
            ],
            [
                'attribute' => $model->ds_atv5,
                'value' => function($model, $index) {
                     if($model->peixe5 != null){
                        return $model->peixe5;
                    }else if($model->caixa5 != null){
                        return $model->caixa5;
                    }else{
                        return 'Não Fez';
                    }
                },
            ],
        ],
    ])
    ?>

</div>
