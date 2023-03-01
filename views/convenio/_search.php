<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConvenioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="convenio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_convenio') ?>

    <?= $form->field($model, 'nr_registro_ans') ?>

    <?= $form->field($model, 'cd_operadora') ?>

    <?= $form->field($model, 'vs_tiss') ?>

    <?= $form->field($model, 'ds_nome') ?>

    <?php // echo $form->field($model, 'tb_preco') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
