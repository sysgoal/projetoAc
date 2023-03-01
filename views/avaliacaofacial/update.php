<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoFacial */

$this->title = 'Atualizar Avaliação Facial: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Facial', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="avaliacao-facial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'model' => $model, 'idAluno' =>$idAluno,'idAluno' => $idAluno, 'idProf' => $idProf,
    ]) ?>

</div>
