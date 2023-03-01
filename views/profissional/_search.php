 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfissionalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profissional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_profissional') ?>

    <?= $form->field($model, 'nm_profissional') ?>

    <?= $form->field($model, 'tp_registro') ?>

    <?= $form->field($model, 'nr_registro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
