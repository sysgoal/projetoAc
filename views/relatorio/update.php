<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */

$this->title = 'Atualizar Relatorio: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Relatorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="relatorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
