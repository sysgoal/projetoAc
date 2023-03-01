<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestePilatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teste-pilates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'dt_teste') ?>

    <?= $form->field($model, 'ds_001') ?>

    <?= $form->field($model, 'ds_002') ?>

    <?php // echo $form->field($model, 'ds_003') ?>

    <?php // echo $form->field($model, 'ds_004') ?>

    <?php // echo $form->field($model, 'ds_005') ?>

    <?php // echo $form->field($model, 'ds_observacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
