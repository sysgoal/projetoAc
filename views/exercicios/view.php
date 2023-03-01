<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicios */

$this->title = $model->nm_exercicio;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="exercicios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'nm_exercicio',
            'cd_tipo_exercicio',            
            'cd_subtipo_exercicio',            
            [                
              'attribute'=>'id_especialidade',              
              'value' =>  $model->especialidade->nm_especialidade,                   
              ],
            
        ],
    ]) ?>

</div>
