<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TesteHofiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teste-hofi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dt_teste') ?>

    <?= $form->field($model, 'ds_tempo') ?>

    <?= $form->field($model, 'tp_nado') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?php // echo $form->field($model, 'ds_observacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
