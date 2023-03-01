<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Turma */

$this->title = $model->nm_turma;
$this->params['breadcrumbs'][] = ['label' => 'Turmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="turma-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_turma], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_turma], [
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
            'id_turma',
            'nm_turma',
            'ds_turno',
            'nr_vagas',
            'hr_inicio',
            'hr_fim',
             [                
              'attribute'=>'id_profissional',              
              'value' =>  $model->profissional->nm_profissional,                   
              ],
            [                
              'attribute'=>'id_profissional2',              
              'value' =>  function($model, $index) {
                            if( $model->profissional2 != null){
                        return  $model->profissional2->nm_profissional;
                    }
                }
              ],
            [                
              'attribute'=>'id_especialidade',              
              'value' =>  $model->especialidade->nm_especialidade, 
              ],
            
        ],
    ]) ?>

</div>
