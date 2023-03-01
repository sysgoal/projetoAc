<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FichaAluno */

$this->title = 'Atualizar ficha do aluno: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Ficha Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="ficha-aluno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
