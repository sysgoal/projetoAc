<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TurmaAluno */

$this->title = 'Atualizar Turma Aluno: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Turma Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="turma-aluno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
