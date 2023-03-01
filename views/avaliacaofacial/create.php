<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoFacial */

$this->title = 'Realizar Avaliação Facial';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Facial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-facial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'idAluno' =>$idAluno,'idAluno' => $idAluno, 'idProf' => $idProf,
    ]) ?>

</div>
