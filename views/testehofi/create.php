<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesteHofi */

$this->title = 'Cadastrar Teste HOFI';
$this->params['breadcrumbs'][] = ['label' => 'Teste Hofi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-hofi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
