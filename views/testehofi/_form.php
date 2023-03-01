<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\TesteHofi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teste-hofi-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="row">
       <div class="col-md-4">
     <?php $alunos = $model->getDataListAluno(); ?>
            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 350px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione um aluno-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>     
        </div>
        <div class="col-md-2">
             <?= $form->field($model, 'dt_teste', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>             
        </div>
 </div>
    <div class="row">       
     <div class="col-md-4">
    <?= $form->field($model, 'ds_tempo')->textInput(['style' => 'width:200px']) ?>
     </div>
     <div class="col-md-4">
    <?= $form->field($model, 'tp_nado')->textInput(['style' => 'width:200px']) ?>
     </div>
    </div>
    <div class="row">    
         <div class="col-md-6">
    <?= $form->field($model, 'ds_observacao')->textarea(['rows' => 6]) ?>
     </div>
   
 </div>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
