<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Convenio */

$this->title = 'Atualizar Convênio: ' . $model->ds_nome;
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ds_nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="convenio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
