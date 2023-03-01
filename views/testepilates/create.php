<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestePilates */

$this->title = 'Cadastrar teste pilates';
$this->params['breadcrumbs'][] = ['label' => 'Teste pilates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-pilates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
