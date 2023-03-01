<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = 'Declaração';
$this->params['breadcrumbs'][] = ['label' => 'Realizar declaração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turma-aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aluno' => $aluno,
    ]) ?>

</div>
