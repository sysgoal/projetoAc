<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoInfantil */

$this->title = 'Realizar Avaliação Infantil';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Infantil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-infantil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
