<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BoletimInfantilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="boletim-infantil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ds_cor_touca') ?>

    <?= $form->field($model, 'ds_atv1') ?>

    <?= $form->field($model, 'ds_atv2') ?>

    <?= $form->field($model, 'ds_atv3') ?>

    <?php // echo $form->field($model, 'ds_atv4') ?>

    <?php // echo $form->field($model, 'ds_atv5') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'id_aluno') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
