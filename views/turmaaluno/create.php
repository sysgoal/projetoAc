<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TurmaAluno */

$this->title = 'Cadastrar aluno na turma';
$this->params['breadcrumbs'][] = ['label' => 'Turma Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
