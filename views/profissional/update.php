<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profissional */

$this->title = 'Atualizar Profissional: ' . $model->nm_profissional;
$this->params['breadcrumbs'][] = ['label' => 'Profissionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nm_profissional, 'url' => ['view', 'id' => $model->id_profissional]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="profissional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
