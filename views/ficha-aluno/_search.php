<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FichaAlunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ficha-aluno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_aluno') ?>

    <?= $form->field($model, 'id_profissional') ?>

    <?= $form->field($model, 'dt_ficha') ?>

    <?= $form->field($model, 'id_exercicio_1') ?>

    <?php // echo $form->field($model, 'id_exercicio_2') ?>

    <?php // echo $form->field($model, 'id_exercicio_3') ?>

    <?php // echo $form->field($model, 'id_exercicio_4') ?>

    <?php // echo $form->field($model, 'id_exercicio_5') ?>

    <?php // echo $form->field($model, 'id_exercicio_6') ?>

    <?php // echo $form->field($model, 'id_exercicio_7') ?>

    <?php // echo $form->field($model, 'id_exercicio_8') ?>

    <?php // echo $form->field($model, 'id_exercicio_9') ?>

    <?php // echo $form->field($model, 'id_exercicio_10') ?>

    <?php // echo $form->field($model, 'id_exercicio_11') ?>

    <?php // echo $form->field($model, 'id_exercicio_12') ?>

    <?php // echo $form->field($model, 'id_exercicio_13') ?>

    <?php // echo $form->field($model, 'id_exercicio_14') ?>

    <?php // echo $form->field($model, 'id_exercicio_15') ?>

    <?php // echo $form->field($model, 'id_exercicio_16') ?>

    <?php // echo $form->field($model, 'id_exercicio_17') ?>

    <?php // echo $form->field($model, 'id_exercicio_18') ?>

    <?php // echo $form->field($model, 'nr_repeticao1') ?>

    <?php // echo $form->field($model, 'nr_repeticao2') ?>

    <?php // echo $form->field($model, 'nr_repeticao3') ?>

    <?php // echo $form->field($model, 'nr_repeticao4') ?>

    <?php // echo $form->field($model, 'nr_repeticao5') ?>

    <?php // echo $form->field($model, 'nr_repeticao6') ?>

    <?php // echo $form->field($model, 'nr_repeticao7') ?>

    <?php // echo $form->field($model, 'nr_repeticao8') ?>

    <?php // echo $form->field($model, 'nr_repeticao9') ?>

    <?php // echo $form->field($model, 'nr_repeticao10') ?>

    <?php // echo $form->field($model, 'nr_repeticao11') ?>

    <?php // echo $form->field($model, 'nr_repeticao12') ?>

    <?php // echo $form->field($model, 'nr_repeticao13') ?>

    <?php // echo $form->field($model, 'nr_repeticao14') ?>

    <?php // echo $form->field($model, 'nr_repeticao15') ?>

    <?php // echo $form->field($model, 'nr_repeticao16') ?>

    <?php // echo $form->field($model, 'nr_repeticao17') ?>

    <?php // echo $form->field($model, 'nr_repeticao18') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
