<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TurmaAluno */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Turma Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="turma-aluno-view">

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
            'id',
             [                
              'attribute'=>'id_aluno',              
              'value' => function($model, $index){
                $aluno = $model->getAlunoById($model->id_aluno);
                  return $aluno->nm_aluno;                
              },                    
              ],   
           [                
              'attribute'=>'id_turma',              
              'value' => function($model, $index){
                $turma = $model->getTurmaById($model->id_turma);
                  return $turma->nm_turma;                
              },                    
              ],           
        ],
    ]) ?>

</div>
