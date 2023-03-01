<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-form">

     <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?php $items = $model->getDataListAluno(); ?>         
            <?=
            $form->field($model, 'id_aluno')->widget(Select2::classname(['maxlength' => true, 'style' => 'width:550px', 'id' => 'nome']), [
                'data' => $items, // the select option data items.The array keys are option values, and the array values are the corresponding option labels
                'options' => ['placeholder' => 'Selecione um aluno'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

        <div class="col-md-6">
            <?php $itemsProfissional = $model->getDataListProfissional(); ?>

            <?=
            $form->field($model, 'id_profissional')->widget(Select2::classname(['maxlength' => true, 'style' => 'width:200px']), [
                'data' => $itemsProfissional, // the select option data items.The array keys are option values, and the array values are the corresponding option labels
                'options' => ['placeholder' => 'Selecione um professor', 'id' => 'profissional'],
                'pluginOptions' => [
                    'allowClear' => true
                ],]);
            ?>
        </div>


    </div>

 <div class="row">
        <div class="col-md-12">
       <?= $form->field($model, 'ds_relatorio')->textarea(['style' => 'width:800px', 'rows' => 7]) ?>
        </div>
 </div>

   
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">                                
                <?= Html::submitButton('Gerar relatório', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div> 


    
  

    <?php ActiveForm::end(); ?>

</div>
