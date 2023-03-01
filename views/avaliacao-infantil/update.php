<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoInfantil */

$this->title = 'Atualizar Avaliação Infantil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Infantil', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaliacao-infantil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
