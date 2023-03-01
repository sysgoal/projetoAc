<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BoletimInfantil */

$this->title = 'Atualizar Festa das Toucas: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Boletim Infantil', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="boletim-infantil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'situacao'=> $situacao,
        'model2' => $model2,
    ]) ?>

</div>
