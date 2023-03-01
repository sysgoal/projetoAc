<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = 'Relatório';
$this->params['breadcrumbs'][] = ['label' => 'Emitir relatório', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aluno' => $aluno,
    ]) ?>

</div>
