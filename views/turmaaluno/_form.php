<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TurmaAluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="turma-aluno-form">
     <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?php $items = $model->getDataListAluno();?>         
         <?= $form->field($model, 'id_aluno')->widget(Select2::classname(), [
                                    'data' => $items,// the select option data items.The array keys are option values, and the array values are the corresponding option labels
                                    'options' => ['placeholder' => 'Selecione um aluno'],
                                    'pluginOptions' => [
                                                'allowClear' => true
                                                        ],
          ]); ?>
        </div>
       <div class="col-md-6">
           <?php $itemsTurma = $model->getDataListTurma();?>
          
           <?= $form->field($model, 'id_turma')->widget(Select2::classname(), [
             'data' => $itemsTurma,// the select option data items.The array keys are option values, and the array values are the corresponding option labels
             'options' => ['placeholder' => 'Selecione uma turma'],
             'pluginOptions' => [
            'allowClear' => true
            ], ]); ?>
        </div>
       
       
   </div>


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
