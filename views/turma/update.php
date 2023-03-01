<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Turma */

$this->title = 'Atualizar Turma: ' . $model->nm_turma;
$this->params['breadcrumbs'][] = ['label' => 'Turmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nm_turma, 'url' => ['view', 'id' => $model->id_turma]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="turma-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
