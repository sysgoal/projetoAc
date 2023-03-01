<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\FichaAluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ficha-aluno-form">
       
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?php $alunos = $model->getDataListAluno(); 
                  $professores = $model->getDataListProfissional(); 
                  $exercicios = $model->getDataListExercicios();
            ?>

            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' -- Selecione um aluno -- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>     
        </div>
        
        <div class="col-md-6">       
            <?=
            $form->field($model, 'id_profissional', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id_profissional',
                'data' => $professores,
                'options' => ['placeholder' => ' -- Selecione um profissional -- ', 'id' => 'al02'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>     
        </div>
    </div>

    
     <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_1', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e1'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao1')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_2', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e2'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao2')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

<div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_3', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e3'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao3')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
   
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_4', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e4'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao4')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

<div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_5', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e5'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao5')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
   
    
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_6', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e6'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao6')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

    
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_7', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e7'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao7')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
    
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_8', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e8'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao8')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
    
    
<div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_9', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e9'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao9')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
    
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_10', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e10'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao10')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

   <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_11', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e11'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao11')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>
    
    <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_12', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e12'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao12')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

  <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_13', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e13'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao13')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

<div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_14', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e14'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao14')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

   <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_15', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e15'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao15')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

   <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_16', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e16'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao16')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>

   <div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_17', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e17'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao17')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div><div class="row">
         <div class="col-md-6">
              <?=
            $form->field($model, 'id_exercicio_18', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $exercicios,
                'options' => ['placeholder' => ' -- Selecione um Exercício -- ', 'id' => 'e18'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>   
             
         </div>
          <div class="col-md-6">
               <?= $form->field($model, 'nr_repeticao18')->textInput(['style' => 'width: 150px']) ?>
             
         </div>
        
     </div>


    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
