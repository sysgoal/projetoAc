<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nm_aluno') ?>

    <?= $form->field($model, 'ds_cpf') ?>

    <?= $form->field($model, 'dt_nascimento') ?>

    <?= $form->field($model, 'ds_sexo') ?>

    <?php // echo $form->field($model, 'ds_identidade') ?>

    <?php // echo $form->field($model, 'ds_responsaveis') ?>

    <?php // echo $form->field($model, 'ds_estado') ?>

    <?php // echo $form->field($model, 'ds_cidade') ?>

    <?php // echo $form->field($model, 'ds_endereco') ?>

    <?php // echo $form->field($model, 'ds_cep') ?>

    <?php // echo $form->field($model, 'ds_email') ?>

    <?php // echo $form->field($model, 'ds_profissao') ?>

    <?php // echo $form->field($model, 'ds_telefone1') ?>

    <?php // echo $form->field($model, 'ds_telefone2') ?>

    <?php // echo $form->field($model, 'ds_whatsapp') ?>

    <?php // echo $form->field($model, 'id_convenio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
