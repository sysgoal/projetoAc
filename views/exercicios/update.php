<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicios */

$this->title = 'Atualizar Exercicios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nm_exercicio, 'url' => ['view', 'id' => $model->nm_exercicio]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="exercicios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
