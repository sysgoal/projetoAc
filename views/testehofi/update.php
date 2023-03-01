<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesteHofi */

$this->title = 'Atualizar Teste HOFI: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Teste Hofi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->aluno->nm_aluno]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="teste-hofi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
