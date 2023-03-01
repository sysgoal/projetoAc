<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FichaAluno */

$this->title = 'Criar Ficha do Aluno';
$this->params['breadcrumbs'][] = ['label' => 'Ficha Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
